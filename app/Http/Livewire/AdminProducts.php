<?php

namespace App\Http\Livewire;

use App\Models\ExtraToProduct;
use App\Models\ProductCategory;
use App\Models\ProducteExtra;
use App\Models\ProductMedia;
use App\Models\ProductRecipe;
use App\Models\ProductView;
use App\Models\StoreProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Symfony\Component\Intl\Currencies;

class AdminProducts extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $currency;
    public $store_info;

    public $title;
    public $description;
    public $price;
    public $receipts = [];
    public $extras = [];
    public $edit_receipts = [];
    public $receipt_is_new = [];
    public $receipt_deleted = [];
    public $edit_extra = [];
    public $extra_is_new = [];
    public $extra_deleted = [];
    public $product_meta;
    public $search_products = null ;

    public $categories;
    public $category_id;
    public $newCategory = false;
    public $cat_title;
    public $cat_s_title;
    public $cat_image;
    public $status = true;
    public $to_menu;

    public $product_images = [];
    public $edit_product_images = [];
    public $to_delete_image_edit = -1;
    public $to_delete_image_tm = -1;
    public $product_images_deleted = [];

    public $cat_id;
    public $store_id;
    public $url = null;
    public $product_id = null;
    public $addProduct = false;
    public $editProduct = false;
    public $product = [];
    public $catigory_sizes = ['tmb' => ['w' => 150, 'h' => 150], 'origin' => ['w' => 300, 'h' => 300]];
    public $product_sizes = ['tmb' => ['w' => 300, 'h' => 300], 'moyen' => ['w' => 600, 'h' => 600], 'origin' => ['w' => 1000, 'h' => 1000]];
    public $extras_sizes = ['tmb' => ['w' => 150, 'h' => 150], 'small' => ['w' => 300, 'h' => 300], 'moyen' => ['w' => 600, 'h' => 600], 'origin' => ['w' => 1000, 'h' => 1000]];
    protected $listeners = ['confirmed','checkUniqueTitle','render'];
