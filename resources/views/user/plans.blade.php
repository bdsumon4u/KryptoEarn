<x-user-layout>
    @push('styles')
        @livewireStyles
    @endpush
    <x-slot name="title">Plans</x-slot>
    <livewire:user.plan-upgrade :plans="$plans" />
    @push('scripts')
        @livewireScripts
    @endpush
</x-user-layout>
