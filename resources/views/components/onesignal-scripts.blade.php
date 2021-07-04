@if(config('services.onesignal.enabled'))
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
        window.OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "{{ config('services.onesignal.app_id') }}",
            });
        });
    </script>
@endif
