
@extends('backend.master')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Update Credentials</h3>
                </div>
                <form action="{{url('/admin/credentis/update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="phone">Email</label>
                      <input type="text" class="form-control" value="{{$authUser->email}}" id="phone" name="phone" placeholder="Enter Phone Number" readonly>
                    </div>
                    <div class="form-group">
                        <label for="old_password">Old Password</label>
                        <input type="text" class="form-control" value="" id="old_password" name="old_password" placeholder="Enter Old Password" required>
                    </div>
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="text" class="form-control" value="" id="password" name="password" placeholder="Enter new Password" required>
                    </div>
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
  
              <!-- general form elements -->
            </div>
        </div>
    </div>
</section>          
@endsection

@push('script')
<script>
    $(function () {
      // Summernote
      $('#summernote').summernote()
  
      // CodeMirror
      CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
        mode: "htmlmixed",
        theme: "monokai"
      });
    })
  </script>
@endpush
