<?php

namespace App\Component;

class GoogleSearch
{

    const API_KEY = "AIzaSyAknDLDERHIqn7z2B0S8fU2eMIYjdJywNw";
    const ENGINE_ID = "006382242660553458173:lljrviqtw08";

    private $service;
    private $params;

    public function __construct()
    {
        $client = new \Google_Client();
        $client->setApplicationName("SearchApp");
        $client->setDeveloperKey(self::API_KEY);

        $this->service = new \Google_Service_Customsearch($client);

        $this->params = [
            'cx' => self::ENGINE_ID
        ];
    }

    public function search(string $searchTerm, int $start = 0): array
    {
        if ($start !== 0) {
            $this->params['start'] = $start;
        }

        $results = $this->service->cse->listCse($searchTerm, $this->params);
        $info = $results->getSearchInformation();

        return [
            'items' => $results->getItems(),
            'count' => $info["totalResults"]
        ];
    }

}
