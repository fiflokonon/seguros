<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Factura - N° {{ $code }}</title>
    <style>
        .page-container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .line {
            margin-bottom: 8px;
        }
        .column {
            float: left;
            width: 50%;
            padding: 10px;
            height: 100px;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }
        body {
            font-family: Grand Hotel, 'serif';
        }

        .header {
            margin-bottom: 20px;
        }

        .invoice-info .info-item {
            flex: 1;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        .table th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .foot{
            float: right;
        }
        .foot-2{
            float: left;
        }
        .total {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .top-logo {
            float: right;
            width: 100px;
            height: 60px;
        }

    </style>
</head>
<body>
<div class="page-container">
    <div class="top-logo">
        <img src="{{ public_path("/assets/media/logos/wp-favicon.png") }}" alt="Logo" style="width: 100px; margin-left: -100px; ">
    </div>
    <div class="header">
        <b>Gepetrol Seguros</b>
        <h3>Facture Pro Forma #{{ $code }}</h3>
        <span>{{ $invoice->state == 'pending' ? "PENDIENTE" : "OK"}}</span>
    </div>
    <div>
        <h2>De:</h2>
        <p style="margin-bottom: 15px;"> Gepetrol Seguros <br>
            Avenida Enrique Nvo S/n, Edificio Alexandra 89 Malabo,<br>
            Teléfono Malabo: (+240) 333 099 311 <br>
            Teléfono Bata: (+240) 350 083 700 -:- 350083701
        </p>
    </div>
    <div class="row">
        <div class="column">
            <div class="line"><strong>A : </strong></div>
            <div class="line">{{ $invoice->first_name.' '.$invoice->last_name }}, {{ $invoice->email }}, {{ $invoice->phone }}</div>
        </div>
    </div>
    <div>
        <strong>Fecha : </strong> {{ $invoice->created_at }}
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Descripción</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>Precio Inicial</td>
                <td>{{ $invoice->initial_price }} XFA</td>
            </tr>
            <tr>
                <td>Precio Accesorios</td>
                <td>{{ $invoice->accessories_price }} XFA</td>
            </tr>
            <tr>
                <td>Precio Atestación</td>
                <td>{{ $invoice->attestation_price }} XFA</td>
            </tr>
            @if($invoice->accessories->isNotEmpty())
                @foreach($invoice->accessories as $accessory)
                <tr>
                    <td>{{ $accessory->title }}</td>
                    <td>{{ $accessory->value }} XFA</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="foot">
        <div class="total">
            <strong>Subtotal:</strong> <b>{{ $invoice->sub_total }} XFA</b>
        </div>
        <div class="total">
            IVA(15%) : {{ $invoice->vat }} XFA
        </div>
        <div class="total">
            <strong>Total :</strong> <b>{{ $invoice->total }} XFA</b>
        </div>
    </div>
    <div class="foot-2" style="margin-top: 100px;">
        <div class="total">
            <b>Detalles de la Cotización</b>
        </div>
        <div class="total">
            <strong>Modelo del Coche: </strong> {{ $invoice->model }}
        </div>
        <div class="total">
            <strong>Matrícula: </strong> {{ $invoice->regis_number }}
        </div>
        <div class="total">
            <strong>Puertas: </strong> {{ $invoice->place_number }}
        </div>
        <div class="total">
            <strong>Potencia Mínima: </strong> {{ $invoice->power->min_power }}
        </div>
        <div class="total">
            <strong>Potencia Máxima: </strong> {{ $invoice->power->max_power }}
        </div>
        <div class="total">
            <strong>Tipo de Remolque: </strong> {{ $invoice->trailer->title }}
        </div>
    </div>
</div>
</body>
</html>

