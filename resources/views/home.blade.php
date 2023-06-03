<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"
          type="text/css">
    @livewireStyles
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                </li>
            </ul>

            <div class="d-flex">
                <ul class="navbar-nav me-auto">
                    @auth()
                        <li class="nav-item mx-1"><a href="{{ route('filament.pages.dashboard') }}" class="btn btn-primary">Account</a></li>
                        <li class="nav-item mx-1"><a href="{{ route('filament.auth.logout') }}" class="btn btn-danger">Logout</a></li>
                    @elseauth()
                        <li class="nav-item mx-1"><a href="{{ route('filament.auth.login') }}" class="btn btn-success">Login</a></li>
                        <li class="nav-item mx-1"><a href="{{ route('register') }}" class="btn btn-primary">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="container">
    <livewire:trip-search></livewire:trip-search>
</div>

@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<x:pharaonic-select2::scripts/>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<x-livewire-alert::scripts/>
</body>
</html>
