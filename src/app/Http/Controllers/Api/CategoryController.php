<?php

namespace App\Http\Controllers\Api;

use App\Models\ProductCategory;
use App\Repositories\ProductRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $data,$repo;

    public function __construct(ProductCategory $category){
        $this->repo['category'] = $category;
    }

    public function index(){
        $data = $this->repo['category']->all();
        return response()->json($data);
    }

    public function detail($slug){
        $data = $this->repo['category']->find($slug);
        return response()->json($data);
    }

    public function edit($slug){
        $data = $this->repo['category']->find($slug);
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

}
