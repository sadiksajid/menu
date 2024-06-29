<?php

namespace App\Http\Livewire;


use DNS1D;
use DNS2D;
use Dompdf\Dompdf;

use App\Models\Index;
use App\Models\Store;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\StoreStafPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

class AdminSecurityCode extends Component
{
    use WithFileUploads;

    public $keys  = [];
    public $new_key  = 0 ;
    public $fullname = [];
    public $roles = ['admin','worker'];
    public $profile_role  = [];
    public $password   = [];
    public $status   = [];
    public $old_password   = [];
    public $double_auth ;

    public $pdfs   = [];


    public $store_id;
    public $store_info;

    public $data;
    public $all_rows = [];
    public $upload_image = [];

    
    public $to_delete_image_tm = 0;
    public $to_delete_image_edit = 0;
    public $Profile_image_deleted = [];
    public $langs = [];


    protected $listeners = ['editImg','ConfirmDeleteProfile'];

    ////////////////////////////////
    public $translations;

    public function mount()
    {
        $this->langs = languages()['langs'];
        $this->translations = app('translations_admin');
        ///////////////////////////////////

        $store = Auth::user()->store ;
        $this->store_id = $store->id;
        $this->store_info = $store;

        $this->double_auth = $store->double_auth ;
        $this->getData();
    
    }

    public function addHeader()
    {
        $this->new_key = $output = 'N'.preg_replace('/[^0-9]/', '', $this->new_key) + 1; 
        $this->keys[$this->new_key] = 'new' ; 
    }
    public function getData()
    {
        $this->data = StoreStafPassword::where('store_id', $this->store_id)->get();

        if(count($this->data) == 0){
            $this->keys['N1'] = 'new' ; 
            $this->new_key = 'N1' ; 

        }else{
            foreach ($this->data as $value) {
                $this->keys[$value->id] = 'old' ; 
                $this->fullname[$value->id] = $value->fullname ; 
                $this->profile_role[$value->id] = $value->role ; 
                $this->pdfs[$value->id] = get_image( $value->code_bar) ; 
                $this->status[$value->id] = $value->status ; 
            }
        }

    }


    public function render()
    {

        return view('livewire.admin.security_code.list');

    }



