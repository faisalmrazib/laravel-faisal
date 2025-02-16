<?php
namespace App\Services;

use GuzzleHttp\Client;

class RajaOngkirService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.rajaongkir.com/starter/',
        ]);
        $this->apiKey = env('RAJAONGKIR_API_KEY');
    }

    public function getProvinces()
    {
        $response = $this->client->get('province', [
            'headers' => [
                'key' => $this->apiKey,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getCities($provinceId)
    {
        $response = $this->client->get('city', [
            'headers' => [
                'key' => $this->apiKey,
            ],
            'query' => [
                'province' => $provinceId,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getCost($origin, $destination, $weight, $courier)
    {
        $response = $this->client->post('cost', [
            'headers' => [
                'key' => $this->apiKey,
            ],
            'form_params' => [
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}