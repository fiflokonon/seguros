<!DOCTYPE html>
<html lang="fr">
<!--begin::Head-->
<head><base href="../../../">
    <title>Crowdfunding - Inscription</title>
    <meta charset="utf-8" />
    <meta name="description" content="Apportez votre contribution aux personnes dans le besoin" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body data-kt-name="metronic" id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
<!--begin::Theme mode setup on page load-->
<script>if ( document.documentElement ) { const defaultThemeMode = "system"; const name = document.body.getAttribute("data-kt-name"); let themeMode = localStorage.getItem("kt_" + ( name !== null ? name + "_" : "" ) + "theme_mode_value"); if ( themeMode === null ) { if ( defaultThemeMode === "system" ) { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } else { themeMode = defaultThemeMode; } } document.documentElement.setAttribute("data-theme", themeMode); }</script>
<!--end::Theme mode setup on page load-->
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-up -->
    <div class="d-flex flex-column flex-column-fluid flex-lg-row">
        <!--begin::Aside-->
        <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10" style="margin-top: -150px">
            <!--begin::Aside-->
            <div class="d-flex flex-column">
                <!--begin::Logo-->
                <a href="/" class="text-center mb-5">
                    <img alt="Logo" src="assets/media/logos/Logo-crowd.png"  class="w-250px text-center"/>
                </a>
                <!--end::Logo-->
                <!--begin::Title-->
                <h1 class="text-black m-0 text-center mb-5">¡Bienvenido!</h1>
                <h2 class="text-black fw-normal m-0 justify-content-center">Tu Seguro de confianza Hoy, Mañana y Siempre</h2>
                <!--end::Title-->
            </div>
            <!--begin::Aside-->
        </div>
        <!--begin::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-center w-lg-50 p-10">
            <!--begin::Card-->
            <div class="card rounded-3 w-md-550px">
                <!--begin::Card body-->
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
                    <!--begin::Form-->
                    <form class="form w-100" method="POST" action="{{ route('register') }}">
                        @csrf
                        <!--begin::Heading-->
                        <div class="text-center mb-11">
                            <!--begin::Title-->
                            <h1 class="text-dark fw-bolder mb-3">Registrarse</h1>
                            <!--end::Title-->
                        </div>
                        <!--begin::Heading-->
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <label for="" class="form-label required">Nombre</label>
                            <input type="text" placeholder="Nombre" name="last_name" autocomplete="off" class="form-control bg-transparent" value="{{ old('last_name') }}"/>
                        </div>
                        <!--begin::Input group-->
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <label for="" class="form-label required">Apellidos</label>
                            <input type="text" placeholder="Apellidos" name="first_name" autocomplete="off" class="form-control bg-transparent" value="{{ old('first_name') }}"/>
                        </div>
                        <!--begin::Input group-->
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <label for="" class="form-label">Correo Electronico</label>
                            <input type="text" placeholder="Correo Electronico" name="email" autocomplete="off" class="form-control bg-transparent" value="{{ old('email') }}"/>
                        </div>
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <label for="" class="form-label">Teléfono</label>
                            <input type="tel" placeholder="+240" name="phone" autocomplete="off" class="form-control bg-transparent"  value="{{ old('phone') }}"/>
                        </div>
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <label for="" class="form-label required">Contraseña</label>
                            <input type="password" placeholder="Contraseña" name="password" autocomplete="off" class="form-control bg-transparent" />
                        </div>
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <label for="" class="form-label">Confirmar Contraseña</label>
                            <input type="password" placeholder="Contraseña" name="password_confirmation" autocomplete="off" class="form-control bg-transparent" />
                        </div>
                        <!--begin::Accept-->
                        {{--<div class="fv-row mb-8">
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="toc" value="1"/>
                                <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">J'accepte
										<a href="#" class="ms-1 link-info">Termes et conditions générales</a></span>
                            </label>
                        </div>--}}
                        <!--end::Accept-->
                        <!--begin::Submit button-->
                        <div class="d-grid mb-10">
                            <button type="submit" class="btn text-uppercase" style="background-color: #013832; color: white">Registrar</button>
                        </div>
                        <!--end::Submit button-->
                        <!--begin::Sign up-->
                        <div class="text-gray-500 text-center fw-semibold fs-6">¿Ya eres cliente?
                            <a href="{{ route('login') }}" class="link-info fw-semibold">Iniciar sesión</a></div>
                        <!--end::Sign up-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-up-->
</div>
<!--end::Root-->
<!--end::Main-->
<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Custom Javascript(used by this page)-->
<script src="assets/js/custom/authentication/sign-up/general.js"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
