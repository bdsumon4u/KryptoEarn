<x-admin-layout>
    @push('styles')
        <livewire:styles />
    @endpush
    <livewire:admin.setting :tab="$tab" />
    @push('scripts')
        <livewire:scripts />
    @endpush
</x-admin-layout>
