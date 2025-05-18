<!-- create.blade.php -->
<x-app-layout>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6 flex justify-between items-center">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            Paket / Create
                        </h2>
                    </div>
                    <form action="{{ route('pakets.store') }}" method="POST">
                        @csrf
                        
                        <!-- Nama Paket Field -->
                        <div class="mb-6">
                            <label for="nama_paket" class="block text-lg font-medium text-gray-700 mb-2">
                                Nama Paket
                            </label>
                            <input value="{{ old('nama_paket') }}" 
                            name="nama_paket" 
                            id="nama_paket" 
                            placeholder="Enter Nama Paket" 
                            type="text" 
                            class="w-full md:w-1/2 h-10 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition px-3">
                            @error('nama_paket')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Kategori Field -->
                        <div class="mb-6">
                            <label for="kategori" class="block text-lg font-medium text-gray-700 mb-2">
                                Kategori
                            </label>
                            <select name="kategori" 
                            id="kategori" 
                            class="w-full md:w-1/2 h-10 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition px-3">
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="Dasar" {{ old('kategori') == 'Dasar' ? 'selected' : '' }}>Dasar</option>
                            <option value="Reguler" {{ old('kategori') == 'Reguler' ? 'selected' : '' }}>Reguler</option>
                            <option value="Bisnis" {{ old('kategori') == 'Bisnis' ? 'selected' : '' }}>Bisnis</option>
                            <option value="Eksekutif" {{ old('kategori') == 'Eksekutif' ? 'selected' : '' }}>Eksekutif</option>
                        </select>
                        @error('kategori')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Harga Field -->
                    <div class="mb-6">
                        <label for="harga" class="block text-lg font-medium text-gray-700 mb-2">
                            Harga
                        </label>
                        <input value="{{ old('harga') }}" 
                        name="harga" 
                        id="harga" 
                        placeholder="Enter Harga" 
                        type="number" 
                        class="w-full md:w-1/2 h-10 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition px-3">
                        @error('harga')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Kecepatan Field -->
                    <div class="mb-6">
                        <label for="kecepatan" class="block text-lg font-medium text-gray-700 mb-2">
                            Kecepatan
                        </label>
                        <input value="{{ old('kecepatan') }}" 
                        name="kecepatan" 
                        id="kecepatan" 
                        placeholder="Enter Kecepatan" 
                        type="text" 
                        class="w-full md:w-1/2 h-10 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition px-3">
                        @error('kecepatan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="flex gap-3 pt-2">
                        <button type="submit" class="bg-slate-700 text-sm rounded-md text-white px-4 py-2 hover:bg-slate-600 transition-colors uppercase">
                            Create Paket
                        </button>
                        <a href="{{ route('pakets.index') }}" class="bg-gray-500 text-sm rounded-md text-white px-4 py-2 hover:bg-gray-600 transition-colors uppercase">
                            Back to paket
                        </a>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>