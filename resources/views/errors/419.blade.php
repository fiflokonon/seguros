<!-- resources/views/errors/419.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Página caducada</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1>419</h1>
            <h2>Page Expired</h2>
            <p>Lo sentimos, tu sesión ha caducado. Por favor, actualice y pruebe de nuevo.</p>
            <a href="{{ url()->previous() }}" class="btn btn-primary">Regresa</a>
        </div>
    </div>
</div>
</body>
</html>
