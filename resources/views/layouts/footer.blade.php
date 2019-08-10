<script src="{{asset('js/jquery3.min.js')}}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>

@if(auth()->check())

    <script src="{{asset('js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/jquery-slim.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-notify.js')}}"></script>
    <script src="{{ asset('js/chartjs.min.js') }}"></script>
    <script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{asset('js/demo.js')}}"></script>
    <script src="{{asset('js/paper-dashboard.js')}}"></script>
    <script src="{{asset('js/paper-dashboard.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/paper-dashboard.js')}}"></script>

    <script src="{{asset('js/tether.min.js')}}"></script>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>

    <!--JS below-->
    <!--modal-->
    <script type="text/javascript">

        let defaultServices = $('#defaultServices'); let specialServices = $('#specialServices');
        let rechargeFrm = $('#rechargeFrm'); let dataFrm = $('#dataFrm');
        let includeToAll ='<input type="hidden" id="special" name="special" value="1" />';
        let cableFrm = $('#cableFrm'); let walletFrm = $('#walletFrm');
        let electricityFrm = $('#electricityFrm'); let payFrm = $('#payFrm');
        let topupFrm = $('#topupFrm'); let messenger = $('#dpMsg');

        function setDefault() {
            defaultServices.hide();
            specialServices.show();
            messenger.html('USER CONTROLS - WITHOUT BONUS');
            $('#special').remove();

        }

        function setSpecial() {
           specialServices.hide(); defaultServices.show();
           messenger.html('USER CONTROLS - WITH BONUS <br/><small>Note: a fee of 10% will be added to all transactions</small>');
            rechargeFrm.prepend(includeToAll);cableFrm.prepend(includeToAll);
            cableFrm.prepend(includeToAll); walletFrm.prepend(includeToAll);
            electricityFrm.prepend(includeToAll); payFrm.prepend(includeToAll);
            topupFrm.prepend(includeToAll);

        }

        $('#mobile9').hide();
        $('#glo').hide();
        $('#airtel').hide();
        $('#mtn').hide();
        $('#mobdata').on('change', function () {
            if ($(this).val() === "1") {
                $('#glo').hide().find('select').removeAttr('required');
                $('#airtel').show().find('select').attr('required', 'required');
                $('#mtn').hide().find('select').removeAttr('required');
                $('#mobile9').hide().find('select').removeAttr('required');

            }
            else if ($(this).val() === "2") {
                $('#mobile9').hide().find('select').removeAttr('required');
                $('#glo').hide().find('select').removeAttr('required');
                $('#mtn').show().find('select').attr('required', 'required');
                $('#airtel').hide().find('select').removeAttr('required');

            } else if ($(this).val() === "3") {
                $('#mobile9').hide().find('select').removeAttr('required');
                $('#airtel').hide().find('select').removeAttr('required');
                $('#glo').show().find('select').attr('required', 'required');
                $('#mtn').hide().find('select').removeAttr('required');
            }
            else if ($(this).val() === "4") {
                $('#mobile9').show().find('select').attr('required', 'required');
                $('#airtel').hide().find('select').removeAttr('required');
                $('#mtn').hide().find('select').removeAttr('required');
                $('#glo').hide().find('select').removeAttr('required');
            }

            else {
                $('#mobile9').hide().find('select').removeAttr('required');
                $('#glo').hide().find('select').removeAttr('required');
                $('#airtel').hide().find('select').removeAttr('required');
                $('#mtn').hide().find('select').removeAttr('required');
            }
        });


        <!--CABLE TV SCRIPT-->

        $('#dstv').hide();
        $('#gotv').hide();
        $('#cable').on('change', function () {
            if ($(this).val() === "30") {
                $('#gotv').hide().find('select').removeAttr('required');
                $('#dstv').show().find('select').attr('required', 'required');
            }
            else if ($(this).val() === "40") {
                $('#gotv').show().find('select').attr('required', 'required');
                $('#dstv').hide().find('select').removeAttr('required');
            }
            else {
                $('#gotv').hide().find('select').removeAttr('required');
                $('#dstv').hide().find('select').removeAttr('required');
            }
        });

        <!-- Electricity Script -->

        let cName = $('#customername');
        let cPhone = $('#customerphone');
        let cLand = $('#lnd');
        let cAdd = $('#customeraddress');
        let cAcct = $('#accountM');
        let cAmount = $('#amountM');
        let ikeja = $('#ikejaType');
        let ibadan = $('#ibadanType');
        let eko = $('#ekoType');
        let portH = $('#portType');
        let enugu = $('#enuguType');
        let abuja = $('#abujaType');


        cName.hide().find('input').removeAttr('required');
        cPhone.hide().find('input').removeAttr('required');
        cLand.hide().find('select').removeAttr('required');
        cAdd.hide().find('textarea').removeAttr('required');
        cAcct.hide().find('input').removeAttr('required');
        cAmount.hide().find('input').removeAttr('required');
        ikeja.hide().find('select').removeAttr('required').removeAttr('name');
        ibadan.hide().find('input').removeAttr('required').removeAttr('name');
        eko.hide().find('select').removeAttr('required').removeAttr('name');
        portH.hide().find('select').removeAttr('required').removeAttr('name');
        enugu.hide().find('select').removeAttr('required').removeAttr('name');
        abuja.hide().find('input').removeAttr('required').removeAttr('name');

        $('#elect').on('change', function () {

            if ($(this).val() === "1") {
                cName.show().find('input').attr('required', 'required');
                cPhone.hide().find('input').removeAttr('required').hide();
                cLand.show().find('select').attr('required', 'required');
                cAdd.show().find('textarea').attr('required', 'required').show();
                cAcct.show().find('input').attr('required', 'required');
                cAmount.show().find('input').attr('required', 'required');

                ikeja.show().find('select').attr('required', 'required').attr('name', 'type').show();
                ibadan.hide().find('input').removeAttr('required').removeAttr('name').hide();
                eko.hide().find('select').removeAttr('required').removeAttr('name').hide();
                portH.hide().find('select').removeAttr('required').removeAttr('name').hide();
                enugu.hide().find('select').removeAttr('required').removeAttr('name').hide();
                abuja.hide().find('input').removeAttr('required').removeAttr('name').hide();
            }
            else if ($(this).val() === "2") {
                cName.show().find('input').attr('required', 'required');
                cPhone.hide().find('input').removeAttr('required').hide();
                cLand.show().find('select').attr('required', 'required');
                cAdd.show().find('textarea').attr('required', 'required').show();
                cAcct.show().find('input').attr('required', 'required');
                cAmount.show().find('input').attr('required', 'required');

                ibadan.show().find('input').attr('required', 'required').attr('name', 'type').show();
                ikeja.hide().find('select').removeAttr('required').removeAttr('name').hide();
                eko.hide().find('select').removeAttr('required').removeAttr('name').hide();
                portH.hide().find('select').removeAttr('required').removeAttr('name').hide();
                enugu.hide().find('select').removeAttr('required').removeAttr('name').hide();
                abuja.hide().find('input').removeAttr('required').removeAttr('name').hide();
            }
            else if ($(this).val() === "3") {
                cName.show().find('input').attr('required', 'required');
                cPhone.show().find('input').attr('required', 'required').show();
                cLand.show().find('select').attr('required', 'required');
                cAdd.hide().find('textarea').removeAttr('required').hide();
                cAcct.show().find('input').attr('required', 'required');
                cAmount.show().find('input').attr('required', 'required');

                eko.show().find('input').attr('required', 'required').attr('name', 'type').show();
                ikeja.hide().find('select').removeAttr('required').removeAttr('name').hide();
                ibadan.hide().find('input').removeAttr('required').removeAttr('name').hide();
                portH.hide().find('select').removeAttr('required').removeAttr('name').hide();
                enugu.hide().find('select').removeAttr('required').removeAttr('name').hide();
                abuja.hide().find('input').removeAttr('required').removeAttr('name').hide();
            }
            else if ($(this).val() === "4") {
                cName.show().find('input').attr('required', 'required');
                cPhone.show().find('input').attr('required', 'required').show();
                cLand.show().find('select').attr('required', 'required');
                cAdd.hide().find('textarea').removeAttr('required').hide();
                cAcct.hide().find('input').removeAttr('required');
                cAmount.show().find('input').attr('required', 'required');

                portH.show().find('select').attr('required', 'required').attr('name', 'type').show();
                ikeja.hide().find('select').removeAttr('required').removeAttr('name').hide();
                ibadan.hide().find('input').removeAttr('required').removeAttr('name').hide();
                eko.hide().find('input').removeAttr('required').removeAttr('name').hide();
                enugu.hide().find('select').removeAttr('required').removeAttr('name').hide();
                abuja.hide().find('input').removeAttr('required').removeAttr('name').hide();
            }
            else if ($(this).val() === "5") {
                cName.show().find('input').attr('required', 'required');
                cPhone.show().find('input').attr('required', 'required');
                cLand.show().find('select').attr('required', 'required');
                cAdd.show().find('textarea').attr('required', 'required');
                cAcct.show().find('input').attr('required', 'required');
                cAmount.show().find('input').attr('required', 'required');

                enugu.show().find('select').attr('required', 'required').attr('name', 'type').show();
                ikeja.hide().find('select').removeAttr('required').removeAttr('name').hide();
                ibadan.hide().find('input').removeAttr('required').removeAttr('name').hide();
                eko.hide().find('input').removeAttr('required').removeAttr('name').hide();
                portH.hide().find('select').removeAttr('required').removeAttr('name').hide();
                abuja.hide().removeAttr('required').removeAttr('name').hide();
            }
            else if ($(this).val() === "6") {
                cName.show().find('input').attr('required', 'required');
                cPhone.show().find('input').attr('required', 'required').show();
                cLand.show().find('select').attr('required', 'required');
                cAdd.show().find('textarea').attr('required', 'required').show();
                cAcct.show().find('input').attr('required', 'required');
                cAmount.show().find('input').attr('required', 'required');

                abuja.show().find('input').attr('required', 'required').attr('name', 'type').show();
                ikeja.hide().find('select').removeAttr('required').removeAttr('name').hide();
                ibadan.hide().find('input').removeAttr('required').removeAttr('name').hide();
                eko.hide().find('select').removeAttr('required').removeAttr('name').hide();
                portH.hide().find('select').removeAttr('required').removeAttr('name').hide();
                enugu.hide().find('select').removeAttr('required').removeAttr('name').hide();
            }
            else {
                cName.hide().find('input').removeAttr('required');
                cPhone.hide().find('input').removeAttr('required').hide();
                cLand.hide().find('select').removeAttr('required');
                cAdd.hide().find('textarea').removeAttr('required').hide();
                cAcct.hide().find('input').removeAttr('required');
                cAmount.hide().find('input').removeAttr('required');

                ikeja.hide().find('select').removeAttr('required').hide().removeAttr('name');
                ibadan.hide().find('input').removeAttr('required').hide().removeAttr('name');
                eko.hide().find('select').removeAttr('required').hide().removeAttr('name');
                portH.hide().find('select').removeAttr('required').hide().removeAttr('name');
                enugu.hide().find('select').removeAttr('required').hide().removeAttr('name');
                abuja.hide().find('input').removeAttr('required').hide().removeAttr('name');
            }
        });


    </script>

@endif