    public function deleteProfile($index)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Delete Profile!',
            'message' => 'Are you sure you want to delete this Profile ?',
            'function' => 'ConfirmDeleteProfile',
            'id' => $index
        ]);

    }

    public function ConfirmDeleteProfile($index)
    {

        if (!str_contains($index,'N')) {
            
            $profiles = Auth::user()->store->profiles->where('status',1)->count()  ; 
             if($profiles > 1){
                StoreStafPassword::where('id',$index)->update(['status'=>0]);
                $this->status[$index] = 0; 
             }else{
                $this->dispatchBrowserEvent('swal:modal', [
                    'type' => 'error',
                    'message' => $this->translations['disable_all_profiles_warning'],
                ]);
             }
         

        }else{
            unset($this->keys[$index]) ;
            unset($this->fullname[$index]) ;
            unset($this->profile_role[$index]) ;
        }
   

    }
    public function EnableProfile($index)
    {
 
        StoreStafPassword::where('id',$index)->update(['status'=>1]);
        $this->status[$index] = 1; 

    }


    public function generatCardPDF($index,$code)
    {    

        $barcode = DNS1D::getBarcodeHTML($code, 'EAN13', 1.5, 50, 'black', false);

        ///// l
        $imagePath = public_path('assets/images/png/print_logo.png');
        $imageData = base64_encode(file_get_contents($imagePath));
        $logoBase64 = 'data:image/png;base64,' . $imageData;

        $data = [
            'name' => $this->fullname[$index] ?? $code,
            'barcode' => $barcode,
            'role' => $this->profile_role[$index] ??  'admin',
            'store' => $this->store_info->title,
            'logoBase64' => $logoBase64,
        ];

        $pdf = new Dompdf();
        $pdf->loadHtml(View::make('livewire.admin.security_code.card', $data));
        $pdf->setPaper([0, 0, 252, 144], 'portrait'); // 252x144 points = 3.5x2 inches
        $pdf->render();

        if($index != 'test'){
            $filePath = 'documents/pass_cards/'.$this->store_info->store_meta.'/card'.(string)$code.'.pdf';

            Storage::disk('minio')->put($filePath, $pdf->output());
    
            return $filePath ;
        }else{
           
            $output = $pdf->output();
            $filePath = 'security_code_card.pdf';

            Storage::put($filePath, $output);

            return response()->download(storage_path('app/' . $filePath))->deleteFileAfterSend(true);
    

        }
     
    }


    public function calculateCheckDigit($code) {
        $sum = 0;
        for ($i = 0; $i < 12; $i++) {
            $digit = (int)$code[$i];
            $sum += ($i % 2 == 0) ? $digit : $digit * 3;
        }
        $remainder = $sum % 10;
        $checkDigit = ($remainder == 0) ? 0 : 10 - $remainder;
    
        return $checkDigit;
    }



    public function TestCOde(){
            
        do {
            $code = rand(100000000000, 999999999999);
        } while (StoreStafPassword::where('code', $code)->exists());

        $code = (string)$code;
        $card = $this->generatCardPDF('test',$code);
    }

    public function checkPassword($password,$id = null)
    {
   

        $profiles = Auth::user()->store->profiles ; 
        if($id != null){
            $profiles = $profiles->where('id','!=',$id);
        }
        foreach ($profiles as $profile) {
            if (Hash::check($password, $profile->password)) {

                return $profile->id ;

            }
        }
        return -1 ;

    }


    public function Update($index)
    {
        // dd($this->checkPassword($this->password[$index],2));

        $this->validate([
            'fullname.'.$index => 'required|string|max:50',
            'profile_role.'.$index => 'required|string|max:20',
            'password.'.$index => 'nullable|string|max:50',
        ]);


        $pass = true ; 
        if($this->keys[$index] == 'old' and isset($this->password[$index])  ) {
            if(strlen($this->password[$index]) != 0){

                $this->validate([
                    'old_password.'.$index => 'required|string|max:50',
                ]);
                if($this->checkPassword($this->password[$index],$index) != -1 ){
                    $pass = false ;
                }

            }


        }elseif($this->keys[$index] == 'new'){
            if($this->checkPassword($this->password[$index]) != -1 ){
                $pass = false ;
            }
        }

        if($pass == true){


            if (str_contains($index,'N' )) {
                $row = new StoreStafPassword();
            } else{
                $row = StoreStafPassword::find($index);
            }
            
            $pass = true ;
    
            
            if($this->keys[$index] == 'old'){

                if(isset($this->password[$index])  ) {

                    if(strlen($this->password[$index]) != 0 ){
                        if(Hash::check($this->old_password[$index] , $row->password)) {
                            $row->password = Hash::make($this->password[$index]);        
                        } else {
                            $pass = false ;
        
                        }
                    
                    }
                }
            
            }else{
                $row->password = Hash::make($this->password[$index]);
    
    
                do {
                    $code = rand(100000000000, 999999999999);
                    $code_full = (string)$code.$this->calculateCheckDigit((string)$code) ; 
                } while (StoreStafPassword::where('code', $code_full)->exists());
                
        
                $card = $this->generatCardPDF($index,$code);
                $row->code_bar = $card ;
                $row->code = $code_full;
    
                $this->pdfs[$index] = get_image( $card) ; 
    
            }
          
            if($pass == true )  {
                if (isset($row)) {
    
                    $row->fullname = $this->fullname[$index];
                    $row->role = $this->profile_role[$index];
                    $row->store_id = $this->store_id;
                    
                    $row->save();

                    unset($this->keys[$index]);
                    $this->getData();
                    $this->dispatchBrowserEvent('swal:modal', [
                        'type' => 'success',
                        'message' => $this->translations['profile_saved'],
                    ]);
        
        
                }
            }else{
                $this->dispatchBrowserEvent('swal:modal', [
                    'type' => 'error',
                    'message' => $this->translations['incorrect_old_password'],
                ]);
            }
        }else{
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'message' => $this->translations['change_password_warning'],
            ]);
        }
        
       
        
    }


    public function DoubleAuth()
    {

        $data = StoreStafPassword::where('store_id', $this->store_id)->where('status',1)->count();

        if($this->double_auth == true and $data == 0 ){
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'message' => $this->translations['cant_enable_double_auth'],
            ]);
        }else{
            if($this->double_auth == true){
                $val = 1 ; 
            }else{
                $val = 0 ; 
            }
            Store::where('id',$this->store_id )->update(['double_auth'=>$val]);
        }
      

    }




}
