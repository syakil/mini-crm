<div class="modal fade" id="employees_edit_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{trans('employees.form.title_edit_form')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('employees.update')}}" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }} {{ method_field('PUT') }}
            <input type="hidden" name="id" id="id">
            <div class="form-group">
                <label for="first_name_edit">{{trans('employees.form.first_name')}}</label>
                <input type="text" class="form-control" id="first_name_edit" name="first_name" placeholder="Enter First Name" value="{{old('first_name')}}">
            </div>
            <div class="form-group">
                <label for="last_name_edit">{{trans('employees.form.last_name')}}</label>
                <input type="text" class="form-control" id="last_name_edit" name="last_name" placeholder="Enter Last Name" value="{{old('last_name')}}">
            </div>
            <div class="form-group">
                <label for="email_edit">Email</label>
                <input type="email" class="form-control" id="email_edit" name="email" placeholder="Enter Company Email" value="{{old('email')}}">
            </div>            
            <div class="form-group">
                <label for="phone">{{trans('employees.form.phone')}}</label>
                <input type="number" class="form-control" id="phone_edit" name="phone" placeholder="Enter Phone Number" value="{{old('phone')}}">
            </div>
            <div class="form-group">
              <label for="company">{{trans('employees.form.company')}}</label>
              <select class="form-control" name="company" id="company_edit" required>
                  <option value="">{{trans('employees.form.company_select')}}</option>
                @foreach($companies as $list)
                  <option value="{{$list->id}}">{{$list->name}}</option>
                @endforeach
              </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('employees.button.close')}}</button>
            <button type="submit" class="btn btn-primary">{{trans('employees.button.submit')}}</button>
        </form>
      </div>
    </div>
  </div>
</div>