@extends('admin-layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/bootstrap-wysihtml5.css')}}">
<link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/select2-bootstrap.min.css')}}">

@endsection


@section('content')
<div class="row">
    <h1 class="page-header">{{$doctor->name}} detail</h1>
    <h2 class="page-header">Schedules</h2>
    @include('flash::message')
    <div class="schedule-container">
        @foreach( $doctor->schedules as $schedule)
        <div class="schedule-box">
            <p>{{$schedule->day}}</p>
            <p>{{$schedule->fee_status}}</p>
            <p>{{$schedule->from_date}} to {{$schedule->to_date}}</p>
            <form action="{{route('schedules.destroy', $schedule->id)}}" method="post">
                @csrf
                @method("delete")
                <button class="btn btn-danger"><span class="fa fa-trash"></span></a></button>
            </form>
        </div>
        @endforeach
    </div>
    <form action="{{route('schedules.store')}}" id="form-data" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="from_date">From Date</label>
                    <input type="date" class="form-control" name="from_date">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="to_date">To Date</label>
                    <input type="date" class="form-control" name="to_date">
                </div>
            </div>

        </div>
        {{-- **important** --}}
        <input type="hidden" class="form-control" name="id" value={{$doctor->id}}>
        <input type="hidden" class="form-control" name="type" value="App\Models\Doctor">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="day">Day</label>
                    <select name="day" class="form-control myclass">
                        @foreach( $days as $value)
                        <option value="{{$value}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="fee_status">Fee Status</label>
                    <select name="fee_status" class="form-control myclass">
                        @foreach( $fee_status as $key=>$value)
                        <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </div>
        </div>
    </form>
    <h2 class="page-header">Accounts</h2>
    @include('flash::message')
    <div class="schedule-container">
        @foreach( $doctor->accounts as $account)
        <div class="schedule-box">
            <p>{{$account->name}}</p>
            <p>{{$account->number}}</p>
            <p>{{$account->channel}}</p>
            {{-- <p>{{$schedule->note}}</p> --}}
            <form action="{{route('accounts.destroy', $account->id)}}" method="post">
                @csrf
                @method("delete")
                <button class="btn btn-danger"><span class="fa fa-trash"></span></a></button>
            </form>
        </div>
        @endforeach
    </div>
    <form action="{{route('accounts.store')}}" id="form-data" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Wave">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="channel">Channels</label>
                    <select name="channel" class="form-control myclass">
                        @foreach( $channels as $channel)
                        <option value="{{$channel}}">{{$channel}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="number">Number</label>
                    <input type="text" class="form-control" name="number">
                </div>
            </div>
        </div>
        {{-- **important** --}}
        <input type="hidden" class="form-control" name="id" value={{$doctor->id}}>
        <input type="hidden" class="form-control" name="type" value="App\Models\Doctor">
        <div class="row">
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <textarea id="mymce" name="note"></textarea>
                </div>
            </div>
        </div>

        <div class="row">

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