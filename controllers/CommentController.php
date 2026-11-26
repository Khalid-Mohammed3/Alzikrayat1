<?php

require_once __DIR__ . '/../models/Comment.php';
require_once __DIR__ . '/../models/Photo.php';

class CommentController extends Controller
{
    private $commentModel;
    private $photoModel;

    public function __construct()
    {
        $this->commentModel = new Comment();
        $this->photoModel = new Photo();
    }

    // Add comment
    public function store($photoId)
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /alzikrayat/public/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Method Not Allowed');
        }

        $photo = $this->photoModel->findById($photoId);

        if (!$photo) {
            http_response_code(404);
            exit('Photo not found.');
        }

        $comment = trim($_POST['comment'] ?? '');

        if ($comment === '' || strlen($comment) > 1000) {
            exit('Comment must be between 1 and 1000 characters.');
        }

        $this->commentModel->create([
            'photo_id' => $photoId,
            'user_id' => $_SESSION['user_id'],
            'comment' => $comment
        ]);

        header("Location: /alzikrayat/public/photo/" . (int)$photoId);
        exit;
    }

    // Delete comment
    public function delete($id)
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /alzikrayat/public/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Method Not Allowed');
        }

        $comment = $this->commentModel->findById($id);

        if (!$comment) {
            http_response_code(404);
            exit('Comment not found.');
        }

        if ($comment['user_id'] != $_SESSION['user_id']) {
            http_response_code(403);
            exit('You cannot delete this comment.');
        }

        $this->commentModel->delete(
            $id,
            $_SESSION['user_id']
        );

        header(
            "Location: /alzikrayat/public/photo/"
            . (int)$comment['photo_id']
        );
        exit;
    }
}