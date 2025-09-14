<?php

namespace App\Http\Controllers;
use App\Models\StatusJaringan;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function index()
    {
        // Ambil data utama untuk ditampilkan dalam tabel
        $monitorings = StatusJaringan::orderBy('tanggal', 'desc')->paginate(10);

        // Ambil data untuk chart: jumlah uptime & downtime (detik), dikelompokkan per bulan tahun ini
        $chartData = StatusJaringan::selectRaw("
                YEAR(tanggal) as year, 
                MONTH(tanggal) as month, 
                SUM(TIME_TO_SEC(uptime)) as total_uptime_seconds, 
                SUM(TIME_TO_SEC(downtime)) as total_downtime_seconds
            ")
            ->whereYear('tanggal', now()->year)
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $chartLabels = [];
        $uptimeData = [];
        $downtimeData = [];

        foreach ($chartData as $row) {
            // Contoh label: "Jan 2025"
            $chartLabels[] = date('M Y', mktime(0, 0, 0, $row->month, 1, $row->year));

            // Konversi detik ke jam dengan 2 angka desimal
            $uptimeData[] = round($row->total_uptime_seconds / 3600, 2);
            $downtimeData[] = round($row->total_downtime_seconds / 3600, 2);
        }

        // Kirim semua data ke view
        return view('admin.monitorings.index', compact(
            'monitorings',
            'chartLabels',
            'uptimeData',
            'downtimeData'
        ));
    }


        public function create()
    {
        return view('admin.monitorings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'status' => 'required|string',
            'uptime_hours' => 'required|integer|min:0|max:23',
            'uptime_minutes' => 'required|integer|min:0|max:59',
            'downtime_hours' => 'required|integer|min:0|max:23',
            'downtime_minutes' => 'required|integer|min:0|max:59',
            'keterangan' => 'nullable|string',
        ]);

        $uptime = sprintf('%02d:%02d:00', $validated['uptime_hours'], $validated['uptime_minutes']);
        $downtime = sprintf('%02d:%02d:00', $validated['downtime_hours'], $validated['downtime_minutes']);

        StatusJaringan::create([
            'tanggal' => $validated['tanggal'],
            'status' => $validated['status'],
            'uptime' => $uptime,
            'downtime' => $downtime,
            'keterangan' => $validated['keterangan'] ?? '',
        ]);

        return redirect()->route('monitorings.index')->with('success', 'Data berhasil ditambahkan.');
    }

}