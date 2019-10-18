<?php

namespace App\Controller;

use App\Component\GoogleSearch;

class FrontController
{

    public function index()
    {
        $searchTerm = filter_input(INPUT_GET, 'q');
        $submited = !is_null($searchTerm);

        if ($submited) {
            $engine = new GoogleSearch();

            $page = filter_input(INPUT_GET, 'p');
            if (!is_null($page)) {
                $start = $page * 10 + 1;
            }

            $results = $engine->search($searchTerm, $start ?? 0);
        }
        
        echo $this->render('index', [
            'results' => $results['items'] ?? null,
            'pages' => $results['count'] ? $results['count'] / 10 : null
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
