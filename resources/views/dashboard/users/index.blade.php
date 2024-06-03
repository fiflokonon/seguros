@extends('partials.dashboard.index')
@section('title', ' Lista de Usuarios')
@php
$roles = \App\Models\Role::all();
@endphp
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
        @include('partials.dashboard.back_message')
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
                                        <button type="button" class="btn" style="background-color: #013832; color: white" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                                    <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            Crear Nuevo Usuario
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
                                                    <h2 class="fw-bolder">Crear Nuevo Usuario</h2>
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
                                                    <form id="kt_modal_add_user_form" method="POST" class="form" action="{{ route('add_user') }}">
                                                        @csrf
                                                        <!--begin::Scroll-->
                                                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                                            <!--begin::Input group-->
                                                            <div class="fv-row mb-7">
                                                                <!--begin::Label-->
                                                                <label class="required fw-bold fs-6 mb-2">Nombre</label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="text" name="last_name" class="form-control mb-3 mb-lg-0" placeholder="Nombre" value="{{ old('last_name') }}"/>
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="fv-row mb-7">
                                                                <!--begin::Label-->
                                                                <label class="required fw-bold fs-6 mb-2">Apellidos</label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="text" name="first_name" class="form-control mb-3 mb-lg-0" placeholder="Apellidos" value="{{ old('first_name') }}" />
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="fv-row mb-7">
                                                                <!--begin::Label-->
                                                                <label class="required fw-bold fs-6 mb-2">Email</label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="email" name="email" class="form-control mb-3 mb-lg-0" placeholder="Email" value="{{ old('email') }}" />
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="fv-row mb-7">
                                                                <!--begin::Label-->
                                                                <label class="required fw-bold fs-6 mb-2">Teléfono</label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="tel" name="phone" class="form-control mb-3 mb-lg-0" placeholder="Teléfono" value="{{ old('phone') }}"/>
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="fv-row mb-7">
                                                                <!--begin::Label-->
                                                                <label class="required fw-bold fs-6 mb-2">Contraseña</label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="password" name="password" class="form-control mb-3 mb-lg-0" placeholder="Contraseña"  />
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="mb-7">
                                                                <!--begin::Label-->
                                                                <label class="required fw-bold fs-6 mb-5">Role</label>
                                                                <!--end::Label-->
                                                                <!--begin::Roles-->
                                                                @foreach($roles as $role)
                                                                <!--begin::Input row-->
                                                                <div class="d-flex fv-row">
                                                                    <!--begin::Radio-->
                                                                    <div class="form-check form-check-custom form-check-solid">
                                                                        <!--begin::Input-->
                                                                        <input class="form-check-input me-3" name="role" type="radio" value="{{ $role->id }}" id="kt_modal_update_role_option_0" checked='{{ old('role') == $role->id ? 'checked' : '' }}' />
                                                                        <!--end::Input-->
                                                                        <!--begin::Label-->
                                                                        <label class="form-check-label" for="kt_modal_update_role_option_0">
                                                                            <div class="fw-bolder text-gray-800">{{ $role->title }}</div>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                    </div>
                                                                    <!--end::Radio-->
                                                                </div>
                                                                <!--end::Input row-->
                                                                <div class='separator separator-dashed my-5'></div>
                                                                @endforeach
                                                                <!--end::Roles-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="mb-7">
                                                                <!--begin::Label-->
                                                                <label class="required fw-bold fs-6 mb-5">Estado</label>
                                                                <!--end::Label-->
                                                                <!--begin::Status-->
                                                                <!--begin::Input row-->
                                                                <div class="d-flex fv-row">
                                                                    <!--begin::Radio-->
                                                                    <div class="form-check form-check-custom form-check-solid">
                                                                        <!--begin::Input-->
                                                                        <input class="form-check-input me-3" name="status" type="radio" value="1" id="kt_modal_update_role_option_0" />
                                                                        <!--end::Input-->
                                                                        <!--begin::Label-->
                                                                        <label class="form-check-label" for="kt_modal_update_role_option_0">
                                                                            <div class="fw-bolder text-gray-800">Activo</div>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                    </div>
                                                                    <!--end::Radio-->
                                                                </div>
                                                                <!--end::Input row-->
                                                                <div class='separator separator-dashed my-5'></div>
                                                                <div class="d-flex fv-row">
                                                                    <!--begin::Radio-->
                                                                    <div class="form-check form-check-custom form-check-solid">
                                                                        <!--begin::Input-->
                                                                        <input class="form-check-input me-3" name="status" type="radio" value="0" id="kt_modal_update_role_option_0" checked='checked' />
                                                                        <!--end::Input-->
                                                                        <!--begin::Label-->
                                                                        <label class="form-check-label" for="kt_modal_update_role_option_0">
                                                                            <div class="fw-bolder text-gray-800">Inactivo</div>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                    </div>
                                                                    <!--end::Radio-->
                                                                </div>
                                                                <!--end::Input row-->
                                                                <div class='separator separator-dashed my-5'></div>
                                                                <!--end::Status-->
                                                            </div>
                                                            <!--end::Input group-->
                                                        </div>
                                                        <!--end::Scroll-->
                                                        <!--begin::Actions-->
                                                        <div class="text-center pt-15">
                                                            <button type="submit" class="btn" id="add_user_submit"  style="background-color: #013832; color: white">
                                                                Crear usario
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
                                <!--end::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body py-4">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                                    <!--begin::Table head-->
                                    <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px">Usuario</th>
                                        <th class="min-w-125px">Telefeno</th>
                                        <th class="min-w-125px">Role</th>
                                        <th class="min-w-125px">Estado</th>
                                        <th class="text-end min-w-100px">Acciones</th>
                                    </tr>
                                    <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="text-gray-600 fw-bold">
                                    @foreach($users as $user)
                                        @php
                                            $firstLetter = substr($user->first_name, 0, 1);
                                        @endphp
                                    <!--begin::Table row-->
                                    <tr>
                                        <!--begin::User=-->
                                        <td class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../demo1/dist/apps/user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-danger text-danger">{{ $firstLetter }}</div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::User details-->
                                            <div class="d-flex flex-column">
                                                <a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">{{ $user->first_name.' '. $user->last_name }}</a>
                                                <span>{{ $user->email }}</span>
                                            </div>
                                            <!--begin::User details-->
                                        </td>
                                        <!--end::User=-->

                                        <!--begin::Last login=-->
                                        <td>
                                            <div class="fw-bolder">{{ $user->phone }}</div>
                                        </td>
                                        <!--end::Last login=-->
                                        <!--begin::Two step=-->
                                        <td>
                                            <div class="fw-bolder">{{ $user->role->title }}</div>
                                        </td>
                                        <!--end::Two step=-->
                                        <!--begin::Email=-->
                                        <td>
                                            @if($user->email_verified_at)
                                                <div class="badge badge-light-success fw-bolder">Activo</div>
                                            @else
                                                <div class="badge badge-light-danger fw-bolder">Inactivo</div>
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
                                                <!--end::Svg Icon--></a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('profile', $user->id) }}" class="menu-link px-3">Detailles</a>
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
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection

