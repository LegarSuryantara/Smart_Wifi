<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Header -->
                    <div class="mb-6 flex justify-between items-center">
                        <h2 class="font-semibold text-2xl text-gray-800 dark:text-black leading-tight">
                            Users / Create
                        </h2>
                    </div>

                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div class="space-y-4">
                            
                            <!-- Name Field -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-black dark:text-gray-300 mb-1">Name</label>
                                <input value="{{ old('name') }}" name="name" id="name" placeholder="Enter Name" type="text" 
                                    class="w-full md:w-1/2 h-10 text-sm text-black border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition px-3">
                                @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-black dark:text-gray-300 mb-1">Email</label>
                                <input value="{{ old('email') }}" name="email" id="email" placeholder="Enter Email" type="email" 
                                    class="w-full md:w-1/2 h-10 text-sm text-black border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition px-3">
                                @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone Field -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-black dark:text-gray-300 mb-1">Phone number</label>
                                <input value="{{ old('phone') }}" name="phone" id="phone" placeholder="Enter phone number" type="tel" 
                                    class="w-full md:w-1/2 h-10 text-sm text-black border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition px-3">
                                @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Address Field - Textarea with fixed height -->
                            <div>
                                <label for="address" class="block text-sm font-medium text-black dark:text-gray-300 mb-1">Address</label>
                                <textarea name="address" id="address" placeholder="Enter address" rows="4"
                                    class="w-full md:w-1/2 text-sm text-black border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition px-3 py-2 h-[120px] min-h-[120px] max-h-[200px] overflow-y-auto">{{ old('address') }}</textarea>
                                @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-black dark:text-gray-300 mb-1">Password</label>
                                <input name="password" id="password" placeholder="Enter Password" type="password" 
                                    class="w-full md:w-1/2 h-10 text-sm text-black border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition px-3">
                                @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm Password Field -->
                            <div>
                                <label for="confirm_password" class="block text-sm font-medium text-black dark:text-gray-300 mb-1">Confirm Password</label>
                                <input name="confirm_password" id="confirm_password" placeholder="Confirm Your Password" type="password" 
                                    class="w-full md:w-1/2 h-10 text-sm text-black border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition px-3">
                                @error('confirm_password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Roles Checkboxes -->
                             <div>
                                <label for="Roles" class="block text-sm font-medium text-black dark:text-gray-300 mb-1">Confirm Password</label>
                                <div class="flex flex-wrap gap-3 mb-4">
                                    
                                    @foreach ($roles as $role)
                                        <div class="w-full sm:w-[calc(50%-0.75rem)] md:w-[calc(33.33%-0.75rem)] lg:w-[calc(25%-0.75rem)]">
                                            <label class="flex items-center space-x-2 p-3 bg-white rounded-lg border border-gray-200 shadow-xs hover:shadow-sm transition-all cursor-pointer hover:bg-gray-50">
                                                <input type="checkbox" 
                                                    name="role[]" 
                                                    value="{{ $role->name }}" 
                                                    id="role-{{ $role->id }}"
                                                    class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                                
                                                <span class="text-sm font-medium text-gray-700 truncate max-w-[180px]"
                                                    title="{{ $role->name }}">
                                                    {{ $role->name }}
                                                </span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex gap-3 pt-2">
                                <button type="submit" class="bg-slate-700 text-sm rounded-md text-white px-4 py-2 hover:bg-slate-600 transition-colors uppercase">
                                    Create user
                                </button>
                                <a href="{{ route('users.index') }}" class="bg-gray-500 text-sm rounded-md text-white px-4 py-2 hover:bg-gray-600 transition-colors uppercase">
                                    Back to users
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>