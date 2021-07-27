<div class="modal fade" id="companies_add_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{trans('companies.form.title_add_form')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('companies.store')}}" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
            <div class="form-group">
                <label for="name">{{trans('companies.form.name')}}</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="company_email">Email</label>
                <input type="email" class="form-control" id="company_email" name="email" placeholder="Enter Company Email" value="{{old('email')}}">
            </div>
            <div class="form-group">
                <label for="website">Website</label>
                <input type="text" class="form-control" id="website" name="website" placeholder="Enter Company Website" value="{{old('website')}}">
            </div>
            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" class="form-control-file" name="logo" id="logo">
                <span class="help-block">{{trans('companies.form.info_pixel')}}</span>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('companies.button.close')}}</button>
            <button type="submit" class="btn btn-primary">{{trans('companies.button.submit')}}</button>
        </form>
      </div>
    </div>
  </div>
</div>