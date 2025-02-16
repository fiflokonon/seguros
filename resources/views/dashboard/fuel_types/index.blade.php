@extends('partials.dashboard.index')
@section('title', 'Tipos de Combustible')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
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
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
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
                                <h4 class="card-title">Tipos de Combustible</h4>
                                <div class="float-lg-end"><button data-bs-toggle="modal" data-bs-target="#kt_modal_add_user" class="btn waves-effect waves-light" style="background-color: #013832; color: white"> <i class="fa fa-plus"></i><b>Nuevo tipo combustible</b></button></div>
                                <table  class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                                    <!--begin::Table head-->
                                    <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px">Tipo de Combustible</th>
                                        <th class="min-w-125px">Estado</th>
                                        <th class="text-end min-w-70px">Acciones</th>
                                    </tr>
                                    <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <tbody>
                                    @foreach($fuel_types as $type)
                                        <tr>
                                            <td>{{ $type->title }}</td>
                                            @if( $type->status )
                                                <td><span class="badge rounded-pill bg-success">Activo</span></td>
                                            @else
                                                <td><span class="badge rounded-pill bg-danger">Inactivo</span></td>
                                            @endif
                                            <!--begin::Action=-->
                                            <td class="text-end">
                                                <a class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Acciones
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                    <span class="svg-icon svg-icon-5 m-0">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
															</svg>
														</span>
                                                    <!--end::Svg Icon-->
                                                </a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        @if( $type->status)
                                                            <a class="menu-link px-3" href="{{ route('deactivate_fuel_type', ['id' => $type->id]) }}"><i class="fa fa-trash text-danger"></i> Désactivar</a>
                                                        @else
                                                            <a class="menu-link px-3" href="{{ route('activate_fuel_type', ['id' => $type->id]) }}"><i class="fa fa-check text-success"></i> Activar</a>
                                                        @endif
                                                    </div>

                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <button class="btn menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_update_fuel_type" data-id="{{ $type->id }}" data-title="{{ $type->title }}" data-code="{{ $type->code }}" data-powers="{{ $type->powers->pluck('id')}}"><i class="fa fa-pen text-success"></i> Modificar</button>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                            <!--end::Action=-->
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <ul class="pagination mt-2">
                        {{ $fuel_types->links() }}
                    </ul>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
        <!--begin::Modal - Add task-->
        <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_add_user_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">Nuevo tipo combustible</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" style="background-color: #013832; color: white" data-bs-dismiss="modal" aria-label="Close">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                        <!--begin::Form-->
                        <form id="kt_modal_add_user_form" class="form" method="POST" action="{{ route('add_fuel_type') }}">
                            @csrf
                            <!--begin::Scroll-->
                            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Tipo combustible</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="title" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Insertar el tipo de combustible" value="{{ old('title') }}" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Code combustible</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="code" class="form-control mb-3 mb-lg-0" placeholder="Insertar el codigo del combusitble" value="{{ old('code') }}" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Potencias</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div class="mb-3 row">
                                        @foreach($powers as $power)
                                            <div class="col-4">
                                                <div class="form-check mb-3">
                                                    <input name="power[]" class="form-check-input" type="checkbox" id="formCheck1" value="{{ $power->id }}">
                                                    <label class="form-check-label" for="formCheck1">{{ $power->min_power }} CV -  {{ $power->max_power }} CV</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Scroll-->
                            <!--begin::Actions-->
                            <div class="text-center pt-15">
                                <button type="submit" class="btn btn-success">
                                    Crear Tipo combustible
                                    <span class="indicator-label"></span>
                                    <span class="indicator-progress">Please wait...<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Modal body-->
                </div>
                <!--end::Modal content-->
            </div>
            <!--end::Modal dialog-->
        </div>
        <!--end::Modal - Add task-->
    </div>
    <!--begin::Modal - Update task-->
    <div class="modal fade" id="kt_modal_update_fuel_type" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_update_fuel_type_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">Actualizar tipo de combustible</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Form-->
                    <form id="kt_modal_update_fuel_type_form" class="form" method="POST" action="{{ route('update_fuel_type') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="update_fuel_type_id">
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_fuel_type_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_fuel_type_header" data-kt-scroll-wrappers="#kt_modal_update_fuel_type_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">Tipo combustible</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="title" id="update_fuel_type_title" class="form-control mb-3 mb-lg-0" placeholder="Insertar el tipo de combustible" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">Code combustible</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="code" id="update_fuel_type_code" class="form-control mb-3 mb-lg-0" placeholder="Insertar el codigo del combusitble" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">Potencias</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <div class="mb-3 row" id="update_fuel_type_powers">
                                    <!-- Les checkboxes des puissances seront injectées ici via JavaScript -->
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="submit" class="btn" style="background-color: #013832; color: white">
                                Actualizar Tipo de combustible
                                <span class="indicator-label"></span>
                                <span class="indicator-progress">Please wait...<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Update task-->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Example data, replace with your actual data
            const powers = @json($powers);

            // Function to clean the checkedPowers string
            function cleanCheckedPowers(checkedPowersStr) {
                // Remove leading ['[ and trailing ]']
                return checkedPowersStr.replace(/^\['\[/, '').replace(/\]'\]$/, '');
            }

            // Function to populate the powers checkboxes
            function populatePowers(checkedPowersStr) {
                const checkedPowers = cleanCheckedPowers(checkedPowersStr);
                const powersContainer = document.getElementById('update_fuel_type_powers');
                powersContainer.innerHTML = ''; // Clear existing checkboxes

                powers.forEach(power => {
                    const isChecked = checkedPowers.includes(power.id);
                    const checkbox = `
                <div class="col-4">
                    <div class="form-check mb-3">
                        <input name="power[]" class="form-check-input" type="checkbox" id="update_formCheck_${power.id}" value="${power.id}" ${isChecked ? 'checked="checked"' : ''}>
                        <label class="form-check-label" for="update_formCheck_${power.id}">${power.min_power} CV - ${power.max_power} CV</label>
                    </div>
                </div>`;
                    powersContainer.insertAdjacentHTML('beforeend', checkbox);
                });
            }

            // Assuming you have a way to trigger the modal open and set the data
            // Example event listener for opening the modal and setting data
            document.querySelectorAll('[data-bs-target="#kt_modal_update_fuel_type"]').forEach(button => {
                button.addEventListener('click', function () {
                    const fuelTypeId = this.getAttribute('data-id');
                    const fuelTypeTitle = this.getAttribute('data-title');
                    const fuelTypeCode = this.getAttribute('data-code');
                    const fuelTypePowers = this.getAttribute('data-powers');

                    document.getElementById('update_fuel_type_id').value = fuelTypeId;
                    document.getElementById('update_fuel_type_title').value = fuelTypeTitle;
                    document.getElementById('update_fuel_type_code').value = fuelTypeCode;

                    populatePowers(fuelTypePowers);
                });
            });
        });

    </script>

@endsection

