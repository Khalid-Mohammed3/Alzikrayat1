<?php

require_once __DIR__ . '/../models/User.php';

class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    /**
     * Display registration page
     */
    public function register()
    {
        $this->view('auth/register');
    }

    /**
     * Process registration form.
     */
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Method Not Allowed');
        }

        $firstName = trim($_POST['first_name'] ?? '');
        $lastName = trim($_POST['last_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

      if (!preg_match('/^[\p{L}\p{M}\s-]{2,50}$/u', $firstName)) {
    exit('Error: First Name is invalid');
}
if (!preg_match('/^[\p{L}\p{M}\s-]{2,50}$/u', $lastName)) {
    exit('Error: Last Name is invalid');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit('Error: Email is invalid');
}

if (strlen($password) < 8) {
    exit('Error: Password must be at least 8 characters');
}

        if ($this->userModel->findByEmail($email)) {
            exit('Email already exists!');
        }

        $hashedPassword = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        $this->userModel->create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password' => $hashedPassword
        ]);

        header('Location: /alzikrayat/public/login');
        exit;
    }

    /**
     * Display login page.
     */
    public function login()
    {
        $this->view('auth/login');
    }

    /**
     * Process login form.
     */
    public function authenticate()
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = $this->userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {

            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];

            setcookie(
                'last_login',
                date('Y-m-d H:i:s'),
                time() + (7 * 24 * 60 * 60),
                '/alzikrayat/public/'
            );

            header('Location: /alzikrayat/public/');
            exit;
        }

        exit('Invalid email or password.');
    }

    /**
     * Log out the current user.
     */
    public function logout()
    {
        session_unset();
        session_destroy();

        header('Location: /alzikrayat/public/login');
        exit;
    }
}