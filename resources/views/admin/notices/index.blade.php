<x-admin-layout>
    @push('styles')
        <style>
            tr th:last-child,
            tr td:last-child {
                width: 200px;
                text-align: center;
            }
        </style>
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
