@extends('admin-layouts.admin')


@section('content')
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Doctor List
            </div>
            <div class="panel-body">
                @include('flash::message')

                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Create at</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>





    @endsection


    @section('script')
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script>
        $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{!! route('api.doctors.datatable') !!}',
            columns: [
                { data: 'name', name: 'name' }, 
                { data: 'created_at', name: 'created_at' }, 
            ]
        });
    });
    </script>

    @endsection