<x-user-layout>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="row layout-top-spacing" style="margin: 20px;">
                    <div id="typographyHeading" class="col-lg-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area">
                                <div class="row">
                                    <div class="single-price col-sm-12 col-md-12 col-lg-6">
                                        <ul>
                                            <li class="list-group-item text-color"> Amount :<span style="color: green"> 0.00018000 </span>
                                                BTC
                                            </li>
                                            <li class="list-group-item text-color">
                                                <div class="input-group"> Address
                                                    <input value="3HFzmXscmNcbNz13B3Pz6LXaiifNADxv1c"
                                                           class="form-control" readonly="" id="clipboardExample1"
                                                           type="text">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <button
                                                                class="btn btn-xs btn-secondary btn-clipboard"
                                                                type="button" data-clipboard-action="copy"
                                                                data-clipboard-target="#clipboardExample1"
                                                            >
                                                                <i class="fa fa-copy"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item text-color">
                                                <div style="margin: 0 auto;">
                                                    <img
                                                        src="https://chart.googleapis.com/chart?chs=300x300&amp;cht=qr&amp;chl=bitcoin:3HFzmXscmNcbNz13B3Pz6LXaiifNADxv1c&amp;choe=UTF-8"
                                                        title="" style="width:300px;">
                                                </div>
                                                <span>
                                                    Login to your Crypto Wallet (e.g Blockchain,Coinpayments,CoinsPH,LunoWallet etc.) and send exactly <strong> 0.00018000 BTC </strong> to <strong> 3HFzmXscmNcbNz13B3Pz6LXaiifNADxv1c </strong>.
                                                    Alternatively, scan the above QR to send from your wallet.
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6"><h6 class=" mb-0 ">Waiting for payments...</h6>
                                        <div class="col-md-3">
                                            <div class="loader-box">
                                                <div class="loader-17"></div>
                                            </div>
                                        </div>
                                        <span id="status">Received 0 BTC.</span><br>
                                        <span id="status_more"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(function(){
                function update(){
                    $.getJSON("https://sochain.com/api/v2/get_address_balance/BTC/3HFzmXscmNcbNz13B3Pz6LXaiifNADxv1c", function(json){
                        console.log(json);
                        //var obj = JSON.parse(json);
                        var status = json.status;
                        if(status == "success"){
                            var data = json.data;
                            var confirmed_balance = parseFloat(data.confirmed_balance);
                            var unconfirmed_balance = parseFloat(data.unconfirmed_balance);
                            var network = data.network;
                            console.log(confirmed_balance);
                            console.log(unconfirmed_balance);
                            if(unconfirmed_balance == 0){
                                $("#status").text("Received 0 BTC.");
                            }else{
                                $("#status").css("color", "green");
                                // $("#status_more").css("color", "green");
                                $("#status").text("Received "+unconfirmed_balance+" BTC");
                                $("#status_more").text("Waiting for atleast 3 confimations before your wallet is funded...You can exit this page if need be.");
                            }
                        }
                    });
                }
                setInterval(update, 30000);
                update();
            });
        </script>
    @endpush
</x-user-layout>
