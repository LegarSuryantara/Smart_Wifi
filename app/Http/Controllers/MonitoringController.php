<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class MonitoringController extends Controller
{
    private function client()
    {
        $config = new Config([
            'host' => '192.168.101.1',
            'user' => 'alief',
            'pass' => 'alief06',
            'port' => 8728,
            'timeout' => 3,
        ]);

        return new Client($config);
    }

    public function index()
    {
        try {
            $client = $this->client();

            $identity = $client->query('/system/identity/print')->read()[0]['name'] ?? 'Unknown';
            $router   = $client->query('/system/routerboard/print')->read()[0]['model'] ?? 'Unknown';
            $system   = $client->query('/system/resource/print')->read()[0] ?? [];

            return view('admin.monitorings.index', [
                'identity' => $identity,
                'router'   => $router,
                'uptime'   => $system['uptime'] ?? 'Unknown',
                'cpu'      => $system['cpu-load'] ?? 'N/A',
            ]);
        } catch (\Throwable $e) {
            return view('admin.monitorings.index', [
                'error' => 'Gagal koneksi ke router: ' . $e->getMessage(),
            ]);
        }
    }

    public function stats()
    {
        try {
            $client = $this->client();
            $interfaces = $client->query('/interface/print')->read();

            $data = [];
            foreach ($interfaces as $iface) {
                if (isset($iface['rx-byte'], $iface['tx-byte'])) {
                    $data[] = [
                        'name' => $iface['name'],
                        'rx'   => (int)$iface['rx-byte'],
                        'tx'   => (int)$iface['tx-byte'],
                    ];
                }
            }

            return response()->json([
                'status' => 'ok',
                'interfaces' => $data
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
