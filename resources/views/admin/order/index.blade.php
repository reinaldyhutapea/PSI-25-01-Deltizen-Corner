
@extends('layouts.admin-template')
@section('content')
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel 5.8 - Daterange Filter in Datatables with Server-side Processing</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
{{-- 
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
   --}} 
   <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css">

  {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>  
  <link href="{{ asset('/css/order.css') }}" rel="stylesheet">
</head> 
<div class="container-fluid">
    <div class="none-mobile-ui">
  <div class="row">
    <div class="col-lg-12">
      <div class="box-header">
          <h6 class="box-title">Daftar Pesanan</h6>
         </div>
      <div class="card shadow mb-4">

      <div class="row" style="margin-bottom: 30px;">
              <div class="col-5">
                  <input type="date" name="from_date" id="from_date" class="form-control" placeholder="From Date"  />
              </div>
              <div class="col-5">
                  <input type="date" name="to_date" id="to_date" class="form-control" placeholder="To Date"  />
              </div>
              <div class="col">
                  <button type="button" name="filter" id="filter" class="btnf">Filter</button>
                  <button type="button" name="refresh" id="refresh" class="btnr">Reset</button>
              </div>
          </div>
          <div style="overflow: auto;" >
             <table class="table table-bordered" id="product-table" width="100%">
                  <thead>
                  <tr>
                      <th>No</th>
                      <th>Id</th>
                      <th>Nama Penerima</th>
                      <th>No telepon yang dapat dihubungi / Alamat</th>
                      <th>Total Bayar</th>
                      <th>Tanggal</th>
                      <th>Status</th>
                      <th></th>
                  </tr>
                  </thead>
              </table>
          </div>
          </div>
       </div>
        </div>
  </div>
</div>




</div>





<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- Modal --}}


     
      <!-- Modal Create Product -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Cetak Laporan Pertanggal</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="card-body">
                      <div class="input-group mb-3" style="float: left;">
                          <div class="col-md-12 awal">
                          <label for="label">Tanggal Awal </label>
                          <input type="date" name="tglawal" id="tglawal" class="form-control" width="100%">
                          </div>
                      </div>
                      <div class="input-group mb-3" style="float: right;">
                          <div class="col-md-12 akhir">
                          <label for="label">Tanggal Akhir </label>
                          <input type="date" name="tglakhir" id="tglakhir" class="form-control">
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">
                  <a href="" onclick="this.href='/order/cetak_pertanggal/' + document.getElementById('tglawal').value +
                  '/' + document.getElementById('tglakhir').value" target="_blank" style="text-decoration: none;color: white;">
                  Cetak <i class="fa-solid fa-print" style="margin-left: 5px"></i></a></button>
              </div>
          </form>
          </div>
          </div>
      </div>


<script>
  function load_data(from_date = '', to_date='') {
      $('#product-table').DataTable({ 
          processing: true,
          serverSide: true,
          ajax:{
              url:'{{ route("order.data") }}',
              data:{from_date:from_date, to_date:to_date}
          },
          columns: [
              { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false },
              { data: 'id', name: 'id' },
              { data: 'receiver', name: 'receiver' },
              { data: 'address', name: 'address' },
              { data: 'total_price', name: 'total_price' },
              { data: 'date', name: 'date'},
              { data: 'status', name: 'status'},
              { data: 'action', name: 'action', orderable: false, searchable: false}
          ]

          
      });
  };
        
          $(document).ready(function(){
              $('.input-daterange').datepicker({
                  todayBtn:'linked',
                  format:'yyyy-mm-dd',
                  autoclose:true
              });

              load_data();
      

          });


      // $(function() {
      //         $('#product-table').DataTable({
      //             processing: true,
      //             serverSide: true,
      //             ajax: '{!! url("/order/data") !!}',
      //             columns: [
      //                 { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
      //                 { data: 'id', name: 'id' },
      //                 { data: 'receiver', name: 'receiver' },
      //                 { data: 'address', name: 'address' },
      //                 { data: 'total_price', name: 'total_price' },
      //                 { data: 'date', name: 'date'},
      //                 { data: 'status', name: 'status'},
      //                 { data: 'action', name: 'action', orderable: false, searchable: false}
      //             ]
        
                  
      //         });
      //     });

  
// batas

 
$('#filter').click(function(){
var from_date = $('#from_date').val();
var to_date = $('#to_date').val();
console.log('result date', from_date, to_date);
if(from_date != '' &&  to_date != '')
{
 $('#product-table').DataTable().destroy();
 load_data(from_date, to_date);
}
else
{
 alert('Both Date is required');
}
});

$('#refresh').click(function(){
$('#from_date').val('');
$('#to_date').val('');
$('#product-table').DataTable().destroy();
load_data();
});

  var myModal = document.getElementById('myModal')
  var myInput = document.getElementById('myInput')
      myModal.addEventListener('shown.bs.modal', function () {
          myInput.focus()
      })
</script>
@endsection