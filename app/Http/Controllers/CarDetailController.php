<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreRequest;
use App\Models\Pcp;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class CarDetailController extends Controller
{
    public function searchDetails(SearchRequest $request)
    {
        $data = $request->validated();
        $regno = $data['regno'];

        $client  = new Client();
        $url = env('API_URL');
        $key = env('API_KEY');

        try {

            $response = $client->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'x-api-key' => $key
                ],
                'json' => [
                    'registrationNumber' => $regno
                ],

            ]);
            $data = $response->getBody()->getContents();
            $car_data = json_decode($data);

            Session::put('car_data', $car_data);
            Session::forget('search_error');

            return back();
        } catch (ClientException $e) {
            $response = $e->getResponse();
            Session::flash('search_error', 'Failed to search registration number: ' . $regno);
            return back();
        }
    }

    public function storeClaim(StoreRequest $request)
    {
        $data = $request->validated();

        // TODO
        Pcp::create($request->all());

        return back();
    }

    public function thankYou()
    {
        return Inertia::render('ThankYou');
    }
}
