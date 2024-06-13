<x-home>
    <home_dev :Wallpappers="{{ json_encode($wallpappers)}}" :cats="{{ json_encode($cats)}}" :sumWallpappers="{{ json_encode($sum_Wallpappers)}}"
        :sumapk_users="{{ json_encode($sum_apk_users)}}" :sumposts="{{ json_encode($sum_posts)}}"
        :sumcourses="{{ json_encode($sum_courses)}}" :sumstore="{{ json_encode($sum_store)}}"
        :socials="{{ json_encode($socials)}}" :about="{{json_encode(cache('appino')['about'])}}"
        :facts="{{json_encode(cache('appino')['facts'])}}" :products="{{json_encode(cache('appino')['products'])}}"
        :email="{{json_encode(cache('appino')['email'])}}" :phone="{{json_encode(cache('appino')['phone'])}}">
    </home_dev>
</x-home>