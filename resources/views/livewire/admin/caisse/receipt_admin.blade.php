<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.2;
            margin-left: -12mm;
            margin-top: -10mm;
        }

        table {
            width: 70mm;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 2px 5px;
            border-bottom: 1px solid #ddd;
        }

        .logo {
            text-align: center;
            margin-bottom: 10px;
            width: 40mm;
            margin: auto;
        }

        .store-name {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .order-info {
            margin-bottom: 10px;
            margin-left: 5px;
        }

        .total-price {
            text-align: left;
            margin-left: 5px;

            margin-bottom: 10px;
            border-top: 2px solid black ;
            padding-top: 1px;
        }
        .total{
            background-color:black ;
            color:white;
            text-align:center;
            padding:3px;
            border-radius:5px;
        }

        .barcode-container {
            text-align: center;
            margin-bottom: 10px;
        }

        .barcode {
            display: inline-block;
        }

        .thanks-msg {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
        }

        h4 {
            margin: 3px;
        }


    </style>
</head>
<body>
    <center>
        <h3 class='total'> Order ID: {{ $order['id'] }}</h3>
    </center>
    <div class="logo">
        <img src="{{ $logoBase64 }}" alt="Logo" class="logo">
    </div>
    
    <div class="order-info">
        Date Time: {{ $date }}<br>
           

    </div>
    <hr>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['qty'] }}</td>
                    <td>{{ $item['price'] }}  <span style='font-size:8px'>{{ $currency }}</span></td>
                    <td>{{ $item['qty'] * $item['price'] }} <span style='font-size:8px'>{{ $currency }}</span></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="total-price" dir="ltr">
        @if($client != null )

            <h2> Client : {{ $client['client']->firstname }} {{ $client['client']->lastname }}</h2>
            <h2>  Phone : {{ $client['client']->phone }} </h2>
            <hr>
            <h4>  Type : {{ $client['type'] }} </h4>
            @if($client['type'] == 'coming' )
                <strong><h2>  Time : {{ $client['date'] }} </h2></strong>
            @else
                <h4>  Location : {{ $client['city'] }} {{ $client['quartier'] }}  </h4>
                <h4>  Address : {{ $client['address'] }}   </h4>
            @endif
            <hr>
        @endif

     
    </div>
        <center>
            <h1 class='total'> Total : {{ $order['total_price'] }} {{ $currency }}</h1>
        </center>
    <div class="barcode-container">
        <div class="barcode">
            {!! $barcode !!}
        </div>
    </div>
</body>
</html>
