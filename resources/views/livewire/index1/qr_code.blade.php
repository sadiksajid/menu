
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.2;
            margin-top: -10mm;
        }

        table {
            width: 100%;
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
        <h3> Name : {{ $data['name'] }}</h3>
        <h3> Phone: {{ $data['phone'] }}</h3>
        <h3>Date: {{ $date }}</h3>
    </div>

    <div class="barcode-container">
        <div class="barcode">
            {!! $qrcode !!}
        </div>
    </div>

    <div class="thanks-msg">
        <h2>Welcome to the competition!</h2>
    </div>
</body>
</html>
