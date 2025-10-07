<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 12px; color: #222; }
        .header { text-align: center; margin-bottom: 16px; }
        .header h1 { margin: 0 0 4px 0; font-size: 18px; }
        .header .meta { font-size: 11px; color: #555; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 7px 10px; }
        th { background: #f7f7f7; text-align: left; }
        tbody tr:nth-child(odd) { background: #fbfbfb; }
        tbody tr:hover { background: #f3f6ff; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .badge { display: inline-block; padding: 2px 6px; border-radius: 3px; font-size: 10px; }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        .footer { margin-top: 12px; font-size: 11px; color: #666; }
    </style>
    @php
        function format_currency($value) {
            try { return 'Rp ' . number_format((float)$value, 0, ',', '.'); } catch (\Throwable $e) { return (string)$value; }
        }
        function status_badge_class($status) {
            $map = [
                'capture' => 'badge-success',
                'settlement' => 'badge-success',
                'paid' => 'badge-success',
                'pending' => 'badge-warning',
                'unpaid' => 'badge-warning',
                'deny' => 'badge-danger',
                'expire' => 'badge-danger',
                'cancel' => 'badge-danger',
                'failure' => 'badge-danger',
            ];
            return $map[strtolower((string)$status)] ?? 'badge-warning';
        }
        function paket_jenis_short($order) {
            $kategori = optional($order->paket)->kategori;
            if (!empty($kategori)) return $kategori;
            $nama = optional($order->paket)->nama_paket ?? $order->paket_name ?? $order->package_name;
            if (!is_string($nama) || $nama === '') return '-';
            $parts = preg_split('/\s*-\s*/', $nama);
            $candidate = trim(end($parts));
            if ($candidate === '' && count($parts) > 0) $candidate = trim($parts[0]);
            $firstWord = explode(' ', $candidate)[0] ?? $candidate;
            return $firstWord ?: '-';
        }
    @endphp
</head>
<body>
    <div class="header">
        <h1>Laporan Transaksi</h1>
        <div class="meta">Dicetak pada: {{ date('d/m/Y H:i:s') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 28px;" class="text-center">No</th>
                <th>ID Pesanan</th>
                <th>Paket</th>
                <th>Nama</th>
                <th>Telepon</th>
                <th class="text-right">Qty</th>
                <th class="text-right">Total</th>
                <th>Status</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $i => $t)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $t->midtrans_order_id ?? $t->id }}</td>
                    <td>{{ paket_jenis_short($t) }}</td>
                    <td>{{ $t->name }}</td>
                    <td>{{ $t->phone }}</td>
                    <td class="text-right">{{ (int) $t->qty }}</td>
                    <td class="text-right">{{ format_currency($t->gross_amount) }}</td>
                    <td>
                        @php $status = $t->transaction_status ?? 'unpaid'; @endphp
                        <span class="badge {{ status_badge_class($status) }}">{{ strtoupper($status) }}</span>
                    </td>
                    <td>{{ optional($t->created_at)->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Tidak ada data transaksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Total Transaksi: {{ count($transactions) }}
    </div>
</body>
</html>


