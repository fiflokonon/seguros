@extends('partials.dashboard.index')
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
                    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Tableau de bord</h1>
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
                <!--begin::Row-->
                <div class="row g-5 g-xl-10">
                    <!--begin::Col-->
                    <div class="col-xl-4 mb-xl-10">
                        <!--begin::Lists Widget 19-->
                        <div class="card card-flush h-xl-100">
                            <!--begin::Heading-->
                            <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px"
                                 style="background-image:url('assets/media/svg/shapes/top-green.png')">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column text-white pt-15">
                                    <span class="fw-bolder fs-2x mb-3">Bienvenido , {{ auth()->user()->first_name }}</span>
                                    <div class="fs-4 text-white">
                                        <span class="opacity-75">Ci-dessous listées vos statistiques</span>
                                    </div>
                                </h3>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Body-->
                            <div class="card-body mt-n20">
                                <!--begin::Stats-->
                                <div class="mt-n20 position-relative">
                                    @if(auth()->user()->role->code == 'admin')
                                        <!--begin::Row-->
                                        <div class="row g-3 g-lg-6">
                                            <!--begin::Col-->
                                            <div class="col-6">
                                                <!--begin::Items-->
                                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-30px me-5 mb-8">
                                                        <span class="symbol-label">
                                                            <!--begin::Svg Icon | path: icons/duotune/medicine/med005.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                                <i class="fa fa-envelope text-success"></i>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Stats-->
                                                    <div class="m-0">
                                                        <!--begin::Number-->
                                                        <span class="text-gray-700 fw-boldest d-block fs-2qx lh-1 ls-n1 mb-1">{{ $invoices_count }}</span>
                                                        <!--end::Number-->
                                                        <!--begin::Desc-->
                                                        <span class="text-gray-500 fw-bold fs-8">Facturas</span>
                                                        <!--end::Desc-->
                                                    </div>
                                                    <!--end::Stats-->
                                                </div>
                                                <!--end::Items-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-6">
                                                <!--begin::Items-->
                                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-30px me-5 mb-8">
                                                        <span class="symbol-label">
                                                            <!--begin::Svg Icon | path: icons/duotune/finance/fin001.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                                <i class="fa fa-users text-success"></i>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Stats-->
                                                    <div class="m-0">
                                                        <!--begin::Number-->
                                                        <span class="text-gray-700 fw-boldest d-block fs-2qx lh-1 ls-n1 mb-1">{{ $users_count }}</span>
                                                        <!--end::Number-->
                                                        <!--begin::Desc-->
                                                        <span class="text-gray-500 fw-bold fs-8">Usarios</span>
                                                        <!--end::Desc-->
                                                    </div>
                                                    <!--end::Stats-->
                                                </div>
                                                <!--end::Items-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-6">
                                                <!--begin::Items-->
                                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-30px me-5 mb-8">
                                                        <span class="symbol-label">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen020.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                                <i class="fa fa-question text-success"></i>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Stats-->
                                                    <div class="m-0">
                                                        <!--begin::Number-->
                                                        <span class="text-gray-700 fw-boldest d-block fs-2qx lh-1 ls-n1 mb-1">{{ $complaints_count }}</span>
                                                        <!--end::Number-->
                                                        <!--begin::Desc-->
                                                        <span class="text-gray-500 fw-bold fs-8">Siniestros</span>
                                                        <!--end::Desc-->
                                                    </div>
                                                    <!--end::Stats-->
                                                </div>
                                                <!--end::Items-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-6">
                                                <!--begin::Items-->
                                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-30px me-5 mb-8">
                                                        <span class="symbol-label">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                                <i class="fa fa-key text-success"></i>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Stats-->
                                                    <div class="m-0">
                                                        <!--begin::Number-->
                                                        <span class="text-gray-700 fw-boldest d-block fs-2qx lh-1 ls-n1 mb-1">{{ $roles_count }}</span>
                                                        <!--end::Number-->
                                                        <!--begin::Desc-->
                                                        <span class="text-gray-500 fw-bold fs-8">Roles</span>
                                                        <!--end::Desc-->
                                                    </div>
                                                    <!--end::Stats-->
                                                </div>
                                                <!--end::Items-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    @elseif(auth()->user()->role->code == 'manager')
                                        <!--begin::Row-->
                                        <div class="row g-3 g-lg-6">
                                            <!--begin::Col-->
                                            <div class="col-6">
                                                <!--begin::Items-->
                                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-30px me-5 mb-8">
                                                        <span class="symbol-label">
                                                            <!--begin::Svg Icon | path: icons/duotune/medicine/med005.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                                <i class="fa fa-envelope text-success"></i>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Stats-->
                                                    <div class="m-0">
                                                        <!--begin::Number-->
                                                        <span class="text-gray-700 fw-boldest d-block fs-2qx lh-1 ls-n1 mb-1">{{ $invoices->count() }}</span>
                                                        <!--end::Number-->
                                                        <!--begin::Desc-->
                                                        <span class="text-gray-500 fw-bold fs-8">Facturas</span>
                                                        <!--end::Desc-->
                                                    </div>
                                                    <!--end::Stats-->
                                                </div>
                                                <!--end::Items-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-6">
                                                <!--begin::Items-->
                                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-30px me-5 mb-8">
                                                        <span class="symbol-label">
                                                            <!--begin::Svg Icon | path: icons/duotune/finance/fin001.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                                <i class="fa fa-question text-success"></i>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Stats-->
                                                    <div class="m-0">
                                                        <!--begin::Number-->
                                                        <span class="text-gray-700 fw-boldest d-block fs-2qx lh-1 ls-n1 mb-1">{{ $pending_complaints }}</span>
                                                        <!--end::Number-->
                                                        <!--begin::Desc-->
                                                        <span class="text-gray-500 fw-bold fs-8">Siniestros progresso</span>
                                                        <!--end::Desc-->
                                                    </div>
                                                    <!--end::Stats-->
                                                </div>
                                                <!--end::Items-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-6">
                                                <!--begin::Items-->
                                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-30px me-5 mb-8">
                                                        <span class="symbol-label">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen020.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                                <i class="fa fa-question text-success"></i>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Stats-->
                                                    <div class="m-0">
                                                        <!--begin::Number-->
                                                        <span class="text-gray-700 fw-boldest d-block fs-2qx lh-1 ls-n1 mb-1">{{ $opened_complaints }}</span>
                                                        <!--end::Number-->
                                                        <!--begin::Desc-->
                                                        <span class="text-gray-500 fw-bold fs-8">Siniestros abiertos</span>
                                                        <!--end::Desc-->
                                                    </div>
                                                    <!--end::Stats-->
                                                </div>
                                                <!--end::Items-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-6">
                                                <!--begin::Items-->
                                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-30px me-5 mb-8">
                                                        <span class="symbol-label">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                                <i class="fa fa-question text-success"></i>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Stats-->
                                                    <div class="m-0">
                                                        <!--begin::Number-->
                                                        <span class="text-gray-700 fw-boldest d-block fs-2qx lh-1 ls-n1 mb-1">{{ $closed_complaints }}</span>
                                                        <!--end::Number-->
                                                        <!--begin::Desc-->
                                                        <span class="text-gray-500 fw-bold fs-8">Siniestros cerrados</span>
                                                        <!--end::Desc-->
                                                    </div>
                                                    <!--end::Stats-->
                                                </div>
                                                <!--end::Items-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    @elseif(auth()->user()->role->code == 'client')
                                        <!--begin::Row-->
                                        <div class="row g-3 g-lg-6">
                                            <!--begin::Col-->
                                            <div class="col-6">
                                                <!--begin::Items-->
                                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-30px me-5 mb-8">
                                                        <span class="symbol-label">
                                                            <!--begin::Svg Icon | path: icons/duotune/medicine/med005.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                                <i class="fa fa-envelope text-success"></i>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Stats-->
                                                    <div class="m-0">
                                                        <!--begin::Number-->
                                                        <span class="text-gray-700 fw-boldest d-block fs-2qx lh-1 ls-n1 mb-1">{{ $invoices->count() }}</span>
                                                        <!--end::Number-->
                                                        <!--begin::Desc-->
                                                        <span class="text-gray-500 fw-bold fs-8">Facturas</span>
                                                        <!--end::Desc-->
                                                    </div>
                                                    <!--end::Stats-->
                                                </div>
                                                <!--end::Items-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-6">
                                                <!--begin::Items-->
                                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-30px me-5 mb-8">
                                                        <span class="symbol-label">
                                                            <!--begin::Svg Icon | path: icons/duotune/finance/fin001.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                                <i class="fa fa-question text-success"></i>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Stats-->
                                                    <div class="m-0">
                                                        <!--begin::Number-->
                                                        <span class="text-gray-700 fw-boldest d-block fs-2qx lh-1 ls-n1 mb-1">{{ $pending_complaints }}</span>
                                                        <!--end::Number-->
                                                        <!--begin::Desc-->
                                                        <span class="text-gray-500 fw-bold fs-8">Siniestros progresso</span>
                                                        <!--end::Desc-->
                                                    </div>
                                                    <!--end::Stats-->
                                                </div>
                                                <!--end::Items-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-6">
                                                <!--begin::Items-->
                                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-30px me-5 mb-8">
                                                        <span class="symbol-label">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen020.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                                <i class="fa fa-question text-success"></i>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Stats-->
                                                    <div class="m-0">
                                                        <!--begin::Number-->
                                                        <span class="text-gray-700 fw-boldest d-block fs-2qx lh-1 ls-n1 mb-1">{{ $opened_complaints }}</span>
                                                        <!--end::Number-->
                                                        <!--begin::Desc-->
                                                        <span class="text-gray-500 fw-bold fs-8">Siniestros abiertos</span>
                                                        <!--end::Desc-->
                                                    </div>
                                                    <!--end::Stats-->
                                                </div>
                                                <!--end::Items-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-6">
                                                <!--begin::Items-->
                                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-30px me-5 mb-8">
                                                        <span class="symbol-label">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                                <i class="fa fa-question text-success"></i>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Stats-->
                                                    <div class="m-0">
                                                        <!--begin::Number-->
                                                        <span class="text-gray-700 fw-boldest d-block fs-2qx lh-1 ls-n1 mb-1">{{ $closed_complaints }}</span>
                                                        <!--end::Number-->
                                                        <!--begin::Desc-->
                                                        <span class="text-gray-500 fw-bold fs-8">Siniestros cerrados</span>
                                                        <!--end::Desc-->
                                                    </div>
                                                    <!--end::Stats-->
                                                </div>
                                                <!--end::Items-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    @endif
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Lists Widget 19-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-8 mb-5 mb-xl-10">
                        <!--begin::Row-->
                        <div class="row g-5 g-xl-10">
                            <!--begin::Col-->
                            <div class="col-xl-12 mb-5 mb-xl-10">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Facturas</h4>
                                        <table  class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                                            <!--begin::Table head-->
                                            <thead>
                                            <!--begin::Table row-->
                                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                <th class="min-w-125px">Fecha</th>
                                                <th class="min-w-125px">Numero Factura</th>
                                                <th class="min-w-125px">Precio Total</th>
                                                <th class="min-w-125px">Estado</th>
                                            </tr>
                                            <!--end::Table row-->
                                            </thead>
                                            <!--end::Table head-->
                                            @if(isset($invoices))
                                                <tbody>
                                                @foreach($invoices as $invoice)
                                                    <tr>
                                                        <td>{{ Carbon\Carbon::parse($invoice->created_at)->locale('es')->translatedFormat('d M Y') }}</td>
                                                        <td>{{ $invoice->code }}</td>
                                                        <td>{{ $invoice->total }} XFA</td>
                                                        @if( $invoice->state == 'pending' )
                                                            <td><span class="badge rounded-pill bg-warning">Pendiente</span></td>
                                                        @elseif($invoice->state == 'approved')
                                                            <td><span class="badge rounded-pill bg-success">Approbado</span></td>
                                                        @elseif($invoice->state == 'refused')
                                                            <td><span class="badge rounded-pill bg-danger">Rechazado</span></td>
                                                        @else
                                                            <td><span class="badge rounded-pill bg-danger">Abierto</span></td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--end::Col-->
                            <ul class="pagination mt-2">
                                {{ $invoices->links() }}
                            </ul>
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection
