<!-- jQuery -->
  <script src="{{asset('admin/vendors/jquery/dist/jquery.min.js')}}"></script>
  <!-- Bootstrap -->
  <script src="{{asset('admin/vendors/bootstrap/b3/js/bootstrap.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{asset('admin/vendors/fastclick/lib/fastclick.js')}}"></script>
  <!-- NProgress -->
  <script src="{{asset('admin/vendors/nprogress/nprogress.js')}}"></script>

  <!-- validator -->
  <script src="{{asset('admin/vendors/validator/validator.js')}}"></script>

  <script src="{{ asset('build/js/custom.min.js') }}"></script>

  <!-- bootstrap-progressbar -->
  <script src="{{asset('admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
  <!-- iCheck -->
  <script src="{{asset('admin/vendors/iCheck/icheck.min.js')}}"></script>
  <!-- Skycons -->
  <script src="{{asset('admin/vendors/skycons/skycons.js')}}"></script>
  <!-- Flot -->
  <script src="{{asset('admin/vendors/Flot/jquery.flot.js')}}"></script>
  <script src="{{asset('admin/vendors/Flot/jquery.flot.pie.js')}}"></script>
  <script src="{{asset('admin/vendors/Flot/jquery.flot.time.js')}}"></script>
  <script src="{{asset('admin/vendors/Flot/jquery.flot.stack.js')}}"></script>
  <script src="{{asset('admin/vendors/Flot/jquery.flot.resize.js')}}"></script>
  <!-- Flot plugins -->
  <script src="{{asset('admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
  <script src="{{asset('admin/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
  <script src="{{asset('admin/vendors/flot.curvedlines/curvedLines.js')}}"></script>
  <!-- DateJS -->
  <script src="{{asset('admin/vendors/DateJS/build/date.js')}}"></script>

  <!-- bootstrap-daterangepicker -->
  <script src="{{asset('admin/vendors/moment/min/moment.min.js')}}"></script>
  <script src="{{asset('admin/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

  <!-- Custom Theme Scripts -->
  <script src="{{asset('admin/build/js/custom.min.js')}}"></script>

  <script src="{{asset('admin/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{asset('admin/vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{asset('admin/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin/vendors/pdfmake/build/vfs_fonts.js')}}"></script>




    <script type="text/javascript">
        $('#cbonus').hide();
        $('#cupdate').hide();

        $('#cedit').on('click', function() {

              $('#cedit').hide();
              $('#creset').hide();
              $('#cbonus').show();
              $('#cupdate').show();

        });

    </script>


    <script type="text/javascript">
    $('#mbonus').hide();
    $('#mupdate').hide();

            $('#medit').on('click', function() {

                  $('#medit').hide();
                  $('#mreset').hide();
                  $('#mbonus').show();
                  $('#mupdate').show();

            });
    </script>


    <script type="text/javascript">
    $('#tbonus').hide();
    $('#tupdate').hide();

            $('#tedit').on('click', function() {

                  $('#tedit').hide();
                  $('#treset').hide();
                  $('#tbonus').show();
                  $('#tupdate').show();

            });
    </script>

    <script type="text/javascript">
    $('#fbonus').hide();
    $('#fupdate').hide();

            $('#fedit').on('click', function() {

                  $('#fedit').hide();
                  $('#freset').hide();
                  $('#fbonus').show();
                  $('#fupdate').show();

            });
    </script>


    <script type="text/javascript">

        let defaultServices = $('#defaultServices'); let specialServices = $('#specialServices');
        let rechargeFrm = $('#rechargeFrm'); let dataFrm = $('#dataFrm');
        let includeToAll ='<input type="hidden" id="special" name="special" value="1" />';
        let cableFrm = $('#cableFrm'); let walletFrm = $('#walletFrm');
        let electricityFrm = $('#electricityFrm'); let payFrm = $('#payFrm');
        let topupFrm = $('#topupFrm'); let messenger = $('#dpMsg');

      



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


        // <!--CABLE TV SCRIPT-->

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

        // <!-- Electricity Script -->

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
