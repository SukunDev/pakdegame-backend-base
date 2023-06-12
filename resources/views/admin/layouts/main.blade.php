<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ !empty($name) ? $name . ' | ' : '' }}{{ $title }}</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
</head>

<body>
    <div class="flex flex-col min-h-screen font-roboto">
        @include('admin.layouts.partials.sidebar')
        <div class="flex flex-col h-screen bg-gray-100 pl-72">
            @include('admin.layouts.partials.header')
            <div class="px-4 py-4 space-y-4 text-gray-700">
                @yield('content')
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script>
        @if (Session::has('status'))
            toastr.{{ Session::get('status') }}("{!! Session::get('message') !!}")
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.warning("{!! $error !!}")
            @endforeach
        @endif
    </script>
</body>

</html>
