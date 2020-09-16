<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class PksController extends Controller
{
    public function index(Request $request){
        return view('pks');
    }

    public function show(Request $request){
        $endPoint = 'api/fetch-pks';
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $request->session()->get('tokenJwt'),
        ])->post(env('BACKEND_URL').$endPoint,
            [
                'page' => $request->page,
                'rows' => $request->rows,
            ]
        );

        echo $response->body();
    }

    public function destroy(Request $request){
        $endPoint = 'api/destroy-pks';
        $response = Http::withHeaders([
            //'Authorization' => 'Bearer ' . $request->session()->get('tokenJwt'),
            'Authorization' => 'Bearer ' . $request->session()->get('tokenJwt'),
        ])->post(env('BACKEND_URL').$endPoint,
            [
                'id' => $request->id,
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
            'Authorization' => 'Bearer ' . $request->session()->get('tokenJwt'),
        ])->post(env('BACKEND_URL').$endPoint,
            [
                'agreement_number' => $request->agreement_number,
                'pks_name' => $request->pks_name,
                'npwp_number' => $request->npwp_number,
                'siup_number' => $request->siup_number,
                'address' => $request->address,
                'telephone' => $request->telephone,
                'fax' => $request->fax,
                'province_code' => $request->province_code,
                'city_code' => $request->city_code,
                'district_code' => $request->district_code,
                'sub_district_code' => $request->sub_district_code,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]
        );

        $response = json_decode($response->body());
        //echo $response;
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
        $response = $client->request('GET', env('BACKEND_URL').$endPoint);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();
        echo $body;
    }

    public function getCities(Request $request){
        $endPoint = 'api/fetch-cities';
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $request->session()->get('tokenJwt'),
        ])->post(env('BACKEND_URL').$endPoint,
            [
                'code' => $request->code,
            ]
        );

        echo $response->body();
    }

    public function getDistricts(Request $request){
        $endPoint = 'api/fetch-districts';
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $request->session()->get('tokenJwt'),
        ])->post(env('BACKEND_URL').$endPoint,
            [
                'code' => $request->code,
            ]
        );

        echo $response->body();
    }

    public function getSubDistricts(Request $request){
        $endPoint = 'api/fetch-subDistricts';
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $request->session()->get('tokenJwt'),
        ])->post(env('BACKEND_URL').$endPoint,
            [
                'code' => $request->code,
            ]
        );

        echo $response->body();
    }

    public function getTbsPrices(Request $request){
        $endPoint = 'api/fetch-tbs-prices';
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $request->session()->get('tokenJwt'),
        ])->post(env('BACKEND_URL').$endPoint,
            [
                'page' => $request->page,
                'rows' => $request->rows,
                'pks_id' => $request->pksId
            ]
        );

        echo $response->body();
    }

    public function createTbsPrice(Request $request){
        $price_date_old = $request->price_date;
        $price_date = date("Y-m-d", strtotime($price_date_old));
        $fields = array(
            'pks_id' => htmlspecialchars($request->pks_id),
            'price_date' => htmlspecialchars($price_date),
            'price' => htmlspecialchars($request->price),
            'price_unit' => htmlspecialchars($request->price_unit),
            'status' => htmlspecialchars($request->status),
        );

        $endPoint = 'api/create-tbs-price';
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $request->session()->get('tokenJwt'),
        ])->post(env('BACKEND_URL').$endPoint,
            [
                'pks_id' => $fields['pks_id'],
                'price_date' => $price_date,
                'price' => $fields['price'],
                'price_unit' => $fields['price_unit'],
                'status' => $fields['status'],
            ]
        );

        $response = json_decode($response->body());
        if($response->status == 'success') {
            echo json_encode($response->data);
        }
    }


}
