<!DOCTYPE html>
<html lang="en">

<head>

    @include('admin-layouts.meta')
    @include('admin-layouts.css')
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        @include('admin-layouts.nav')

        <div id="page-wrapper">
            @yield('content')
        </div>

    </div>
    @include('admin-layouts.script')
</body>

</html>
