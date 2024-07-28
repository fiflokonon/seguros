@extends('partials.dashboard.index')
@section('title', 'Categorías')
@php
    $categories = \App\Models\CarCategory::all();
    $fuel_types = \App\Models\FuelType::whereHas('powers')->get();
    $powers = \App\Models\Power::all();
    $trailers = \App\Models\Trailer::all();
    $type_cars = \App\Models\TypeCar::all();
    $accessories = \App\Models\Parameter::where('accessory', true)->get();
@endphp
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        @if(auth()->user() !=null )
            <!--begin::Toolbar-->
            <div class="toolbar" id="kt_toolbar">
                <!--begin::Container-->
                <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                    <!--begin::Page title-->
                    <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                         data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                         class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                        <!--begin::Title-->
                        <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Dashboard</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Toolbar-->
        @endif
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body">
                        <!--begin::Stepper-->
                        <div class="stepper stepper-links d-flex flex-column pt-15" id="kt_create_account_stepper">
                            <!--begin::Nav-->
                            <div class="stepper-nav mb-5">
                                <!--begin::Step 1-->
                                <div class="stepper-item current" data-kt-stepper-element="nav">
                                    <h3 class="stepper-title">Datos del vehículo</h3>
                                </div>
                                <!--end::Step 1-->
                                <!--begin::Step 2-->
                                <div class="stepper-item" data-kt-stepper-element="nav">
                                    <h3 class="stepper-title">Accesorios</h3>
                                </div>
                                <!--end::Step 2-->
                                <!--begin::Step 3-->
                                <div class="stepper-item" data-kt-stepper-element="nav">
                                    <h3 class="stepper-title">Conductor</h3>
                                </div>
                                <!--end::Step 3-->

                                <!--begin::Step 4-->
                                <div class="stepper-item" data-kt-stepper-element="nav">
                                    <h3 class="stepper-title">Precio</h3>
                                </div>
                                <!--end::Step 4-->
                            </div>
                            <!--end::Nav-->
                            <!--begin::Form-->
                            <form class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" id="kt_create_account_form" method="POST" action="{{ route('create_invoice', $brand) }}">
                                <!--begin::Step 1-->
                                <div class="current" data-kt-stepper-element="content">
                                    <!--begin::Wrapper-->
                                    <div class="w-100">
                                        <!--begin::Heading-->
                                        <div class="pb-10 pb-lg-15">
                                            <!--begin::Title-->
                                            <h2 class="fw-bolder text-dark">Datos del vehículo</h2>
                                            <!--end::Title-->
                                            <!--begin::Notice-->
                                            <div class="text-muted fw-bold fs-6">Por favor, completa los siguientes
                                                datos.
                                            </div>
                                            <!--end::Notice-->
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label mb-3">Has seleccionado : </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <span class="fw-bold text-gray-800 form-control-lg fs-6">{{ $brand->title }}</span>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label mb-3 required">¿Y el modelo? : </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="model" class="form-control form-control-lg" placeholder="ej. Avensis 2.0" value="{{ old('model') }}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label mb-3 required">¿Cuál es la matrícula de tu coche?
                                                : </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="regis_number" id="regis_number"
                                                   oninput="formatMatricula()"
                                                   pattern="^[A-Z]{2}\s*-\s*[0-9]{3}\s*-\s*[A-Z]{1,2}$"
                                                   class="form-control form-control-lg"
                                                   placeholder="ej. AN - 252 - AZ" value="{{ old('regis_number') }}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label mb-3 required">¿Cuántas puertas tiene tu coche?
                                                : </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="number" min="2" max="10" name="place_number" class="form-control form-control-lg" {{ old('place_number') }}/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label mb-3 required">¿Qué uso das al coche?: </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="category" data-control="select2"
                                                    class="form-select form-select-lg" data-placeholder="Seleccionnar uso del coche">
                                                <option></option>
                                                @foreach($categories as $category)
                                                    <option
                                                        value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label mb-3 required">Tipo de Coche :</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="type_car" data-control="select2"
                                                    class="form-select form-select-lg" data-placeholder="Seleccionnar tipo de coche">
                                                <option></option>
                                                @foreach($type_cars as $type)
                                                    <option
                                                        value="{{ $type->id }}" {{ old('type_car') == $type->id ? 'selected' : '' }}>{{ $type->title }}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label mb-3 required">Tipo de Combustible :</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="fuel_type" id="fuel-type-select" class="form-select form-select-lg" data-placeholder="Seleccionar tipo de Combustible">
                                                <option selected disabled value="">Seleccionar tipo de Combustible</option>
                                                @foreach($fuel_types as $type)
                                                    <option value="{{ $type->id }}" {{ old('type_car') == $type->id ? 'selected' : '' }}>{{ $type->title }}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row" id="power-select-container">
                                            <!--begin::Label-->
                                            <label class="form-label mb-3 required">¿Conoces la potencia de tu coche en
                                                CV? :</label>
                                            <!--end::Label-->
                                            <select name="power" data-control="select2"  id="power-select" class="form-select form-select-lg" data-placeholder="Seleccionar Power">
                                                <option selected disabled value="">Seleccionar Power</option>
                                                <!-- Dynamically populated options here -->
                                            </select>
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label mb-3 required">Tipo de Remolque :</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="trailer" data-control="select2" class="form-select form-select-lg" data-placeholder="Seleccionar tipo de Remolque">
                                                <option></option>
                                                @foreach($trailers as $trailer)
                                                    <option
                                                        value="{{ $trailer->id }}" {{ old('trailer') == $trailer->id ? 'selected' : '' }}>{{ $trailer->title }}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Step 1-->
                                <!--begin::Step 2-->
                                <div data-kt-stepper-element="content">
                                    <!--begin::Wrapper-->
                                    <div class="w-100">
                                        <!--begin::Heading-->
                                        <div class="pb-10 pb-lg-15">
                                            <!--begin::Title-->
                                            <h2 class="fw-bolder text-dark">¿Quieres incluir algún accesorios?</h2>
                                            <!--end::Title-->
                                            <!--begin::Notice-->
                                            <div class="text-muted fw-bold fs-6">Opcional</div>
                                            <!--end::Notice-->
                                        </div>
                                        <!--end::Heading-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label mb-3">Listas de Accesorios : </label>
                                            <!--end::Label-->
                                            @foreach($accessories as $accessory)
                                            <!--begin::Input-->
                                            <div class="form-check mb-3">
                                                <input name="accessory[]" class="form-check-input" type="checkbox" id="formCheck1" value="{{ $accessory->id }}">
                                                <label class="form-check-label" for="formCheck1">{{ $accessory->title }}(
                                                    {{ number_format($accessory->value, 0, ',', '.') }} xfa )</label>
                                            </div>
                                            <!--end::Input-->
                                            @endforeach
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Step 2-->
                                <!--begin::Step 3-->
                                <div data-kt-stepper-element="content">
                                    <!--begin::Wrapper-->
                                    <div class="w-100">
                                        <!--begin::Heading-->
                                        <div class="pb-10 pb-lg-12">
                                            <!--begin::Title-->
                                            <h2 class="fw-bolder text-dark">Conductor</h2>
                                            <!--end::Title-->
                                            <!--begin::Notice-->
                                            <div class="text-muted fw-bold fs-6">Por favor, completa los siguientes
                                                datos.
                                            </div>
                                            <!--end::Notice-->
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label required">Nombre</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input name="last_name" type="text" class="form-control form-control-lg" value="{{ auth()->user() !== null ? auth()->user()->last_name : '' }}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label required">Apellidos</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input name="first_name" class="form-control form-control-lg" value="{{ auth()->user() !== null ? auth()->user()->first_name : '' }}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label required">Email</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input name="email" class="form-control form-control-lg" value="{{ auth()->user() !== null ? auth()->user()->email : '' }}"/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label required">Teléfono</label>
                                            <br>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input name="phone" type="tel" id="phone" class="form-control form-control-lg" value="{{ auth()->user() !== null ? auth()->user()->phone : '' }}"/>
                                            <div id="errorMessage" class="text-danger mt-2" style="display: none;">Por favor ingrese solo números.</div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Step 3-->
                                <!--begin::Step 4-->
                                <div data-kt-stepper-element="content">
                                    <!--begin::Wrapper-->
                                    <div class="w-100">
                                        <!--begin::Heading-->
                                        <div class="pb-8 pb-lg-10">
                                            <!--begin::Title-->
                                            <h2 class="fw-bolder text-dark">Registro Completado con Éxito </h2>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Body-->
                                        <div class="mb-0">
                                            <!--begin::Text-->
                                            <div class="fs-6 text-gray-600 mb-5">Gracias por completar el proceso de registro. Estás a un paso de finalizar tu operación.
                                                Por favor, revisa los detalles de tu factura a continuación antes de proceder con la validación final.
                                                Tu satisfacción es importante para nosotros. En caso de tener preguntas o necesitar asistencia adicional, no dudes en contactarnos.
                                            </div>
                                            <!--end::Text-->
                                            <!--begin::Alert-->
                                            <!--begin::Notice-->
                                            <div
                                                class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                                                <!--begin::Icon-->
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                                                <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                                    <i class="fa fa-mail-bulk"></i>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <!--end::Icon-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex flex-stack flex-grow-1">
                                                    <!--begin::Content-->
                                                    <div class="fw-bold">
                                                        <h4 class="text-gray-900 fw-bolder">Nuestros Contactos</h4>
                                                        <div class="fs-6 text-gray-700">
                                                            <div>
                                                                <ul>
                                                                    <li> <i class="fa fa-globe"></i> https://gepetrol-seguros.com</li>
                                                                    <li> <i class="fa fa-phone-volume"></i>  T:(+240) 333 099 311 -:- 350 083 700 -:- 350083701</li>
                                                                    <li> <i class="fa fa-envelope"></i> info@gepetrolseguros.org</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Notice-->
                                            <!--end::Alert-->
                                            <div class="col text-center mt-3">
                                                <button type="button" id="factura" class="btn" style="background-color: #013832; color: white"  >Validar factura</button>
                                            </div>
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Step 4-->
                                <!--begin::Actions-->
                                <div class="d-flex flex-stack pt-15">
                                    <!--begin::Wrapper-->
                                    <div class="mr-2">
                                        <button type="button" class="btn btn-lg me-3" style="background-color: #013832; color: white" data-kt-stepper-action="previous">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
                                            <span class="svg-icon svg-icon-4 me-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="currentColor"/>
                                                    <path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="currentColor"/>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->Anterior
                                        </button>
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Wrapper-->
                                    <div>
                                        <button type="button" class="btn btn-lg me-3" style="background-color: #013832; color: white"  data-kt-stepper-action="submit">
                                            <span class="indicator-label">Enviar
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                <span class="svg-icon svg-icon-3 ms-2 me-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"/>
                                                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"/>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="indicator-progress">Please wait...<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <button type="button" class="btn btn-lg" style="background-color: #013832; color: white"  data-kt-stepper-action="next">Siguiente
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                            <span class="svg-icon svg-icon-4 ms-1 me-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"/>
                                                    <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"/>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Stepper-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
        <script>
            function formatMatricula() {
                var input = document.getElementById('regis_number');
                var valor = input.value.toUpperCase(); // Aseguramos que sea mayúscula
                // Limpiar el valor de cualquier caracter no deseado (manteniendo solo letras y números, y eliminando espacios adicionales)
                valor = valor.replace(/[^A-Z0-9]/g, '');
                // Formatear la entrada para el patrón "AA-123-BB"
                if (valor.length > 2 && valor.length <= 5) {
                    valor = valor.substring(0, 2) + '-' + valor.substring(2);
                } else if (valor.length > 5) {
                    valor = valor.substring(0, 2) + '-' + valor.substring(2, 5) + '-' + valor.substring(5, 7);
                }
                // Establecer el valor formateado de nuevo en el input
                input.value = valor;
            }

            document.addEventListener('DOMContentLoaded', function () {
                const fuelTypeSelect = document.getElementById('fuel-type-select');
                const powerSelect = document.getElementById('power-select');

                fuelTypeSelect.addEventListener('change', function () {
                    const fuelTypeId = this.value;
                    fetchPowers(fuelTypeId);
                });

                function fetchPowers(fuelTypeId) {
                    fetch(`/get-powers/${fuelTypeId}`)
                        .then(response => response.json())
                        .then(data => {
                            updatePowerOptions(data.powers);
                        })
                        .catch(error => {
                            console.error('Error fetching powers:', error);
                        });
                }

                function updatePowerOptions(powers) {
                    powerSelect.innerHTML = ''; // Clear existing options
                    const defaultOption = document.createElement('option');
                    defaultOption.selected = true;
                    defaultOption.disabled = true;
                    defaultOption.value = '';
                    defaultOption.textContent = 'Seleccionar Power';
                    powerSelect.appendChild(defaultOption);

                    powers.forEach(power => {
                        const option = document.createElement('option');
                        option.value = power.id;
                        option.textContent = `${power.min_power} CV - ${power.max_power} CV`;
                        powerSelect.appendChild(option);
                    });
                }

                // Fetch initial powers based on pre-selected fuel type (if any)
                const initialFuelTypeId = fuelTypeSelect.value;
                if (initialFuelTypeId) {
                    fetchPowers(initialFuelTypeId);
                }
            });

            document.addEventListener("DOMContentLoaded", function() {
                // Sélectionner le formulaire
                const form = document.getElementById("kt_create_account_form");
                const submitButton = document.getElementById("factura");

                // Ajouter un événement pour le bouton de soumission
                submitButton.addEventListener("click", function(e) {
                    e.preventDefault(); // Empêcher la soumission traditionnelle du formulaire
                    console.log("Submission click");
                    // Récupérer les données du formulaire
                    const formData = new FormData(form);

                    // Ajouter le token CSRF à la requête
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    formData.append('_token', csrfToken);

                    // Envoyer la requête via fetch
                    fetch(form.action, {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            if (data.success) {
                                // Redirection en cas de succès avec l'ID de la facture
                                const invoiceId = data.invoice_id;
                                window.location.href = `/invoices/${invoiceId}/details`;
                            } else if(!data.success){
                                // Gérer les erreurs
                                console.error('Erreur:', data.message.json());
                                Swal.fire({
                                    text: "Error al enviar el formulario. Intentar otra vez.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok !",
                                    customClass: { confirmButton: "btn btn-light" }
                                });
                            }
                            else {
                                // Gérer les erreurs
                                console.error('Erreur:', data.message);
                                Swal.fire({
                                    text: "Error al enviar el formulario. Intentar otra vez.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok!",
                                    customClass: { confirmButton: "btn btn-light" }
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Erreur:', error);
                            Swal.fire({
                                text: "Error al enviar el formulario. Intentar otra vez.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok!",
                                customClass: { confirmButton: "btn btn-light" }
                            });
                        });
                });
            });


        </script>
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

                    exampleInput.addEventListener('input', function () {
                        const value = exampleInput.value;
                        if (/^\d*$/.test(value)) {
                            errorMessage.style.display = 'none';
                        } else {
                            exampleInput.value = value.replace(/\D/g, ''); // Remove non-digit characters
                            errorMessage.style.display = 'block';
                        }
                    });
                })

            </script>
    </div>
@endsection



