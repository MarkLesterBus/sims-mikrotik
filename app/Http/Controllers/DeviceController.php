<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use App\Models\Device;
use RouterOS\Client;
use RouterOS\Query;


class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function formatBytes($bytes)
    {
        if ($bytes > 0) {
            $i = floor(log($bytes) / log(1024));
            $sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            return sprintf('%.02F', round($bytes / pow(1024, $i), 1)) * 1 . ' ' . @$sizes[$i];
        } else {
            return 0;
        }
    }

    public function index($device)
    {
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('devices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $device = Device::create([
            'uuid' => Str::uuid(),
            'name' => $request->name,
            'host' => $request->host,
            'user' => $request->user,
            'password' => $request->password,
            'port' => $request->port,
            'comment' => $request->comment,
        ]);
        $success = true;
        return redirect('/device')->with('completed', 'Student has been updated');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($device)
    {
        $session = Device::where('uuid', $device)->first();
        $client = new Client(['host' => $session->host, 'user' => $session->user, 'pass' => $session->password, 'port' => (int)$session->port]);

        $query = new Query('/system/resource/print');
        $resources = $client->query($query)->read();

        $query = new Query('/system/identity/print');
        $identity = $client->query($query)->read();

        $query = new Query('/log/print');
        $logs = $client->query($query)->read();


        return view('devices.index', [
            'uuid' => $device,
            'resources' => $resources,
            'identity' => $identity,
            'total_memory' => $this->formatBytes($resources[0]['total-memory']),
            'free_memory' => $this->formatBytes($resources[0]['free-memory']),
            'free_hdd_space' => $this->formatBytes($resources[0]['free-hdd-space']),
            'total_hdd_space' => $this->formatBytes($resources[0]['total-hdd-space']),
            'logs' => $logs,
        ]);
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
    public function update(Request $request, $id)
    {
        //
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
