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
        }

        .total-price {
            text-align: right;
            margin-bottom: 10px;
            border-top: 2px solid black ;
            padding-top: 1px;
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
    </style>
</head>
<body>
    <div class="logo">
        <img src="{{ $logoBase64 }}" alt="Logo" class="logo">
    </div>
    
    <div class="order-info">
        Order ID: {{ $order['id'] }}<br>
        Date Time: {{ $date }}
    </div>

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
                    <td>{{ $item['price'] }}</td>
                    <td>{{ $item['qty'] * $item['price'] }} {{ $currency }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="total-price">
        <center>
        
        <h2>Order ID: {{ $order['id'] }}</h2>
            <h2> Total Price: {{ $order['total_price'] }} {{ $currency }}</h2>
        </center>
    </div>

    <div class="barcode-container">
        <div class="barcode">
            {!! $barcode !!}
        </div>
    </div>
</body>
</html>
