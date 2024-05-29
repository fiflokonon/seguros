<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tu factura</title>
    <style>
        body {
            font-family: sans-serif;
            color: #444;
            line-height: 1.4;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .code {
            display: inline-block;
            background-color: #f1f1f1;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 20px;
            font-weight: bold;
        }
        .copy-btn {
            display: inline-block;
            background-color: #008CBA;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            margin-left: 20px;
        }
    </style>
</head>
<body>
<h1>Factura de Seguro</h1>
    <div>
        <h3 style="text-decoration: underline">Code de la factura:</h3> <span>{{$code}}</span><br>
        <p>Gracias por elegir <b>Seguros Gepetrol</b>.
        <p>Adjunto su factura</p>
    </div>
</body>
</html>



