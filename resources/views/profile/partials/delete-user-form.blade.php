<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-black">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-black">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <div class="mt-6 space-y-6">
        <button
            type="button"
            class="bg-red-600 text-sm rounded-md text-white px-4 py-2 hover:bg-red-700 transition-colors uppercase"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >
            {{ __('Delete Account') }}
        </button>

        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900 dark:text-black">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-black">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mt-6">
                    <x-input-label for="password" :value="__('Password')" class="text-black" />
                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-full bg-gray-100 border-gray-300 text-gray-800"
                        autocomplete="current-password"
                    />
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>

                <div class="mt-6 flex items-center gap-4 justify-end">
                    <button type="button" class="bg-gray-500 text-sm rounded-md text-white px-4 py-2 hover:bg-gray-600 transition-colors uppercase"
                        x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </button>

                    <button type="submit" class="bg-red-600 text-sm rounded-md text-white px-4 py-2 hover:bg-red-700 transition-colors uppercase ms-3">
                        {{ __('Delete Account') }}
                    </button>
                </div>
            </form>
        </x-modal>
    </div>
</section>
