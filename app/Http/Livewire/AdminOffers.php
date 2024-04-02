<?php

namespace App\Http\Livewire;

use App\Models\Offer;
use App\Models\OfferProduct;
use App\Models\StoreProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Symfony\Component\Intl\Currencies;

class AdminOffers extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $title;
    public $meta;
    public $description;
    public $price;
    public $search;
    public $status;
    public $products;
    public $selected_products = [];
    public $selected_products_qty = [];
    public $selected_products_info = [];
    public $qty = [];
    public $currency;
    public $store_info;

    public $offer_image;
    public $edit_offer_image;
    public $offer_image_squad;
    public $edit_offer_image_squad;
    public $to_delete_image_edit = -1;
    public $to_delete_image_tm = -1;
    public $offer_image_deleted;
    public $offer_image_squad_deleted;

    public $store_id;
    public $url = null;
    public $offer_id = null;
    public $addOffer = false;
    public $editOffer = false;
    public $offer = [];
    // public $offer_sizes = ['tmb' => ['w' => 300, 'h' => 300], 'moyen' => ['w' => 600, 'h' => 600], 'origin' => ['w' => 1000, 'h' => 1000]];
    protected $listeners = ['confirmed'];

    public function mount($url = null, $id = null)
    {
        $this->store_info = Auth::user()->store;
        $this->store_id = $this->store_info->id;
        $this->url = $url;
        $this->offer_id = $id;

        switch ($url) {
            case 'addOffer':
                break;
            case 'editOffer':
                $this->editOffer();
                break;
        }
        $this->products = StoreProduct::where('store_id', $this->store_id)
            ->where('status', '1')
            ->orderBy('id', 'DESC')
            ->limit(20)->get();

        if (isset($this->store_info->currency)) {
            $this->currency = Currencies::getSymbol($this->store_info->currency);
        } else {
            $this->currency = 'DH';
        }

    }
    public function render()
    {

        switch ($this->url) {
            case 'addOffer':
                $this->addOffer = true;
                return view('livewire.admin.offers.add_offer');
                break;
            case 'editOffer':
                if (!empty($this->offer)) {
                    return view('livewire.admin.offers.add_offer');
                    break;
                }

            default:
                $offers = Offer::where('store_id', $this->store_id)
                    ->orderBy('id', 'DESC')
                    ->paginate(20);

                return view('livewire.admin.offers.offers_list', ['offers' => $offers]);
                break;
        }

    }

    public function Search()
    {
        $this->products = StoreProduct::where('store_id', $this->store_id)
            ->where('title', 'LIKE', '%' . $this->search . '%')
            ->orWhere('id', $this->search)
            ->where('status', '1')
            ->orderBy('id', 'DESC')
            ->limit(20)->get();

    }

    public function selectProduct($id)
    {
        $this->selected_products[$id] = $id;
        $this->selected_products_qty[$id] = 1;
        $this->qty[$id] = 1;
        $this->selected_products_info[$id] = $this->products->where('id', $id)->first();
        $this->selected_products_info[$id]['total'] = $this->selected_products_info[$id]['price'];

    }
    public function removeProduct($id)
    {
        unset($this->selected_products[$id]);
        unset($this->selected_products_qty[$id]);
        unset($this->selected_products_info[$id]);
    }
    public function quantityProduct($id)
    {
        $this->selected_products_qty[$id] = $this->qty[$id];
        $this->selected_products_info[$id]['total'] = $this->selected_products_info[$id]['price'] * $this->qty[$id];

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

    public function to_delete_image_tm($index)
    {
        $this->to_delete_image_tm = $index;
    }

    public function no_delete_image_tm()
    {
        $this->to_delete_image_tm = -1;
    }

    public function delete_image_tm($img)
    {
        if ($img == 1) {
            $this->offer_image = '';
        } else {
            $this->offer_image_squad = '';
        }
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

    public function delete_image_edit($img)
    {
        if ($this->to_delete_image_edit != -1) {

            if ($img == 1) {
                $this->offer_image_deleted = $this->edit_offer_image;
                $this->edit_offer_image = '';
            } else {
                $this->offer_image_squad_deleted = $this->edit_offer_image_squad;
                $this->edit_offer_image_squad = '';
            }

            $this->to_delete_image_edit = -1;
        }

    }

////////////////////////////////////////////////////////////////////////////////////

    public function submitOffer()
    {
        $this->validate([
            'title' => 'required|string|max:100',
            'meta' => 'required|string|max:150|unique:offers,offer_meta',
            'description' => 'required|string|max:15000',
            'status' => 'required|boolean',
            'price' => 'required|integer',
            'offer_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'offer_image_squad' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $link = 'offer_image_' . str_replace(' ', '_', $this->title) . md5(microtime()) . '.webp';
        $image = File::get($this->offer_image->getRealPath());
        $save_result = save_livewire_filetocdn($image, 'offer_images', $link);

        $link2 = 'offer_image_squad_' . str_replace(' ', '_', $this->title) . md5(microtime()) . '.webp';
        $image = File::get($this->offer_image_squad->getRealPath());
        $save_result2 = save_livewire_filetocdn($image, 'offer_images', $link2);

        if ($save_result and $save_result2) {
            $offer = new Offer();
            $offer->title = $this->title;
            $offer->offer_meta = $this->meta;
            $offer->description = $this->description;
            $offer->status = $this->status;
            $offer->price = $this->price;
            $offer->old_price = array_sum(array_column($this->selected_products_info, 'total'));
            $offer->store_id = $this->store_id;
            $offer->image = $link;
            $offer->image_squad = $link2;
            $offer->save();

        }

        $offer_prod = [];
        if (count($this->selected_products_info) != 0) {
            foreach ($this->selected_products_info as $product) {
                $offer_prod[] = [
                    'store_product_id' => $product['id'],
                    "offer_id" => $offer->id,
                    "qty" => $this->qty[$product['id']],
                    "created_at" => now(),
                    "updated_at" => now(),
                ];
            }

            OfferProduct::insert($offer_prod);
        }

        $this->dispatchBrowserEvent('swal:modal_back', [
            'type' => 'success',
            'title' => 'Offer Submitted Successfully!',
            'url' => '/admin/offers',

        ]);

    }

//////////////////////////////////////////////////////////////////////////////////

    public function editOffer($id = null)
    {

        $offer_id = $this->offer_id ?? $id;

        $this->offer = Offer::where('id', $offer_id)
            ->with(['products' => function ($q) {
                $q->with(['product' => function ($q) {
                    $q->with('media');

                }]);
            }])->first();

        if (!empty($this->offer)) {
            $this->editOffer = true;

            $this->title = $this->offer->title;
            $this->description = $this->offer->description;
            $this->meta = $this->offer->offer_meta;
            $this->status = $this->offer->status;
            $this->price = $this->offer->price;
            $this->edit_offer_image = $this->offer->image;
            $this->edit_offer_image_squad = $this->offer->image_squad;
            // dd($this->offer->products);
            foreach ($this->offer->products as $product) {
                $this->selected_products[$product->store_product_id] = $product->store_product_id;
                $this->selected_products_qty[$product->store_product_id] = $product->qty;
                $this->qty[$product->store_product_id] = $product->qty;
                $this->selected_products_info[$product->store_product_id] = $product->product->toArray();
                $this->selected_products_info[$product->store_product_id]['total'] = $product->qty * $product->product->price;

            }

        }

    }
////////////////////////////////////////////////////////////////////////////////////
    public function updateOffer()
    {
        $this->validate([
            'title' => 'required|string|max:100',
            'meta' => 'required|string|max:150',
            'description' => 'required|string|max:15000',
            'status' => 'required|boolean',
            'price' => 'required|integer',
            'offer_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'offer_image_squad' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $offer = Offer::find($this->offer_id);

        if ($this->meta != $offer->offer_meta) {
            $this->validate([
                'meta' => 'required|string|max:150|unique:offers,offer_meta',
            ]);
        }
        $check = true;
        if (!empty($this->offer_image)) {

            File::delete(storage_path('app') . '/public/offer_images/' . $this->offer_image_deleted);

            $link = 'offer_image_' . str_replace(' ', '_', $this->title) . md5(microtime()) . '.webp';
            $image = File::get($this->offer_image->getRealPath());
            $save_result = save_livewire_filetocdn($image, 'offer_images', $link);
            if (!$save_result) {
                $check = false;
            }
            $offer->image = $link;

        }
        if (!empty($this->offer_image_squad)) {
            File::delete(storage_path('app') . '/public/offer_images/' . $this->offer_image_squad_deleted);

            $link2 = 'offer_image_squad_' . str_replace(' ', '_', $this->title) . md5(microtime()) . '.webp';
            $image = File::get($this->offer_image_squad->getRealPath());
            $save_result = save_livewire_filetocdn($image, 'offer_images', $link2);
            if (!$save_result) {
                $check = false;
            }
            $offer->image_squad = $link2;

        }

        if ($check) {
            $offer->title = $this->title;
            $offer->offer_meta = $this->meta;
            $offer->description = $this->description;
            $offer->status = $this->status;
            $offer->price = $this->price;
            $offer->old_price = array_sum(array_column($this->selected_products_info, 'total'));
            $offer->store_id = $this->store_id;
            $offer->save();

            $offer_prod = [];
            if (count($this->selected_products_info) != 0) {
                foreach ($this->selected_products_info as $product) {
                    $offer_prod[] = [
                        'store_product_id' => $product['id'],
                        "offer_id" => $offer->id,
                        "qty" => $this->qty[$product['id']],
                        "created_at" => now(),
                        "updated_at" => now(),
                    ];
                }

                OfferProduct::where('offer_id', $offer->id)->delete();
                OfferProduct::insert($offer_prod);
            }

            $this->dispatchBrowserEvent('swal:confirm_redirect', [
                'type' => 'success',
                'title' => 'Offer Updated Successfully!',
                'message' => 'Do you want to back to offers page ?',
                'url' => '/admin/offers',

            ]);
        } else {
            $this->dispatchBrowserEvent('swal:alert', [
                'type' => 'warning',
                'title' => 'Cant Upload Image!',
                'message' => 'Please check the image you upload ore change it ?',

            ]);
        }

    }

    public function DeleteOffer()
    {

        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Please Confirm !',
            'message' => 'Do you Want Delete This Offer ?',
        ]);

    }
    // public function confirmed()
    // {
    //     $offer = Offer::where('id', $this->offer_id)->withCount('order_offers')->first();
    //     if (!empty($offer)) {
    //         if ($offer->order_offers_count > 0) {
    //             $offer->delete();
    //             OfferMedia::where('store_offer_id', $this->offer_id)->delete();
    //             OfferRecipe::where('store_offer_id', $this->offer_id)->delete();
    //             ExtraToOffer::where('store_offer_id', $this->offer_id)->delete();
    //             OfferView::where('store_offer_id', $this->offer_id)->delete();
    //         } else {
    //             $offer->forceDelete();
    //             $offer_image = OfferMedia::where('store_offer_id', $this->offer_id)->get();
    //             foreach ($offer_image as $image) {
    //                 foreach ($this->offer_sizes as $key => $size) {
    //                     File::delete(storage_path('app') . '/public/offer_image/' . $key . '/' . $image->media);

    //                 }
    //             }
    //             OfferMedia::where('store_offer_id', $this->offer_id)->forceDelete();
    //             OfferRecipe::where('store_offer_id', $this->offer_id)->forceDelete();
    //             ExtraToOffer::where('store_offer_id', $this->offer_id)->forceDelete();
    //             OfferView::where('store_offer_id', $this->offer_id)->forceDelete();

    //         }
    //         $this->dispatchBrowserEvent('swal:modal_back', [
    //             'type' => 'success',
    //             'title' => 'Offer Deleted Successfully!',
    //             // 'message' => 'Do you want to back to offers page ?',
    //             'url' => '/admin/offers',

    //         ]);
    //     } else {
    //         $this->NotFound();
    //     }

    // }
    public function NotFound()
    {
        $this->dispatchBrowserEvent('swal:modal_back', [
            'type' => 'success',
            'title' => 'Offer Not Found',
            // 'message' => 'Do you want to back to offers page ?',
            'url' => '/admin/offers',

        ]);
    }
    public function cancel()
    {
        return Redirect::to('/admin/offers');
    }
}
