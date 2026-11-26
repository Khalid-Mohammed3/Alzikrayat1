<?php

require_once __DIR__ . '/../models/Photo.php';
require_once __DIR__ . '/../models/Comment.php';

/**
 * PhotoController
 * Handles photo display, upload, details, and deletion.
 */
class PhotoController extends Controller
{
    private $photoModel;

    /**
     * Initialize the Photo Model.
     */
    public function __construct()
    {
        $this->photoModel = new Photo();
    }

    /**
     * Ensure that the user is logged in.
     */
    private function checkLogin()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /alzikrayat/public/login');
            exit;
        }
    }

    /**
     * Display all photos in the gallery.
     */
    public function index()
    {
        $photos = $this->photoModel->getAll();

        $this->view('photos/gallery', [
            'photos' => $photos
        ]);
    }

    /**
     * Display the photo upload form.
     */
    public function uploadForm()
    {
        $this->checkLogin();
        $this->view('photos/upload');
    }

    /**
     * Validate and upload a photo.
     */
    public function store()
    {
        $this->checkLogin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Method Not Allowed');
        }

        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (
            $title === '' ||
            mb_strlen($title) > 200 ||
            !isset($_FILES['photo']) ||
            $_FILES['photo']['error'] !== UPLOAD_ERR_OK
        ) {
            exit('Invalid photo or title.');
        }

        $file = $_FILES['photo'];

        if ($file['size'] > 5 * 1024 * 1024) {
            exit('Maximum file size is 5 MB.');
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file['tmp_name']);

        $allowed = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp'
        ];

        if (!isset($allowed[$mime])) {
            exit('Only JPG, PNG, GIF and WEBP images are allowed.');
        }

        $fileName = bin2hex(random_bytes(16))
                    . '.' . $allowed[$mime];

        $uploadDir = __DIR__ . '/../public/images/uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (!move_uploaded_file(
            $file['tmp_name'],
            $uploadDir . $fileName
        )) {
            exit('Failed to upload image.');
        }

        try {
            $this->photoModel->create([
                'user_id' => $_SESSION['user_id'],
                'file_name' => $fileName,
                'title' => $title,
                'description' => $description
            ]);
        } catch (PDOException $e) {
            $filePath = $uploadDir . $fileName;

            if (is_file($filePath)) {
                unlink($filePath);
            }

            error_log($e->getMessage());
            http_response_code(500);
            exit('Could not save photo information.');
        }

        header('Location: /alzikrayat/public/gallery');
        exit;
    }

    /**
     * Display a photo with its comments.
     *
     * @param int $id Photo ID.
     */
    public function show($id)
    {
        $photo = $this->photoModel->findById($id);

        if (!$photo) {
            http_response_code(404);
            exit('Photo not found.');
        }

        $commentModel = new Comment();
        $comments = $commentModel->getByPhoto($id);

        $this->view('photos/details', [
            'photo' => $photo,
            'comments' => $comments
        ]);
    }

    /**
     * Delete a photo after verifying its ownership.
     *
     * @param int $id Photo ID.
     */
    public function delete($id)
    {
        $this->checkLogin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Method Not Allowed');
        }

        $photo = $this->photoModel->findById($id);

        if (!$photo || $photo['user_id'] != $_SESSION['user_id']) {
            http_response_code(403);
            exit('You cannot delete this photo.');
        }

        $deleted = $this->photoModel->delete(
            $id,
            $_SESSION['user_id']
        );

        if ($deleted) {
            $filePath = __DIR__ . '/../public/images/uploads/'
                        . $photo['file_name'];

            if (is_file($filePath)) {
                unlink($filePath);
            }
        }

        header('Location: /alzikrayat/public/gallery');
        exit;
    }
}