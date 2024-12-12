<!DOCTYPE html>
<html lang="en">
<head>
    <title>Seguros - Contraseña olvidada</title>
    <meta charset="utf-8" />
    <meta name="description" content="Apportez votre contribution aux personnes dans le besoin" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="/assets/media/logos/favicon.ico" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle-->
    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<body class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-column flex-column-fluid flex-lg-row">
        <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
            <div class="d-flex flex-column">
                <a href="/" class="text-center mb-5">
                    <img alt="Logo" src="/assets/media/logos/Logo-crowd.png" class="w-150px text-center"/>
                </a>
                <h1 class="text-dark m-0 text-center mb-5">¡Olvidaste tu contraseña!</h1>
                <p class="text-dark fw-normal m-0 text-center">Ingresa tu correo electrónico y recibe el enlace de restablecimiento de contraseña</p>
            </div>
        </div>
        <div class="d-flex flex-center w-lg-50 p-10">
            <div class="card rounded-3 w-md-550px">
                <div class="card-body p-10 p-lg-20">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="form w-100" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="text-center mb-11">
                            <h1 class="text-dark fw-bolder mb-3">Contraseña olvidada</h1>
                        </div>
                        <div class="fv-row mb-8">
                            <label for="email_reset" class="form-label">Correo Electrónico</label>
                            <input id="email_reset" type="email" placeholder="Correo Electrónico" name="email" autocomplete="off" class="form-control bg-transparent" required />
                        </div>
                        <div class="d-grid mb-10">
                            <button type="submit" class="btn btn-primary text-uppercase" style="background-color: #013832; color: white">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/assets/plugins/global/plugins.bundle.js"></script>
<script src="/assets/js/scripts.bundle.js"></script>
</body>
</html>

