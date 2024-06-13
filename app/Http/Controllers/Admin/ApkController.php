<?php

namespace App\Http\Controllers\Admin;

use App\Models\Apk;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ApkController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Apk-list', ['only' => ['Apk','ShowUpdateApk']]);
        $this->middleware('permission:Apk-edit', ['only' => ['UpdateApk']]);
        $this->middleware('permission:Apk-create', ['only' => ['ShowAddApk','ApkAdd']]);
    }
   

    public function Apk()
    {
        $apks=Apk::join('Apk_description', "Apk.apk_id", "=", "Apk_description.apk_id")->where("Apk_description.language_id", "=", 1)->get();
        
        
        return view('admin.mains-admin.Apk.Apk-list', ['apks'=>$apks]);
    }
    
    public function ShowAddApk()
    {
        $apks = DB::select("SELECT cp.apk_id AS apk_id,
        GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '   >  ') AS
        name, c1.parent_id, c1.sort_order FROM Apk_path cp
        LEFT JOIN Apk c1 ON (cp.apk_id = c1.apk_id) LEFT JOIN Apk c2 ON 
        (cp.path_id = c2.apk_id) LEFT JOIN Apk_description cd1 ON (cp.path_id = cd1.apk_id)
        LEFT JOIN Apk_description cd2 ON (cp.apk_id = cd2.apk_id) WHERE cd1.language_id = '1'
        AND cd2.language_id = '1' GROUP BY cp.apk_id,c1.parent_id,c1.sort_order ORDER BY name ASC;");

        return view('admin.mains-admin.Apk.Apk-add', ['apks' => $apks]);
    }
    

    public function ApkAdd(Request $request)
    {
        if ($request->has('image')) {
            $imageName = '/catalog/Apk/' . $request->file('image')->getClientOriginalName();
            Storage::disk('ftp')->put($imageName, fopen($request->file('image'), 'r+'));
        }

        $Apk = Apk::create([
            'image' => $imageName ?? "",
            'parent_id' => $request->Apk,
            'status' =>  $request->status,
        ]);

        $Apk->names()->createMany([
            ['language_id' => '1','name'=> $request->name_eng,'meta_title'=>$request->name_eng],
            ['language_id' => '2','name'=> $request->name_ar,'meta_title'=>$request->name_ar],
            ['language_id' => '4','name'=> $request->name_fr,'meta_title'=>$request->name_fr]
        ]);

        DB::table('Apk_to_store')->insert([
            ['apk_id' => $Apk->apk_id, 'store_id' => 0]
        ]);

        return Redirect::to("admin/Apk")->with('success', 'The record has been added successfully');
    }

    public function ApkShow($id)
    {
        $Apk= Apk::join('Apk_description', "Apk.apk_id", "=", "Apk_description.apk_id")->where("Apk.apk_id", "=", $id)->get();
       
        $apks = DB::select("SELECT cp.apk_id AS apk_id,
        GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '   >  ') AS
        name, c1.parent_id, c1.sort_order FROM Apk_path cp
        LEFT JOIN Apk c1 ON (cp.apk_id = c1.apk_id) LEFT JOIN Apk c2 ON 
        (cp.path_id = c2.apk_id) LEFT JOIN Apk_description cd1 ON (cp.path_id = cd1.apk_id)
        LEFT JOIN Apk_description cd2 ON (cp.apk_id = cd2.apk_id) WHERE cd1.language_id = '1'
        AND cd2.language_id = '1' GROUP BY cp.apk_id,c1.parent_id,c1.sort_order ORDER BY name ASC;");

        return view('admin.mains-admin.Apk.Apk-show', ['Apk'=>$Apk,'apks'=>$apks]);
    }

    public function ApkUpdate(Request $request, $id)
    {
        $Apk=Apk::find($id);

        $updateDetails = [
            'parent_id' => $request->Apk,
            'status' => $request->status,
        ];

        if ($request->has('image')) {
            $imageName = '/catalog/Apk/' . $request->file('image')->getClientOriginalName();
            Storage::disk('ftp')->put($imageName, fopen($request->file('image'), 'r+'));
            Arr::add($updateDetails, 'image', $imageName);
        }

        $Apk->update($updateDetails);

        ApkDescription::where('apk_id', '=', $id)->delete();

        $Apk->names()->createMany([
            ['language_id' => '1','name'=> $request->name_eng,'meta_title'=>$request->name_eng],
            ['language_id' => '2','name'=> $request->name_ar,'meta_title'=>$request->name_ar],
            ['language_id' => '4','name'=> $request->name_fr,'meta_title'=>$request->name_fr]
        ]);

        return Redirect::to("admin/Apk")->with('success', 'The record has been added successfully');
    }
}
