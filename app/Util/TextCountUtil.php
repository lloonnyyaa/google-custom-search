<?php

namespace App\Util;

use Html2Text\Html2Text;

class TextCountUtil
{

    public function addCount(array $results)
    {
        foreach ($results as $key => $result) {
            $count = str_word_count($this->getContent($result['link']), 0);
            $results[$key]['words_count'] = $count;
        }

        return $results;
    }

    private function getContent(string $url)
    {
        $options = array(
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
        );

        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $content = curl_exec($ch);
        curl_close($ch);

        $html = new Html2Text($content);

        return $html->getText();
    }

}
