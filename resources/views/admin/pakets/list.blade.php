<!-- List.blade.php -->
<x-app-layout>
<x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Paket Internet') }}
        </h2>
        <div class="flex space-x-2">
            <a href="{{ route('pakets.home') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600 transition-colors uppercase">
                User Dashboard
            </a>
            <a href="{{ route('pakets.create') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600 transition-colors uppercase">
                Tambah Paket
            </a>
        </div>
    </div>
</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>

            <div class="overflow-hidden rounded-lg shadow">
                <table class="w-full rounded-lg overflow-hidden">
                    <thead class="bg-gray-50">
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left" width="60">#</th>
                            <th class="px-6 py-3 text-left">Nama Paket</th>
                            <th class="px-6 py-3 text-left">Kategori</th>
                            <th class="px-6 py-3 text-left">Kecepatan</th>
                            <th class="px-6 py-3 text-left">Harga</th>
                            <th class="px-6 py-3 text-left" width="120">Dibuat</th>
                            <th class="px-6 py-3 text-center" width="180">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @if ($pakets->isNotEmpty())
                            @foreach ($pakets as $paket)
                                <tr class="border-b">
                                    <td class="px-6 py-3 text-left">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-3 text-left">
                                        {{ $paket->nama_paket }}
                                    </td>
                                    <td class="px-6 py-3 text-left">
                                        {{ $paket->kategori }}
                                    </td>
                                    <td class="px-6 py-3 text-left">
                                        {{ $paket->kecepatan }} Mbps
                                    </td>
                                    <td class="px-6 py-3 text-left">
                                        Rp {{ number_format($paket->harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-3 text-left">
                                        {{ $paket->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-3 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('pakets.edit', $paket->id) }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600 transition-colors uppercase">
                                                Edit
                                            </a>
                                            <form action="{{ route('pakets.destroy', $paket->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 text-sm rounded-md text-white px-3 py-2 hover:bg-red-500 transition-colors uppercase" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                    Tidak ada data paket
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>