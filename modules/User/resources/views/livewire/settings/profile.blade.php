<section class="w-full">
    @include('user::partials.settings-heading')

    <flux:heading class="sr-only">{{ __('Profile Settings') }}</flux:heading>

    <x-user::settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        <form class="my-6 w-full space-y-6" wire:submit="updateProfileInformation">
            <flux:input :label="__('Name')" autocomplete="name" autofocus required type="text" wire:model="name" />

            <div>
                <flux:input :label="__('Email')" autocomplete="email" required type="email" wire:model="email" />

                @if ($this->hasUnverifiedEmail)
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="cursor-pointer text-sm"
                                wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="!dark:text-green-400 mt-2 font-medium !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button class="w-full" type="submit" variant="primary">{{ __('Save') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        @if ($this->showDeleteUser)
            <livewire:user::settings.delete-user-form />
        @endif
    </x-user::settings.layout>
</section>
