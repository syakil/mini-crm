@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item active">{{trans('employees.index.breadcrumb')}}</li>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
@endsection

@section('title-page')
{{trans('employees.index.title')}}
@endsection

@section('content')

@if ($errors->has('first_name'))
  <script>  
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: "{{ $errors->first('first_name') }}",
    })
  </script> 
@elseif ($errors->has('last_name'))
  <script>  
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: "{{ $errors->first('last_name') }}",
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
                    <button class="btn btn-primary" data-toggle="modal" data-target="#employees_add_form">+{{trans('employees.button.add_button')}}</button>
                </div>
            </div>

            <div class="card-body">
            <table class="table table-bordered table-companies">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>{{trans('employees.table.first_name')}}</th>
                      <th>{{trans('employees.table.last_name')}}</th>
                      <th>{{trans('employees.table.company')}}</th>
                      <th>Email</th>
                      <th>{{trans('employees.table.phone')}}</th>
                      <th style="width: 40px">{{trans('employees.table.action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                      
                      @php
                      {{$no=1;}}
                      @endphp

                      @foreach($employee as $list)
                      <tr>
                            <td>{{$no++}}</td>
                            <td>{{$list->first_name}}</td>
                            <td>{{$list->last_name}}</td>
                            <td>{{$list->companie->name}}</td>
                            <td>{{$list->email}}</td>
                            <td>{{$list->phone}}</td>
                            <td>
                                <div class="btn-group">
                                    <a onclick="edit({{$list->id}})" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                    <a onclick="deleteItem({{$list->id}})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                      </tr>
                      @endforeach
                      
                  </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{$employee->links("pagination::bootstrap-4")}}
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col-md-12 -->
</div>
<!-- /.row -->

@include('employees.add_form')
@include('employees.edit_form')
@endsection


@section('script')
<script>
    
function edit(id){
  url ="{{ route('employees.getId',':id')}}",
  url = url.replace(':id',id);
  $.ajax({
    url: url,
    type: "GET",
    dataType: 'json',
    success: function(data){
      console.log(data); 
        $('#employees_edit_form').modal('show');
        $('#id').val(data.id);
        $('#first_name_edit').val(data.first_name);       
        $('#last_name_edit').val(data.last_name);
        $( "#phone_edit" ).val(data.phone);
        $( "#email_edit" ).val(data.email);
        $( "#company_edit" ).val(data.company);
        $( "#company_edit option:selected" ).text();
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
      url = "{{route('employees.delete',':id')}}";
      url = url.replace(':id',id);
      $.ajax({
        url : url,
        type : "POST",
        data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
        success : function(data){
          Swal.fire({
            icon: 'success',
            title: 'Data Anda Berhasil Di Hapus!',
            showConfirmButton: false,
            timer: 1500
          })
          setTimeout(
            function() 
            {
              location.reload(true);
            }, 1200);
          
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