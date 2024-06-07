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
    public $langs = [];

    protected $listeners = ['editText', 'editBtn', 'editImg'];
    ////////////////////////////
    public $translations;
    public function mount()
    {
        $this->langs = languages()['langs'];
        $this->translations = app('translations_admin');

        $this->store_id = Auth::user()->store_id;
        $this->store_info = Auth::user()->store;
        $this->data = Menu::where('store_id', $this->store_id)->where('name', 'menu1')->first();
        if (empty($this->data)) {
            $this->data = new Menu();
            $this->data->name = 'menu1';
            $this->data->store_id = $this->store_id;
            $this->data->save();
        } else {

            foreach ($this->langs as $lang) {

                $titles = $this->data->getTranslation('titles', $lang);
                $this->titles[$lang] = json_decode($titles, true);
                $buttons = $this->data->getTranslation('buttons', $lang);
                $this->buttons[$lang] = json_decode($buttons, true);

                $texts = $this->data->getTranslation('texts', $lang);
                $this->texts[$lang] = json_decode($texts, true);

            }

            $this->images = $this->data->images;
            $this->images = json_decode($this->images, true);

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
            foreach ($this->langs as $lang) {
                if ($lang == 'en') {
                    $this->titles['en'][$id] = $text;
                } else {
                    $this->titles[$lang][$id] = translate($text, $lang);
                }

                $this->data->setTranslation('titles', $lang, json_encode($this->titles[$lang], JSON_UNESCAPED_UNICODE));

            }
        } else if ($type == 'url') {
            $this->urls[$id] = $text;
            $this->data->urls = json_encode($this->urls);
        } else {
            foreach ($this->langs as $lang) {
                if ($lang == 'en') {
                    $this->texts['en'][$id] = $text;
                } else {
                    $this->texts[$lang][$id] = translate($text, $lang);
                }

                $this->data->setTranslation('texts', $lang, json_encode($this->texts[$lang], JSON_UNESCAPED_UNICODE));

            }
        }

        $this->data->save();
    }

    public function editBtn($id, $data)
    {
        foreach ($this->langs as $lang) {
            if ($lang == 'en') {
                $this->buttons['en'][$id] = array(
                    'title' => $data[0],
                    'url' => $data[1],
                );
            } else {
                $this->buttons[$lang][$id] = array(
                    'title' => translate($data[0], $lang),
                    'url' => $data[1],
                );

            }

            $this->data->setTranslation('buttons', $lang, json_encode($this->buttons[$lang], JSON_UNESCAPED_UNICODE));

        }
        $this->data->save();
    }

    public function editImg($id)
    {
        if (!empty($this->upload_image)) {
            $img_link = 'menu1_' . md5(microtime()) . '.webp';
            $image = File::get($this->upload_image->getRealPath());
            $save_result = save_livewire_filetocdn($image, 'menu1', $img_link);
            $img_link = 'menu1/' . $img_link;

            if ($save_result) {
                $this->images[$id] = $img_link;
                $this->data->images = json_encode($this->images);
                $this->data->save();
                $this->dispatchBrowserEvent('closeModal');
            } else {
                $this->dispatchBrowserEvent('swal:modal', [
                    'type' => 'warning',
                    'message' => $this->translations['image_problem'],
                ]);
            }

        }

    }

}
