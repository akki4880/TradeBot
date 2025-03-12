<?php

namespace App\Http\Controllers;

use App\Models\TradeBot;
use Illuminate\Http\Request;

class TradeBotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("trade.index");
    }



    public function getalltrade()
    {
        $url = 'https://api.dhan.co/v2/trades';
        $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJkaGFuIiwicGFydG5lcklkIjoiIiwiZXhwIjoxNzMwMjg4OTM5LCJ0b2tlbkNvbnN1bWVyVHlwZSI6IlNFTEYiLCJ3ZWJob29rVXJsIjoiIiwiZGhhbkNsaWVudElkIjoiMTEwNDY1Mzc0NyJ9.jniyg-NAJw0W0myoeNSmW9Eq2aczLPf5K9ZJmVkaaD6bRW7qxr9N8gfXYnWyQrU_nW7Jhx6Wvhflber3LWb_qg';


        $response = Http::withHeaders([
            'access-token' => $accessToken,
        ])->get($url);

        //dd($response->status(), $response->body(), $response->headers())

        // Check if the response is successful
        if ($response->successful()) {
            $data = $response->json();
            //dd($data);
            return view('trade.index', ['data' => $data]);
        } else {
            return response()->json(['error' => 'API request failed'], 500);
        }
    }


    public function placeOrder()
    {
        // API URL
        $url = 'https://api.dhan.co/v2/orders';

        // Access token from Postman
        $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJkaGFuIiwicGFydG5lcklkIjoiIiwiZXhwIjoxNzMwMjg4OTM5LCJ0b2tlbkNvbnN1bWVyVHlwZSI6IlNFTEYiLCJ3ZWJob29rVXJsIjoiIiwiZGhhbkNsaWVudElkIjoiMTEwNDY1Mzc0NyJ9.jniyg-NAJw0W0myoeNSmW9Eq2aczLPf5K9ZJmVkaaD6bRW7qxr9N8gfXYnWyQrU_nW7Jhx6Wvhflber3LWb_qg';

        // Data for the POST request (same as in Postman)
        $orderData = json_encode([
            "dhanClientId" => "1104653747",
            "correlationId" => "",
            "transactionType" => "BUY",
            "exchangeSegment" => "NSE_EQ",
            "productType" => "INTRADAY",
            "orderType" => "LIMIT",
            "validity" => "DAY",
            "securityId" => "1333",
            "quantity" => "5",
            "disclosedQuantity" => "0",
            "price" => "1651",
            "triggerPrice" => "",
            "afterMarketOrder" => false,
            "amoTime" => "OPEN",
            "boProfitValue" => 1665,
            "boStopLossValue" => 1658
        ]);

        //dd($orderData);
        $response = Http::withHeaders([
            'access-token' => $accessToken,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withBody($orderData, 'application/json')->post($url);



        //dd($response->status(), $response->body(), $response->headers());

        // Check the response status and body
        if ($response->successful()) {
            // Handle successful response
            $data = $response->json();
            //dd($data);
            return view('trade.index', ['order' => $data]);
        } else {
            // Log or handle error response
            return response()->json(['error' => $response->body()], $response->status());
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TradeBot $tradeBot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TradeBot $tradeBot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TradeBot $tradeBot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TradeBot $tradeBot)
    {
        //
    }
}
