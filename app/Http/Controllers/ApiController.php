<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Apk;
use App\Models\Store;
use App\Models\ApkUser;
use App\Models\ApkView;
use App\Models\Activity;
use App\Models\ApkSocial;
use App\Models\StoreView;
use App\Models\Wallpapper;
use App\Models\ApkUserToken;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\WallpapperView;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    public function ApkInfo(Request $request) // good
    {

        $this->validate($request, [
            'apk' => 'required|integer',
        ]);
        $apk = $request->apk;

        $Apk = Apk::find($apk);

        $apk = array(
            'nav_color' => $Apk->nav_color,
            'background_color' => $Apk->background_color,
            'title_color' => $Apk->title_color,
            'text_color' => $Apk->text_color,
        );
        return Response::json(array('info' => $apk));
    }

    public function AppLinks(Request $request) // good
    {
        $this->validate($request, [
            'apk' => 'required|integer',
        ]);
        $apk = $request->apk;

        $socials = ApkSocial::where('apk_id',$apk)->get();
        if(!empty($socials)){
            $info = array(
                'instagram' => $socials->where('social_media','instagram')->first()->link ?? 'instagrem.com',
                'facebook'  => $socials->where('social_media','facebook')->first()->link ?? 'facebook.com',
                'youtube'   => $socials->where('social_media','youtube')->first()->link ?? 'youtube.com',
            );
        }else{
            $info = array(
                'instagram' => 'instagrem.com',
                'facebook'  => 'facebook.com',
                'youtube'   => 'youtube.com',
            );
        }
        
        return Response::json(array('info' => $info));
    }

    public function AllWallpappers(Request $request) // good
    {

        $this->validate($request, [
            'apk' => 'required|integer',
            'page' => 'required|integer',
            'itms' => 'required|integer',
        ]);

        $apk = $request->apk;
        $page = $request->page;
        $itms = $request->itms;

        $wallpappers = Wallpapper::where('apk_id', $apk)->where('status', 1)->orderBy('id', 'desc')->paginate($itms);

        $x = 0;
        if (count($wallpappers) > 0) {
            foreach ($wallpappers as $var) {
                $var->meta = $var->meta ?? ' ';
                $var->btn_text = $var->btn_text ?? ' ';
                $var->link = $var->link ?? ' ';
                $var->wallpapper = request()->getHttpHost()."/storage/wallpappers/" . $var->wallpapper;
                $var->view = ($var->view > 30) ? $var->view : rand(20, 50);
                $array[$x] = $var;
                $array[$x]['meta_description'] = substr($var->description, 0, 194) . ' ...';

                $x++;
            }
        } else {
            $array = [];
        }

        return Response::json(array('wallpappers' => $array));
        //  echo json_encode(array('wallpappers'=>$array));
    }

    public function SearchWallpapper(Request $request)
    {

        $this->validate($request, [
            'apk' => 'required|integer',
            'page' => 'required|integer',
            'itms' => 'required|integer',
            'title' => 'required|string',
        ]);

        $apk = $request->apk;
        $page = $request->page;
        $itms = $request->itms;
        $title = $request->title;

        $wallpappers = Wallpapper::where('apk_id', $apk)->where('status', 1)->where('title', 'LIKE', "%$title%")->orderBy('id', 'desc')->paginate($itms);

        $x = 0;
        if (count($wallpappers) > 0) {
            foreach ($wallpappers as $var) {
                $var->meta = $var->meta ?? ' ';
                $var->btn_text = $var->btn_text ?? ' ';
                $var->link = $var->link ?? ' ';
                $var->wallpapper = request()->getHttpHost()."/storage/wallpappers/" . $var->wallpapper;
                $var->view = ($var->view > 30) ? $var->view : rand(20, 50);

                $array[$x] = $var;
                $array[$x]['meta_description'] = substr($var->description, 0, 194) . ' ...';

                $x++;
            }
        } else {
            $array = [];
        }

        return Response::json(array('wallpappers' => $array));
        //  echo json_encode(array('wallpappers'=>$array));
    }

    public function GetWallpapper(Request $request) // good
    {

        $this->validate($request, [
            'id' => 'required|integer',
        ]);

        $id = $request->id;

        $wallpapper = Wallpapper::find($id);

        $wallpapper->meta = $wallpapper->meta ?? ' ';
        $wallpapper->btn_text = $wallpapper->btn_text ?? ' ';
        $wallpapper->link = $wallpapper->link ?? ' ';
        $wallpapper->wallpapper = request()->getHttpHost()."/storage/wallpappers/" . $wallpapper->wallpapper;
        $wallpapper->view = ($wallpapper->view > 30) ? $wallpapper->view : rand(20, 50);


        return Response::json(array('Wallpapper' => $wallpapper));
        //  echo json_encode(array('Wallpapper'=>$wallpapper));
    }

    // public function WallpapperView(Request $request)
    // {

    //     $this->validate($request, [
    //         'id' => 'required|integer',
    //     ]);

    //     Wallpapper::where("id", $request->id)->update(['viewed' => DB::raw('viewed+1')]);

    // }

    public function WallpapperPreview(Request $request)
    {

        $this->validate($request, [
            'id' => 'required|integer',
        ]);

        Wallpapper::where("id", $request->id)->update(['preview_n' => DB::raw('preview_n+1')]);

    }

    public function WallpapperViews(Request $request)
    {

        $this->validate($request, [
            'id' => 'required|integer',
            'userId' => 'required|integer',
        ]);

        if (!WallpapperView::where('wallpapper_id', $request->id)->where('apk_user_id', $request->userId)->exists()) {
            $apk_user = new WallpapperView();
            $apk_user->wallpapper_id = $request->id;
            $apk_user->apk_user_id = $request->userId;
            $apk_user->save();
        }
        Wallpapper::where("id", $request->id)->update(['view' => DB::raw('view+1')]);


        return Response::json(1);

        // echo json_encode(1);

    }

    public function AddToken(Request $request)
    {

        $this->validate($request, [
            'apk' => 'required|integer',
            'token' => 'required|string',
        ]);

        if (!ApkUserToken::where('token', $request->token)->where('apk_id', $request->apk)->exists()) {
            $token = new ApkUserToken();
            $token->apk_id = $request->apk;
            $token->token = $request->token;
            $token->save();
        }

    }

    public function AddApkUser(Request $request) // good 
    {

        $this->validate($request, [
            'email' => 'nullable|string',
            'apk'   => 'required|integer',
            'token' => 'nullable|string',
        ]);

 
        $apk_user = ApkUser::where('token', $request->token)->where('apk_id', $request->apk)->first();

        if (empty($apk_user)) {
            $apk_user = new ApkUser();
            $apk_user->email = $request->email ?? 'user@email.com';
            $apk_user->apk_id = $request->apk;
            $apk_user->token = $request->token;
            $apk_user->save();
            ////  notification
            $var = $request->email ?? 'user@email.com';
            $activity = new Activity();
            $activity->notification = "New User";
            $activity->app = $apk_user->Apk->title;
            $activity->content = $var;
            $activity->type = "new_apk_user";
            $activity->apk_id = $request->apk;
            $activity->save();

            $message = " New apk_user Registred :  " . $request->email ?? 'user@email.com';
            $note = new Notification();
            $note->message = $message;
            $note->ids = $apk_user->id;
            $note->apk_id = $request->apk;
            $note->type = 'apk_user';
            $note->save();

        } elseif (isset($request->email)) {
            $apk_user->email = $request->email;
            $apk_user->save();
        }

        return Response::json(array('userId' => $apk_user->id ?? 0));

        // echo json_encode(1);

    }

    public function ApkView(Request $request) // good 
    {

        $this->validate($request, [
            'userId' => 'nullable|integer',
            'apk' => 'required|integer',
            'token' => 'nullable|string',
        ]);
        $user = $request->userId ;
        $apk_user = new ApkView();

        if(empty($user)){
            $token = ApkUser::where('token', $request->token)->where('apk_id', $request->apk)->first();
            $user  = $token->id;
        }

        $apk_user->apk_user_id = $user;
        $apk_user->apk_id = $request->apk;
        $apk_user->save();

        return Response::json(1);

        // echo json_encode(1);

    }

    public function ApkDelete(Request $request)
    {

        $this->validate($request, [
            'userId' => 'nullable|integer',
            'apk' => 'required|integer',
        ]);

        $apk_user = new ApkDelete();
        $apk_user->apk_user_id = $request->userId;
        $apk_user->apk_id = $request->apk;
        $apk_user->save();

        return Response::json(1);

        // echo json_encode(1);

    }

    public function FinishWallpapper(Request $request)
    {

        $this->validate($request, [
            'userId' => 'nullable|integer',
            'apk' => 'required|integer',
            'WallpapperId' => 'required|integer',

        ]);

        $wallpapper = new Finishwallpapper();
        $wallpapper->wallpapper_id = $request->WallpapperId;
        $wallpapper->apk_user_id = $request->userId;
        $wallpapper->apk_id = $request->apk;
        $wallpapper->save();
        return Response::json(1);

    }

    public function RequistWallpapper(Request $request)
    {

        $this->validate($request, [
            'userId' => 'nullable|integer',
            'apk' => 'required|integer',
            'title' => 'required|string',

        ]);

        $wallpapper = new Requistwallpapper();
        $wallpapper->title = $request->title;
        $wallpapper->apk_user_id = $request->userId;
        $wallpapper->apk_id = $request->apk;
        $wallpapper->save();
        ////  notification
        $activity = new Activity();
        $activity->notification = "New Request";
        $activity->app = $wallpapper->Apk->title;
        $activity->content = $request->title;
        $activity->type = "request";
        $activity->apk_id = $request->apk;
        $activity->save();

        $message = " New Wallpapper Requist :  " . $request->title;
        $note = new Notification();
        $note->message = $message;
        $note->ids = $wallpapper->id;
        $note->apk_id = $request->apk;

        $note->type = 'requist';
        $note->save();

        ////  notification
        return Response::json(1);

    }

    public function AllPosts(Request $request)
    {

        $this->validate($request, [
            'apk' => 'required|integer',
            'page' => 'required|integer',
            'itms' => 'required|integer',
        ]);

        $apk = $request->apk;
        $page = $request->page;
        $itms = $request->itms;

        $posts = Post::where('apk_id', $apk)->where('status', 1)->orderBy('id', 'desc')->paginate($itms);

        $x = 0;

        $hash = new \App\Lib\PseudoCrypt();
        $p_array = [];
        $link = request()->getHttpHost() . '/post/';

        if (count($posts) > 0) {
            foreach ($posts as $post) {
                $array = [];
                $array['id'] = $post->id;
                $array['apk_id'] = $post->apk_id;
                $array['description'] = $post->description;
                $array['link'] = $post->link ?? '';
                if (!empty($post->link)) {
                    $array['link'] = $link . $hash->hash($post->id, 6) . '/';
                } else {
                    $array['link'] = '';
                }

                $array['btn_text'] = $post->btn_text ?? '';
                $array['created_at'] = $post->created_at ?? '';
                $array['title'] = $post->title ?? '';

                if (!empty($post->s_title)) {
                    $array['p_s_title'] = substr($post->s_title, 0, 194) . ' ...';
                } else {
                    $array['p_s_title'] = '';
                }
                $array['s_title'] = $post->s_title;
                try {
                    $image = $post->media->where("is_image", 1)->where("is_primary", 1)->first()->media;
                } catch (\Throwable$th) {
                    try {
                        $image = $post->media->where("is_image", 1)->first()->media;
                    } catch (\Throwable$th) {
                        $image = '';
                    }
                }

                $array['primary_image'] = "storage/post_images/" . $image;

                $arr_img = [];
                foreach ($post->media->where("is_image", 1)->all() as $img) {
                    $arr_img[] = "storage/post_images/" . $img->media;
                }
                $array['images'] = $arr_img;

                try {
                    $array['video'] = "storage/post_videos/" . $post->media->where("is_image", 0)->first()->media;

                } catch (\Throwable$th) {
                    $array['video'] = '';

                }
                $array['views'] = ($post->views > 30) ? $post->views : rand(20, 50);
                $p_array[$x] = $array;
                $x++;
            }
        }

        return Response::json(array('posts' => $p_array));
        //  echo json_encode(array('wallpappers'=>$array));
    }

    public function PostView(Request $request)
    {

        $this->validate($request, [
            'userId' => 'required|integer',
            'postId' => 'required|integer',
        ]);

        $apk_user = new PostView();
        $apk_user->apk_user_id = $request->userId;
        $apk_user->post_id = $request->postId;
        $apk_user->save();
        $posts = Post::find($request->postId);
        $posts->views += 1;
        $posts->save();

        return Response::json(1);

        // echo json_encode(1);

    }

    ////////////////////// store

    public function AllProducts(Request $request)
    {

        $this->validate($request, [
            'apk' => 'required|integer',
            'page' => 'required|integer',
            'itms' => 'required|integer',
        ]);

        $apk = $request->apk;
        $page = $request->page;
        $itms = $request->itms;

        $products = Store::where('apk_id', $apk)->where('status', 1)->orderBy('id', 'desc')->paginate($itms);

        $x = 0;
        $hash = new \App\Lib\PseudoCrypt();
        $p_array = [];
        $link = request()->getHttpHost() . '/product/';
        if (count($products) > 0) {
            foreach ($products as $product) {
                $array = [];
                $array['id'] = $product->id;
                $array['apk_id'] = $product->apk_id;
                $array['description'] = $product->description;
                $array['link'] = $link . $hash->hash($product->id, 6) . '/';
                $array['btn_text'] = $product->btn_text ?? '';
                $array['created_at'] = $product->created_at ?? '';
                $array['title'] = $product->title ?? '';

                if (!empty($product->s_title)) {
                    $array['p_s_title'] = substr($product->s_title, 0, 194) . ' ...';
                } else {
                    $array['p_s_title'] = '';
                }
                $array['s_title'] = $product->s_title;
                try {
                    $image = $product->media->where("is_image", 1)->where("is_primary", 1)->first()->media;
                } catch (\Throwable$th) {
                    try {
                        $image = $product->media->where("is_image", 1)->first()->media;
                    } catch (\Throwable$th) {
                        $image = '';
                    }
                }

                $array['primary_image'] = request()->getHttpHost()."/storage/store_images/" . $image;

                $arr_img = [];
                foreach ($product->media->where("is_image", 1)->all() as $img) {
                    $arr_img[] = request()->getHttpHost()."/storage/store_images/" . $img->media;
                }
                $array['images'] = $arr_img;

                try {
                    $array['video'] = request()->getHttpHost()."/storage/product_videos/" . $product->media->where("is_image", 0)->first()->media;

                } catch (\Throwable$th) {
                    $array['video'] = '';

                }
                $array['views'] = ($product->views > 30) ? $product->views : rand(20, 50);
                $p_array[$x] = $array;
                $x++;
            }
        }

        return json_encode(array('products' => $p_array), JSON_UNESCAPED_SLASHES);
        //  echo json_encode(array('wallpappers'=>$array));
    }

    public function ProductView(Request $request)
    {

        $this->validate($request, [
            'userId'    => 'required|integer',
            'productId' => 'required|integer',
            'apk'       => 'required|integer',
        ]);

        $apk_user = new StoreView();
        $apk_user->apk_user_id = $request->userId;
        $apk_user->store_id    = $request->productId;
        $apk_user->apk_id      = $request->apk;
        $apk_user->save();
        $product = Store::find($request->productId);
        $product->views += 1;
        $product->save();

        return Response::json(1);

    }



}