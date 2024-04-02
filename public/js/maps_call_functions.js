


window.addEventListener('maps:lib', event => {
    var fix_lo = event.detail.fix_lo;
    var fix_la = event.detail.fix_la;
    var change_lo = event.detail.change_lo;
    var change_la = event.detail.change_la;
    var fix_name = event.detail.fix_name;
    var change_name = event.detail.change_name;
    var change_type = event.detail.change_type;
    var fix_type = event.detail.fix_type;
    var is_express = event.detail.is_express;
    var max_km = event.detail.max_km;
    var map_height = event.detail.map_height;
    var pick = event.detail.pick;
    var click = event.detail.click;

    var data = {
        fix_lo: fix_lo ?? null,
        fix_la: fix_la ?? null,
        change_lo: change_lo ?? null,
        change_la: change_la ?? null,
        fix_name: fix_name ?? null,
        change_name: change_name ?? null,
        fix_type: fix_type ?? null,
        change_type: change_type ?? null,
        is_express: is_express ?? null,
        max_km: max_km ?? 25000,
        map_height: map_height ?? 400,
        pick: pick ?? false,
        click: click ?? true,
    }

    maps_change_loacal_calcul_price(data)

});