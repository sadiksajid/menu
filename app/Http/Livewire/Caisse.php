<?php

namespace App\Http\Livewire;

use App\Models\CategoryToStore;
use App\Models\OrderProducte;
use App\Models\StoreOrder;
use App\Models\StoreProduct;
// use charlieuki\ReceiptPrinter\ReceiptPrinter as ReceiptPrinter;
use DNS1D;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\Intl\Currencies;

class Caisse extends Component
{
    use WithPagination;
    public $currency;
    public $store_info;

    public $categories;
    public $products;
    public $category_id;
    public $total = 0;

    public $selected_cat = 0;
    public $selected_products = [];
    public $selected_products_ids = [];
    public $selected_products_qty = [];

    protected $listeners = ['RemoveProd', 'confirmed'];
////////////////////////////////
    public $translations;
    public $langs = [];

    public function mount()
    {
        $this->langs = languages()['langs'];
        $this->translations = app('translations_admin');
///////////////////////////////////
        $this->store_info = Auth::user()->store;
        $this->store_id = $this->store_info->id;

        if (isset($this->store_info->currency)) {
            $this->currency = Currencies::getSymbol($this->store_info->currency);
        } else {
            $this->currency = 'DH';
        }
        $this->getCategories();
        $this->getProducts();
    }
    public function render()
    {

        return view('livewire.admin.caisse.caisse');

    }
    public function getCategories()
    {
        $currentLocale = app()->getLocale();

        if (Cache::has('caisse_categories')) {
            $this->categories = Cache::get('caisse_categories');
        } else {
            $this->categories = CategoryToStore::Join('product_categories as cat', 'category_to_stores.product_category_id', 'cat.id')
                ->where('category_to_stores.store_id', $this->store_id)
                ->select('cat.id', 'cat.image', 'cat.title->' . $currentLocale . ' as title')->get()->toArray();
            Cache::put('caisse_categories', $this->categories, 86400);
        }

    }
    public function getProducts($id = 0)
    {

        if (Cache::has('caisse_products')) {
            $this->products = Cache::get('caisse_products');

            if ($this->selected_cat != 0) {
                $this->products = $this->products->where('product_category_id', $this->selected_cat);
            }
        } else {

            $this->products = StoreProduct::where('store_id', $this->store_id)
                ->where('to_menu', 1)
                ->orderBy('id', 'DESC')
                ->get();
            Cache::put('caisse_products', $this->products, 86400);
            if ($this->selected_cat != 0) {
                $this->getProducts($this->selected_cat);
            }
        }
    }

    public function SelectCat($id)
    {
        $this->selected_cat = $id;
        $this->getProducts($this->selected_cat);
    }

    public function SelectProd($id)
    {
        $product = $this->products->where('id', $id)->first();
        if (!in_array($id, $this->selected_products_ids)) {
            $this->selected_products[$id] = array(
                'image' => $product?->media[0]->media ?? 'pngs/food-icon.jpg',
                'price' => $product->price,
                'type' => 'product',
                'title' => $product->title,
                'id' => $product->id,
            );

            $this->selected_products_ids[$id] = $id;
            $this->selected_products_qty[$id] = 1;

            $this->dispatchBrowserEvent('swip');

        } else {
            $this->selected_products_qty[$id] += 1;

        }

        $this->calculTotal();
    }

    public function RemoveProd($id)
    {
        unset($this->selected_products[$id]);
        unset($this->selected_products_ids[$id]);
        unset($this->selected_products_qty[$id]);

        $this->calculTotal();
    }
    public function ResetAll()
    {
        $this->selected_products = [];
        $this->selected_products_ids = [];
        $this->selected_products_qty = [];

        $this->dispatchBrowserEvent('swip');
        $this->calculTotal();
    }

    public function calculTotal()
    {
        $total = 0;
        foreach ($this->selected_products as $prod) {
            $total = $total + ($prod['price'] * $this->selected_products_qty[$prod['id']]);
        }
        $this->total = $total;
    }

    public function changeQte($id, $type)
    {
        if ($type == 'plus') {
            $this->selected_products_qty[$id] += 1;
        } else {
            $this->selected_products_qty[$id] -= 1;

        }
        $this->calculTotal();
    }

