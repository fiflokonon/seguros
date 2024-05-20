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
                                <h4 class="card-title">Liste des rôles</h4>
                                <div class="float-lg-end"><a href="{{ route('add_role') }}" class="btn btn-primary waves-effect waves-light"> <i class="ti-plus"> <b>Nouveau role</b></i></a></div>
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="bg-danger">
                                    <tr>
                                        <th>Role</th>
                                        <th>Description</th>
                                        <th>Statut</th>
                                        <th>Date de création</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{ $role->title }}</td>
                                            <td>{{ $role->description }}</td>
                                            @if( $role->status )
                                                <td><span class="badge rounded-pill bg-success">Actif</span></td>
                                            @else
                                                <td><span class="badge rounded-pill bg-danger">Inactif</span></td>
                                            @endif
                                            <td>{{ $role->created_at }}</td>
                                            <td class="text-center">
                                                <a class="dropdown-toggle" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <button class="btn"><i class="ti-more-alt"></i></button>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                    @if( $role->status)
                                                        <a class="dropdown-item" href="{{ route('deactivate_role', ['id' => $role->id]) }}"><i class="ti-trash text-danger"></i> Désactiver</a>
                                                    @else
                                                        <a class="dropdown-item" href="{{ route('activate_role', ['id' => $role->id]) }}"><i class="ti-check text-success"></i> Activer</a>
                                                    @endif
                                                    <a class="dropdown-item" href="{{ route('role', ['id' => $role->id]) }}"><i class="ti-trash text-danger"></i> Modifier</a>
                                                    <a class="dropdown-item" href="{{ route('role_details', ['id' => $role->id]) }}"> <i class="ti-eye text-success"></i> Voir</a>
                                                </div>
                                            </td>
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
@endsection
