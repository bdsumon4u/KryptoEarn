<x-user-layout>
    @push('styles')
        <style>
            #maincontainer {
                width:100%;
                height: 100%;
            }
            #leftcolumn {
                float:left;
                display:inline-block;
                width: 100px;
                height: 100%;
            }
            #contentwrapper {
                float:left;
                display:inline-block;
                width: -moz-calc(100% - 100px);
                width: -webkit-calc(100% - 100px);
                width: calc(100% - 100px);
                height: 100%;
            }
        </style>
    @endpush
    <x-slot name="title">My Referrals</x-slot>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="body-bottom">
                        @if($referrer = $user->referrer)
                        <text>MY REFERRER:</text>
                        <input style="margin-bottom:5px;"
                               value="{{ $referrer->username }}"
                               class="form-control" readonly=""
                               id="clipboardExample1" type="text" />
                        @endif
                        <text>MY REFERRAL LINK:</text>
                        <input style="margin-bottom:5px;"
                               value="{{ route('register', ['ref' => request()->user()->username]) }}"
                               class="form-control" readonly=""
                               id="clipboardExample1" type="text" />
                        <div class="row">
                            <div>
                                <div id="maincontainer">
                                    <div id="leftcolumn">
                                        <button class="btn btn-sm btn-primary btn-clipboard" type="button"
                                                data-clipboard-action="copy" data-clipboard-target="#clipboardExample1">
                                            <i class="fa fa-copy"></i>Copy
                                        </button>
                                    </div>
                                    <div id="contentwrapper">
                                        <!-- AddToAny BEGIN -->
                                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                            <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                            <a class="a2a_button_facebook"></a>
                                            <a class="a2a_button_twitter"></a>
                                            <a class="a2a_button_email"></a>
                                            <a class="a2a_button_pinterest"></a>
                                            <a class="a2a_button_linkedin"></a>
                                            <a class="a2a_button_reddit"></a>
                                            <a class="a2a_button_google_gmail"></a>
                                            <a class="a2a_button_whatsapp"></a>
                                            <a class="a2a_button_telegram"></a>
                                        </div>
                                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                                        <!-- AddToAny END -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top:5px;" class="row">
                            <div class="col-12">
                                @php($valid_till = request()->user()->valid_till)
                                <div class="alert alert-sm alert-{{ $valid_till ? 'primary' : 'danger' }} dark fade show" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-clock">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    @if($valid_till)
                                        <p>Your Plan Will Be Expired On <strong>{{ $valid_till->formatted('d-M-Y H:i A') }}</strong>.</p>
                                    @else
                                        <p>Your Plan is Expired! Please Upgrade To Continue.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-3">
                    <h5> My Referrals </h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Package</th>
                                <th scope="col">Date Joined</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->referred as $referred)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $referred->name }}</td>
                                <td>{{ $referred->phone }}</td>
{{--                                <td>@foreach(str_split($referred->email) as $char) {{ $loop->first || $loop->last ? $char : '*' }} @endforeach</td>--}}
                                <td>{{ $referred->membership->plan->name }}</td>
                                <td>{{ $referred->created_at->format('d-M-Y H:i A') }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @push('scripts')
            <script src="{{ asset('cuba/user1/assets/js/clipboard/clipboard.js') }}"></script>
            <script src="{{ asset('cuba/user1/assets/js/clipboard/clipboard-script.js') }}"></script>
        @endpush
</x-user-layout>
