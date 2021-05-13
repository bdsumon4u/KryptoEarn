@push('styles')
    <link rel="stylesheet" href="{{ asset('cuba/disk/slider-captcha/slidercaptcha.min.css') }}">
    <style>
        .refreshIcon {
            top: -50px;
        }
    </style>
@endpush
<div id="captcha"></div>
@push('scripts')
    <script src="{{ asset('cuba/disk/slider-captcha/longbow.slidercaptcha.min.js') }}"></script>
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
