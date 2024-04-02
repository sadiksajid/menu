<?php

use App\Models\OffersAnalyse;
use App\Models\OffersView;
use App\Models\ProductCategory;
use App\Models\ProductMedia;
use App\Models\ProductView;
use App\Models\StoreView;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

if (!function_exists('money')) {
    function money($value, $short_format = false, $currency = null)
    {
        $setting = \Illuminate\Support\Facades\Cache::remember('settings', 3600, function () {
            return \App\Settings::first();
        });
        if ($currency instanceof \App\Currencies) {
            $code = $currency['code'] ?? $setting->currency->code;
            $symbol = $currency['symbol'] ?? $setting->currency->symbol;
        } else if (isset($currency)) {
            $currency = \App\Currencies::where('code', $currency)->first();
            $code = $currency->code;
            $symbol = $currency->symbol;
        } else {
            $code = $setting->currency->code;
            $symbol = $setting->currency->symbol;
        }
        $formatter = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
        $formatter->setSymbol(NumberFormatter::CURRENCY_SYMBOL, $symbol);
        $formatter->setPattern("#,##0.00 ¤;-#,##0.00 ¤");
        $money = $formatter->formatCurrency(number_format(floatval($value), 2, '.', ''), $code);
        if ($short_format) {
            $value = number_format_short($value);
            return preg_replace('/[0-9\.,]+/', $value, $money);
        }
        return $money;
    }
}

if (!function_exists('money_convert')) {
    function money_convert($amount, $from, $to = null, $exchange_fee = true, $api = false)
    {
        $setting = \Illuminate\Support\Facades\Cache::remember('settings', 3600, function () {
            return \App\Settings::first();
        });
        if ($from == 'default') {
            $from = $setting->currency->code;
        } else {
            $from_currency = \App\Currencies::where('code', $from)->first();
            if ($exchange_fee == true) {
                $exchange_rate = $from_currency->rate + ($from_currency->rate * $from_currency->exchange_fee / 100);
            } else if ($api == true) {
                $exchange_rate = $from_currency->api_rate;
            } else {
                $exchange_rate = $from_currency->rate;
            }

            if ($exchange_rate == 0) {
                $exchange_rate = 1;
            }

            $amount = ($amount / $exchange_rate);
        }

        if (isset($to)) {
            $to_currency = \App\Currencies::where('code', $to)->first();
            if ($exchange_fee == true) {
                $exchange_rate = $to_currency->rate + ($to_currency->rate * $to_currency->exchange_fee / 100);
            } else if ($api == true) {
                $exchange_rate = $to_currency->api_rate;
            } else {
                $exchange_rate = $to_currency->rate;
            }

            return ($exchange_rate * $amount);
        }

        return $amount;
    }
}

if (!function_exists('number_format_short')) {
    function number_format_short($n, $precision = 2)
    {
        if ($n < 0) {
            $n *= -1;
        }

        if ($n < 900) {
            // 0 - 900
            $n_format = number_format($n, $precision);
            $suffix = '';
        } else if ($n < 900000) {
            // 0.9k-850k
            $n_format = number_format($n / 1000, $precision);
            $suffix = 'K';
        } else if ($n < 900000000) {
            // 0.9m-850m
            $n_format = number_format($n / 1000000, $precision);
            $suffix = 'M';
        } else if ($n < 900000000000) {
            // 0.9b-850b
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = 'B';
        } else {
            // 0.9t+
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = 'T';
        }
        // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
        // Intentionally does not affect partials, eg "1.50" -> "1.50"
        if ($precision > 0) {
            $dotzero = '.' . str_repeat('0', $precision);
            $n_format = str_replace($dotzero, '', $n_format);
        }
        return $n_format . $suffix;
    }
}

