@extends('backend.master')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Update Settings</h3>
                </div>
                <form action="{{url('/admin/general-setting/update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="phone">Phone</label>
                      <input type="text" class="form-control" value="{{$settings->phone}}" id="phone" name="phone" placeholder="Enter Phone Number" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" value="{{$settings->email}}" id="email" name="email" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea id="summernote" name="address">{{$settings->address}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="facebook">Facebook Link (Optional)</label>
                        <input type="text" class="form-control" value="{{$settings->facebook}}" id="facebook" name="facebook" placeholder="Enter facebook link">
                      </div>
                      <div class="form-group">
                        <label for="twitter">Twitter Link (Optional)</label>
                        <input type="text" class="form-control" value="{{$settings->twitter}}" id="twitter" name="twitter" placeholder="Enter twitter link">
                      </div>
                      <div class="form-group">
                        <label for="instagrm">Instagrm Link (Optional)</label>
                        <input type="text" class="form-control" value="{{$settings->instagrm}}" id="instagrm" name="instagrm" placeholder="Enter instagrm link">
                      </div>
                      <div class="form-group">
                        <label for="youtube">Youtube Link (Optional)</label>
                        <input type="text" class="form-control" value="{{$settings->youtube}}" id="youtube" name="youtube" placeholder="Enter youtube link">
                      </div>
                    <div class="form-group">
                      <label for="logo">Logo</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="logo" name="logo" accept="/*">
                          <label class="custom-file-label" for="logo">Choose file</label>
                        </div>
                      </div>
                      <img src="{{asset('backend/images/settings/'.$settings->logo)}}" alt="" height="100" width="150">
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



