<?php

namespace App\Http\Controllers;

use App\Models\RouterosAPI;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function index()
    {
        $ip_routeros = '192.168.101.1';
        $user_routeros = 'alief';
        $pass_routeros = 'alief06';
        $API_routeros = new RouterosAPI();
        $API_routeros->debug(false);

        if ($API_routeros->connect($ip_routeros, $user_routeros, $pass_routeros)) {
            $identityPrint = $API_routeros->comm('/system/identity/print');
            $routerModel = $API_routeros->comm('/system/routerboard/print');
        } else {
            return 'koneksi gagal';
        }

        $data = [
            'identity' => $identityPrint[0]['name'],
            'router' => $routerModel[0]['model'],
        ];

        dd($data);

        return view('admin.monitorings.index', $data);
    }


    public function create() {}

    public function store(Request $request) {}
}