if (!function_exists('timeDiff')) {
    function timeDiff($firstTime, $lastTime): string
    {
        $firstTime = strtotime($firstTime);
        $lastTime = strtotime($lastTime);

        $difference = $lastTime - $firstTime;

        $data['years'] = abs(floor($difference / 31536000));
        $data['months'] = abs(floor(($difference - $data['years'] * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24)));
        $data['days'] = abs(floor(($difference - ($data['years'] * 31536000)) / 86400));
        $data['hours'] = abs(floor(($difference - ($data['years'] * 31536000) - ($data['days'] * 86400)) / 3600));
        $data['minutes'] = abs(floor(($difference - ($data['years'] * 31536000) - ($data['days'] * 86400) - ($data['hours'] * 3600)) / 60));

        $timeString = '';

        if ($data['years'] > 0) {
            if ($data['years'] > 1) {
                return $timeString .= $data['years'] . " Years";
            } else {
                return $timeString .= "Year";
            }

        }
        if ($data['months'] > 0) {
            if ($data['months'] > 1) {
                return $timeString .= $data['months'] . " Months";
            } else {
                return $timeString .= "Month";
            }

        }

        if ($data['days'] > 0) {
            if ($data['days'] > 1) {
                return $timeString .= $data['days'] . " Days";
            } else {
                return $timeString .= "Day";
            }

        }

        if ($data['hours'] > 0) {
            if ($data['hours'] > 1) {
                return $timeString .= $data['hours'] . " Hours";
            } else {
                return $timeString .= "Hour";
            }

        }

        if ($data['minutes'] > 0) {
            if ($data['minutes'] > 1) {
                return $timeString .= $data['minutes'] . " Minutes";
            } else {
                return $timeString .= "Minute";
            }

        }

        if ($data['months'] > 0) {
            if ($data['months'] > 1) {
                return $timeString .= $data['months'] . " Months";
            } else {
                return $timeString .= "Month";
            }

        }

        if ($data['days'] > 0) {
            if ($data['days'] > 1) {
                return $timeString .= $data['days'] . " Days";
            } else {
                return $timeString .= "Day";
            }

        }

        if ($data['hours'] > 0) {
            if ($data['hours'] > 1) {
                return $timeString .= $data['hours'] . " Hours";
            } else {
                return $timeString .= "Hour";
            }

        }

        if ($data['minutes'] > 0) {
            if ($data['minutes'] > 1) {
                return $timeString .= $data['minutes'] . " Minutes";
            } else {
                return $timeString .= "Minute";
            }

        }

        return $timeString;
    }
}

if (!function_exists('convert_days')) {
    function convert_days($days)
    {
        $start_date = new \Carbon\Carbon();
        $end_date = (new $start_date)->addDays($days + 1);
        return timeDiff($start_date, $end_date);
    }
}

if (!function_exists('custom_asset')) {
    function custom_asset($path, $url = null)
    {
        if (isset($url)) {
            return env('ASSET_URL', $url) . '/' . ltrim($path, '/');
        }
        // check if cdn;
        else {
            return env('ASSET_URL', 'https://codpartner.fra1.digitaloceanspaces.com') . '/' . ltrim($path, '/');
        }

        if (str_contains($path, 'users')) {
            return env('ASSET_URL', 'https://codpartner.fra1.digitaloceanspaces.com') . '/' . ltrim($path, '/');
        }
        // check if cdn;

        if (str_contains($path, 'product')) {
            return env('ASSET_URL', 'https://codpartner.fra1.digitaloceanspaces.com') . '/' . ltrim($path, '/');
        }
        // check if cdn;

        if (str_contains($path, 'payments')) {
            return env('ASSET_URL', 'https://codpartner.fra1.digitaloceanspaces.com') . '/' . ltrim($path, '/');
        }

        if (str_contains($path, 'sourcing')) {
            return env('ASSET_URL', 'https://codpartner.fra1.digitaloceanspaces.com') . '/' . ltrim($path, '/');
        }

        if (str_contains($path, 'img')) {
            return env('ASSET_URL', 'https://codpartner.fra1.digitaloceanspaces.com') . '/' . ltrim($path, '/');
        }

        return 'https://codpartner.fra1.digitaloceanspaces.com/' . $path;
        //return env('ASSET_URL', 'https://app.codpartner.com').'/'. ltrim($path, '/'); // check if cdn;
    }
}

if (!function_exists('save_livewire_filetocdn')) {
    function save_livewire_filetocdn($file, $subfolder, $name, $sizes = null)
    {
        try {
            $manager = new ImageManager(new Driver());

            if ($sizes != null) {
                foreach ($sizes as $key => $size) {
                    $img = $manager->read($file);
                    $width = $size['w']; // your max width
                    $height = $size['h']; // your max height
                    if ($img->height() < $height and $img->width() < $width) {
                        $width = $img->width();
                        $height = $img->height();
                    }

                    $webpContent = $img->scale($width, $height)->toWebp(100);

                    $path = $subfolder . '/' . $key . '/' . $name;
                    Storage::disk('public')->put($path, $webpContent);

                }
            } else {
                $img = $manager->read($file);
                $width = $img->width();
                $height = $img->height();
                $webpContent = $img->scale($width, $height)->toWebp(100);
                $path = $subfolder . '/' . $name;
                Storage::disk('public')->put($path, $webpContent);

                $webpContent = $img->scale($width, $height)->toWebp(100);
                $path = $subfolder . '/' . $name;
                Storage::disk('public')->put($path, $webpContent);

                if ($height >= 1000) {
                    $webpContent = $img->scale($width / 2, $height / 2)->toWebp(100);

                } else {
                    $webpContent = $img->scale($width, $height)->toWebp(60);
                }
                $path = $subfolder . '/tmb/' . $name;
                Storage::disk('public')->put($path, $webpContent);
            }

            return true;
        } catch (\Throwable $th) {
            dd($th);
            return false;
        }

    }
}

