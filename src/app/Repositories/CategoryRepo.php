<?php

namespace App\Repositories;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryRepo {

    public function __construct() {
    }

    public function all($paginate=null){
        if ($paginate!=null){
            $data = ProductCategory::latest()->paginate($paginate);
        }else{
            $data = ProductCategory::latest()->get();
        }
        return $data;
    }

    public function find($slug){
        $data = ProductCategory::whereSlug($slug)->first();
        return $data;
    }

    public function search($word){
        $data = ProductCategory::where('title','like','%'.$word.'%')->first();
        return $data;
    }

    public function store($post,$image){
        if (isset($post['id'])){
            $data = ProductCategory::find($post['id']);
        }else{
            $data = new ProductCategory();
        }

        if (isset($image)){
            if (isset($data->image)) {
                Storage::delete($data->image);
            }
            $post['image'] = handleUpload($image,'product');
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
        $data = ProductCategory::find($id);
        if (isset($data->image)) {
            Storage::delete($data->image);
        }
        $data->delete();
    }


}