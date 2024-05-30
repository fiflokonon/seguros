@extends('partials.dashboard.index')
@section('title', 'Relacón cotización')
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
                                <h4 class="card-title">Relacón cotización</h4>
                                <div class="float-lg-end"><button data-bs-toggle="modal" style="background-color: #013832; color: white" data-bs-target="#kt_modal_add_user" class="btn waves-effect waves-light"> <i class="fa fa-plus"></i><b>Nueva cotización</b></button></div>
                                <table  class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                                    <!--begin::Table head-->
                                    <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-gray-400 fw-bolder fs-5 text-uppercase gs-0">
                                        <th class="min-w-100px">Categoría</th>
                                        <th class="min-w-100px">Tipo de Combustible</th>
                                        <th class="min-w-100px">Tipo coche</th>
                                        <th class="min-w-100px">Potencia Mínima</th>
                                        <th class="min-w-100px">Potencia Máxima</th>
                                        <th class="min-w-100px">Tipo de Remolque</th>
                                        <th class="min-w-100px">Precio Inicial</th>
                                        <th class="text-end min-w-70px">Acciones</th>
                                    </tr>
                                    <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <tbody>
                                    @foreach($tarifications as $tarification)
                                        <tr>
                                            <td>{{ $tarification->car_category->title }}</td>
                                            <td>{{ $tarification->fuel_type->title }}</td>
                                            <td>{{ $tarification->type_car->title }}</td>
                                            <td>{{ $tarification->power->min_power }}</td>
                                            <td>{{ $tarification->power->max_power }}</td>
                                            <td>{{ $tarification->trailer->title }}</td>
                                            <td>{{ $tarification->price }}</td>
                                            <!--begin::Action=-->
                                            <td class="text-end">
                                                <a class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Acciones
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                    <span class="svg-icon svg-icon-5 m-0">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
															</svg>
														</span>
                                                    <!--end::Svg Icon--></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        @if( $tarification->status)
                                                            <a class="menu-link px-3" href="{{ route('deactivate_role', ['id' => $tarification->id]) }}"><i class="fa fa-trash text-danger"></i> Désactiver</a>
                                                        @else
                                                            <a class="menu-link px-3" href="{{ route('activate_role', ['id' => $tarification->id]) }}"><i class="fa fa-check text-success"></i> Activer</a>
                                                        @endif
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <button class="btn menu-link px-3" onclick="openUpdateTarificationModal({{ $tarification->id }}, '{{ $tarification->category_id }}', '{{ $tarification->type_car_id }}', '{{ $tarification->fuel_type_id }}', '{{ $tarification->trailer_id }}', '{{ $tarification->power_id }}', '{{ $tarification->min_place }}', '{{ $tarification->max_place }}', '{{ $tarification->price }}')"><i class="fa fa-pen-alt text-dark"></i> Modificar</button>
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
                        {{ $tarifications->links() }}
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
                        <h2 class="fw-bolder">Nueva cotización</h2>
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
                        <form id="kt_modal_add_user_form" class="form" method="POST" action="{{ route('add_tarification') }}">
                            @csrf
                            <!--begin::Scroll-->
                            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Categoría</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select name="category" id="" class="form-select form-select-solid form-select-lg fw-bold" data-control="select2">
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Tipo de Coche</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select name="type_car" id="" class="form-select form-select-solid form-select-lg fw-bold" data-control="select2">
                                        @foreach($type_cars as $type)
                                            <option value="{{ $type->id }}">{{ $type->title }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Tipo de Combustible</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select name="fuel_type" id="" class="form-select form-select-solid form-select-lg fw-bold" data-control="select2">
                                        @foreach($fuel_types as $fuel_type)
                                            <option value="{{ $fuel_type->id }}">{{ $fuel_type->title }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Tipo Remolque</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select name="trailer" id="" class="form-select form-select-solid form-select-lg fw-bold" data-control="select2">
                                        @foreach($trailers as $trailer)
                                            <option value="{{ $trailer->id }}">{{ $trailer->title }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Potencia</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select name="power" id="" class="form-select form-select-solid form-select-lg fw-bold" data-control="select2">
                                        @foreach($powers as $power)
                                            <option value="{{ $power->id }}">{{ $power->min_power }} CV - {{ $power->max_power }} CV</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Mínima place</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="number" name="min_place" class="form-control mb-3 mb-lg-0" placeholder="Insertar Mínima place " value="{{ old('price') }}" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Máxima place</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="number" name="max_place" class="form-control mb-3 mb-lg-0" placeholder="Insertar Máxima place" value="{{ old('price') }}" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Precio</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="number" name="price" class="form-control mb-3 mb-lg-0" placeholder="Insertar el precio" value="{{ old('price') }}" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Scroll-->
                            <!--begin::Actions-->
                            <div class="text-center pt-15">
                                <button type="submit" class="btn" style="background-color: #013832; color: white">
                                    Crear Categoría
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

        <!--begin::Modal - Update Tarification-->
        <div class="modal fade" id="kt_modal_update_tarification" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_update_tarification_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">Actualizar Cotización</h2>
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
                        <form id="kt_modal_update_tarification_form" class="form" method="POST" action="{{ route('update_tarification') }}">
                            @csrf
                            @method('PUT')
                            <!-- Hidden input for the tarification ID -->
                            <input type="hidden" id="update_tarification_id" name="id">

                            <!--begin::Scroll-->
                            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_tarification_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_tarification_header" data-kt-scroll-wrappers="#kt_modal_update_tarification_scroll" data-kt-scroll-offset="300px">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Categoría</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select name="category" id="update_tarification_category" class="form-select form-select-solid form-select-lg fw-bold" data-control="select2">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Tipo de Coche</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select name="type_car" id="update_tarification_type_car" class="form-select form-select-solid form-select-lg fw-bold" data-control="select2">
                                        @foreach($type_cars as $type)
                                            <option value="{{ $type->id }}">{{ $type->title }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Tipo de Combustible</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select name="fuel_type" id="update_tarification_fuel_type" class="form-select form-select-solid form-select-lg fw-bold" data-control="select2">
                                        @foreach($fuel_types as $fuel_type)
                                            <option value="{{ $fuel_type->id }}">{{ $fuel_type->title }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Tipo Remolque</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select name="trailer" id="update_tarification_trailer" class="form-select form-select-solid form-select-lg fw-bold" data-control="select2">
                                        @foreach($trailers as $trailer)
                                            <option value="{{ $trailer->id }}">{{ $trailer->title }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Potencia</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select name="power" id="update_tarification_power" class="form-select form-select-solid form-select-lg fw-bold" data-control="select2">
                                        @foreach($powers as $power)
                                            <option value="{{ $power->id }}">{{ $power->min_power }} CV - {{ $power->max_power }} CV</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Mínima place</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="number" id="update_tarification_min_place" name="min_place" class="form-control mb-3 mb-lg-0" placeholder="Insertar Mínima place " />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Máxima place</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="number" id="update_tarification_max_place" name="max_place" class="form-control mb-3 mb-lg-0" placeholder="Insertar Máxima place" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Precio</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="number" id="update_tarification_price" name="price" class="form-control mb-3 mb-lg-0" placeholder="Insertar el precio" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Scroll-->

                            <!--begin::Actions-->
                            <div class="text-center pt-15">
                                <button type="submit" class="btn" style="background-color: #013832; color: white">
                                    Actualizar Cotización
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
        <!--end::Modal - Update Tarification-->
        <script>
            function openUpdateTarificationModal(id, categoryId, typeCarId, fuelTypeId, trailerId, powerId, minPlace, maxPlace, price) {
                // Pré-remplir les champs du formulaire avec les valeurs existantes
                document.getElementById('update_tarification_id').value = id;
                document.getElementById('update_tarification_category').value = categoryId;
                document.getElementById('update_tarification_type_car').value = typeCarId;
                document.getElementById('update_tarification_fuel_type').value = fuelTypeId;
                document.getElementById('update_tarification_trailer').value = trailerId;
                document.getElementById('update_tarification_power').value = powerId;
                document.getElementById('update_tarification_min_place').value = minPlace;
                document.getElementById('update_tarification_max_place').value = maxPlace;
                document.getElementById('update_tarification_price').value = price;

                // Ouvrir le modal
                $('#kt_modal_update_tarification').modal('show');
            }
        </script>
    </div>
@endsection

