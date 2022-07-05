
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