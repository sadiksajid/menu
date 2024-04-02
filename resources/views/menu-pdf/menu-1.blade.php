<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Restaurant</title>
  <!-- Fonts -->
  {{-- <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Zilla+Slab&display=swap" rel="stylesheet" /> --}}
  <!-- CSS -->
  <style>

html {
   margin: 0px;
   padding: 0;

  }

    @page {
      size: 200mm 300mm;
      margin: 0;
      padding: 0;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      background-color: #f1f5f8;
      font-family: "Zilla Slab", serif;
    }

    h2 {
      font-family: "Great Vibes", cursive;
      font-size: 3rem;
      text-align: center;
      color: #ff6a23;
      padding-top: 10mm;
      padding-bottom: 10mm;
    }

    footer > h2 {
      font-family: "Great Vibes", cursive;
      font-size: 2rem;
      text-align: center;
      color: #964b29;
    }

    
/*inline-block*/
.inline-b {
  max-width:200mm;
  margin:0 auto;
}
.inline-b-item {
  display: inline-block;
}



    .menu {
      margin-top: 20px;
    }

    .menu-items {
      /* display: flex; */
      margin-right: 20px;
      /* padding-right: 50px; */
      width: 80mm;
    }

    .menu-items .menu-info {
      margin-left: 5mm;
      width: 100%;
    }

    .menu-title {
      /* justify-content: space-between; */
      border-bottom: 1px solid black;
    }



    h4 {
      color: #e00a00;
    }

    .menu-text {
      padding-top: 20px;
    }

    footer {
      margin-top: 50px;
      position: relative;
      bottom: 30px;
      width: 100%;
    }

   
  </style>
</head>
<body>
  <div class="title">
    <h2>My Restaurant Menu</h2>
  </div>
  <!-- menu items -->

  <ul class="container inline-b">
    @foreach ($products as $cat)
      @foreach ($cat as $prod)
        <li class="menu-items inline-b-item">
          <div  class="inline-b">
              <img  src="{{ storage_path('app/Public/product_images/moyen/'.$prod['media'][0]['media']) }}" alt="Spicy lobster" 
              style="  width: 27mm;
              height: 35mm;
              object-fit: cover;
              border: 0.25rem solid black;
              border-radius: 10px;
              box-shadow: -10px 10px 10px 0px black;
              float:left
              " >
            <div class="menu-info ">
              <div class="menu-title">
                <h4 style="margin:0px">{{$prod['title']}}</h4>
                <h4 class="price" style="margin:0px">{{ $prod['price']}} {{ $currency }}</h4>
              </div>
              <div class="menu-text">
                {{ substr($prod['description'], 0, 40) }}
              </div>
            </div>
          </div>
        </li>
      @endforeach
    @endforeach
  </ul>
</body>
</html>