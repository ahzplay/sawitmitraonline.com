<?php


namespace App\libs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CallService extends Controller
{
    private $url;

    public function __construct()
    {}

    public function testing() {
        return 'For Testing';
    }

    public function post() {
        $endpoint = "http://localhost:8000/api/get-provinces";
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', $endpoint);

        $statusCode = $response->getStatusCode();
        $content = $response->getBody();

        return $content;
    }
}
