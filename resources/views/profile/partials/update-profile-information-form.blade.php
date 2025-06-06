<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-black">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-black">
            {{ __("Update your account's profile information, email address, and contact details.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        
        <div class="mb-8">
            <x-input-label class="text-black" for="profile_photo" :value="__('Foto Profil')" />
            
            <div class="flex flex-col items-center mt-4">
                @if($user->profile_photo)
                    <img src="{{ asset('storage/'.$user->profile_photo) }}" 
                        class="w-32 h-32 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600 mb-4">
                @else
                    <div class="w-32 h-32 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center border-2 border-gray-200 dark:border-gray-600 mb-4">
                        <span class="text-gray-500 dark:text-gray-300 text-4xl font-medium">
                            {{ substr($user->name, 0, 1) }}
                        </span>
                    </div>
                @endif
                
                <div class="w-full max-w-xs text-center">
                    <div class="flex items-center justify-center space-x-2">
                        <label for="profile_photo" class="cursor-pointer">
                            <span class="inline-flex items-center px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 dark:focus:ring-indigo-800 rounded-lg font-medium text-white transition duration-200 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                {{ __('Upload') }}
                            </span>
                            <input id="profile_photo" name="profile_photo" type="file" class="hidden" onchange="displayFileName(this)">
                        </label>
                        @if($user->profile_photo)
                        <button type="button" 
                            onclick="confirmDeleteProfilePhoto()" 
                            class="inline-flex items-center px-4 py-2.5 bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-800 rounded-lg font-medium text-white transition duration-200 shadow-md"
                            aria-label="{{ __('Delete profile photo') }}"
                            title="{{ __('Delete profile photo') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <span class="sr-only">{{ __('Delete') }}</span>
                        </button>
                        @endif
                    </div>
                    <p id="file-name" class="mt-2 text-sm text-gray-600 dark:text-gray-400 text-center"></p>
                </div>
            </div>
            
            <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
        </div>

        <div>
            <x-input-label class="text-black" for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-gray-100 border-gray-300 text-gray-800" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label class="text-black" for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-gray-100 border-gray-300 text-gray-800" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label class="text-black" for="phone" :value="__('No Hp')" />
            <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full bg-gray-100 border-gray-300 text-gray-800" 
                :value="old('phone', $user->phone)" required autocomplete="tel" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Format: 0812 3456 7890 (10-15 digits)') }}
            </p>
        </div>

        <div>
            <x-input-label class="text-black" for="address" :value="__('Alamat')" />
            <x-textarea id="address" name="address" class="mt-1 block w-full bg-gray-100 border-gray-300 text-gray-800 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                autocomplete="street-address" rows="3">{{ old('address', $user->address) }}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-gray-500 text-sm rounded-md text-white px-4 py-2 hover:bg-gray-600 transition-colors uppercase">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
    function displayFileName(input) {
        const fileNameElement = document.getElementById('file-name');
        if (input.files.length > 0) {
            fileNameElement.textContent = input.files[0].name;
        } else {
            fileNameElement.textContent = '';
        }
    }

    function confirmDeleteProfilePhoto() {
        if (!confirm('Are you sure you want to delete your profile photo?')) {
            return;
        }

        fetch('{{ route("profile.delete-photo") }}', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(async response => {
            const data = await response.json();
            if (!response.ok) {
                throw new Error(data.message || 'Failed to delete photo');
            }
            window.location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message);
        });
    }
</script>