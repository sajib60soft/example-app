<?php

namespace App\Http\Controllers;

use App\Mail\MyTestMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PushNotificationController extends Controller
{
    public function index()
    {
        return view('pages.notification');
    }

    public function tokenStore(Request $request)
    {
        try {
            $request->user()->update(['fcm_token' => $request->token]);
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'success' => false
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required'
        ]);

        try {
            $fcmTokens = User::find(auth()->id())->fcm_token;
            if ($fcmTokens) {
                $data['description'] = $request->message;
                $data['title'] = $request->title;
                $data['image'] = '';
                $this->sendPushNotification($data, $fcmTokens);
            }
            return redirect()->back();
        } catch (\Exception $e) {
            report($e);
            dd($e);
            return redirect()->back()->with('error', 'Something goes wrong while sending notification.');
        }
    }

    public function sendPushNotification($data, $topic)
    {
        $final = array(
            'to' => '/topics/' . $topic,
            'priority' => 'high',
            'notification' => [
                'body' => $data['description'],
                'title' => $data['title'],
                'sound' => 'Default',
                'image' => $data['image']
            ],
        );

        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = array(
            'Authorization: key=' . env('FCM_SECRET_KEY'),
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($final));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
}
