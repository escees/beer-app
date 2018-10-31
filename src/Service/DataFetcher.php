<?php

declare(strict_types=1);

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DataFetcher
{
    private $dataImporter;

    public function __construct(DataImporter $dataImporter)
    {
        $this->dataImporter = $dataImporter;
    }

    public function fetch()
    {
        $guzzleClient = new Client();
        /** @var GuzzleResponse $response */
        try {
            $response = $guzzleClient->request('GET', 'http://ontariobeerapi.ca/beers/');
        } catch (GuzzleException $exception) {
            return new JsonResponse(
                ['message' => $exception->getMessage()],
                JsonResponse::HTTP_NOT_FOUND
            );
        }

        if (Response::HTTP_OK === $response->getStatusCode()){
            return $this->dataImporter->import($response->getBody());
        }

        return false;
    }
}