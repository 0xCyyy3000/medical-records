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
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="row">
        <aside class="col bg-my-white pe-0">
            <div class="container d-flex align-items-center p-2 gap-2 mb-4">
                {{-- <img src="{{ asset('images/icons8-health-book-96.png') }}" alt="medicak-book" width="45"> --}}
                <span class="row p-2">
                    <h2 class="m-auto primary fw-bold">Medical Records</h2>
                    <p class="muted">Management System</p>
                </span>
            </div>
            <div class="sidebar position-relative">
                <a href="{{ route('dashboard') }}" class="align-items-center text-decoration-none white active">
                    <span class="material-icons-sharp">dashboard</span>
                    <h3 class="m-auto ms-0">Dashboard</h3>
                </a>

                <a href="#" class="align-items-center text-decoration-none">
                    <span class="material-icons-sharp">person_add</span>
                    <h3 class="m-auto ms-0 ">Add patient</h3>
                </a>

                <a href="#" class="align-items-center text-decoration-none">
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

                <div class="position-fixed bottom-0 mb-3">
                    <a href="#" class="align-items-center text-decoration-none">
                        <span class="material-icons-sharp ">logout</span>
                        <h3 class="m-auto ms-0 ">Logout</h3>
                    </a>
                </div>
            </div>
        </aside>
        <div class="col-md-10 ps-0">
            <div class="container p-3 border-bottom border-2">
                <div class="d-flex gap-2 mt-1">
                    <span class="material-icons-sharp primary person">person_outline</span>
                    <h2 class="fw-bold">Dashboard</h2>
                </div>
            </div>
            {{ $slot }}
        </div>
    </div>
</body>

</html>
