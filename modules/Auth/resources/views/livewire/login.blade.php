<div>
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" class="mb-4" />

    <form wire:submit='company'>
        <!-- Company Domain -->
        <div>
            <x-input-label :value="__('Company Domain')" for="domain" />
            <x-text-input autocomplete="domain" autofocus class="mt-1 block w-full" id="domain" name="domain"
                placeholder="company, company.example.com or example.com" required type="text" wire:model.lazy="domain" />
            <x-input-error :messages="$errors->get('domain')" class="mt-2" />
        </div>

        <div class="mt-4 flex items-center justify-end">
            <x-primary-button class="ms-3">
                {{ __('Continue') }} &rarr;
            </x-primary-button>
        </div>

        <div class="mt-4 border-t pt-4 text-center">
            Don't have an account?
            <a class="-text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                href="{{ route('register') }}">
                {{ __('Register now - free!') }}
            </a>
        </div>
    </form>

</div>
