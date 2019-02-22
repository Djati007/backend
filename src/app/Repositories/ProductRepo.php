<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductRepo {

    public function __construct() {
    }

    public function all($paginate=null){
        if ($paginate!=null){
            $data = Product::latest()->with('category')->paginate($paginate);
        }else{
            $data = Product::latest()->with('category')->get();
        }
        return $data;
    }

    public function byCategory($slug,$paginate=null){
        if (isset($slug)){
            $category = ProductCategory::whereSlug($slug)->first();
        }
        if ($paginate!=null){
            $data = Product::where('category_id',$category->id)->latest()->with('category')->paginate($paginate);
        }else{
            $data = Product::where('category_id',$category->id)->latest()->with('category')->get();
        }
        return $data;
    }

    public function find($slug){
        $data = Product::whereSlug($slug)->with('category')->first();
        return $data;
    }

    public function search($word=null,$paginate=null){
        if ($word!=null){
            if ($paginate!=null){
                $data = Product::where('title','like','%'.$word.'%')->with('category')->paginate($paginate);
            }else{
                $data = Product::where('title','like','%'.$word.'%')->with('category')->get();
            }
        }else{
            if ($paginate!=null){
                $data = Product::latest()->with('category')->paginate($paginate);
            }else{
                $data = Product::latest()->with('category')->get();
            }
        }
        return $data;
    }

    public function store($post,$image){
        if (isset($post['id'])){
            $data = Product::find($post['id']);
        }else{
            $data = new Product();
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
        $data = Product::find($id);
        if (isset($data->image)) {
            Storage::delete($data->image);
        }
        $data->delete();

        return [
            'status' => true,
            'message' => 'Success Deleted data',
        ];
    }


}