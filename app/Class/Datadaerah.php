<?php

namespace App\Class;

class Datadaerah
{
    protected $url = 'https://wilayah.id/api/';

    protected $client;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    public function getProvinces()
    {
        $response = $this->client->get($this->url . 'provinces.json');

        return json_decode($response->getBody()->getContents());
    }

    public function getCities($province_id)
    {
        $response = $this->client->get($this->url . 'regencies/' . $province_id . '.json');

        return json_decode($response->getBody()->getContents());
    }

    public function searchProvince($province_name)
    {
        $provinces = $this->getProvinces();

        return collect($provinces->data)->firstWhere('name', $province_name);
    }

    public function searchCity($province_code, $city_name)
    {
        $cities = $this->getCities($province_code);

        return collect($cities->data)->firstWhere('name', $city_name);
    }
}
