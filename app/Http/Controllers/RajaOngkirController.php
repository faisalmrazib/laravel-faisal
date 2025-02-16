<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class RajaOngkirController extends Controller
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = 'your-api-key'; // Ganti dengan API Key Anda
        $this->baseUrl = 'https://api.rajaongkir.com/starter';
    }

    // Fungsi untuk mendapatkan daftar provinsi
    public function getProvinces()
    {
        $client = new Client();
        $response = $client->get($this->baseUrl . '/province', [
            'headers' => [
                'key' => $this->apiKey,
            ],
        ]);

        $result = json_decode($response->getBody(), true);
        return response()->json($result);
    }

    // Fungsi untuk mendapatkan daftar kota berdasarkan provinsi
    public function getCities($provinceId)
    {
        $client = new Client();
        $response = $client->get($this->baseUrl . '/city', [
            'headers' => [
                'key' => $this->apiKey,
            ],
            'query' => [
                'province' => $provinceId,
            ],
        ]);

        $result = json_decode($response->getBody(), true);
        return response()->json($result);
    }

    // Fungsi untuk cek ongkir
    public function checkShippingCost(Request $request)
    {
        $client = new Client();
        $response = $client->post($this->baseUrl . '/cost', [
            'headers' => [
                'key' => $this->apiKey,
            ],
            'form_params' => [
                'origin' => $request->origin, // ID kota asal
                'destination' => $request->destination, // ID kota tujuan
                'weight' => $request->weight, // Berat dalam gram
                'courier' => $request->courier, // Kode kurir (jne, tiki, pos)
            ],
        ]);

        $result = json_decode($response->getBody(), true);
        return response()->json($result);
    }
}