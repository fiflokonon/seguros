@extends('partials.dashboard.index')
@section('title', 'Categorías')
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
                    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">CALCULA TU SEGURO DE FORMA RÁPIDA Y SENCILLA</h1>
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
                                <h4 class="card-title">¿De qué marca es el coche?</h4>
                                <div class="">
                                    @foreach($mas as $brand)
                                        <a href="{{ route('invoice_form', $brand->id) }}">
                                        <img src="{{ $brand->image }}" width="80px">
                                        </a>
                                    @endforeach
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-12 col-form-label">Si tu marca no está entre las más buscadas, por favor selecciona de esta lista.</label>
                                    <div class="col-md-10">
                                        <select name="brand" id="brand-select" class="form-select form-select-lg" data-control="select2">
                                            <option selected disabled>Seleccione una Marca</option>
                                            @foreach($minos as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- Button will be shown here -->
                                <div id="next-button-container" style="display:none;">
                                    <a id="next-button" class="btn" style="background-color: #013832; color: white" href="#">Siguiente</a>
                                </div>
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
    <!-- Inclure jQuery via un CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialiser Select2
            $('#brand-select').select2();
            // Attacher l'événement change
            $('#brand-select').on('change', function() {
                const nextButtonContainer = document.getElementById('next-button-container');
                const nextButton = document.getElementById('next-button');
                var selectedBrand = $(this).val();
                //console.log('La valeur sélectionnée est : ' + selectedBrand);
                if (selectedBrand) {
                    const nextButtonUrl = `{{ route('invoice_form', ':id') }}`.replace(':id', selectedBrand);
                    nextButton.href = nextButtonUrl;
                    nextButtonContainer.style.display = 'block';
                } else {
                    nextButtonContainer.style.display = 'none';
                }
                // Vous pouvez également exécuter d'autres actions ici
            });
        });

    </script>
@endsection


