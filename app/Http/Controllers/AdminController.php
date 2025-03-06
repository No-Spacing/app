<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;


use Inertia\Inertia;

class AdminController extends Controller
{
    
    public function PostLogin (Request $request) {

        $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember) ) {
            //$request->session()->put('admin', $credentials->id);
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        } else {
            return back()->with('message','Invalid credentials');
        }

    }

    public function RegisterUser (Request $request){

        $request->validate([
            'username' => [ 'required', 'unique:admins', 'min:6' ],
            'password' => [ 'required', 'confirmed', 'min:6' ]
        ]);

        DB::table('admins')
        ->insert([
            'username' => $request->username,
            'password' => hash::make($request->password),
        ]);

        return redirect('')->with('snackbar', true);
    }

    public function Products () {
        $products = Product::all();
        return Inertia::render('Products', ['products' => $products]);
    }

    public function FilterProducts ($category) {

        $products = DB::table('products')
        ->where('category', $category)
        ->get();

        return Inertia::render('Products', ['products' => $products]);
    }

    public function PostProduct (Request $request) {

        if($request->productDetails == 1){
            $request->validate(
                [
                    'name' => 'required',
                    'category' => 'required',
                    'description' => 'required'
                ],
                [
                    'category.required' => 'Select an item for category' 
                ]
            );
        } else if ($request->productDetails == 2){
            $request->validate(
                [
                    'image' => [ 'required', 'array' ],            
                    'image.*' => [ 'image' ]
                ]
            );
        } else if ($request->productDetails == 3){
            $request->validate(
                [
                    'date_time' => 'required'
                ]
            );
            DB::table('products')->insert([
                'name' => $request->name,
                'category' => $request->category,
                'description' => $request->description,
                'date_time' => $request->date_time
            ]);
            return redirect('/products');
        }
        
    }

    public function UpdateProduct (Request $request) {

        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'date_time' => 'required'
        ]);

        DB::table('products')
        ->where('id', $request->id)
        ->update([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'date_time' => $request->date_time,
        ]);

    }

    public function DeleteProduct ($id) {
        DB::table('products')->where('id', $id)->delete();
    }

    public function VideoPlayer($id){
        $videoFile = DB::table('video_tables')->where('id', $id)->first();
        return Inertia::render('Videos', ['videoFile' => $videoFile]);
    }


    public function logout (Request $request) {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/'); 
    }
}
