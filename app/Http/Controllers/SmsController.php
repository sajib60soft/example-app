<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Twilio\Rest\Client;

class SmsController extends Controller
{
    public function index()
    {
        return view('pages.twilio');
    }

    public function smsSend(Request $request)
    {
        $receiverNumber = '+8801685108453';
        $message = "This is testing from ItSolutionStuff.com";
        try {
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number,
                'body' => $message
            ]);
            dd('SMS Sent Successfully.');
        } catch (Exception $e) {
            dd("Error: " . $e->getMessage());
        }
    }

    public function easyIndex()
    {
        return view('pages.easy');
    }

    public function easySend(Request $request)
    {
        try {
            $receiverNumber = '+8801685108453';
            $message = 'Hello 1';

            $username  = 'hakihakioj9tv2023';
            $password = 'yjPlbrCN';
            $from     = '';
            $to       = $receiverNumber;
            $text     = $message;

            $postFeild = 'username=' . $username . '&password=' . $password . '&to=' . $to . '&from=' . $from . '&text=' . $text . '&type=0';

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.easysendsms.app/bulksms',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $postFeild,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Cookie: ASPSESSIONIDASCQBARR=NKOHDCHDOFEOOALJIGDGGPAM'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            dd('SMS Sent Successfully.');
        } catch (Exception $e) {
            dd("Error: " . $e->getMessage());
        }
    }
}