if (!function_exists('add_to_tmb_if_not_products')) {
    function add_to_tmb_if_not_products($urls, $subfolder, $sizes)
    {
        foreach ($urls as $media) {

            $url = $media->media;
            $manager = new ImageManager(new Driver());

            if (Storage::disk('public')->exists($subfolder . '/' . $url)) {
                foreach ($sizes as $key => $size) {
                    $url = $media->media;

                    $img = $manager->read(Storage::disk('public')->get($subfolder . '/' . $url));

                    $width = $size['w']; // your max width
                    $height = $size['h']; // your max height
                    if ($img->height() < $height and $img->width() < $width) {
                        $width = $img->width();
                        $height = $img->height();
                    }

                    $webpContent = $img->scale($width, $height)->toWebp(100);

                    $info = pathinfo($url);
                    $url = str_replace($info['extension'], 'webp', $url);

                    $path = $subfolder . '/' . $key . '/' . $url;

                    Storage::disk('public')->put($path, $webpContent);

                }
                $update = ProductMedia::find($media->id);
                $update->media = $url;
                $update->save();

            } else {
                echo ($subfolder . '/' . $url);
            }

        }

    }
}

if (!function_exists('add_to_tmb_if_not_category')) {
    function add_to_tmb_if_not_category($urls, $subfolder, $sizes)
    {

        $url = $urls->image;
        $manager = new ImageManager(new Driver());

        if (Storage::disk('public')->exists($subfolder . '/' . $url) and $url != null) {
            foreach ($sizes as $key => $size) {
                $url = $urls->image;
                $img = $manager->read(Storage::disk('public')->get($subfolder . '/' . $url));

                $width = $size['w']; // your max width
                $height = $size['h']; // your max height
                if ($img->height() < $height and $img->width() < $width) {
                    $width = $img->width();
                    $height = $img->height();
                }

                $webpContent = $img->scale($width, $height)->toWebp(100);

                $info = pathinfo($url);
                $url = str_replace($info['extension'], 'webp', $url);

                $path = $subfolder . '/' . $key . '/' . $url;

                Storage::disk('public')->put($path, $webpContent);

            }
            $update = ProductCategory::find($urls->id);
            $update->image = $url;
            $update->save();

        } else {
            echo ($subfolder . '/' . $url);
        }

    }
}

if (!function_exists('testMobile')) {
    function testMobile()
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        // Common mobile user agents
        $mobileKeywords = ['Android', 'iPhone', 'iPad', 'Windows Phone', 'BlackBerry', 'Opera Mini', 'Mobile'];

        foreach ($mobileKeywords as $keyword) {
            if (strpos($userAgent, $keyword) !== false) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('getStoreName')) {
    function getStoreName()
    {
        $currentPath = url()->current();

        $pathArray = explode('/', $currentPath);

        // Filter out empty elements
        $pathArray = array_filter($pathArray);
        if (in_array('store', $pathArray)) {
            $meta_index = array_search('store', $pathArray) + 1;
            $store_meta = $pathArray[$meta_index];
            return $store_meta;
        } else {
            return null;
        }

    }
}

if (!function_exists('setView')) {
    /////// view calculation to db
    function setView($type, $store_id, $p_id = null)
    {
        if ($type == 'store') {
            $view = new StoreView();
            $view->store_id = $store_id;
            if (Auth::guard('client')->check()) {
                $view->client_id = Auth::guard('client')->id();
            }
            $view->save();

        } elseif ($type == 'offer') {
            $view = new OffersView();
            $view->store_id = $store_id;
            $view->offer_id = $p_id;
            if (Auth::guard('client')->check()) {
                $view->client_id = Auth::guard('client')->id();
            }
            $view->save();

            $offer_analyse = OffersAnalyse::where('store_id', $store_id)
                ->where('offer_id', $p_id)
                ->whereDate('created_at', '=', Carbon::today()->toDateString())
                ->first();
            if (!empty($offer_analyse)) {
                $offer_analyse->views = $offer_analyse->views + 1;
                $offer_analyse->save();
            } else {
                $offer_analyse = new OffersAnalyse();
                $offer_analyse->views = 1;
                $offer_analyse->store_id = $store_id;
                $offer_analyse->offer_id = $p_id;
                $offer_analyse->save();
            }
        } else {
            $view = new ProductView();
            $view->store_id = $store_id;
            $view->store_product_id = $p_id;
            if (Auth::guard('client')->check()) {
                $view->client_id = Auth::guard('client')->id();
            }
            $view->save();
        }

    }
}