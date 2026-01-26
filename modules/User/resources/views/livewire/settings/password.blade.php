<section class="w-full">
    @include('user::partials.settings-heading')

    <flux:heading class="sr-only">{{ __('Password Settings') }}</flux:heading>

    <x-user::settings.layout :heading="__('Update password')" :subheading="__('Ensure your account is using a long, random password to stay secure')">
        <form class="mt-6 space-y-6" method="POST" wire:submit="updatePassword">
            <flux:input :label="__('Current password')" autocomplete="current-password" required type="password"
                wire:model="current_password" />
            <flux:input :label="__('New password')" autocomplete="new-password" required type="password"
                wire:model="password" />
            <flux:input :label="__('Confirm Password')" autocomplete="new-password" required type="password"
                wire:model="password_confirmation" />

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button class="w-full" type="submit" variant="primary">{{ __('Save') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="password-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>
    </x-user::settings.layout>
</section>
