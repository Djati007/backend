<?php

namespace App\Repositories;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BannerRepo {

    public function __construct() {
    }

    public function all($paginate=null){
        if ($paginate!=null){
            $data = Banner::latest()->paginate($paginate);
        }else{
            $data = Banner::latest()->get();
        }
        return $data;
    }

    public function find($slug){
        $data = Banner::whereSlug($slug)->first();
        return $data;
    }

    public function store($post,$image){
        if (isset($post['id'])){
            $data = Banner::find($post['id']);
        }else{
            $data = new Banner();
        }

        if (isset($image)){
            if (isset($data->image)) {
                Storage::delete($data->image);
            }
            $post['image'] = handleUpload($image,'banner');
        }
        $data->fill($post);
        $view = $data->save();

        if (isset($post['id'])){
            return [
                'status' => true,
                'message' => 'Success Update data',
                'data' => $view
            ];
        }else{
            return [
                'status' => true,
                'message' => 'Success Created data',
                'data' => $view
            ];
        }
    }

    public function delete($id){
        $data = Banner::find($id);
        if (isset($data->image)) {
            Storage::delete($data->image);
        }
        $data->delete();
    }


}