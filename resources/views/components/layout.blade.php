@props(['title'])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('js/gijgo.min.js') }}" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    @livewireStyles
    @powerGridStyles
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    <div class="row no-gutters" style="--bs-gutter-x: 0rem !important;">
        <aside class="col bg-my-white sticky-top">
            <div class="container d-flex align-items-center p-2 gap-2 mb-4">
                <span class="row p-2">
                    <h2 class="m-auto primary fw-bold">Medical Records</h2>
                    <p class="muted">Management System</p>
                </span>
            </div>
            <div class="sidebar mt-5">
                <a href="{{ route('dashboard') }}"
                    class="align-items-center text-decoration-none white
                     {{ Route::current()->getName() == 'dashboard' ? 'active' : '' }}">
                    <span class="material-icons-sharp">dashboard</span>
                    <h3 class="m-auto ms-0">Dashboard</h3>
                </a>

                {{-- <a href="{{ route('add.patient') }}"
                    class="align-items-center text-decoration-none
                {{ Route::current()->getName() == 'add.patient' ? 'active' : '' }}">
                    <span class="material-icons-sharp">person_add</span>
                    <h3 class="m-auto ms-0 ">Add patient</h3>
                </a> --}}

                <a href="{{ route('index.patient') }}"
                    class="align-items-center text-decoration-none
                {{ (Route::current()->getName() == 'index.patient' or
                Route::current()->getName() == 'add.patient' or
                Route::current()->getName() == 'patient.select')
                    ? 'active'
                    : '' }}">
                    <span class="material-icons-sharp ">groups</span>
                    <h3 class="m-auto ms-0 ">Patient List</h3>
                </a>

                <a href="#" class="align-items-center text-decoration-none">
                    <span class="material-icons-sharp ">settings</span>
                    <h3 class="m-auto ms-0 ">Account Settings</h3>
                </a>

                <a href="#" class="align-items-center text-decoration-none">
                    <span class="material-icons-sharp ">work_history</span>
                    <h3 class="m-auto ms-0 ">Activity Logs</h3>
                </a>

                <div class="position-absolute bottom-0 mb-3">
                    <a href="#" class="align-items-center text-decoration-none">
                        <span class="material-icons-sharp ">logout</span>
                        <h3 class="m-auto ms-0 ">Logout</h3>
                    </a>
                </div>
            </div>
        </aside>
        <div class="col-md-10 px-0">
            <div class="container p-3 border-bottom border-2 bg-my-primary sticky-top">
                <div class="d-flex gap-2 mt-1">
                    {{-- <span class="material-icons-sharp text-white person">person_outline</span> --}}
                    {{-- <h2 class="fw-bold text-white">{{ $title }}</h2> --}}
                </div>
            </div>
            <main class="my-4">
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            {{-- <img src="..." class="rounded me-2" alt="..."> --}}
                            <strong class="me-auto">Alert</strong>
                            <small>a moment ago</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                        <div class="toast-body" id="toastBody">
                            Hello, world! This is a toast message.
                        </div>
                    </div>
                </div>
                {{ $slot }}
            </main>
        </div>
    </div>

    {{-- For alerts --}}
    {{-- <script>
        // const has_alert = "{{ Session::has('alert') }}";
        // const alert_message = "{{ Session::get('alert') }}";

        // const success = "{{ Session::has('success') }}";

        // if (has_alert) {

        // }
    // </script> --}}
    @livewireScripts
    @powerGridScripts
</body>

</html>
