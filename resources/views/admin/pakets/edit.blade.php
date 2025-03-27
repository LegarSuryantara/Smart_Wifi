<!-- edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Paket / Edit
            </h2>
            <a href="{{ route('pakets.index') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600 transition-colors uppercase">Back to paket</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('pakets.update', $paket->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <label for="nama_paket" class="text-lg font-medium">Nama Paket</label>
                        <div class="my-3">
                            <input value="{{ old('nama_paket', $paket->nama_paket) }}" name="nama_paket" placeholder="Enter Nama Paket" type="text" class="text-black border-gray-300 shadow-sm max-w-1/2 rounded-lg">
                            @error('nama_paket')
                            <p class="text-red-400 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <label for="kategori" class="text-lg font-medium">Kategori</label>
                        <div class="my-3">
                            <select name="kategori" class="text-black border-gray-300 shadow-sm max-w-1/2 rounded-lg">
                                <option value="" disabled>Pilih Kategori</option>
                                <option value="Dasar" {{ $paket->kategori == 'Dasar' ? 'selected' : '' }}>Dasar</option>
                                <option value="Reguler" {{ $paket->kategori == 'Reguler' ? 'selected' : '' }}>Reguler</option>
                                <option value="Bisnis" {{ $paket->kategori == 'Bisnis' ? 'selected' : '' }}>Bisnis</option>
                                <option value="Eksekutif" {{ $paket->kategori == 'Eksekutif' ? 'selected' : '' }}>Eksekutif</option>
                            </select>
                            @error('kategori')
                            <p class="text-red-400 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <label for="harga" class="text-lg font-medium">Harga</label>
                        <div class="my-3">
                            <input value="{{ old('harga', $paket->harga) }}" name="harga" placeholder="Enter Harga" type="number" class="text-black border-gray-300 shadow-sm max-w-1/2 rounded-lg">
                            @error('harga')
                            <p class="text-red-400 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <label for="kecepatan" class="text-lg font-medium">Kecepatan</label>
                        <div class="my-3">
                            <input value="{{ old('kecepatan', $paket->kecepatan) }}" name="kecepatan" placeholder="Enter Kecepatan" type="text" class="text-black border-gray-300 shadow-sm max-w-1/2 rounded-lg">
                            @error('kecepatan')
                            <p class="text-red-400 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <button class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600 transition-colors uppercase">Update Paket</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>