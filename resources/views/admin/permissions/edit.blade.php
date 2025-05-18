<!-- edit.blade.php -->
<x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                    <div class="mb-6 flex justify-between items-center">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            Permission / Edit
                        </h2>
                    </div>

                    <form action="{{ route('permissions.update', $permission->id) }}" method="post">
                        @csrf
                        @method('POST')
                        
                        <!-- Name Field -->
                        <div class="mb-6">
                            <label for="name" class="block text-lg font-medium text-gray-700 mb-2">
                                Name
                            </label>
                            <input value="{{ old('name', $permission->name) }}" 
                            name="name" 
                            id="name" 
                            placeholder="Enter Name" 
                            type="text" 
                            class="w-full md:w-1/2 h-10 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition px-3">
                            @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="flex gap-3 pt-2">
                            <button type="submit" class="bg-slate-700 text-sm rounded-md text-white px-4 py-2 hover:bg-slate-600 transition-colors uppercase">
                                Update permission
                            </button>
                            <a href="{{ route('permissions.index') }}" class="bg-gray-500 text-sm rounded-md text-white px-4 py-2 hover:bg-gray-600 transition-colors uppercase">
                                Back to permissions
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>