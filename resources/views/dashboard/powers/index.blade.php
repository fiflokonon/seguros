@extends('partials.dashboard.index')
@section('title', 'Potentias')
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
                                <h4 class="card-title">Potentias</h4>
                                <div class="float-lg-end"><button data-bs-toggle="modal" style="background-color: #013832; color: white" data-bs-target="#kt_modal_add_user" class="btn waves-effect waves-light"> <i class="fa fa-plus"></i><b>Nueva potentia</b></button></div>
                                <table  class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                                    <!--begin::Table head-->
                                    <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px">Min potentia</th>
                                        <th class="min-w-125px">Max potentia</th>
                                        <th class="min-w-125px">Estado</th>
                                        <th class="text-end min-w-70px">Acciones</th>
                                    </tr>
                                    <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <tbody>
                                    @foreach($powers as $power)
                                        <tr>
                                            <td>{{ $power->min_power }}</td>
                                            <td>{{ $power->max_power }}</td>
                                            @if( $power->status )
                                                <td><span class="badge rounded-pill bg-success">Activo</span></td>
                                            @else
                                                <td><span class="badge rounded-pill bg-danger">Inactivo</span></td>
                                            @endif
                                            {{--<td>{{ $type->created_at }}</td>--}}
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
                                                        @if( $power->status)
                                                            <a class="menu-link px-3" href="{{ route('deactivate_power', ['id' => $power->id]) }}"><i class="fa fa-trash text-danger"></i> Desactivar</a>
                                                        @else
                                                            <a class="menu-link px-3" href="{{ route('activate_power', ['id' => $power->id]) }}"><i class="fa fa-check text-success"></i> Activar</a>
                                                        @endif
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <button class="btn menu-link px-3" onclick="openUpdatePowerModal({{$power->id}}, {{$power->min_power}}, {{ $power->max_power }}, {{ $power->fuel_types->pluck('id') }} )"><i class="fa fa-pen-alt text-dark"></i> Editar</button>
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
                        {{ $powers->links() }}
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
                        <h2 class="fw-bolder">Nueva potentia</h2>
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
                        <form id="kt_modal_add_user_form" class="form" method="POST" action="{{ route('add_power') }}">
                            @csrf
                            <!--begin::Scroll-->
                            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Min potentia</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="number" min="1" name="min_power" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Insertar el tipo de coche" value="{{ old('min_power') }}" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Max potentia</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="number" min="1" name="max_power" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Insertar el tipo de coche" value="{{ old('max_power') }}" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Tipo Combustible</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div class="mb-3 row">
                                        @foreach($fuel_types as $fuel_type)
                                            <div class="col-4">
                                                <div class="form-check mb-3">
                                                    <input name="fuel_type[]" class="form-check-input" type="checkbox" id="formCheck1" value="{{ $fuel_type->id }}">
                                                    <label class="form-check-label" for="formCheck1">{{ $fuel_type->title }}</label>
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
                                <button type="submit" class="btn" style="background-color: #013832; color: white">
                                    Crear potentia
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

        <!--begin::Modal - Update Power-->
        <div class="modal fade" id="kt_modal_update_power" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_update_power_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">Actualizar potentia</h2>
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
                        <form id="kt_modal_update_power_form" class="form" method="POST" action="{{ route('update_power') }}">
                            @csrf
                            <!-- Hidden input for the power ID -->
                            <input type="hidden" id="update_power_id" name="id">
                            <!--begin::Scroll-->
                            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_power_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_power_header" data-kt-scroll-wrappers="#kt_modal_update_power_scroll" data-kt-scroll-offset="300px">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Min potentia</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="number" min="1" id="update_power_min_power" name="min_power" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Insertar la potentia mínima" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Max potentia</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="number" min="1" id="update_power_max_power" name="max_power" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Insertar la potentia máxima" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Tipo Combustible</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div class="mb-3 row">
                                        @foreach($fuel_types as $fuel_type)
                                            <div class="col-4">
                                                <div class="form-check mb-3">
                                                    <input name="fuel_type[]" class="form-check-input" type="checkbox" value="{{ $fuel_type->id }}">
                                                    <label class="form-check-label">{{ $fuel_type->title }}</label>
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
                                <button type="submit" class="btn" style="background-color: #013832; color: white">
                                    Actualizar potentia
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
        <!--end::Modal - Update Power-->

        <script>
            function openUpdatePowerModal(id, minPower, maxPower, fuelTypes) {
                // Pré-remplir les champs du formulaire avec les valeurs existantes
                document.getElementById('update_power_id').value = id;
                document.getElementById('update_power_min_power').value = minPower;
                document.getElementById('update_power_max_power').value = maxPower;

                // Décocher toutes les cases à cocher
                document.querySelectorAll('input[name="fuel_type[]"]').forEach(checkbox => {
                    checkbox.checked = false;
                });

                // Cocher les cases correspondant aux types de carburant
                fuelTypes.forEach(fuelType => {
                    console.log("Fuel type:", fuelType);
                    const checkbox = document.querySelector(`input[name="fuel_type[]"][value="${fuelType}"]`);
                    console.log("Check", checkbox);
                    if (checkbox) {
                        checkbox.setAttribute("checked", "checked"); // Utiliser directement la propriété checked
                    }
                });

                // Retarder légèrement l'ouverture du modal
                setTimeout(() => {
                    $('#kt_modal_update_power').modal('show');
                }, 100); // Ajuster le délai si nécessaire
            }
        </script>



    </div>
@endsection

