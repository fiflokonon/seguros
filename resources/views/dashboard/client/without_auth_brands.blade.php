<!DOCTYPE html>
<html lang="fr">
<!--begin::Head-->
@include('partials.dashboard.head')
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <div class="row">
            <div class="col-lg-12">
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
                        <div class="row">
                            @foreach($mas as $brand)
                                <div class="col-2">
                                    <a href="{{ route('invoice_form', $brand->id) }}">
                                        <img src="{{ $brand->image }}" width="50px">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-12 col-form-label">Si tu marca no está entre las más buscadas, por favor selecciona de esta lista.</label>
                            <div class="col-md-10">
                                <select name="brand" id="brand-select" class="form-select form-select-lg">
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
<!--end::Root-->
<!--end::Main-->

<!--begin::Scrolltop-->
@include('partials.dashboard.scrolltop')
<!--end::Scrolltop-->

@include('partials.dashboard.scripts')
</body>
<!--end::Body-->
</html>
