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
                            <th>Email</th>
                            <th>Roles</th>
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
            filter: false,
            ajax: '{!! route('api.users.datatable') !!}',
            columns: [
            { data: 'name', name: 'name' }, 
            { data: 'email', name: 'email' }, 
            { data: 'roles', name: 'roles' }, 
            { data: 'created_at', name: 'created_at' }, 
            ]
        });
    });
    </script>

    @endsection