@extends('partials.dashboard.index')
@section('title', 'Facturas')
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
                                <h4 class="card-title">Facturas</h4>
                                <table  class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                                    <!--begin::Table head-->
                                    <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px">Fecha</th>
                                        <th class="min-w-125px">Hora</th>
                                        <th class="min-w-125px">Numero Factura</th>
                                        <th class="min-w-125px">Precio Total</th>
                                        <th class="min-w-125px">Estado</th>
                                        <th class="text-end min-w-70px">Acciones</th>
                                    </tr>
                                    <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    @if(isset($invoices))
                                    <tbody>
                                    @foreach($invoices as $invoice)
                                        <tr>
                                            <td>{{ Carbon\Carbon::parse($invoice->created_at)->locale('es')->translatedFormat('d M Y') }}</td>
                                            <td>{{ Carbon\Carbon::parse($invoice->created_at)->locale('es')->translatedFormat('H:i:s') }}</td>
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
                                                        <a href="{{ route('invoice_details', $invoice->id) }}" class="btn menu-link px-3" ><i class="fa fa-paperclip text-success"></i>Detalles</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    @if(auth()->user()->role->code == 'manager')
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="{{ route('approve_invoice', $invoice->id) }}" class="btn menu-link px-3" ><i class="fa fa-check text-success"></i>Approbado</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="{{ route('refuse_invoice', $invoice->id) }}" class="btn menu-link px-3" ><i class="fa fa-times text-danger"></i>Rechazado</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    @endif
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                            <!--end::Action=-->
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                @if($invoices->count() > 0 && !empty($invoices->links()))
                    <ul class="pagination mt-2">
                        {{ $invoices->links() }}
                    </ul>
                @endif
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>

@endsection

