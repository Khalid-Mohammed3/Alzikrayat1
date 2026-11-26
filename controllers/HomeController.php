<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Photo.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Comment.php';

class HomeController extends Controller {

    private $photoModel;
    private $userModel;
    private $commentModel;

    public function __construct() {

        $this->photoModel = new Photo();
        $this->userModel = new User();
        $this->commentModel = new Comment();
    }

    public function index() {

        $photos = $this->photoModel->getAll();

        $this->view('home', [
            'photos' => $photos,
            'usersCount' => $this->userModel->countAll(),
            'photosCount' => $this->photoModel->countAll(),
            'commentsCount' => $this->commentModel->countAll()
        ]);
    }

    public function about() {

        $this->view('about');
    }
}