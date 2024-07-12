<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            width: 3.5in;
            height: 2in;
            left:0px;
            top:0px;
            margin-left: -12mm;
            margin-top: -10mm;
        }
        .card {
            width: 100%;
            display: flex;
        }
        .card-content {
            width: 100%;
        }
        .name {
            font-size: 15px;
        }
        .company {
            font-size: 16px;
        }
        .contact {
            font-size: 14px;
        }

        .logo {
            float:right;
            margin-right:20px;
            margin-bottom: 10px;
            width: 50%;
        }
        .barcode-container {
            text-align: center;
            
        }

        .barcode {
            display: inline-block;
        }

    </style>
</head>
<body>
    <div class="card">
        <div class="card-content">

        <div style='position:relative;width:3.5in;height:0.7in;margin-top:20px'>
            <div style='float:left;margin-left:20px'>
                <div class="name">Full Name : {{ $name }}</div>
                <div class="name">Role : {{ $role }}</div>
            </div>
           
            <div class="logo">
                <img src="{{ $logoBase64 }}" alt="Logo" class="logo">
            </div>
        </div>
            
            

            <div class="barcode-container">
                <div class="barcode">
                    {!! $barcode !!}
                </div>
            </div>

        </div>
    </div>
</body>
</html>
