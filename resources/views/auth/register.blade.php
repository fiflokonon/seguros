<!DOCTYPE html>
<html lang="fr">
<!--begin::Head-->
<head><base href="../../../">
    <title>Serugos - Registrarse</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput.min.js"></script>
</head>
<!--end::Head-->
<!--begin::Body-->
<body data-kt-name="metronic" id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-up -->
    <div class="d-flex flex-column flex-column-fluid flex-lg-row">
        <!--begin::Aside-->
        <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10" style="margin-top: -150px">
            <!--begin::Aside-->
            <div class="d-flex flex-column">
                <a href="{{ route('client_brands') }}" class="btn btn-lg mb-2" style="background-color: #013832; color: white"><i class="fa fa-car"></i>  CALCULA TU SEGURO DE FORMA RÁPIDA Y SENCILLA.</a>
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
                        @if (session('warning'))
                            <div class="alert alert-warning">
                                {{ session('warning') }}
                            </div>
                        @endif
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
                            <label for="phone" class="col-form-label-lg required">Teléfono</label>
                            <br>
                            <input type="tel" name="phone" autocomplete="off" id="phone" class="form-control form-control-lg bg-transparent" value="{{ old('phone') }}" style="width: 100% !important;"/>
                            <div id="errorMessage" class="text-danger mt-2" style="display: none;">Por favor ingrese solo números.</div>
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
                            <button type="submit" class="btn text-uppercase" style="background-color: #013832; color: white" id="sub_button">Registrar</button>
                        </div>
                        <!--end::Submit button-->
                        <!--begin::Sign In-->
                        <div class="text-gray-500 text-center fw-semibold fs-6">¿Ya eres cliente?
                            <a href="{{ route('login') }}" class="link-info fw-semibold">Iniciar sesión</a></div>
                        <!--end::Sign In-->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js"></script>
<script>
    // Attendez que le DOM soit chargé
    document.addEventListener('DOMContentLoaded', function () {
        // Sélectionnez le champ de numéro de téléphone
        var input = document.querySelector("#phone");

        // Initialisez intl-tel-input
        var iti = window.intlTelInput(input, {
            initialCountry: "gq",
            onlyCountries: ["gq"],// Sélection automatique du pays basée sur l'adresse IP de l'utilisateur
            separateDialCode: true, // Inclure le code de pays dans le champ de numéro de téléphone
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js", // Script utilitaire requis
        });

        // Écoutez l'événement de soumission du formulaire
        document.querySelector("form").addEventListener("submit", function () {
            // Récupérez le code de pays sélectionné
            var countryCode = iti.getSelectedCountryData().dialCode;

            // Récupérez la valeur du numéro de téléphone
            var phoneNumber = input.value;

            // Concaténez le code de pays avec le numéro de téléphone
            input.value = "+" + countryCode + phoneNumber;
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const exampleInput = document.getElementById('phone');
        const errorMessage = document.getElementById('errorMessage');
        const submit_button = document.getElementById('sub_button');
        console.log("Button", submit_button);

        exampleInput.addEventListener('input', function () {
            const value = exampleInput.value;
            if (/^\d*$/.test(value)) {
                errorMessage.style.display = 'none';
                submit_button.style.display = 'block';
            } else {
                exampleInput.value = value.replace(/\D/g, ''); // Remove non-digit characters
                errorMessage.style.display = 'block';
                submit_button.style.display = 'none';
            }
        });
    })

</script>
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
