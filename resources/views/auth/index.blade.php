<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="fixed inset-0 bg-slate-900">
    </div>
    <div class="fixed inset-0 max-w-xl m-auto h-fit">
        <div class="w-full px-4 py-4 bg-white border rounded-md">
            <form class="flex flex-col space-y-4" method="POST" action="/{{ Request::path() }}">
                @csrf
                <div class="flex flex-col space-y-1">
                    <label class="font-semibold text-gray-600 capitalize dark:text-gray-300"
                        for="email">email</label>
                    <input
                        class="w-full text-gray-600 dark:text-white px-4 py-2 bg-gray-200 dark:hover:bg-white/[0.07] dark:active:bg-white/5 border border-gray-300 dark:border-white/[0.12] rounded-md dark:bg-white/5 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none transition duration-300"
                        type="email" name="email" id="email">
                </div>
                <div class="flex flex-col space-y-1">
                    <label class="font-semibold text-gray-600 capitalize dark:text-gray-300"
                        for="password">password</label>
                    <input
                        class="w-full text-gray-600 dark:text-white px-4 py-2 bg-gray-200 dark:hover:bg-white/[0.07] dark:active:bg-white/5 border border-gray-300 dark:border-white/[0.12] rounded-md dark:bg-white/5 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none transition duration-300"
                        type="password" name="password" id="password">
                </div>
                <div class="flex justify-center">
                    <div class="flex flex-col">
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}">
                        </div>
                        @error('g-recaptcha-response')
                            <p class="text-center text-red-500">selesaikan google recaptcha</p>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-center">
                    <button type="submit"
                        class="w-full py-2 text-white transition duration-300 bg-green-500 rounded-xl hover:bg-green-400 active:bg-green-500">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        toastr.options = {
            closeButton: true,
            debug: false,
            newestOnTop: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            preventDuplicates: false,
            showDuration: '300',
            hideDuration: '1000',
            timeOut: '5000',
            extendedTimeOut: '1000',
            showEasing: 'swing',
            hideEasing: 'linear',
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut',
        }
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
