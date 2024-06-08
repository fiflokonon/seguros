@extends('partials.dashboard.index')
@section('title', 'Detailles sinistro')
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
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Detailles de Sinietros</h4>
                            <div class="col-12">
                                @include('partials.dashboard.back_message')
                                <div class="container mt-5">
                                    <!-- En-tête de la plainte -->
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="mb-4 fw-bolder">Titulo : </span>{{ $complaint->title }}
                                        </div>
                                    </div>
                                    <!-- Description de la plainte -->
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="mb-4 fw-bolder">Descripcion : </span>
                                            <p class="mb-4">{{ $complaint->description }}</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <span class="mb-4 fw-bolder bg-warning">Estado : </span>@if($complaint->state == 'pending') {{ 'En progresso' }} @elseif($complaint->state == 'opened') {{ 'Abierto' }}@else{{ 'Cerrado' }} @endif
                                        </div>
                                    </div>
                                    <!-- Images jointes -->
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="mb-4 fw-bolder">Imagenes Adjuntas : </span>
                                            <div class="complaint-images mb-4">
                                                @foreach(json_decode($complaint->images) as $image)
                                                <a href="/complaints/{{$image}}" target="_blank">
                                                    <img src="/complaints/{{$image}}" alt="Image" width="300">
                                                </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @if(auth()->user()->role->code == 'manager')
                                    <div class="row">
                                        <span class="mb-4 fw-bolder">Cambiar Estado : </span>
                                        <div class="mt-2 mb-3">
                                            @if($complaint->state == 'pending')
                                                <a href="" class="btn" style="background-color: #013832; color: white"><i class="fas fa-envelope-open-text fs-4 me-2"></i> Abierto</a>
                                                <a href="" class="btn" style="background-color: #013832; color: white"><i class="fas fa-envelope-open-text fs-4 me-2"></i>Cerrado</a>
                                            @elseif($complaint->state == 'opened')
                                                <a href="" class="btn" style="background-color: #013832; color: white"><i class="fas fa-envelope-open-text fs-4 me-2"></i>Cerrado</a>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                    <!-- Historique des réponses -->
                                    <div class="row">
                                        <div class="col-12">
                                            <h2 class="mb-4">Historial de Respuestas</h2>
                                            @if($complaint->answers->isNotEmpty())
                                                @foreach($complaint->answers as $answer)
                                                <div class="response mb-3">
                                                    <div class="response-author">Respondido por : {{ $answer->user->first_name.' '. $answer->user->last_name }}</div>
                                                    <p>{{ $answer->body }}</p>
                                                </div>
                                                @endforeach
                                            @else
                                                <div class="response mb-3">
                                                    <p class="text-danger">No respuesta por la hora</p>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                    @if(auth()->user()->role->code == 'manager')
                                    <!-- Formulaire de nouvelle réponse -->
                                    <div class="row">
                                        <div class="col-12">
                                            <h2 class="mb-4">Añadir Respuesta cc:</h2>
                                            <form method="POST" action={{ route('answer_complaint', $complaint->id) }} >
                                                @csrf
                                                <div class="form-group">
                                                    <textarea class="form-control" name="body" rows="5" placeholder="Escribe tu respuesta aqui"></textarea>
                                                </div>
                                                <button type="submit" class="btn mt-2" style="background-color: #013832; color: white">Enviar</button>
                                            </form>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection


