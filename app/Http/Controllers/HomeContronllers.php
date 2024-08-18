<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
class HomeContronllers extends Controller
{
    public function index(){

        $products = Products::all();
        return view('app.home',compact('products'));
    }
    public function create ()
    {
        return view('products.create');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'price' => 'required|numeric',
            'image' => [
                'required',
                File::image()
                    ->min('1kb')
                    ->max('2mb')
            ],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('products.create')
                ->withErrors($validator)
                ->withInput();
        }else{
            $file=$request->file('image');
            $name=time().$file->getClientOriginalName();
            $request->file('image')->storeAs(
                'imageArticle',
                $name,
                'public'
            );
            Products::create([
                'title'=>$request->title,
                'image'=>$name,
                'price'=>$request->price,
            ]);

            return back()->with('success','Votre article a été envoyé');
        }
    }
}
