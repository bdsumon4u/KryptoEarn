<x-user-layout>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    @if($count)
                    {!! $html->table() !!}
                    @else
                        <div class="row">
                            <div class="col-sm-10 offset-sm-1 col-md-6 offset-md-3">
                                <div class="info-block">
                                    <div class="alert alert-danger outline-2x" role="alert">
                                        We don't have any partner from your country yet.
                                        <a href="{{ route('partners.create') }}">Become A Partner</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('cuba/assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
        {!! $html->scripts() !!}
    @endpush
</x-user-layout>
