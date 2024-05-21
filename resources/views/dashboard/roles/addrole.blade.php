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
                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="./new-role">
                            @csrf
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
                                    <h4 class="card-title">Ajout de role</h4>
                                    <div class="mb-3 row">
                                        <label for="example-text-input" class="col-md-2 col-form-label">Role</label>
                                        <div class="col-md-10">
                                            <input class="form-control" name="title" type="text" id="example-text-input" placeholder="Admin">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="example-email-input" class="col-md-2 col-form-label">Description</label>
                                        <div class="col-md-10">
                                            <input class="form-control" name="description" type="text" id="example-text-input" placeholder="Description">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="example-email-input" class="col-md-2 col-form-label">Permissions:</label>
                                    </div>
                                    <div class="mb-3 row">
                                        @foreach($permissions as $permission)
                                            <div class="col-4">
                                                <div class="form-check mb-3">
                                                    <input name="permission[]" class="form-check-input" type="checkbox" id="formCheck1" value="{{ $permission->id }}">
                                                    <label class="form-check-label" for="formCheck1">{{ $permission->title }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mb-3 row">
                                        <button type="submit" class="btn btn-primary" style="background-color: #013832; color: white">Enregistrer</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- end col -->
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection


