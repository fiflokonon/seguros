@extends('partials.dashboard.index')
@section('title', ' Lista de marcas')
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
                        <!--begin::Card-->
                        <div class="card">
                            <!--begin::Card header-->
                            <div class="card-header border-0 pt-6">
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <!--begin::Toolbar-->
                                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                        <!--begin::Add user-->
                                        <button type="button" class="btn text-white" style="background-color: #013832; color: white" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                                    <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            Crear Nueva marca
                                        </button>
                                        <!--end::Add user-->
                                    </div>
                                    <!--end::Toolbar-->

                                    <!--begin::Modal - Add task-->
                                    <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                                        <!--begin::Modal dialog-->
                                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                            <!--begin::Modal content-->
                                            <div class="modal-content">
                                                <!--begin::Modal header-->
                                                <div class="modal-header" id="kt_modal_add_user_header">
                                                    <!--begin::Modal title-->
                                                    <h2 class="fw-bolder">Nueva marca</h2>
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
                                                    <form id="kt_modal_add_user_form" class="form" method="POST" action="{{ route('add_brand') }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <!--begin::Scroll-->
                                                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                                            <!--begin::Input group-->
                                                            <div class="fv-row mb-7">
                                                                <!--begin::Label-->
                                                                <label class="required fw-bold fs-6 mb-2">Marca</label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="text" name="title" class="form-control mb-3 mb-lg-0" placeholder="Insertar el titulo de la marca" />
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="mb-7">
                                                                <!--begin::Label-->
                                                                <label class="required fw-bold fs-6 mb-5">Tipo</label>
                                                                <!--end::Label-->
                                                                <!--begin::Roles-->
                                                                <!--begin::Input row-->
                                                                <div class="d-flex fv-row">
                                                                    <!--begin::Radio-->
                                                                    <div class="form-check form-check-custom form-check-solid">
                                                                        <!--begin::Input-->
                                                                        <input class="form-check-input me-3" name="most_used" type="radio" value="1" id="kt_modal_update_role_option_0" checked='checked' />
                                                                        <!--end::Input-->
                                                                        <!--begin::Label-->
                                                                        <label class="form-check-label" for="kt_modal_update_role_option_0">
                                                                            <div class="fw-bolder text-gray-800">Mas bucadas</div>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                    </div>
                                                                    <!--end::Radio-->
                                                                </div>
                                                                <!--end::Input row-->
                                                                <div class='separator separator-dashed my-5'></div>
                                                                <!--begin::Input row-->
                                                                <div class="d-flex fv-row">
                                                                    <!--begin::Radio-->
                                                                    <div class="form-check form-check-custom form-check-solid">
                                                                        <!--begin::Input-->
                                                                        <input class="form-check-input me-3" name="most_used" type="radio" value="0" id="kt_modal_update_role_option_1" />
                                                                        <!--end::Input-->
                                                                        <!--begin::Label-->
                                                                        <label class="form-check-label" for="kt_modal_update_role_option_1">
                                                                            <div class="fw-bolder text-gray-800">No mas bucadas</div>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                    </div>
                                                                    <!--end::Radio-->
                                                                </div>
                                                                <!--end::Input row-->
                                                                <div class='separator separator-dashed my-5'></div>
                                                                <!--end::Roles-->
                                                            </div>
                                                            <!--end::Input group-->

                                                            <!--begin::Input group-->
                                                            <div class="fv-row mb-7" id="image-upload-group" style="display: none;">
                                                                <!--begin::Label-->
                                                                <label class="required fw-bold fs-6 mb-2">Imagen</label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="file" name="image" class="form-control form-control-solid mb-3 mb-lg-0"/>
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                        </div>
                                                        <!--end::Scroll-->
                                                        <div class="text-center pt-15">
                                                            <button type="submit" class="btn"  style="background-color: #013832; color: white">
                                                                Crear marca
                                                                <span class="indicator-label"></span>
                                                                <span class="indicator-progress">Please wait...<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                            </button>
                                                        </div>
                                                        <!--end::Actions-->
                                                    </form>
                                                    <!--end::Form-->
                                                </div>
                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function () {
                                                        const mostUsedRadios = document.querySelectorAll('input[name="most_used"]');
                                                        const imageUploadGroup = document.getElementById('image-upload-group');

                                                        mostUsedRadios.forEach(radio => {
                                                            radio.addEventListener('change', function () {
                                                                if (this.value == '1') {
                                                                    imageUploadGroup.style.display = 'block';
                                                                    imageUploadGroup.querySelector('input[name="image"]').setAttribute('required', 'required');
                                                                } else {
                                                                    imageUploadGroup.style.display = 'none';
                                                                    imageUploadGroup.querySelector('input[name="image"]').removeAttribute('required');
                                                                }
                                                            });
                                                        });

                                                        // Initialize display based on the initially checked radio button
                                                        const checkedRadio = document.querySelector('input[name="most_used"]:checked');
                                                        if (checkedRadio && checkedRadio.value == '1') {
                                                            imageUploadGroup.style.display = 'block';
                                                            imageUploadGroup.querySelector('input[name="image"]').setAttribute('required', 'required');
                                                        } else {
                                                            imageUploadGroup.style.display = 'none';
                                                            imageUploadGroup.querySelector('input[name="image"]').removeAttribute('required');
                                                        }
                                                    });
                                                </script>
                                                <!--end::Modal body-->
                                            </div>
                                            <!--end::Modal content-->
                                        </div>
                                        <!--end::Modal dialog-->
                                    </div>
                                    <!--end::Modal - Add task-->
                                </div>
                                <!--end::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body py-4">
                                <h4 class="card-title">Marcas</h4>
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
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                                    <!--begin::Table head-->
                                    <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px">Marca</th>
                                        <th class="min-w-125px">Type</th>
                                        <th class="min-w-125px">Estado</th>
                                        <th class="text-end min-w-100px">Acciones</th>
                                    </tr>
                                    <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="text-gray-600 fw-bold">
                                    @foreach($brands as $brand)
                                        @php
                                            $firstLetter = substr($brand->title, 0, 1);
                                        @endphp
                                    <!--begin::Table row-->
                                    <tr>
                                        <!--begin::User=-->
                                        <td class="d-flex align-items-center">
                                            @if($brand->image != null)
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../demo1/dist/apps/user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="{{ $brand->image }}" alt="Emma Smith" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->
                                            @else
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a>
                                                    <div class="symbol-label fs-3 bg-light-danger text-danger">{{ $firstLetter }}</div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->
                                            @endif
                                            <!--begin::User details-->
                                            <div class="d-flex flex-column">
                                                <a class="text-gray-800 text-hover-primary mb-1">{{ $brand->title }}</a>
                                            </div>
                                            <!--begin::User details-->
                                        </td>
                                        <!--end::User=-->
                                        <!--begin::Email=-->
                                        <td>
                                            @if($brand->most_used)
                                                <div class="badge badge-light-success fw-bolder">Mas bucada</div>
                                            @else
                                                <div class="badge badge-light-warning fw-bolder">No mas bucada </div>
                                            @endif
                                        </td>
                                        <!--end::Email=-->
                                        <!--begin::Email=-->
                                        <td>
                                            @if($brand->status)
                                                <div class="badge badge-light-success fw-bolder">Activo</div>
                                            @else
                                                <div class="badge badge-light-success fw-bolder">Inactivo</div>
                                            @endif
                                        </td>
                                        <!--end::Email=-->
                                        <!--begin::Action=-->
                                        <td class="text-end">
                                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Acciones
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
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_update_user" onclick="setBrandData({{ $brand->id }}, '{{ $brand->title }}', {{ $brand->most_used }}, '{{ $brand->image }}')" class="menu-link px-3"> <i class="fa fa-pen-alt text-dark"></i> Modifiar</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3" data-kt-users-table-filter="delete_row">Delete</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                        <!--end::Action=-->
                                    </tr>
                                    <!--end::Table row-->
                                    @endforeach
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!-- end col -->
                </div>
                <ul class="pagination mt-2">
                    {{ $brands->links() }}
                </ul>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->

        <!--begin::Modal - Update task-->
        <div class="modal fade" id="kt_modal_update_user" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_update_user_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">Actualizar marca</h2>
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
                        <form id="kt_modal_update_user_form" class="form" method="POST" action="{{ route('update_brand') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="update_brand_id">
                            <!--begin::Scroll-->
                            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_user_header" data-kt-scroll-wrappers="#kt_modal_update_user_scroll" data-kt-scroll-offset="300px">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Marca</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="title" id="update_brand_title" class="form-control mb-3 mb-lg-0" placeholder="Insertar el titulo de la marca" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-5">Tipo</label>
                                    <!--end::Label-->
                                    <!--begin::Roles-->
                                    <!--begin::Input row-->
                                    <div class="d-flex fv-row">
                                        <!--begin::Radio-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="most_used" type="radio" value="1" id="kt_modal_update_role_option_0" />
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_0">
                                                <div class="fw-bolder text-gray-800">Mas bucadas</div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Radio-->
                                    </div>
                                    <!--end::Input row-->
                                    <div class='separator separator-dashed my-5'></div>
                                    <!--begin::Input row-->
                                    <div class="d-flex fv-row">
                                        <!--begin::Radio-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="most_used" type="radio" value="0" id="kt_modal_update_role_option_1" />
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_1">
                                                <div class="fw-bolder text-gray-800">No mas bucadas</div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Radio-->
                                    </div>
                                    <!--end::Input row-->
                                    <div class='separator separator-dashed my-5'></div>
                                    <!--end::Roles-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="fv-row mb-7" id="update_image-upload-group" style="display: none;">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Imagen</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="file" name="image" class="form-control form-control-solid mb-3 mb-lg-0"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Scroll-->
                            <div class="text-center pt-15">
                                <button type="submit" class="btn"  style="background-color: #013832; color: white">
                                    Actualizar marca
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
    </div>
    <script>
        function setBrandData(id, title, most_used, image) {
            document.getElementById('update_brand_id').value = id;
            document.getElementById('update_brand_title').value = title;
            if (most_used === 1 || most_used === true) {
                document.getElementById('kt_modal_update_role_option_0').setAttribute('checked', 'checked');
                document.getElementById('update_image-upload-group').style.display = 'block';
                document.querySelector('#update_image-upload-group input[name="image"]').setAttribute('required', 'required');
            } else {
                document.getElementById('kt_modal_update_role_option_1').setAttribute('checked', 'checked');
                document.getElementById('update_image-upload-group').style.display = 'none';
                document.querySelector('#update_image-upload-group input[name="image"]').removeAttribute('required');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const mostUsedRadiosUpdate = document.querySelectorAll('#kt_modal_update_user_form input[name="most_used"]');
            const imageUploadGroupUpdate = document.getElementById('update_image-upload-group');

            mostUsedRadiosUpdate.forEach(radio => {
                radio.addEventListener('change', function () {
                    if (this.value == '1') {
                        imageUploadGroupUpdate.style.display = 'block';
                        imageUploadGroupUpdate.querySelector('input[name="image"]').setAttribute('required', 'required');
                    } else {
                        imageUploadGroupUpdate.style.display = 'none';
                        imageUploadGroupUpdate.querySelector('input[name="image"]').removeAttribute('required');
                    }
                });
            });
        });

    </script>

@endsection

