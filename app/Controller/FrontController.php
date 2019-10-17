<?php

namespace App\Controller;

use App\Component\GoogleSearch;

class FrontController
{

    public function index()
    {
        $searchTerm = filter_input(INPUT_POST, 'q');
        $submited = !is_null($searchTerm);

        if ($submited) {
            $engine = new GoogleSearch();
            $results = $engine->search($searchTerm);
        }

        echo $this->render('index', [
            'results' => $results ?? null
        ]);
    }

    private function render($view, $params = [])
    {
        $file = $_SERVER['DOCUMENT_ROOT'] . 'app' . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . $view . '.php';

        if (file_exists($file)) {
            ob_start();
            ob_implicit_flush(false);
            extract($params, EXTR_OVERWRITE);
            require($file);

            return ob_get_clean();
        } else {
            return '';
        }
    }

}
