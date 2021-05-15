<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('send',function(Request $request){
    $json_data = [
        "to" => 'citWliC5XFLKGquI3XkR9k:APA91bGLJWfe4MFkd3chHwbmLoqiMnen6Kd__f-gq1ZA9IvGiEJAKGoB5STlMgWjOqrM9bCwUAKU0Tx7i5rX5I0FiV70vzrBTdhHseQgKBF0dxWPovziwfmaLa3NEwmnmot17_JmfcZI',
        "data" => [
            "body" => "Web Notififcation",
            "title" => "Web Notification",
            "icon" => "ic_launcher",
            'link' => 'http://localhost:3000/hhh'
        ]
    ];
    $data = json_encode($json_data);
    //FCM API end-point
    $url = 'https://fcm.googleapis.com/fcm/send';
    //api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
    $server_key = 'AAAAUjU1uiM:APA91bHfu2qg1-iIaNNka6X4aEPU-47uzu1CHWkbeJs2bUAEzPV4fFJeK7nKg_O-LolHZ3LnR6hyKeyfGywuJNHe0pid5n8YcDR5_gZG4Zyaasv09yTfcGfg-IMAdK4lm2K1OJ4vVkCq';
    //header with content_type api key
    $headers = array(
        'Content-Type:application/json',
        'Authorization:key='.$server_key
    );
    //CURL request to route notification to FCM connection server (provided by Google)
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $result = curl_exec($ch);               
    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
    curl_close($ch);
});