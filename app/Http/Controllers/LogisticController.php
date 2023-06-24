<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Logistic;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class LogisticController extends Controller
{
    public function viewLogisticDetail()
    {
        $logistics = Logistic::orderBy('id', 'ASC')->get();
        foreach ($logistics as $logistic) {
            if ($logistic->status != 'pending' && $logistic->parcel_number != null)
            {
                $orderNumber = $logistic->parcel_number;
                
                $apiUrl = "https://connect.easyparcel.my/?ac=";
                $apiKey = 'EP-euMXnumbB';
                $action = "EPParcelStatusBulk";

                $postparam = [
                    'api'   => $apiKey,
                    'bulk'  => [
                        ['order_no' => $orderNumber],
                    ],
                ];
                
                $url = $apiUrl . $action;
                $response = Http::post($url, $postparam);
                
                if ($response->successful()) {
                    $status = $response->json();
                    // Store the parcel status information in the $logistic object
                    $logistic->status = $status['result'][0]['parcel'][0]['ship_status'];
                    $logistic->save();
                } else {
                    // Handle the case where the API request fails
                    $logistic->status = null;
                }
            }
        }

        return view('logistic.index', compact('logistics'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logistic $logistic)
    {
        $validatedData = $request->validate([
            'weight' => 'required|numeric',
            'collect_date' => 'required|date',
        ]);
        $weight = $validatedData['weight'];
        $collect_date = $validatedData['collect_date'];
        $courier = [$request['courier']];
        


        $apiUrl = "https://connect.easyparcel.my/?ac=";
        $apiKey = 'EP-euMXnumbB';

        $action = "EPSubmitOrderBulkV3";
        $postData = [
            'api' => $apiKey,
            'courier' => $courier,
            'dropoff' => '0',
            'bulk' => [
                [
                    'referrence' => $logistic->id,
                    'weight' => $weight,
                    'content' => $logistic->description,
                    'value' => '100',
                    'pick_name' => $logistic->sender_name,
                    'pick_company' => 'TSK SYNERGY',
                    'pick_contact' => '+6018-404-0438',
                    'pick_mobile' => '+6018-404-0438',
                    'pick_addr1' => 'Jalan Iman',
                    'pick_addr2' => 'UTM',
                    'pick_addr3' => '',
                    'pick_addr4' => '',
                    'pick_city' => 'Skudai',
                    'pick_state' => 'Johor',
                    'pick_code' => '81310',
                    'pick_country' => 'MY',
                    'send_name' => $logistic->recipient_name,
                    'send_contact' => $logistic->recipient_phone,
                    'send_mobile' => $logistic->recipient_phone,
                    'send_addr1' => $logistic->recipient_address,
                    'send_addr2' => '',
                    'send_addr3' => '',
                    'send_addr4' => '',
                    'send_city' => $logistic->recipient_address_city,
                    'send_state' => $logistic->recipient_address_state,
                    'send_code' => $logistic->recipient_address_postcode,
                    'send_country' => 'MY',
                    'collect_date' => $collect_date,
                    'send_email' => '',
                    'sms' => '0',
                ]
            ]
        ];

        $url = $apiUrl . $action;
        
        $response = Http::post($url, $postData);

        if ($response->successful()) {
            print_r($responseData);
            if(isset($responseData['result']['success'][0]['courier'])){
                $logistic->status = 'Shipment Arranged';
                $logistic->courier = $responseData['result']['success'][0]['courier'];
                $logistic->tracking_number = $responseData['result']['success'][0]['awb'];
                $logistic->awb_id_link = $responseData['result']['success'][0]['awb_id_link'];
                $logistic->tracking_url = $responseData['result']['success'][0]['tracking_url'];
                $logistic->parcel_number = $responseData['result']['success'][0]['order_number'];
                $logistic->shipment_date = $collect_date;
                $logistic->save();
                // Redirect or return response as needed
                return redirect()->route ('logistic.detail')->with('success', 'Status updated successfully');
            }
            else{
                return redirect()->route ('logistic.detail')->with('success', 'Please select other dates (Courier Service Unavailable on Selected Date)');
            }
        } else {
            // Handle the API request failure
            echo "API request failed";
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
