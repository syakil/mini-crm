@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item active">{{trans('companies.index.breadcrumb')}}</li>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
@endsection

@section('title-page')
{{trans('companies.index.title')}}
@endsection

@section('content')
@if ($errors->has('name'))
  <script>  
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: "{{ $errors->first('name') }}",
    })
  </script> 
@elseif ($errors->has('logo'))
  <script>  
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: "{{ $errors->first('logo') }}",
    })
  </script>
@elseif ($message = Session::get('error'))
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: '{{$message}}',
        })
      </script>
@elseif ($message = Session::get('success'))
  <script>
        Swal.fire({
          icon: 'success',
          title: 'Horaay!',
          text: 'Data Berhasil Disimpan',
        })
      </script>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#companies_add_form">+ {{trans('companies.button.add_button')}}</button>
                </div>
            </div>

            <div class="card-body">
            <table class="table table-bordered table-companies">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>{{trans('companies.table.name')}}</th>
                      <th>Email</th>
                      <th>Logo</th>
                      <th>Website</th>
                      <th style="width: 40px">{{trans('companies.table.action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col-md-12 -->
</div>
<!-- /.row -->
@include('companies.add_form')
@include('companies.edit_form')
@endsection


@section('script')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function() {

    table = $('.table-companies').DataTable({
     "processing" : true,
     "serverside" : true,
     "ajax" : {
       "url" : "{{ route('companies.data') }}",
       "type" : "GET"
     }
   }); 


});

function edit(id){
  url ="{{ route('companies.getId',':id')}}",
  url = url.replace(':id',id);
  $.ajax({
    url: url,
    type: "GET",
    dataType: 'json',
    success: function(data){
      console.log(data); 
        $('#companies_edit_form').modal('show');
        $('#name_edit').val(data.name);       
        $('#id').val(data.id);
        $('#company_email_edit').val(data.email);
        $('#website_edit').val(data.website)
    },
    error : function(){
        alert("Tidak dapa menyimpad data!");
    }
  }); 
}


function deleteItem(id){
  Swal.fire({
    title: "Anda Ingin Menhapusnya ?",
    showDenyButton: true,
    icon: 'question',
    confirmButtonText: "Hapus",
    denyButtonText: "Batal",
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      url = "{{route('companies.delete',':id')}}";
      url = url.replace(':id',id);
      $.ajax({
        url : url,
        type : "POST",
        data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
        success : function(data){
          table.ajax.reload();
          Swal.fire('Data Anda Berhasil Di Hapus!', '', 'success')
        },
        error : function(){
          Swal.fire('Tidak Dapat Menghapus Data!', '', 'error')
        }
      })
    } else if (result.isDenied) {
      Swal.fire('Data Anda Tidak Jadi Di Hapus!', '', 'info')
    }
  })
}
</script>
@endsection