@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/parking.css')}}">
<link rel="stylesheet" href="{{asset('css/receipt.css')}}">
<div class="container">
  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">


        <div class="container">
          <div class="tab"></div>
          <div class="paid">
            <p>Receipt Paid successfully</p>
          </div>
          <div class="receipt">
            <div class="paper">
              <div class="title">
                <h2>Successfully Entered</h2>
              </div>
              <div class="title">
                <h3><span class="enteredMsg" id="enteredMsg"></span></h3>
              </div>
              <br>
              <br>
              <div class="title">
                <h3>{{date('Y-m-d H:m:s')}}</h3>
              </div>
              <div class="date"></div>
              <table>
                <tbody>

                  <tr>
                    <td colspan="2" class="center"><input data-dismiss="modal" aria-label="Close" onClick="closeModal()" type="button" value="Close" /></td>
                  </tr>
                </tbody>
              </table>

            </div>

            <div>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">


        <div class="container">
          <div class="tab"></div>
          <div class="paid">
            <p>Receipt Paid successfully</p>
          </div>
          <div class="receipt">
            <div class="paper">
              <div class="title">PARKING TICKET</div>
              <div class="date">Date: {{date('Y-m-d')}}</div>
              <table>
                <tbody>
                  <tr>
                    <td><b><span id="license"></b></td>
                    <td class="right"></td>
                  </tr>

                  <tr>
                    <td>From: <span id="time_in"></td>
                    <td class="right">To: <span id="time_out"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td class="right"><h4>Rp <span id="price"></h4></td>
                  </tr>
                  <tr>
                    <td colspan="2" class="center"><input type="button" value="Pay Now" onClick="pay()" /></td>
                  </tr>
                </tbody>
              </table>
              <div class="sign center">
                <div class="barcode"></div>
                <br />
                <span id="license">
                <br />
                <div class="thankyou">
                  Thank you for your business
                </div>
              </div>
            </div>

            <div>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-8">

      <body onload=display_ct();>
        <div class="cover"></div>
        <div class="forms">
          <span id='ct'></span>
          <form id="ajaxform">
            <meta name="csrf-token" content="{{ csrf_token() }}" />
            <h3><i class="material-icons">Bounche Parking System</i></h3>
            <input class="form-control" style="width: 319px;" type="text" id="datetime" />
            <div id="cc">
              <label>License Number <span class="pull-right card-type"></span></label>
              <div class="flexrow flow-left">
                <input class="form-control" id="license_num" name="license_num" onkeyup="this.value = this.value.toUpperCase();" onkeypress="return event.charCode != 32" type="text" value="B" />

              </div>
              <div class="flexrow">

              </div>
              <div class="flexrow flow-right buttonrow">
                <button class="confirm save-data">Checking</button>
              </div>
          </form>
        </div>
      </body>
    </div>
  </div>
</div>
<script src="{{asset('js/jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/parking.js')}}"></script>
<script type="text/javascript">
  function display_c() {
    var refresh = 1000; 
    mytime = setTimeout('display_ct()', refresh)
  }

  function display_ct() {
    var x = new Date()
    document.getElementById('datetime').value = x.toString();

    display_c();
  }
  $(".save-data").click(function(event) {
    event.preventDefault();

    let license_num = $("input[name=license_num]").val();
    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      url: "{{ route('checking') }}",
      type: "POST",
      cache: false,
      data: {
        license_num: license_num,
        _token: _token
      },
      success: function(response) {
     
        if (response == "entry") {

          $("#ajaxform")[0].reset();
          $("#enteredMsg").text(license_num);
          $('#exampleModal2').modal('show');
        } else {

          $("#ajaxform")[0].reset();
          $("#license").text(response.license_num);
          $("#time_in").text(response.time_in);
          $("#time_out").text(response.time_out);
          $("#price").text(response.price);
          $('#exampleModal').modal('show');
        }
      },
    });


  });
  function pay() {
  
    $(".receipt").slideUp("slow");
    $(".paid").slideDown("slow");
    $(".receipt").slideDown("slow");
    $(".paid").slideUp("slow");
    $('#exampleModal').modal('hide');
  }

  function closeModal() {
    $('#exampleModal2').modal('hide');
  }
</script>
@endsection