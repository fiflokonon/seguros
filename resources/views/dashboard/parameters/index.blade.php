@extends('partials.dashboard.index')
@section('title', 'Parámetros')
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
                                <h4 class="card-title">Parámetros</h4>
                                <table  class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                                    <!--begin::Table head-->
                                    <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px">Titulo</th>
                                        <th class="min-w-125px">Accessorio</th>
                                        <th class="min-w-125px">Valor</th>
                                        <th class="min-w-125px">Estado</th>
                                        <th class="text-end min-w-70px">Acciones</th>
                                    </tr>
                                    <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <tbody>
                                    @foreach($parameters as $parameter)
                                        <tr>
                                            <td>{{ $parameter->title }}</td>
                                            @if( $parameter->accessory )
                                                <td><span class="badge rounded-pill bg-success">Si</span></td>
                                            @else
                                                <td><span class="badge rounded-pill bg-danger">No</span></td>
                                            @endif
                                            <td>{{ $parameter->value }}</td>
                                            @if( $parameter->status )
                                                <td><span class="badge rounded-pill bg-success">Activo</span></td>
                                            @else
                                                <td><span class="badge rounded-pill bg-danger">Inactivo</span></td>
                                            @endif
                                            <!--begin::Action=-->
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Acciones
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
                                                        <button class="btn menu-link px-3" onclick="openUpdateParameterModal({{ json_encode($parameter) }})" ><i class="fa fa-pen-alt text-danger"></i> Editar</button>
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
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>

    <!--begin::Modal - Update parameter-->
    <div class="modal fade" id="kt_modal_update_parameter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_update_parameter_header">
                    <h2 class="fw-bolder">Actualizar Paramétro</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"/>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <form id="kt_modal_update_parameter_form" class="form" method="POST" action="{{ route('update_parameter') }}">
                        @csrf
                        <input type="hidden" name="id" id="update_parameter_id">
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_parameter_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_parameter_header" data-kt-scroll-wrappers="#kt_modal_update_parameter_scroll" data-kt-scroll-offset="300px">
                            <div class="fv-row mb-7">
                                <label class="required fw-bold fs-6 mb-2">Titulo</label>
                                <input type="text" id="update_parameter_title" class="form-control mb-3 mb-lg-0" disabled/>
                            </div>

                            <div class="fv-row mb-7">
                                <label class="required fw-bold fs-6 mb-2">Valor</label>
                                <input type="number" name="value" id="update_parameter_value" class="form-control mb-3 mb-lg-0"/>
                            </div>

                        </div>
                        <div class="text-center pt-15">
                            <button type="submit" class="btn" style="background-color: #013832; color: white">
                                Actualizar Paramétro
                                <span class="indicator-label"></span>
                                <span class="indicator-progress">Please wait...<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function openUpdateParameterModal(parameter) {
            document.getElementById('update_parameter_id').value = parameter.id;
            document.getElementById('update_parameter_title').value = parameter.title;
            document.getElementById('update_parameter_value').value = parameter.value;

            $('#kt_modal_update_parameter').modal('show');
        }
    </script>
    <!--end::Modal - Update parameter-->
@endsection

