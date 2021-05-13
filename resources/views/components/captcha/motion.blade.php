@push('styles')
    <link rel="stylesheet" href="{{ asset('cuba/disk/motion-captcha/jquery.motionCaptcha.0.2.css') }}">
    <style>
        /* MotionCAPTCHA canvas */
        #mc-canvas {
            margin: 0 auto 20px;
            padding: 1px;
            display: block;
            border: 1px solid #433e45;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
        }
        #mc-canvas.mc-invalid {
            border: 1px solid #aa4444;
        }
        #mc-canvas.mc-valid {
            border: 1px solid #44aa44;
        }
    </style>
@endpush
<div id="mc">
    <p>Please draw the shape in the box to submit the form:</p>
    <canvas id="mc-canvas"></canvas>
</div>
@push('scripts')
    <script src="{{ asset('cuba/disk/motion-captcha/jquery.motionCaptcha.0.2.js') }}"></script>
    <script>
        $('#form').motionCaptcha({
            shapes: ['triangle', 'x', 'rectangle', 'circle', 'check', 'zigzag', 'arrow', 'delete', 'pigtail', 'star']
        });
    </script>
@endpush
