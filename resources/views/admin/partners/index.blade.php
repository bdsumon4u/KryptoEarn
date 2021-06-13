<x-admin-layout>
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
        <script>
            $(document).ready(function () {
                $(document).on('click', '.btn-approve', function (ev) {
                    $.ajax({
                        type: 'POST',
                        url: '/partners/' + $(this).data('id'),
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            _method: 'PATCH',
                            approve: true,
                        },
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                });
            });
        </script>
    @endpush
</x-admin-layout>
