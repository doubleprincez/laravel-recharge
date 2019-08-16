<!-- Airtime purchase modal -->
<div class="modal fade" id="form"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Purchase Airtime</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="rechargeFrm" method="post" action="{{ route('recharge') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="recharge_type" value="1"/>
                    <div class="form-group">
                        <label for="email1">Amount</label>
                        <input type="number" class="form-control" id="email1" name="recharge_amount" placeholder="Amount to recharge" minlenght="10" required>
                    </div>
                    <div class="form-group">
                        <label for="Phone">Phone</label>
                        <input type="tel" class="form-control" id="Phone" name="recharge_phone" placeholder="Phone number" maxlength="11" required>
                    </div>
                    <div class="form-group">
                        <label for="Subscriber">Subscriber</label>
                        <select  id="inlineFormCustomSelect" name="recharge_network_id" class="form-control" required>
                            <option >Choose...</option>
                            <option value="1">Airtel</option>
                            <option value="2">MTN</option>
                            <option value="3">GLO</option>
                            <option value="4">9mobile</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                    <button type="submit" onsubmit="this.disabled=true;this.innerText='Sending…'" class="btn btn-success">Purchase</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- DATA Modal -->
<div class="modal fade " id="buyData"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Purchase DATA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="dataFrm" action="{{ route('data') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="type" value="2"/>
                    <div class="form-group">
                        <label for="Phone">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone number" required>
                    </div>
                    <div class="form-group">
                        <label for="Subscriber">Subscriber</label>
                        <select class="custom-select mr-sm-2 validate[required]"  name="networkID" id="mobdata"  required>
                            <option  >Choose...</option>
                            <option value="1">Airtel</option>
                            <option value="2">MTN</option>
                            <option value="3">GLO</option>
                            <option value="4">9mobile</option>
                        </select>
                    </div>

                    <!-- 9mobile data plan -->
                    <div class="form-group" id="mobile9">
                        <label for="plan1">9Mobile Data Plan</label>
                        <select class="custom-select mr-sm-2 " id="dtplan1" name="amount" >
                            <option  >Choose...</option>
                            <option value="500">500 (500MB)</option>
                            <option value="1000">1000 (1GB)</option>
                            <option value="1200">1200 (1.5GB)</option>
                            <option value="2000">2000 (2.5GB)</option>
                            <option value="3000">3000 (3.5GB)</option>
                            <option value="3500">3500 (5GB)</option>
                            <option value="8000">8000 (11GB)</option>
                            <option value="10000">10000 (15GB)</option>
                        </select>
                    </div>

                    <!-- Airtel data plan -->
                    <div class="form-group"   id="airtel">
                        <label for="plan">Airtel Data Plan</label>
                        <select class="custom-select mr-sm-2" id="dtplan" name="amount" >
                            <option  >Choose..</option>
                            <option value="300">300 (350MB + 10% Extra)</option>
                            <option value="500">500 (750MB + 10% Extra)</option>
                            <option value="1000">1000 (1.5GB + 10% Extra)</option>
                            <option value="1500">1500 (3.5GB)2.5GB+1GB(1AM-7AM) + 10%)</option>
                            <option value="2000">2000 ((3.5GB) + 10% Extra)</option>
                            <option value="2500">2500 (5.5GB 4.5GB+1GB(1AM-7AM)+ 10%)</option>
                            <option value="3000">3000 (6.5GB 5.5GB+1GB(1AM-7AM) + 10%)</option>
                            <option value="4000">4000 ((9.5GB)7.5GB+2GB(1AM-7AM) + 10%)</option>
                            <option value="5000">5000 ((12GB)10GB+2GB(1AM-7AM) + 10%)</option>
                        </select>
                    </div>

                    <!-- Glo mobie data -->
                    <div class="form-group"  id="glo">
                        <label for="plan">Glo Data Plan</label>
                        <select class="custom-select mr-sm-2" id="dtplan" name="amount" >
                            <option  >Choose...</option>
                            <option value="200">200 (242MB)</option>
                            <option value="500">500 (920MB)</option>
                            <option value="1000">1000 (1.8GB)</option>
                            <option value="2000">2000 (4.5GB)</option>
                            <option value="2500">2500 (7.2GB)</option>
                            <option value="3000">3000 (8.75GB)</option>
                            <option value="4000">4000 (12.5GB)</option>
                            <option value="5000">5000 (15.6GB)</option>
                        </select>
                    </div>

                    <!-- mtn mobile data -->
                    <div class="form-group" id="mtn">
                        <label for="plan">MTN Data Plan</label>
                        <select class="custom-select mr-sm-2" id="dtplan" name="amount">
                            <option >Choose...</option>
                            <option value="200">200 (100MB)</option>
                            <option value="500">500 (750MB)</option>
                            <option value="1000">1000 (1GB)</option>
                            <option value="1500">1500 (3GB)</option>
                            <option value="2000">2000 (3.5GB)</option>
                            <option value="5000">5000 (10GB)</option>
                            <option value="6000">6000 (15GB)</option>
                            <option value="10000">5000 (22GB)</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                    <button type="submit"  class="btn btn-success">Subscribe</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- CABLE TV  modal -->
