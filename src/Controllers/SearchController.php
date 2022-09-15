<?php

namespace IdTravel\Challenge\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use IdTravel\Challenge\Providers\Hotels\HotelProviderId90Travel;

class SearchController
{
    private HotelProviderId90Travel $hotelProvider;

    public function __construct()
    {
        session_start();
        if (!isset($_SESSION['session'])) {
            header("Location: http://localhost:8881/login", TRUE, 301);
            exit();
        }
        $this->hotelProvider = new HotelProviderId90Travel();
    }

    public function search(): void
    {
        try {
            $params = array_merge($_GET);
            $content = $this->hotelProvider->search($params);
            $data = [
                'member' => $_SESSION['session']->member,
                'results' => $content['hotels'],
                'pagination' => [
                    'page' => $content['meta']['page'],
                    'total' => $content['meta']['total_pages'],
                    'url' => 'http://localhost:8881/search?' . http_build_query($params)
                ],
                'olds' => [
                    'destination' => $params['destination'] ?? '',
                    'checkin' => $params['checkin'] ?? '',
                    'checkout' => $params['checkout'] ?? '',
                    'guests' => $params['guests'] ?? '',
                ]
            ];
            echo view('search', $data);
        } catch (GuzzleException $e) {
            $data = [
                'error' => 'Error interno. Intente mas tarde.',
                'member' => $_SESSION['session']->member,
                'olds' => [
                    'destination' => $params['destination'] ?? '',
                    'checkin' => $params['checkin'] ?? '',
                    'checkout' => $params['checkout'] ?? '',
                    'guests' => $params['guests'] ?? '',
                ]
            ];
            if (count($params) > 0) {
                $data['results'] = [];
            }
            echo view('search', $data);
        } catch (\Exception $e) {
            $data = [
                'error' => $e->getMessage(),
                'member' => $_SESSION['session']->member,
                'olds' => [
                    'destination' => $params['destination'] ?? '',
                    'checkin' => $params['checkin'] ?? '',
                    'checkout' => $params['checkout'] ?? '',
                    'guests' => $params['guests'] ?? '',
                ]
            ];
            if (count($params) > 0) {
                $data['results'] = [];
            }
            echo view('search', $data);
        }

    }
}