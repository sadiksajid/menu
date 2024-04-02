
    @if ($Apk->children()->count() > 0 )
        @php $margin+=7; @endphp
        @foreach($Apk->children()
        ->join('Apk_description', "Apk.apk_id", "=", "Apk_description.apk_id")
        ->where("Apk_description.language_id", "=", 1)
        ->get() as $Apk)
                <ol class="breadcrumb breadcrumb-arrow mt-3 ml-{{$margin}}"  style="color:white;margin-left:{{$margin}}rem !important;">
                    <li><a href='{{route('Apk-show',[$Apk->apk_id])}}'>{{ $Apk->name  ?? ''}}</a></li>
                </ol> 
                @include('admin.mains-admin.Apk.Apk', $Apk)
            @endforeach      
    @endif
 