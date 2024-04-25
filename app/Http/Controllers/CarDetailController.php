<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreRequest;
use App\Mail\SendVehicleDetailEmail;
use App\Models\Pcp;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

        // $url = "https://driver-vehicle-licensing.api.gov.uk/vehicle-enquiry/v1/vehicles";
        // $key = "cJYFpTF7Db8zonDMVCaKuxS9N0OWFElaBq6kMcK5";

        // dd($url);

        // $reference = explode(",",$request->ids);

        try {
            // $response = $client->request('POST', $url, [
            //     'headers' => [
            //         'Content-Type' => 'application/json',
            //         'x-api-key' => $key
            //     ],
            //     'json' => [
            //         'registrationNumber' => $regno
            //     ],
            // ]);

            $response = $client->post($url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'x-api-key' => $key
                ],
                'json' => [
                    'registrationNumber' => $regno
                ],
            ]);
            $data = $response->getBody()->getContents();
            $car_data = json_decode($data);

            // dd($car_data);

            // $curl_post_data = [
            //     'registrationNumber' => $regno
            // ];
            // // $url = "'http://127.0.0.1:8000/services/update";
            // $data = json_encode($curl_post_data);
            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_URL, $url);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'x-api-key:' . $key));
            // $data = curl_exec($ch);

            // $car_data = json_decode($data, true);

            $sessionData = Session::get('car_data');
            if ($sessionData) {
                Session::forget('car_data');
            }
            Session::put('car_data', $car_data);
            Session::forget('search_error');

            return redirect()->to(route('home'));
        } catch (ClientException $e) {
            $response = $e->getResponse();
            Session::flash('search_error', 'Registration not found: ' . $regno);
            return back();
        }
    }

    public function storeClaim(StoreRequest $request)
    {
        $data = $request->validated();

        Pcp::create($request->all());
        $email = new SendVehicleDetailEmail($request->all());
        Mail::send($email);
        return to_route('thank-you');
    }

    public function thankYou()
    {
        return Inertia::render('Pcp/ThankYou');
    }
}
