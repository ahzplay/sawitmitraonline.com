<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class PksController extends Controller
{
    public function index(){
        return view('pks');
    }

    public function show(Request $request){
        $endPoint = 'api/fetch-pks';
        $response = Http::withHeaders([
            'Authorization' => 'foo',
        ])->post(env('BACKEND_URL_LOCAL').$endPoint,
            [
                'page' => $request->page,
                'rows' => $request->rows,
            ]
        );

        echo $response->body();
    }

    public function create(Request $request){
        $result = array();
        $validator = Validator::make($request->all(),
            [
                'pks_name' => 'required',
            ],
            [
                'pks_name.required' => 'PKS Name cannot be empty.',
            ]
        );

        if($validator->fails()){
            return response()->json(array(
                'status'=>false,
                'message'=>$validator->errors()->first()
            ), 400);
        }

        $endPoint = 'api/create-pks';
        $response = Http::withHeaders([
            'Authorization' => 'foo',
        ])->post(env('BACKEND_URL_LOCAL').$endPoint,
            [
                'agreement_number' => $request->agreement_number,
                'pks_name' => $request->pks_name,
                'npwp_number' => $request->npwp_number,
                'siup_number' => $request->siup_number,
                'address' => $request->address,
                'telephone' => $request->telephone,
                'fax' => $request->fax,
                'province' => $request->province,
                'city' => $request->city,
                'district' => $request->district,
                'sub_district' => $request->sub_district,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]
        );

        $response = json_decode($response->body());
        if($response->status == 'success')
            $result['status'] = true;
        else {
            $result['status'] = false;
            $result['message'] = $response->message;
        }

        return $result;
    }

    public function getProvinces(){
        $client = new \GuzzleHttp\Client();
        $endPoint = 'api/fetch-provinces';
        $response = $client->request('GET', env('BACKEND_URL_LOCAL').$endPoint);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();
        echo $body;
    }

    public function getCities(Request $request){
        $client = new \GuzzleHttp\Client();
        $endPoint = 'api/fetch-cities';
        $response = $client->request(
            'POST',
            env('BACKEND_URL_LOCAL').$endPoint,
            ['query' => [
                'code' => $request->code,
            ]]
        );
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();
        echo $body;
    }

    public function getDistricts(Request $request){
        $client = new \GuzzleHttp\Client();
        $endPoint = 'api/fetch-districts';
        $response = $client->request(
            'POST',
            env('BACKEND_URL_LOCAL').$endPoint,
            ['query' => [
                'code' => $request->code,
            ]]
        );
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();
        echo $body;
    }

    public function getSubDistricts(Request $request){
        $client = new \GuzzleHttp\Client();
        $endPoint = 'api/fetch-subDistricts';
        $response = $client->request(
            'POST',
            env('BACKEND_URL_LOCAL').$endPoint,
            ['query' => [
                'code' => $request->code,
            ]]
        );
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();
        echo $body;
    }


}
