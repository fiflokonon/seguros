<!DOCTYPE html>
<html lang="en">
<head>
    <title>Seguros - Restablecer contraseña</title>
    <meta charset="utf-8" />
    <meta name="description" content="Apportez votre contribution aux personnes dans le besoin" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="/favicon.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
</head>
<body data-kt-name="metronic" id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-column flex-column-fluid flex-lg-row">
        <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
            <div class="d-flex flex-column">
                <a href="/" class="text-center mb-5">
                    <img alt="Logo" src="/assets/media/logos/Logo-crowd.png" class="w-150px text-center" />
                </a>
                <h1 class="text-dark m-0 text-center mb-5">Restablecer contraseña</h1>
                <h2 class="text-dark fw-normal m-0 justify-content-center">
                    Llene este formulario para restablecer su contraseña
                </h2>
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
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form class="form w-100" method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="fv-row mb-8">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input
                                id="email"
                                type="text"
                                name="email"
                                class="form-control bg-transparent @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                placeholder="Ingrese su correo"
                            />
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="fv-row mb-8">
                            <label for="password" class="form-label">Contraseña</label>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="form-control bg-transparent @error('password') is-invalid @enderror"
                                placeholder="Ingrese su contraseña"
                            />
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="fv-row mb-8">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                class="form-control bg-transparent"
                                placeholder="Confirme su contraseña"
                            />
                        </div>

                        <div class="d-grid mb-10">
                            <button
                                type="submit"
                                class="btn btn-primary text-uppercase"
                                style="background-color: #013832; color: white">
                                Restablecer contraseña
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>var hostUrl = "assets/";</script>
<script src="/assets/plugins/global/plugins.bundle.js"></script>
<script src="/assets/js/scripts.bundle.js"></script>
<script src="/assets/js/custom/authentication/sign-in/general.js"></script>
</body>
</html>
