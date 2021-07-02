<x-user-layout>
    @push('styles')
        <style>
            .captcha-card {
                margin: 0 auto;
                width: 290px;
                height: 360px;
                border-radius: 4px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.125);

                display: flex;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-clip: border-box;
                border: 1px solid rgba(0,0,0,.125);
            }

            .captcha-card .card-header {
                background-image: none;
                background-color: rgba(0, 0, 0, 0.03);
            }

            .captcha-card .card-body {
                padding: 1rem;
            }

            .captcha-card canvas:first-child {
                border-radius: 4px;
                border: 1px solid #e6e8eb;
            }
        </style>
    @endpush
    <x-slot name="title">Tasks</x-slot>
    <div class="container-fluid search-page">
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="card">
                    <div class="card-body"><h6 class="mb-2">{{ $user->task_remaining }} captcha remaining.</h6>
                        <div class="row" style="margin-bottom: 25px;">
                            <div class="col p-0">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th style="width:40%;" scope="col"></th>
                                            <th scope="col">
                                                <img style="max-height:100px;height:auto;width:auto;" src="{{ asset('cuba/user1/assets/images/captcha/'.$captcha['provider']['image']) }}" alt="{{ $captcha['provider']['source'] }}">
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">Captcha ID:</th>
                                            <td>{{ $captcha['id'] }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Source:</th>
                                            <td>{{ $captcha['provider']['source'] }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Timeout:</th>
                                            <td>{{ now(config('app.timezone'))->addSeconds($timeout)->format('d-M-Y h:i:s A') }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Time remaining:</th>
                                            <td>
                                                <text id="diswpute">Timed out!</text>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <form method="post" action="{{ route('tasks.store') }}" id="form" class="mt-3">
                                    @csrf
                                    <input name="captcha_id" type="hidden" value="7338" />
                                    <div class="card captcha-card">
                                        <div class="card-header p-2">
                                            <span>Drag/Draw To Earn</span>
                                        </div>
                                        <div class="card-body p-1">
                                            <x:dynamic-component :component="'captcha.'.$captcha['type']" />
                                        </div>
                                        <div class="card-footer p-2">
                                            <div class="d-flex justify-content-around">
                                                <button type="submit" name="skip" value="skip" class="btn btn-light">Skip</button>
                                                <input disabled id="submit" class="btn btn-primary" type="submit" value="Submit" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            let intervalTimer;
            let timeLeft = 0;
            let wholeTime = {{ $timeout }};
            // let progressBar = document.querySelector('.e-c-progress');
            // let indicator = document.getElementById('e-indicator');
            // let pointer = document.getElementById('e-pointer');
            let dispute = document.getElementById('diswpute');
            // let length = Math.PI * 2 * 100;
            // progressBar.style.strokeDasharray = length;
            function update(value, timePercent = 12) {
                var offset = -length - length * value / (timePercent);
                //progressBar.style.strokeDashoffset = offset;
                //pointer.style.transform = `rotate(${360 * value / (timePercent)}deg)`;
            }
            const displayOutput = document.querySelector('.display-remain-time')
            const pauseBtn = document.getElementById('pause');
            const setterBtns = document.querySelectorAll('button[data-setter]');
            update(wholeTime);
            displayTimeLeft(wholeTime);
            function changeWholeTime(seconds){
                if ((wholeTime + seconds) > 0){
                    wholeTime += seconds;
                    update(wholeTime);
                }
            }
            function timer(seconds){
                let remainTime = Date.now() + (seconds * 1000);
                displayTimeLeft(seconds);
                intervalTimer = setInterval(function(){
                    timeLeft = Math.round((remainTime - Date.now()) / 1000);
                    // console.log(timeLeft);
                    let isStarted;
                    if (timeLeft <= 0) {
                        clearInterval(intervalTimer);
                        isStarted = false;
                        displayTimeLeft(0);
                        return;
                    }
                    displayTimeLeft(timeLeft);
                }, 1000);
            }
            function displayTimeLeft(timeLeft){
                //console.log(timeLeft);
                let minutes = Math.floor(timeLeft / 60);
                let seconds = timeLeft % 60;
                let displayString = `${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
                //displayOutput.textContent = displayString;
                dispute.textContent = "Time remaining " + minutes + " minutes " + seconds + " seconds!";
                if (minutes === 0 && seconds === 0){
                    //location.reload();
                    dispute.textContent = "Timed out!";
                }else {
                    update(timeLeft);
                }
            }
            timer(wholeTime);
        </script>
    @endpush
</x-user-layout>
