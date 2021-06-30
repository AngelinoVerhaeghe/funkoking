<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalServices
{
    //Wat zal er binnen komen vanuit de makeRequest
    public function makeRequest($method, $requestUrl, $queryParams = [], $formParams = [], $headers = [], $isJsonRequest = false)
    {

        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        if (method_exists($this, 'resolveAuthorization')) {
            $this->resolveAuthorization($queryParams, $formParams, $headers);
        }

        //Op de API van de client
        $response = $client->request($method, $requestUrl, [
            //Is het een json request? Ja dan gaan we de form parameters ophalen in paypalservice
            $isJsonRequest ? 'json' : 'form_params' => $formParams,
            'headers' => $headers,
            'query' => $queryParams,
        ]);

        //Alle waarden hier in $response
        $response = $response->getBody()->getContents();

        //Decodering van json naar normaal formaat
        if (method_exists($this, 'decodeResponse')) {
            $response = $this->decodeResponse($response);
        }

        return $response;
    }
}
