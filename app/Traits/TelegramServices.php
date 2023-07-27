<?php
namespace App\Traits;

trait TelegramServices
{

    public function makeRequest($method,$requestUrl,  $queryParams =[], $formParams = [], $headers = [])
    {
        $botToken= "/bot1020334382:AAFf4MJ_xdbhAfE31n5zYqMD4N9eohNGdek";
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.telegram.org' ]);
        $response = $client->request( $method, $botToken . $requestUrl, [
            'query' => $queryParams,
            'form_params' => $formParams,
            'headers' => $headers,
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
