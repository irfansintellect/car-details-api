<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreRequest;
use App\Mail\SendVehicleDetailEmail;
use App\Models\Pcp;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class CarDetailController extends Controller
{
    public function searchDetails(SearchRequest $request)
    {
        $data = $request->validated();
        $regno = $data['regno'];
        $url = env('API_URL');
        $apiKey = env('API_KEY');

        try {
            $response = Http::withHeaders([
                'x-api-key' => $apiKey,
            ])->post($url, [
                'registrationNumber' => $regno,
            ])->json();

            return response()->json($response, 201);
        } catch (\Exception $e) {
            return response()->json('An unknown error occurred. Please try again later.', 500);
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
