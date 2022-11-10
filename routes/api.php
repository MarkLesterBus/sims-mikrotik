<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Device;
use RouterOS\Client;
use RouterOS\Query;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/traffic/{device}/', function ($device, $interface) {
    $session = Device::where('uuid', $device)->first();
    $client = new Client(['host' => $session->host, 'user' => $session->user, 'pass' => $session->password, 'port' => (int)$session->port]);

    $query =  (new Query('/interface/monitor-traffic'))
        ->equal('interface', 'ether1')
        ->equal('once');
    $traffic = $client->query($query)->read();
    return response()->json($traffic, 200);
});
