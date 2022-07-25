<!DOCTYPE html>
<html>
<head>
    <title>REPORTE DE PAGO DE RESIDENTES</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h1>REPORTE DE PAGO DE RESIDENTES DEL {{$start_date}} al {{$finish_date}}</h1>
    <p>{{ $date }}</p>
  
    <table class="table table-bordered">
        <tr>
            <th>Num.placa</th>
            <th>Tiempo estacionado (min.)</th>
            <th>Cantidad a pagar</th>
        </tr>
        @foreach($data as $reg)
        <tr>
            <td>{{ $reg->plate_vehicle }}</td>
            <td>{{ $reg->duration }}</td>
            <td>{{ $reg->total_pay }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>