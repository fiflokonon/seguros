@extends('partials.dashboard.index')
@section('title', 'Factura')
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
                <!-- begin::Invoice 3-->
                <div class="card">
                    <!-- begin::Body-->
                    <div class="card-body py-20">
                        <!-- begin::Wrapper-->
                        <div class="mw-lg-950px mx-auto w-100">
                            <!-- begin::Header-->
                            <div class="d-flex justify-content-between flex-column flex-sm-row mb-19">
                                <h4 class="fw-boldest text-gray-800 fs-2qx pe-5 pb-7">Factura PRO FORMA</h4>
                                <!--end::Logo-->
                                <div class="text-sm-end">
                                    <!--begin::Logo-->
                                    <a href="#" class="d-block mw-150px ms-sm-auto">
                                        <img alt="Logo" src="/assets/media/logos/logo-c-blue.png" class="w-100" />
                                    </a>
                                    <!--end::Logo-->
                                    <!--begin::Text-->
                                    <div class="text-sm-end fw-bold fs-4 text-muted mt-7">
                                        <div> Gepetrol Seguros</div>
                                        <div>Avenida Enrique Nvo S/n, Edificio Alexandra 89 Malabo</div>
                                        <div>(+240) 333 099 311</div>
                                        <div>(+240) 350 083 700 -:- 350083701</div>
                                    </div>
                                    <!--end::Text-->
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="pb-12">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column gap-7 gap-md-10">
                                    <!--begin::Message-->
                                    <div class="fw-bolder fs-2">{{ $invoice->first_name.' '.$invoice->last_name }}
                                        <span class="fs-6">({{ $invoice->email }})</span>
                                        <br>
                                        <br>
                                    <!--begin::Message-->
                                    <!--begin::Separator-->
                                    <div class="separator"></div>
                                    <!--begin::Separator-->
                                    <!--begin::Order details-->
                                    <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bolder">
                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Date</span>
                                            <span class="fs-5">{{ Carbon\Carbon::parse($invoice->created_at)->locale('es')->translatedFormat('d M Y H:i') }}</span>
                                        </div>
                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Invoice ID</span>
                                            <span class="fs-5">#INV-{{ $invoice->code }}</span>
                                        </div>
                                    </div>
                                    <!--end::Order details-->
                                    <!--begin:Order summary-->
                                    <div class="d-flex justify-content-between flex-column">
                                        <!--begin::Table-->
                                        <div class="table-responsive border-bottom mb-9">
                                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                <thead>
                                                <tr class="border-bottom fs-6 fw-bolder text-muted">
                                                    <th class="min-w-175px pb-2">Descripción</th>
                                                    <th class="min-w-100px text-end pb-2">Total</th>
                                                </tr>
                                                </thead>
                                                <tbody class="fw-bold text-gray-600">
                                                <!--begin::Products-->
                                                <tr>
                                                    <!--begin::Product-->
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Title-->
                                                            <div class="ms-5">
                                                                <div class="fw-bolder">Precio Inicial</div>
                                                            </div>
                                                            <!--end::Title-->
                                                        </div>
                                                    </td>
                                                    <!--end::Product-->
                                                    <!--begin::Total-->
                                                    <td class="text-end">{{ $invoice->initial_price }}</td>
                                                    <!--end::Total-->
                                                </tr>
                                                <tr>
                                                    <!--begin::Product-->
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Title-->
                                                            <div class="ms-5">
                                                                <div class="fw-bolder">Precio Accessorios</div>
                                                            </div>
                                                            <!--end::Title-->
                                                        </div>
                                                    </td>
                                                    <!--end::Product-->
                                                    <!--begin::Total-->
                                                    <td class="text-end">{{ $invoice->accessories_price }}</td>
                                                    <!--end::Total-->
                                                </tr>
                                                <tr>
                                                    <!--begin::Product-->
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Title-->
                                                            <div class="ms-5">
                                                                <div class="fw-bolder">Precio Attestacion</div>
                                                            </div>
                                                            <!--end::Title-->
                                                        </div>
                                                    </td>
                                                    <!--end::Product-->
                                                    <!--begin::Total-->
                                                    <td class="text-end">{{ $invoice->attestation_price }}</td>
                                                    <!--end::Total-->
                                                </tr>
                                                <!--end::Products-->
                                                <!--begin::Subtotal-->
                                                <tr>
                                                    <td colspan="3" class="text-end">Subtotal</td>
                                                    <td class="text-end">{{ $invoice->sub_total }}</td>
                                                </tr>
                                                <!--end::Subtotal-->
                                                <!--begin::VAT-->
                                                <tr>
                                                    <td colspan="3" class="text-end">IVA (15%)</td>
                                                    <td class="text-end">{{ $invoice->vat }}</td>
                                                </tr>
                                                <!--end::VAT-->
                                                <!--begin::Grand total-->
                                                <tr>
                                                    <td colspan="3" class="fs-3 text-dark fw-bolder text-end">Total</td>
                                                    <td class="text-dark fs-3 fw-boldest text-end">{{ $invoice->total }}</td>
                                                </tr>
                                                <!--end::Grand total-->
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--end::Table-->
                                    </div>
                                    <!--end:Order summary-->
                                        <!--begin::Billing & shipping-->
                                        <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10">
                                            <div class="flex-root d-flex flex-column">
                                                <span class="text-muted fw-bolder">Detailles de la Cotization</span>
                                                <span class="fs-6">
                                                    <b>Modelo del coche :</b> {{ $invoice->model }}
                                                    <br />
                                                    <b>Matricula :</b> {{ $invoice->regis_number }}
															<br />
                                                    <b>Puertas :</b> {{ $invoice->place_number }}
															<br />
                                                   <b>Potencia Minima :</b> {{ $invoice->power->min_power }}
															<br />
                                                  <b>Potencia Maxima :</b> {{ $invoice->power->max_power }}
															<br />
                                                  <b>Tipo de Remolque :</b> {{ $invoice->trailer->title }}
															<br />
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Billing & shipping-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Body-->
                            <!-- begin::Footer-->
                            <div class="d-flex flex-stack flex-wrap mt-lg-20 pt-13">
                                <!-- begin::Actions-->
                                <div class="my-1 me-5">
                                    <!-- begin::Pint-->
                                    <button type="button" class="btn my-1 me-12" style="background-color: #013832; color: white" onclick="window.print();">Imprimir</button>
                                    <!-- end::Pint-->
                                    <!-- begin::Download-->
                                    <button type="button" class="btn my-1" style="background-color: #013832; color: white" >Consíguelo por email</button>
                                    <!-- end::Download-->
                                </div>
                                <!-- end::Actions-->
                            </div>
                            <!-- end::Footer-->
                        </div>
                        <!-- end::Wrapper-->
                    </div>
                    <!-- end::Body-->
                </div>
                <!-- end::Invoice 1-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const brandSelect = document.getElementById('brand-select');
            const nextButtonContainer = document.getElementById('next-button-container');
            const nextButton = document.getElementById('next-button');

            brandSelect.addEventListener('change', function () {
                const selectedBrandId = this.value;
                if (selectedBrandId) {
                    const nextButtonUrl = `{{ route('invoice_form', ':id') }}`.replace(':id', selectedBrandId);
                    nextButton.href = nextButtonUrl;
                    nextButtonContainer.style.display = 'block';
                } else {
                    nextButtonContainer.style.display = 'none';
                }
            });
        });

    </script>
@endsection


