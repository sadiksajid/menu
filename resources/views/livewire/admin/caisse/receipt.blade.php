<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        /* Define your CSS styles for the receipt */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.2;
            width: 70mm;
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

        /* Add more CSS rules as needed */
    </style>
</head>
<body style="margin-left:-7mm">
    <div class="logo">
        <img src="{{$store['logo']}}" alt="Logo">
    </div>
    
    <div class="store-name">
        {{ $store['name'] }}
    </div>
    
    <div class="order-info">
        Order ID: {{ $order['id'] }}<br>
        Date/Time: {{ $date }}
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
                    <td>{{ $item['qty'] * $item['price'] }} {{$currency}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="total-price">
        Total Price: {{ $order['total_price'] }} {{$currency}}
    </div>

    <div class="barcode-container">
        <div class="barcode">
            {!! $barcode !!}
        </div>
    </div>

    <div class="thanks-msg">
        Thank you for your purchase!
    </div>
</body>
</html>