<x-admin-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('cuba/assets/css/vendors/datatables.css') }}">
        <link rel="stylesheet" href="{{ asset('cuba/assets/css/vendors/datatables-extension.css') }}">
    @endpush
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        {!! $html->table() !!}
                    </div>
                </div>
            </div>
        </div>
    @push('scripts')
        <script src="{{ asset('cuba/assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
        {!! $html->scripts() !!}
    @endpush
</x-admin-layout>
