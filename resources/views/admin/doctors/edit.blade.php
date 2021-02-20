@extends('admin-layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/bootstrap-wysihtml5.css')}}">
<link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/select2-bootstrap.min.css')}}">

@endsection


@section('content')
<div class="row">
    <h1 class="page-header">Add Doctor Info</h1>
    <form action="{{route('doctors.update', $doctor->id)}}" id="form-data" method="POST">
        @method('PATCH')
        @csrf
        <div class="row">

            <div class="col-lg-4">
                <div class="form-group">
                    <label for="name">*Name</label>
                    <input type="text" class="form-control" name="name" value="{{$doctor->name}}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="name_myan">*Name (Myanmar)</label>
                    <input type="text" class="form-control" name="name_myan" value="{{$doctor->name_myan}}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="facebook_url">Facebook</label>
                    <input type="text" class="form-control" name="facebook_url" value="{{$doctor->facebook_url}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="phone">*Phone</label>
                    <input type="text" class="form-control" name="phone" value="{{$doctor->phone}}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="address">*Address</label>
                    <input type="text" class="form-control" name="address" value="{{$doctor->address}}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="viber">Viber</label>
                    <input type="text" class="form-control" name="viber" value="{{$doctor->viber}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="lat">Latitude</label>
                    <input type="text" class="form-control" name="lat" value="{{$doctor->lat}}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="lng">Longitude</label>
                    <input type="text" class="form-control" name="lng" value="{{$doctor->lng}}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control myclass">
                        <option value="AVAILABLE" selected>
                            Available
                        </option>
                        <option value="NOT_AVAILABLE">
                            Not Available
                        </option>
                        <option value="BUSY">
                            Busy
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="from_date">From Date</label>
                    <input type="date" class="form-control" name="from_date" value="{{$doctor->from_date}}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="to_date">To Date</label>
                    <input type="date" class="form-control" name="to_date" value="{{$doctor->to_date}}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="fee_status">Fee Status</label>
                    <select name="fee_status" class="form-control myclass">
                        @foreach( $fee_status as $key=>$value)
                            @if($key == $doctor->fee_status)
                                <option value="{{$key}}" selected>{{$value}}</option>
                            @else
                                <option value="{{$key}}">{{$value}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="specialization_id">Choose Specialization</label>
                    <select name="specialization_id" class="form-control myclass">
                        @foreach( $specializations as $key=>$value)
                            @if($key == $doctor->specialization_id)
                                <option value="{{$key}}" selected>{{$value}}</option>
                            @else
                                <option value="{{$key}}">{{$value}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="town_pcode">Choose Town</label>
                    <select name="town_pcode" class="form-control myclass">
                        @foreach( $towns as $key=>$value)
                            @if($key == $doctor->town_pcode)
                                <option value="{{$key}}" selected>{{$value}}</option>
                            @else
                                <option value="{{$key}}">{{$value}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <textarea id="mymce" name="note">{{$doctor->note}}</textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>





@endsection


@section('script')
<script src="{{ asset('js/tinymce/jquery.tinymce.min.js') }}"></script>
<script src="{{asset('js/select2.min.js')}}"></script>

<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>


<script>
    $(document).ready(function() {
        if ($("#mymce").length > 0) {
            tinymce.init({
                selector: "textarea#mymce",
                theme: "modern",
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor",
                    "image code"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | print preview media fullpage | forecolor backcolor emoticons | link image",
                image_title: true, 

              automatic_uploads: true,

              file_picker_types: 'image', 
              file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                
                input.onchange = function() {
                  var file = this.files[0];
                  
                  var reader = new FileReader();
                  reader.onload = function () {
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);

                    // call the callback and populate the Title field with the file name
                    cb(blobInfo.blobUri(), { title: file.name });
                  };
                  reader.readAsDataURL(file);
                };
                
                input.click();
              }

            });
        }

    });
      $('.myclass').select2({
        // tags: true
      });
</script>
@endsection