<?php

namespace App\Http\Controllers\Api;

use App\Repositories\BannerRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    protected $data,$repo;

    public function __construct(BannerRepo $banner){
        $this->repo['banner'] = $banner;
    }

    public function index(){
        $data = $this->repo['banner']->all();
        return response()->json($data);
    }

    public function store(Request $req){
        $post = $req->post();
        $img = $req->file('image');

        $req->validate([
            'title' => 'required|max:255',
            'image' => 'mimes:jpeg,bmp,png',
        ]);

        $data = $this->repo['banner']->store($post,$img);

        return response()->json($data);
    }

    public function edit($slug){
        $data = $this->repo['banner']->find($slug);
        return response()->json($data);
    }

    public function detail($slug){
        $data = $this->repo['banner']->find($slug);
        return response()->json($data);
    }
    public function delete($id){
        $data = $this->repo['banner']->delete($id);
        return response()->json($data);
    }
}