<div class="modal fade" id="cabletv"   tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Recharge CABLE TV</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="cableFrm" method="POST" action="{{ route('cable') }}">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="account">Unique id</label>
                        <input type="text" class="form-control" name="account" id="uid" placeholder="Decoder ID" required maxlength="20">
                    </div>

                    <div class="form-group">
                        <label for="customer_name">Customer Name</label>
                        <input type="text" class="form-control" name="customer_name" placeholder="Customer Name" required maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="Subscriber">Subscriber</label>
                        <select class="custom-select mr-sm-2 validate[required]" name="type" id="cable"   required>
                            <option >Choose One</option>
                            <option value="30">DSTV</option>
                            <option value="40">GOTV</option>
                        </select>
                    </div>


                    <!-- GOTV plan -->
                    <div class="form-group"  id="gotv">
                        <label for="ctplan">GOTV PLANS</label>
                        <select class="custom-select mr-sm-2" id="ctplan" name="amount">
                            <option>Choose One</option>
                            <option value="400">400 (GOTV LITE MONTHLY)</option>
                            <option value="1050">1050 (GOTV LITE QUATERLY)</option>
                            <option value="1250">1250 (GOTV VALUE)</option>
                            <option value="1990">1900 (GOTV PLUS)</option>
                            <option value="3200">3200 (GOTV MAX)</option>
                        </select>
                    </div>

                    <!--DSTV PLANS -->

                    <div class="form-group" id="dstv">
                        <label for="ctplan1">DSTV PLANS</label>
                        <select class="custom-select mr-sm-2" id="ctplan1" name="amount"  >
                            <option >Choose One</option>
                            <option value="2000">2000 (DSTV ACCESS)</option>
                            <option value="4000">4000 (DSTV FAMILY)</option>
                            <option value="5400">5400 (ASIAN BOUQET)</option>
                            <option value="6000">6000 (DSTV COMPACT)</option>
                            <option value="10650">10650 (DSTV COMPACT PLUS)</option>
                            <option value="15800">15800 (DSTV PREMIUM)</option>
                            <option value="17700">17700 (DSTV PREMIUM ASIA)</option>
                            <option value="5400">5400 (ASIAN BOUQET)</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                    <button type="submit" onsubmit="this.disabled=true;this.innerText='Subscribing…'" class="btn btn-success">Subscribe</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{--<!-- By Pin Card -->--}}
{{--<div class="modal fade" id="buyPin"  tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
    {{--<div class="modal-dialog" role="document">--}}
        {{--<div class="modal-content">--}}
            {{--<div class="modal-header border-bottom-0">--}}
                {{--<h5 class="modal-title" id="buyPin">Purchase Pin</h5>--}}
                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                    {{--<span aria-hidden="true">&times;</span>--}}
                {{--</button>--}}
            {{--</div>--}}
            {{--<form method="POST" action="{{ route('pin') }}">--}}
                {{--@csrf--}}
                {{--<input type="hidden" name="pin_type" value="3"/>--}}
                {{--<div class="modal-body">--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="pinNetworkId">Network</label>--}}
                        {{--<select class="custom-select mr-sm-2 validate[required]" name="pin_network_id" id="pinNetworkId" required>--}}
                            {{--<option value="" selected>Choose One</option>--}}
                            {{--<option value="1">Airtel</option>--}}
                            {{--<option value="3">Glo</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="pinPhone">Phone Number </label>--}}
                        {{--<input type="text" class="form-control" name="pin_phone" id="pinPhone" placeholder="Phone Number" required maxlength="11">--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="pinAmount">Amount</label>--}}
                        {{--<input type="text" class="form-control" name="pin_amount" id="pinAmount" placeholder="Amount" required maxlength="8">--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="modal-footer border-top-0 d-flex justify-content-center">--}}
                    {{--<button type="submit" onsubmit="this.disabled=true;this.innerText='Subscribing…'" class="btn btn-success">Subscribe</button>--}}
                {{--</div>--}}
            {{--</form>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}


<!-- wallet to wallet -->
<div class="modal fade" id="wallet"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">WALLET TO WALLET TRANSFER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="walletFrm" action="{{ route('wallet') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Amount">Amount</label>
                        <input type="number" class="form-control" id="Amount" name="amount" placeholder="Amount to Transfer"  maxlength="9000">
                    </div>
                    <div class="form-group">
                        <label for="Phone">Wallet id</label>
                        <input type="text" class="form-control" id="wallet_id" name="wallet_id" placeholder="Wallet Id">
                    </div>

                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                    <button type="submit" onsubmit="this.disabled=true;this.innerText='Transfering…'" class="btn btn-success">Transfer</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Electricity purchase modal -->
<div class="modal fade" id="electricity"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Electricity Purchase</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <form method="post" id="electricityFrm" action="{{ route('electricity') }}">
                    @csrf
                    <div class="form-group">
                        <label for="Subscriber">Company</label>
                        <select  id="elect"  class="form-control" required>
                            <option >Choose One</option>
                            <option value="1">Ikeja EDC</option>
                            <option value="2">Ibadan EDC Prepaid</option>
                            <option value="3">Eko EDC</option>
                            <option value="4">PortHarcourt EDC</option>
                            <option value="5">Enugu EDC</option>
                            <option value="6">Abuja EDC Prepaid</option>
                        </select>
                    </div>


                    <div class="modal-body">
                        <div class="form-group" id="ikejaType">
                            <label >Type</label>
                            <select  class="form-control" >
                                <option>Choose One</option>
                                <option value="10" >Ikeja Postpaid</option>
                                <option value="11">Ikeja Prepaid</option>
                            </select>
                        </div>
                        <div class="form-group" id="ibadanType">
                            <input type="hidden"  value="12" />
                        </div>
                        <div class="form-group" id="ekoType" >
                            <select class="form-control" >
                                <option>Choose One</option>
                                <option value="13" >Eko Postpaid</option>
                                <option value="14">Eko Prepaid</option>
                            </select>
                        </div>
                        <div id="portType" class="form-group">
                            <select class="form-control" >
                                <option>Choose One</option>
                                <option  value="15">Portharcourt Postpaid</option>
                                <option value="16">Portharcourt Prepaid</option>
                            </select>
                        </div>
                        <div class="form-group" id="enuguType" >
                            <select class="form-control" >
                                <option >Choose One</option>
                                <option value="21" >Enugu EDC Postpaid</option>
                                <option value="22">Enugu EDC Prepaid</option>
                            </select>
                        </div>
                        <div class="form-group" id="abujaType">
                            <input type="hidden"  value="24"/>
                        </div>

                        <div class="form-group" id="customername" >
                            <label for="customername">Customer Name</label>
                            <input type="text" class="form-control" name="customer_name" placeholder="Customer Name">
                        </div>


                        <div class="form-group" id="customerphone">
                            <label for="customerphone">Customer phone</label>
                            <input type="text" class="form-control"  name="customer_phone" placeholder="Customer phone" maxlength="11">
                        </div>


                        <div class="form-group" id="lnd">
                            <label for="Subscriber">Landlord or Tenant</label>
                            <select  id="inlineFormCustomSelect" name="contact_type" class="form-control" >
                                <option>Choose One</option>
                                <option value="tenant">Tenant</option>
                                <option value="landlord">Landlord</option>
                            </select>
                        </div>


                        <div class="form-group" id="customeraddress">
                            <label  >Customer Address</label>
                            <textarea  class="form-control"  name="customer_address" placeholder="Customer Address" maxlength="500" cols="5"> </textarea>
                        </div>


                        <div class="form-group"  id="accountM">
                            <label for="account">Meter id</label>
                            <input type="text" class="form-control" name="account" placeholder="METER ID" maxlength="15">
                        </div>

                        <div class="form-group" id="amountM">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control"  name="amount" placeholder="Amount" maxlength="8">
                        </div>


                    </div>

                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                        <button onsubmit="this.disabled=true;this.innerText='Purchasing...' " type="submit" class="btn btn-success">Purchase</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>


<!-- Pay for others -->
<div class="modal fade" id="Activate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Activate Others</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="payFrm" action="{{ route('pay') }}">
                <div id="activateOthersMsg"></div>
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="tel" class="form-control" name="phone" id="activateOthersPhone"
                               placeholder="Wallet Phone Number" maxlength="11" onkeyup="checkWalletUser()"><span
                                class="fa fa-spinner fa-spin" style="display: none" id="activateOthersLoader"></span>
                    </div>
                    <div class="form-group" id="activateOthersAcctName" style="display: none">
                        <h3 id="activateAcctName"></h3>
                    </div>
                    <input type="hidden" name="metadata"
                           value="{{ json_encode($array = ['transaction' => 'activate',]) }}">
                    <input type="hidden" id="hiddenActivateOthersName" name="name" value=""> {{-- required --}}
                    <input type="hidden" id="hiddenActivateOthersEmail" name="email" value=""> {{-- required --}}
                    <input type="hidden" name="amount" value="1000000"> {{-- required --}}
                    <input type="hidden" id="hiddenActivateOthersPhone" name="phone" value="">
                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                    <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                    <button type="submit" onsubmit="this.disabled=true;this.innerText='Activating...'" id="walletToWalletBtn" class="btn btn-success" disabled>Activate</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Account Top up-->
<div class="modal fade" id="Topup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Top Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="topupFrm" action="{{ route('pay') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">

                        <input type="text" name="amount" class="form-control" id="amount" placeholder="Amount" required>
                        <input type="hidden" name="metadata" value="{{ json_encode($array = ['transaction' => 'topup',]) }}">
                        <input type="hidden" name="email" value="{{ auth()->user()->email }}"> {{-- required --}}

                        <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                        <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                    </div>

                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                    <button onsubmit="this.disabled=true;this.innerText='Sending…'" type="submit" class="btn btn-success">Top up</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>


    function checkWalletUser() {
        let phone = $("#activateOthersPhone");
        let activateOthersLoader = $("#activateOthersLoader");
        let activateOthersMsg = $('#activateOthersMsg');
        let activateOthersAcctName = $('#activateOthersAcctName');
        let activateAcctName = $('#activateAcctName');
        let walletToWalletBtn = $('#walletToWalletBtn');
        let hiddenActivateOthersName = $('#hiddenActivateOthersName');
        let hiddenActivateOthersEmail = $('#hiddenActivateOthersEmail');
        let hiddenActivateOthersPhone = $('#hiddenActivateOthersPhone');

        let value = phone.val();
        if (value.length === 11) {

            let result = {'_token': '{{ csrf_token() }}', 'phone': value};
            $.ajax({
                'url': '/fetchWalletAccount',
                'type': 'post',
                'data': result,
                beforeSend() {
                    walletToWalletBtn.attr('disabled', 'disabled');
                    activateOthersLoader.show();
                },
                success(data) {
                    activateOthersLoader.hide();
                    if (data.activated === 'true' || data.activated === true) {
                        activateOthersMsg.attr('class', 'alert alert-danger').html('Account already activated').show();
                        walletToWalletBtn.attr('disabled', 'disabled');
                        activateOthersAcctName.hide();
                    }else if(data.error && data.error!==''){
                        activateOthersMsg.attr('class', 'alert alert-danger').html(''+data.error).show();
                        walletToWalletBtn.attr('disabled', 'disabled');
                        activateOthersAcctName.hide();
                    } else {
                        activateOthersMsg.removeAttr('class').fadeOut();
                        activateAcctName.html(data.name);
                        activateOthersAcctName.show();
                        hiddenActivateOthersName.val(data.name);
                        hiddenActivateOthersEmail.val(data.email);
                        hiddenActivateOthersPhone.val(data.phone);

                        walletToWalletBtn.removeAttr('disabled');
                    }

                },
                error(err) {
                    walletToWalletBtn.attr('disabled', 'disabled');
                    activateOthersAcctName.hide();
                    activateOthersMsg.attr('class', 'alert alert-danger').html(err.responseText).show();
                }
            });
        } else if (value.length < 11) {
            $.ajax().abort();
            activateOthersAcctName.hide();
            activateOthersLoader.hide();
            activateOthersMsg.fadeOut();
        }
        walletToWalletBtn.attr('disabled', 'disabled');
    }


</script>
