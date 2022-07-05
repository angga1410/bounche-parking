@extends('layouts.app')

@section('content')
<!-- <link rel="stylesheet" href="{{asset('css/login.css')}}"> -->
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<div class="container">
<body class="main-bg">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Bounche Parking System') }}</div>

                <div class="card-body">
                <table class="table table-striped table-light" id="table">
           <thead>
              <tr>
                 <th> License Number </th>
								 <th>Entry D/T</th>
                                 <th>Exit D/T</th>
                 <th>Duration</th>
                 <th>Amount</th>
                 
               
              </tr>
           </thead>
        </table>
                </div>
            </div>
        </div>
    </div>
    </body>
</div>
<script src="{{asset('js/jquery/jquery.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

<script>
  $(function () {
    
    $('#table').DataTable({
      responsive: true,
      autoWidth: false,
      paging: false,
               processing: true,
               serverSide: true,
               scrollY: 600,
               info:false,
            dom: 'Bfrtip',
            buttons: [
             'excel', 'pdf', 'print'
        ],
               ajax: "{{ route('getdata') }}",
               columns: [  
                        { data: 'license_num', name: 'license_num' },
                        { data: 'time_in', name: 'time_in' },
                        { data: 'time_out', name: 'time_out' },
                        { data: 'duration', name: 'duration' },
                        { data: 'price', name: 'price' },
                       
                      

                     ]
            });
  });
</script>
@endsection