<!DOCTYPE html>
<html>

<head>
    <style>
    @page {
        margin: 0px;
    }

    html {
        background-color: red
    }

    body {
        background-image: url('{{$bgBase64}}');
        background-size: cover;
        /* Adjust the size as needed */
        background-repeat: no-repeat;
        /* Prevents the image from repeating */
        background-position: center;
        /* Centers the image */
        /* font-family: Arial, sans-serif; */
        margin: 0;
        padding: 0;
        left: 0px;
        top: 0px;
        position: relative;
    }


    </style>


</head>

<body>
    <div class='qr_code_div'>
        {!! $QRcode !!}
    </div>

    @isset($template['title_config'])
    <div style="position:fixed;
        font-size:{{$template['title_config']['font-size']}}pt ;
        top:{{$template['title_config']['top']}}pt;
        @isset($template['title_config']['position']) left: 50%; transform: translateX(-50%); @else left:{{$template['title_config']['left']}}pt @endisset;
        @isset($template['title_config']['font_name']) font-family: {{$template['title_config']['font_name']}};  @endisset;



        color:{{$template['title_config']['color']}};">
        <p style='padding:0px;margin:0px'>{{$info['title']}}</p>
    </div>
    @endisset
    @isset($template['phone1_config'])
    <div style="position:fixed;
        font-size:{{$template['phone1_config']['font-size']}}pt;
        top:{{$template['phone1_config']['top']}}pt;
        @isset($template['phone1_config']['position'])   left: 50%; transform: translateX(-50%);  @else left:{{$template['phone1_config']['left']}}pt @endisset;

        @isset($template['phone1_config']['font_url']) font-family: '{{$template['phone1_config']['font_name']}}', sans-serif;  @endisset;

        color:{{$template['phone1_config']['color']}}">
        <p style='padding:0px;margin:0px'>{{$info['phone1']}}</p>
    </div>
    @endisset
    @isset($template['phone2_config'])
    <div style="position:fixed;
        font-size:{{$template['phone2_config']['font-size']}}pt;
        top:{{$template['phone2_config']['top']}}pt;
        @isset($template['phone2_config']['position']) left: 50%; transform: translateX(-50%); @else left:{{$template['phone2_config']['left']}}pt @endisset;
        @isset($template['phone2_config']['font_url']) font-family: '{{$template['phone2_config']['font_name']}}', sans-serif;  @endisset;
        color:{{$template['phone2_config']['color']}}">
        <p style='padding:0px;margin:0px'>{{$info['phone2']}}</p>

    </div>
    @endisset
    @isset($template['email_config'])
    <div style="position:fixed;
        font-size:{{$template['email_config']['font-size']}}pt;
        top:{{$template['email_config']['top']}}pt;
        @isset($template['email_config']['position']) left: 50%; transform: translateX(-50%); @else left:{{$template['email_config']['left']}}pt @endisset;
        @isset($template['email_config']['font_url']) font-family: '{{$template['email_config']['font_name']}}', sans-serif;  @endisset;
        color:{{$template['email_config']['color']}}">
        <p style='padding:0px;margin:0px'>{{$info['email']}}</p>

    </div>
    @endisset
</body>

</html>