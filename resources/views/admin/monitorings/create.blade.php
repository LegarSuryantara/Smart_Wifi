<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Status Jaringan') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('monitorings.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ \Carbon\Carbon::now()->toDateString() }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Normal">Normal</option>
                            <option value="Gangguan">Gangguan</option>
                            <option value="Gangguan Berat">Gangguan Berat</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Uptime</label>
                        <div class="d-flex gap-2">
                            <input type="number" name="uptime_hours" class="form-control" min="0" max="23" placeholder="Jam" required>
                            <input type="number" name="uptime_minutes" class="form-control" min="0" max="59" placeholder="Menit" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Downtime</label>
                        <div class="d-flex gap-2">
                            <input type="number" name="downtime_hours" class="form-control" min="0" max="23" placeholder="Jam" required>
                            <input type="number" name="downtime_minutes" class="form-control" min="0" max="59" placeholder="Menit" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('monitorings.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
