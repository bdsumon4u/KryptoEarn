<x-user-layout>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <ul>
                        <li class="list-group-item text-color d-flex justify-center">
                            <img
                                src="{{ asset('cuba/user1/assets/images/gateway/'.$deposit->gateway.'.png') }}"
                                style="max-width:150px; max-height:100px; margin:0 auto;">
                        </li>
                        <li class="list-group-item text-color"> Amount:
                            <strong> {{ $deposit->amount }} -
                                USD</strong></li>
                        <li class="list-group-item text-color"> Charge :
                            <strong>{{ $deposit->charge }} - USD</strong></li>
                        <li class="list-group-item text-color"> Payable :
                            <strong>{{ $deposit->payable }} - USD </strong></li>
                        <li class="list-group-item text-color d-flex justify-content-around">
                            <form action="{{ route('deposits.destroy', $deposit) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger custom-btn btn-lg "> CANCEL <i class="fa fa-times"></i></button>
                            </form>
                            <form action="{{ route('deposits.update', $deposit) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success custom-btn btn-lg "> PROCEED <i class="fa fa-check"></i></button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
