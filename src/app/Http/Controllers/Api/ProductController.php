<?php

namespace App\Http\Controllers\Api;

use App\Repositories\CategoryRepo;
use App\Repositories\ProductRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $data,$repo;

    public function __construct(ProductRepo $product, CategoryRepo $category){
        $this->repo['product'] = $product;
        $this->repo['category'] = $category;
    }

    public function index(){
        $data = $this->repo['product']->all(10);
        return response()->json($data);
    }

    public function detail($slug){
        $data = $this->repo['product']->find($slug);
        return response()->json($data);
    }

    public function edit($slug){
        $data = $this->repo['product']->find($slug);
        return response()->json($data);
    }

    public function store(Request $req){
        $post = $req->post();
        $img = $req->file('image');

        $req->validate([
            'title' => 'required|max:255',
            'image' => 'mimes:jpeg,bmp,png',
        ]);

        $data = $this->repo['product']->store($post,$img);

        return response()->json($data);
    }

    public function delete($id){
        $data = $this->repo['product']->delete($id);

        return response()->json($data);
    }

    public function category(){
        $data = $this->repo['category']->all();
        return response()->json($data);
    }

    public function byCategory($slug){
        $data = $this->repo['product']->byCategory($slug,10);
        return response()->json($data);
    }


    public function search(Request $req){
        $word = $req->get('search');
        $data = $this->repo['product']->search($word,10);
        return response()->json($data);
    }

}
