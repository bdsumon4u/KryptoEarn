<x-user-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('cuba/disk/slidercaptcha.min.css') }}">
        <style>
            .slidercaptcha {
                margin: 0 auto;
                width: 315px;
                height: 330px;
                border-radius: 4px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.125);
            }

            .slidercaptcha .card-body {
                padding: 1rem;
            }

            .slidercaptcha canvas:first-child {
                border-radius: 4px;
                border: 1px solid #e6e8eb;
            }

            .slidercaptcha.card .card-header {
                background-image: none;
                background-color: rgba(0, 0, 0, 0.03);
            }

            .refreshIcon {
                top: -50px;
            }
        </style>
    @endpush
    <x-slot name="title">Tasks</x-slot>
    <div class="row">
        <div class="col-sm-8 col-md-3 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('tasks.store') }}" id="form">
                        @csrf
                        <input name="captcha_id" type="hidden" value="7338" />
                        <div class="slidercaptcha card">
                            <div class="card-header p-2">
                                <span>Drag To Earn</span>
                            </div>
                            <div class="card-body">
                                <div id="captcha"></div>
                            </div>
                            <div class="card-footer p-2">
                                <div class="d-flex justify-content-around">
                                    <button type="submit" name="skip" value="skip" class="btn btn-light">Skip</button>
                                    <button disabled id="submit" class="btn btn-primary" type="submit"> Submit </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('cuba/disk/longbow.slidercaptcha.min.js') }}"></script>
        <script>
            var captcha = sliderCaptcha({
                id: 'captcha',
                repeatIcon: 'fa fa-repeat',
                onSuccess: function () {
                    $('#submit').removeAttr('disabled');
                    // var handler = setTimeout(function () {
                    //     window.clearTimeout(handler);
                    //     captcha.reset();
                    // }, 500);
                }
            });
        </script>
    @endpush
</x-user-layout>
