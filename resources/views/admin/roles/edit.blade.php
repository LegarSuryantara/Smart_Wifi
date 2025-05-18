<!-- edit.blade.php -->
<x-app-layout>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6 flex justify-between items-center">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            Roles / Edit
                        </h2>
                    </div>
                    <form action="{{ route('roles.update', $role->id) }}" method="post">
                        @csrf
                        @method('POST')
                        
                        <!-- Name Field -->
                        <div class="mb-6">
                            <label for="name" class="block text-lg font-medium text-black dark:text-gray-300 mb-2">Name</label>
                            <input value="{{ old('name', $role->name) }}" name="name" id="name" placeholder="Enter Name" type="text" 
                            class="w-full md:w-1/2 h-10 text-sm text-black dark:text-gray-100 bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition px-3">
                            @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Permissions Checkboxes -->
                        <div class="mb-6">
                            <label class="block text-lg font-medium text-black dark:text-gray-300 mb-2">Permissions</label>
                            <div class="flex flex-wrap gap-3">
                                @foreach ($permissions as $permission)
                                <div class="w-full sm:w-[calc(50%-0.75rem)] md:w-[calc(33.33%-0.75rem)] lg:w-[calc(25%-0.75rem)]">
                                    <label for="permission-{{ $permission->id }}" 
                                    class="flex items-center space-x-2 p-3 bg-white dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 shadow-xs hover:shadow-sm transition-all cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <input {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} type="checkbox" 
                                    name="permission[]" 
                                    value="{{ $permission->name }}" 
                                    id="permission-{{ $permission->id }}"
                                    class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    
                                    <span class="text-sm font-medium text-black dark:text-gray-300 truncate max-w-[180px]"
                                    title="{{ $permission->name }}">
                                    {{ $permission->name }}
                                </span>
                            </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="flex gap-3 pt-2">
                                <button type="submit" class="bg-slate-700 text-sm rounded-md text-white px-4 py-2 hover:bg-slate-600 transition-colors uppercase">
                                    Update role
                                </button>
                                <a href="{{ route('roles.index') }}" class="bg-gray-500 text-sm rounded-md text-white px-4 py-2 hover:bg-gray-600 transition-colors uppercase">Back to roles</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>