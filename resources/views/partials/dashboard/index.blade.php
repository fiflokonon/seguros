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
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        <!--begin::Aside-->
        @include('partials.dashboard.aside')
        <!--end::Aside-->
        <!--begin::Wrapper-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            @if(auth()->user() != null)
            <!--begin::Header-->
            @include('partials.dashboard.header')
            <!--end::Header-->
            @endif
            <!--begin::Content-->
            @yield('content')
            <!--end::Content-->
            @if(auth()->user() != null)
            <!--begin::Footer-->
            @include('partials.dashboard.footer')
            <!--end::Footer-->:
            @endif
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Root-->
<!--end::Main-->

<!--begin::Scrolltop-->
@include('partials.dashboard.scrolltop')
<!--end::Scrolltop-->

@include('partials.dashboard.scripts')
</body>
<!--end::Body-->
</html>
