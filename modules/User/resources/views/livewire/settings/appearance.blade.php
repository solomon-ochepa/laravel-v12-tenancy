<section class="w-full">
    @include('user::partials.settings-heading')

    <flux:heading class="sr-only">{{ __('Appearance Settings') }}</flux:heading>

    <x-user::settings.layout :heading="__('Appearance')" :subheading="__('Update the appearance settings for your account')">
        <flux:radio.group variant="segmented" x-data x-model="$flux.appearance">
            <flux:radio icon="sun" value="light">{{ __('Light') }}</flux:radio>
            <flux:radio icon="moon" value="dark">{{ __('Dark') }}</flux:radio>
            <flux:radio icon="computer-desktop" value="system">{{ __('System') }}</flux:radio>
        </flux:radio.group>
    </x-user::settings.layout>
</section>