////////////////////////////////
    public $translations;
    public $langs = [];

    public function mount($url = null, $id = null)
    {
        $this->langs = languages()['langs'];
        $this->translations = app('translations_admin');
///////////////////////////////////
        // $this->TranslateAll();
        $this->store_info = Auth::user()->store;
        $this->store_id = $this->store_info->id;
        $this->url = $url;
        $this->product_id = $id;
        $this->receipts[] = '';
        $this->receipt_is_new[] = 0;
        $this->extra_is_new[] = 0;
        $this->extras[] = '';

        if (isset($this->store_info->currency)) {
            $this->currency = Currencies::getSymbol($this->store_info->currency);
        } else {
            $this->currency = 'DH';
        }
        switch ($url) {
            case 'addProduct':
                $this->getCategories();
                break;
            case 'editProduct':
                $this->getCategories();
                $this->editProduct();
                break;
        }

        $products = StoreProduct::whereNull('product_meta')->get();
        foreach ($products as $product) {
            $product->product_meta = $this->sanitizeString( $product->title);
            $product->save();
        }

    }
    public function render()
    {

        switch ($this->url) {
            case 'addProduct':
                $this->addProduct = true;
                return view('livewire.admin.products.addProduct');
                break;
            case 'editProduct':
                if (!empty($this->product)) {
                    return view('livewire.admin.products.addProduct');
                    break;
                }

            default:
                $products = StoreProduct::where('store_id', $this->store_id)
                    ->when($this->search_products,function($q){
                        $q->where('title','LIKE','%'.$this->search_products.'%');
                    })
                    ->orderBy('id', 'DESC')
                    ->paginate(20);
                // foreach ($products as $value) {
                //     add_to_tmb_if_not($value->media, 'product_images', $this->product_sizes);
                // }

                return view('livewire.admin.products.table', ['products' => $products]);
                break;
        }

    }

    public function clearSearch()
    {
        $this->search_products = null;

    }
    public function getCategories()
    {
        $currentLocale = app()->getLocale();

        $this->categories = ProductCategory::where('store_id', $this->store_id)->select('id','title->' . $currentLocale.' as title')->get()->toArray();

    }

    public function TranslateAll()
    {
        $products = DB::table('store_products')->get();
        foreach ($products as $product) {
            $pro = StoreProduct::find($product->id);
            foreach ($this->langs as $lang) {
                if ($lang == 'en') {
                    $title = $product->title;
                    $description = $product->description;
                } else {
                    $title = translate($product->title, $lang);
                    $description = translate($product->description, $lang);
                }

                $pro->setTranslation('title', $lang, $title, JSON_UNESCAPED_UNICODE);
                $pro->setTranslation('description', $lang, $description, JSON_UNESCAPED_UNICODE);

            }

            $pro->save();
        }
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->description = '';
        $this->link = '';
        $this->btn_text = '';
        $this->status = 1;
        $this->store_images = [];
        $this->images = [];
        $this->store_image_edit = [];
        $this->v_store = [];

        $this->set1 = true;
        $this->set2 = false;
        $this->newCategory = false;
        unset($this->image);
        unset($this->image_edit);
        unset($this->pdf);

    }

    public function addReceipt()
    {
        $this->receipts[] = '';
        $this->receipt_is_new[] = 0;
    }
    public function removeReceipt($key)
    {
        unset($this->receipts[$key]);
        if ($this->receipt_is_new[$key] != 0) {
            $this->receipt_deleted[] = $this->receipt_is_new[$key];
        }

        unset($this->receipt_is_new[$key]);
    }

    public function newCategory()
    {
        $this->newCategory = true;
    }
    public function cancelCategory()
    {
        $this->newCategory = false;
    }
    

    public function submitCategory()
    {

        $this->validate([
            'cat_title' => 'required|string|max:50',
            'cat_s_title' => 'required|string|max:100',
            'cat_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $cat = new ProductCategory();

        foreach ($this->langs as $lang) {
            if ($lang == 'en') {
                $title = $this->cat_title;
                $cat_s_title = $this->cat_s_title;
            } else {
                $title = translate($this->cat_title, $lang);
                $cat_s_title = translate($this->cat_s_title, $lang);
            }

            $cat->setTranslation('title', $lang, $title, JSON_UNESCAPED_UNICODE);
            $cat->setTranslation('s_title', $lang, $cat_s_title, JSON_UNESCAPED_UNICODE);

        }

        $cat->store_id = $this->store_id;
        $cat->category_meta = str_replace([' ', ',', ':', '-', '?'], '_', strtolower($this->cat_title));

        if (!empty($this->cat_image)) {
            $this->img_link = 'Category_' . str_replace(' ', '_', $this->cat_title) . md5(microtime()) . '.webp';
            $image = File::get($this->cat_image->getRealPath());
            $save_result = save_livewire_filetocdn($image, 'categories', $this->img_link, $this->catigory_sizes);

            $this->img_link = 'categories/' . $this->img_link;

            if ($save_result) {
                $cat->image = $this->img_link;
            }

        }
        $cat->save();

        $this->getCategories();
        $this->newCategory = false;

    }

    public function addExtra()
    {
        $this->extras[] = '';
        $this->extra_is_new[] = 0;
    }

    public function removeExtra($key)
    {
        unset($this->extras[$key]);

        if ($this->extra_is_new[$key] != 0) {
            $this->extra_deleted[] = $this->extra_is_new[$key];
        }

        unset($this->extra_is_new[$key]);
    }

    public function to_delete_image_tm($index)
    {
        $this->to_delete_image_tm = $index;
    }

    public function no_delete_image_tm()
    {
        $this->to_delete_image_tm = -1;
    }

    public function delete_image_tm()
    {
        unset($this->product_images[$this->to_delete_image_tm]);
        $this->to_delete_image_tm = -1;
    }

    public function to_delete_image_edit($index)
    {
        $this->to_delete_image_edit = $index;
    }

    public function no_delete_image_edit()
    {
        $this->to_delete_image_edit = -1;
    }

    public function delete_image_edit()
    {
        if ($this->to_delete_image_edit != -1) {
            $this->product_images_deleted[] = $this->edit_product_images[$this->to_delete_image_edit];
            unset($this->edit_product_images[$this->to_delete_image_edit]);
            $this->to_delete_image_edit = -1;
        }

    }

////////////////////////////////////////////////////////////////////////////////////


function checkUniqueTitle() {
    if(!empty($this->title)){
        $this->product_meta =   $this->sanitizeString($this->title);

        $this->validate([
            'product_meta' => 'required|string|max:250|unique:store_products,product_meta',
        ]);
    }

}




function sanitizeString($string) {
    // Replace spaces with underscores
    $string = str_replace(' ', '_', $string);
    
    // Remove any character that is not a letter, number, hyphen, or underscore
    $sanitizedString = preg_replace('/[^a-zA-Z0-9_-]/', '', $string);
    
    return $sanitizedString;
}
    public function submitProduct()
    {

        if($this->newCategory == false ){
            $this->product_meta =   $this->sanitizeString($this->title);
            
            $this->validate([
                'title' => 'required|string|max:250',
                'product_meta' => 'required|string|max:250|unique:store_products,product_meta',
                'description' => 'required|string|max:3500',
                'status' => 'required|boolean',
                'price' => 'required|integer',
                'category_id' => 'required|integer',
                'receipts.*' => 'nullable|string|max:1500',
                'product_images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);
    
            if (count($this->extras) != 0 and (!empty($this->extras['0']['title']) or !empty($this->extras['0']['price']) or !empty($this->extras['0']['image']))) {
                $this->validate([
                    'extras.*.title' => 'required|string|max:50',
                    'extras.*.price' => 'required|integer',
                    'extras.*.image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
                ]);
            }
            $product = new StoreProduct();
    
            foreach ($this->langs as $lang) {
                if ($lang == 'en') {
                    $title = $this->title;
                    $description = $this->description;
                } else {
                    $title = translate($this->title, $lang);
                    $description = translate($this->description, $lang);
                }
    
                $product->setTranslation('title', $lang, $title, JSON_UNESCAPED_UNICODE);
                $product->setTranslation('description', $lang, $description, JSON_UNESCAPED_UNICODE);
    
            }
    
            $product->status = $this->status;
            $product->to_menu = $this->to_menu;
            $product->price = $this->price;
            $product->store_id = $this->store_id;
            $product->product_category_id = $this->category_id;
            $product->save();

            $images = array();
            foreach ($this->product_images as $img) {
    
                $link = 'product_image_' . str_replace(' ', '_', $this->title) . md5(microtime()) . '.webp';
                $image = File::get($img->getRealPath());
                $save_result = save_livewire_filetocdn($image, 'product_images', $link, $this->product_sizes);
    
                $link = 'product_images/' . $link;
    
                if ($save_result) {
                    $images[] = $link;
                }
    
            }
    
            $images_set = [];
            foreach ($images as $image) {
                $images_set[] = [
                    'media' => $image,
                    "store_product_id" => $product->id,
                    "created_at" => now(),
                    "updated_at" => now(),
                ];
            }
    
            ProductMedia::insert($images_set);
    
            $receipts_set = [];
            if (count($this->receipts) != 0) {
                foreach ($this->receipts as $receipt) {
                    $receipts_set[] = [
                        'element' => $receipt,
                        "store_product_id" => $product->id,
                        "created_at" => now(),
                        "updated_at" => now(),
                    ];
                }
    
                ProductRecipe::insert($receipts_set);
            }
            if (count($this->extras) != 0 and (!empty($this->extras['0']['title']) or !empty($this->extras['0']['price']) or !empty($this->extras['0']['image']))) {
                $extras_set = [];
                $extra_ids = [];
                foreach ($this->extras as $extra) {
                    if (!empty($extra)) {
                        if (!empty($extra['image'])) {
    
                            $link = 'extra_image_' . str_replace(' ', '_', $extra['title']) . md5(microtime()) . '.webp';
                            $image = File::get($extra['image']->getRealPath());
                            $save_result = save_livewire_filetocdn($image, 'extra_images', $link, $this->extras_sizes);
    
                            $link = 'extra_images/' . $link;
    
                        } else {
                            $link = '';
                        }
    
                        $extras_set = [
                            'image' => $link,
                            'title' => $extra['title'],
                            'price' => $extra['price'],
                            "store_id" => $this->store_id,
                            "created_at" => now(),
                            "updated_at" => now(),
                        ];
    
                        $extra_ids[] = [
                            'product_extra_id' => ProducteExtra::insertGetId($extras_set),
                            'store_product_id' => $product->id,
                            "created_at" => now(),
                            "updated_at" => now(),
                        ];
                    }
    
                }
    
                ExtraToProduct::insert($extra_ids);
            }
    
            $this->dispatchBrowserEvent('swal:modal_back', [
                'type' => 'success',
                'title' => $this->translations['product_submitted_success'],
                // 'message' => 'Do you want to back to products page ?',
                'url' => '/admin/products',
    
            ]);
        }else{
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'warning',
                'message' => 'Save Category First!',
                'text' => 'You can\'t save the product if you didn\'t save the category',
    
            ]);
        }

    }

//////////////////////////////////////////////////////////////////////////////////

    public function editProduct($id = null)
    {

        $product_id = $this->product_id ?? $id;
        $this->product = StoreProduct::find($product_id);

        if (!empty($this->product)) {
            $this->editProduct = true;

            $this->title = $this->product->title;
            $this->description = $this->product->description;
            $this->status = $this->product->status;
            $this->price = $this->product->price;
            $this->category_id = $this->product->product_category_id;
            $this->edit_product_images = $this->product->media;
            $this->edit_receipts = $this->product->recipes;
            $this->receipts = $this->edit_receipts->pluck('element');
            $this->receipt_is_new = $this->edit_receipts->pluck('id');
            $this->edit_extra = $this->product->extras;
            $this->extra_is_new = $this->edit_extra->pluck('product_extra_id');
            $this->to_menu = $this->product->to_menu;

            if (count($this->extra_is_new) == 0) {
                $this->extra_is_new[] = 0;
            }

            $x = 0;
            foreach ($this->edit_extra as $extra) {
                $this->extras[$x] = [
                    'title' => $extra->extra->title,
                    'price' => $extra->extra->price,
                    'image' => $extra->extra->image,
                ];
                $x++;
            }
        }

    }
////////////////////////////////////////////////////////////////////////////////////
    public function updateProduct()
    {
        if($this->newCategory == false){

            $this->validate([
                'title' => 'required|string|max:100',
                'description' => 'required|string|max:15000',
                'status' => 'required|boolean',
                'price' => 'required|integer',
                'category_id' => 'required|integer',
    
                'receipts.*' => 'nullable|string|max:1500',
                // 'extras.title.*' => 'nullable|string|max:50',
                // 'extras.price.*' => 'nullable|integer',
                'product_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);
    
            if (count($this->extras) != 0 and (!empty($this->extras['0']['title']) or !empty($this->extras['0']['price']) or !empty($this->extras['0']['image']))) {
    
                foreach ($this->extras as $key => $extra) {
                    if ($this->extra_is_new[$key] != 0) {
                        try {
                            $this->validate([
                                'extras.' . $key . '.image' => 'required|string|max:250',
                            ]);
                        } catch (\Throwable $th) {
                            $this->validate([
                                'extras.' . $key . '.image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                            ]);
                        }
                    } else {
                        $this->validate([
                            'extras.' . $key . '.image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                        ]);
                    }
    
                }
    
                $this->validate([
                    'extras.*.title' => 'required|string|max:50',
                    'extras.*.price' => 'required|integer',
                ]);
    
            }
    
            $product = StoreProduct::find($this->product_id);
            if($product->title != $this->title){
                $this->product_meta =   $this->sanitizeString($this->title);
                $this->validate([
                    'product_meta' => 'required|string|max:250|unique:store_products,product_meta',
                ]);
            }elseif(empty($product->product_meta)){
                $product->product_meta =$this->sanitizeString($this->title);
            }
            $product->title = $this->title;
            $product->description = $this->description;
            $product->status = $this->status;
            $product->to_menu = $this->to_menu;
            $product->price = $this->price;
            $product->product_category_id = $this->category_id;
            $product->save();
    
            $x = 0;
            $images = array();
            foreach ($this->product_images as $img) {
    
                $this->validate([
                    'product_images.' . $x => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                ]);
    
                $link = 'product_image_' . str_replace(' ', '_', $this->title) . md5(microtime()) . '.webp';
                $image = File::get($img->getRealPath());
                $save_result = save_livewire_filetocdn($image, 'product_images', $link, $this->product_sizes);
                $link = 'product_images/' . $link;
    
                if ($save_result) {
                    $images[] = $link;
                }
    
            }
    
            $images_set = [];
            foreach ($images as $image) {
                $images_set[] = [
                    'media' => $image,
                    "store_product_id" => $product->id,
                    "created_at" => now(),
                    "updated_at" => now(),
                ];
            }
            if (!empty($this->product_images_deleted)) {
                foreach ($this->product_images_deleted as $image) {
                    foreach ($this->product_sizes as $key => $size) {
    
                        delete_file($key . '/' . $image['media']);
    
                        $old_image = ProductMedia::find($image['id']);
                        if (!empty($old_image)) {
                            $old_image->delete();
                        }
                    }
    
                }
            }
    
            if (!empty($images_set)) {
                ProductMedia::insert($images_set);
            }
    
            $receipts_set = [];
    
            if (count($this->receipts) != 0) {
                $x = 0;
                foreach ($this->receipt_is_new as $key => $id) {
                    if ($id == 0) {
                        $receipts_set[] = [
                            'element' => $this->receipts[$key],
                            "store_product_id" => $product->id,
                            "created_at" => now(),
                            "updated_at" => now(),
                        ];
                    } else {
                        ProductRecipe::find($id)->update(['element' => $this->receipts[$key], "updated_at" => now()]);
                    }
    
                    $x++;
                }
                if (!empty($receipts_set)) {
                    ProductRecipe::insert($receipts_set);
                }
            }
    
            if (!empty($this->receipt_deleted)) {
                ProductRecipe::whereIn('id', $this->receipt_deleted)->delete();
            }
    
            if (count($this->extras) != 0 and (!empty($this->extras['0']['title']) or !empty($this->extras['0']['price']) or !empty($this->extras['0']['image']))) {
                $extras_set = [];
                $extra_ids = [];
                $x = 0;
    
                foreach ($this->extras as $key => $extra) {
                    if (!empty($extra)) {
                        $link = '';
                        if ($this->extra_is_new[$key] == 0) {
    
                            if (!empty($extra['image'])) {
    
                                $link = 'extra_image_' . str_replace(' ', '_', $extra['title']) . md5(microtime()) . '.webp';
                                $image = File::get($extra['image']->getRealPath());
                                $save_result = save_livewire_filetocdn($image, 'extra_images', $link, $this->extras_sizes);
                                $link = 'extra_images/' . $link;
    
                            }
    
                            $extras_set = [
                                'image' => $link,
                                'title' => $extra['title'],
                                'price' => $extra['price'],
                                "store_id" => $this->store_id,
                                "created_at" => now(),
                                "updated_at" => now(),
                            ];
                            $extra_ids[] = [
                                'product_extra_id' => ProducteExtra::insertGetId($extras_set),
                                'store_product_id' => $product->id,
                                "created_at" => now(),
                                "updated_at" => now(),
                            ];
                        } else {
    
                            if (!empty($extra['image']) and is_string($extra['image']) != true) {
    
                                $link = 'extra_image_' . str_replace(' ', '_', $extra['title']) . md5(microtime()) . '.webp';
                                $image = File::get($extra['image']->getRealPath());
                                $save_result = save_livewire_filetocdn($image, 'extra_images', $link, $this->extras_sizes);
                                $link = 'extra_images/' . $link;
    
                                $delete_img = $this->edit_extra->where('product_extra_id', $this->extra_is_new[$key])->first();
                                foreach ($this->extras_sizes as $key_extra => $size) {
                                    delete_file($key_extra . '/' . $delete_img->image);
    
                                }
                            } else {
                                $link = $extra['image'];
                            }
    
                            $extras_update = [
                                'image' => $link,
                                'title' => $extra['title'],
                                'price' => $extra['price'],
    
                            ];
                            // dd($this->extra_is_new[$key],$extras_update);
                            $extra_p = ProducteExtra::find($this->extra_is_new[$key]);
                            $extra_p->image = $link;
                            $extra_p->title = $extra['title'];
                            $extra_p->price = $extra['price'];
                            $extra_p->save();
    
                        }
                    }
                }
    
                if (!empty($extra_ids)) {
    
                    ExtraToProduct::insert($extra_ids);
                }
    
                if (!empty($this->extra_deleted)) {
                    foreach ($this->extra_deleted as $id) {
                        $delete_extra[] = $this->edit_extra->where('product_extra_id', $id)->first()->id;
                    }
    
                    ExtraToProduct::whereIn('id', $delete_extra)->delete();
                }
            }
    
            $this->dispatchBrowserEvent('swal:confirm_redirect', [
                'type' => 'success',
                'title' => $this->translations['product_updated_success'],
                'message' => $this->translations['do_you_want_to_back_product'],
                'url' => '/admin/products',
    
            ]);
    

    

        }else{
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'warning',
                'message' => 'Save Category First!',
                'text' => 'You can\'t save the product if you didn\'t save the category',
    
            ]);
        }

        
    }

    public function DeleteProduct()
    {

        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => $this->translations['please_confirm'],
            'message' => $this->translations['product_delete_msg_1'],
        ]);

    }
    public function confirmed()
    {
        $product = StoreProduct::where('id', $this->product_id)->withCount('order_products')->first();
        if (!empty($product)) {
            if ($product->order_products_count > 0) {
                $product->delete();
                ProductMedia::where('store_product_id', $this->product_id)->delete();
                ProductRecipe::where('store_product_id', $this->product_id)->delete();
                ExtraToProduct::where('store_product_id', $this->product_id)->delete();
                ProductView::where('store_product_id', $this->product_id)->delete();
            } else {
                $product->forceDelete();
                $product_images = ProductMedia::where('store_product_id', $this->product_id)->get();
                foreach ($product_images as $image) {
                    foreach ($this->product_sizes as $key => $size) {
                        delete_file($key . '/' . $image->media);

                    }
                }
                ProductMedia::where('store_product_id', $this->product_id)->forceDelete();
                ProductRecipe::where('store_product_id', $this->product_id)->forceDelete();
                ExtraToProduct::where('store_product_id', $this->product_id)->forceDelete();
                ProductView::where('store_product_id', $this->product_id)->forceDelete();

            }
            $this->dispatchBrowserEvent('swal:modal_back', [
                'type' => 'success',
                'title' => $this->translations['product_delete_success'],
                'url' => '/admin/products',

            ]);
        } else {
            $this->NotFound();
        }

    }
    public function NotFound()
    {
        $this->dispatchBrowserEvent('swal:modal_back', [
            'type' => 'success',
            'title' => $this->translations['product_not_found'],
            'url' => '/admin/products',

        ]);
    }
    public function cancel()
    {
        return Redirect::to('/admin/products');
    }
}
