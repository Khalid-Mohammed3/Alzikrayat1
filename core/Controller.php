<?php

class Controller {

    protected function view($view, $data = []) {

        extract($data);

        $file = __DIR__ . '/../views/' . $view . '.php';

        if (file_exists($file)) {

            require __DIR__ . '/../views/layout/header.php';

            require $file;

            require __DIR__ . '/../views/layout/footer.php';

        } else {

            http_response_code(404);
            echo "View not found!";

        }
    }
}