<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use App\Models\StoreProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;
use Symfony\Component\Intl\Currencies;

class EditMenu extends Component
{
    use WithFileUploads;

    public $titles = [];
    public $buttons = [];
    public $images = [];
    public $texts = [];
    public $urls = [];

    public $store_id;
    public $store_info;

    public $data;
    public $upload_image;
    public $products;
    public $currency;

    protected $listeners = ['editText', 'editBtn', 'editImg'];

    public function mount()
    {
        $this->store_id = Auth::user()->store_id;
        $this->store_info = Auth::user()->store;
        $this->data = Menu::where('store_id', $this->store_id)->where('name', 'menu1')->first();
        if (empty($this->data)) {
            $this->data = new Menu();
            $this->data->name = 'menu1';
            $this->data->store_id = $this->store_id;
            $this->data->language = 'EN';
            $this->data->save();
        } else {
            $this->titles = $this->data->titles;
            $this->titles = json_decode($this->titles, true);

            $this->buttons = $this->data->buttons;
            $this->buttons = json_decode($this->buttons, true);

            $this->images = $this->data->images;
            $this->images = json_decode($this->images, true);

            $this->texts = $this->data->texts;
            $this->texts = json_decode($this->texts, true);

            $this->urls = $this->data->urls;
            $this->urls = json_decode($this->urls, true);

        }

        $products = StoreProduct::select('store_products.*')
            ->where('store_id', $this->store_id)
            ->where('to_menu', 1)
            ->with('media')
            ->with('category')
            ->get();

        $this->products = $products->groupBy('product_category_id')->toArray();

        if (isset($this->store_info->currency)) {
            $this->currency = Currencies::getSymbol($this->store_info->currency);
        } else {
            $this->currency = 'DH';
        }

    }

    public function render()
    {
        $this->dispatchBrowserEvent('refreshJs');

        return view('livewire.admin.menu1.menu');

    }

    public function editText($type, $id, $text)
    {
        if ($type == 'title') {
            $this->titles[$id] = $text;
            $this->data->titles = json_encode($this->titles);
        } else if ($type == 'url') {
            $this->urls[$id] = $text;
            $this->data->urls = json_encode($this->urls);
        } else {
            $this->texts[$id] = $text;
            $this->data->texts = json_encode($this->texts);
        }

        $this->data->save();
    }

    public function editBtn($id, $data)
    {
        $this->buttons[$id] = array(
            'title' => $data[0],
            'url' => $data[1],
        );

        $this->data->buttons = json_encode($this->buttons);
        $this->data->save();
    }

    public function editImg($id)
    {
        if (!empty($this->upload_image)) {
            $img_link = 'menu1_' . md5(microtime()) . '.webp';
            $image = File::get($this->upload_image->getRealPath());
            $save_result = save_livewire_filetocdn($image, 'menu1', $img_link);
            if ($save_result) {
                $this->images[$id] = $img_link;
                $this->data->images = json_encode($this->images);
                $this->data->save();
                $this->dispatchBrowserEvent('closeModal');
            } else {
                $this->dispatchBrowserEvent('swal:modal', [
                    'type' => 'warning',
                    'message' => 'Problem in Image',
                ]);
            }

        }

    }

}
