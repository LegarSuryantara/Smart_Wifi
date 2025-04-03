<!-- create.blade.php -->
<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Users / Create
            </h2>
            <a href="{{ route('users.index') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600 transition-colors uppercase">Back to user</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('users.store') }}" method="post">


                    @csrf
                    <label for="" class="text-lg font-sm">Name</label>
                        <div class="my-3">
                            <input value="{{ old('name') }}" name="name" placeholder="Enter Name" type="text" class="text-black border-gray-300 shadow-sm max-w-1/2 rounded-lg">
                            @error('name')
                            <p class="text-red-400 font-sm">{{ $message  }}</p>
                            @enderror
                        </div>

                        <label for="" class="text-lg font-sm">Email</label>
                        <div class="my-3">
                            <input value="{{ old('email') }}" name="email" placeholder="Enter Email" type="text" class="text-black border-gray-300 shadow-sm max-w-1/2 rounded-lg">
                            @error('email')
                            <p class="text-red-400 font-sm">{{ $message  }}</p>
                            @enderror
                        </div>
                        
                        <label for="" class="text-lg font-sm">Phone number</label>
                        <div class="my-3">
                            <input value="{{ old('phone') }}" name="phone" placeholder="Enter phone number" type="tel" class="text-black border-gray-300 shadow-sm max-w-1/2 rounded-lg">
                            @error('phone')
                            <p class="text-red-400 font-sm">{{ $message  }}</p>
                            @enderror
                        </div>

                        <label for="" class="text-lg font-sm">Address</label>
                        <div class="my-3">
                            <input value="{{ old('address') }}" name="address" placeholder="Enter address" type="text" class="text-black border-gray-300 shadow-sm max-w-1/2 rounded-lg">
                            @error('address')
                            <p class="text-red-400 font-sm">{{ $message  }}</p>
                            @enderror
                        </div>

                        <label for="" class="text-lg font-sm">Password</label>
                        <div class="my-3">
                            <input value="{{ old('password') }}" name="password" placeholder="Enter Password" type="password" class="text-black border-gray-300 shadow-sm max-w-1/2 rounded-lg">
                            @error('password')
                            <p class="text-red-400 font-sm">{{ $message  }}</p>
                            @enderror
                        </div>

                        <label for="" class="text-lg font-sm">Confirm Password</label>
                        <div class="my-3">
                            <input value="{{ old('confirm_password') }}" name="confirm_password" placeholder="Confirm Your Password" type="password" class="text-black border-gray-300 shadow-sm max-w-1/2 rounded-lg">
                            @error('confirm_password')
                            <p class="text-red-400 font-sm">{{ $message  }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-wrap gap-3 mb-3">
                            @foreach ($roles as $role)
                                <div class="w-full sm:w-[calc(50%-0.75rem)] md:w-[calc(33.33%-0.75rem)] lg:w-[calc(25%-0.75rem)]">
                                    <label for="permission-{{ $role->id }}" 
                                        class="flex items-center space-x-2 p-3 bg-white rounded-lg border border-gray-200 shadow-xs hover:shadow-sm transition-all cursor-pointer hover:bg-gray-50">

                                        <input
                                            type="checkbox" 
                                            name="role[]" 
                                            value="{{ $role->name }}" 
                                            id="role-{{ $role->id }}"
                                            class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        
                                        <span class="text-base font-medium text-gray-700 truncate max-w-[180px]"
                                            title="{{ $role->name }}">
                                            {{ $role->name }}
                                        </span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <button class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600 transition-colors uppercase">Create user</button>
                     </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