    public function generateReceiptPDF()
    {
        // $pdf->stream('receipt_n_' . $order_id . '_' . $date . '.pdf');
        $order_id = 123;
        $date = now()->format('d-m-Y H:i');
        $products = $this->getReceiptItems();
        $barcode = DNS1D::getBarcodeHTML($order_id, 'C39+');

        // Ensure $date is UTF-8 encoded
        $date = utf8_encode($date);

        $data = [
            'items' => $products,
            'barcode' => $barcode,
            'date' => $date,
            'order' => ['id' => $order_id, 'total_price' => array_sum(array_column($products, 'total'))],
            'store' => ['name' => $this->store_info->title, 'logo' => $this->store_info->logo],
            'currency' => $this->currency,
        ];

        $pdf = new Dompdf();
        $pdf->loadHtml(View::make('livewire.admin.caisse.receipt', $data));
        $pdf->setPaper([0, 0, 226.77, 283.46], 'portrait'); // Set the paper size to match the width of an 80mm POS printer
        $pdf->render();

        $this->dispatchBrowserEvent('pdfRendered', [
            'pdfData' => base64_encode($pdf->output()),
        ]);

    }

    private function getReceiptItems()
    {
        $items = [];

        foreach ($this->selected_products as $key => $product) {
            $items[] = [
                'name' => $product['title'],
                'qty' => $this->selected_products_qty[$product['id']],
                'price' => $product['price'],
                'total' => $product['price'] * $this->selected_products_qty[$product['id']],
            ];
        }

        return $items;
    }

    public function ValidCheckout()
    {
        if (count($this->selected_products) > 0) {
            $this->dispatchBrowserEvent('swal:confirm', [
                'type' => 'warning',
                'title' => $this->translations['please_confirm'],
                'message' => $this->translations['caisse_order_submit'],
            ]);
        }

    }

    public function confirmed()
    {

        $this->generateReceiptPDF();

        if (count($this->selected_products) > 0) {

            $order = new StoreOrder();
            $order->store_id = $this->store_id;
            // $order->comment = $this->comment;
            $order->from_web = 0;
            $order->total = $this->total;
            $order->currency = $this->currency;
            $order->order_type = 'caisse';
            $order->payment_type = 'CASH';
            $order->status = 'caisse_delivered';
            $order->admin_id = Auth::id();
            $order->save();

            $products = [];
            $x = 0;
            $y = 0;
            $order_offers = array();
            foreach ($this->selected_products as $key => $product) {
                if ($product['type'] == 'offer') {
                    $order_offers[$x]['id'] = $product['product']->id;
                    $order_offers[$x]['price'] = $product['product']->price * $product['qte'];
                    $order_offers[$x]['old_price'] = $product['product']->old_price * $product['qte'];
                    $order_offers[$x]['qte'] = $product['qte'];
                    $x++;

                    ////////////////////////////////////
                    foreach ($product['product']->products as $offer_prod) {
                        $products[$y] = array(
                            'store_product_id' => $offer_prod->store_product_id,
                            'store_order_id' => $order->id,
                            'qte' => $offer_prod->qty * $product['qte'],
                            'price' => $offer_prod->product->price * $product['qte'],
                            'total' => $offer_prod->product->price * $offer_prod->qty * $product['qte'],
                            'offer_id' => $product['product']->id,
                            'is_offer' => 1,
                            "created_at" => now(),
                            "updated_at" => now(),
                        );
                        $y++;
                    }
                } else {
                    $products[$y] = array(
                        'store_product_id' => $product['id'],
                        'store_order_id' => $order->id,
                        'qte' => $this->selected_products_qty[$product['id']],
                        'price' => $product['price'],
                        'total' => $product['price'] * $this->selected_products_qty[$product['id']],
                        'offer_id' => null,
                        'is_offer' => 0,
                        "created_at" => now(),
                        "updated_at" => now(),
                    );
                }

                $y++;
            };
            if (count($order_offers) > 0) {
                $order->offers = json_encode($order_offers);
                $order->save();
            }
            OrderProducte::insert($products);

        }

        $this->ResetAll();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => $this->translations['caisse_order_success'],
        ]);
        $this->generateReceiptPDF();

    }

}
