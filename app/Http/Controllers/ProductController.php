<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::filter(request(['search']))->get();
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'slug' => 'required',
                'price' => 'required'
            ]
        );
        Product::create($request->all());
    }

    public function show(Product $product)
    {
        return Product::findOrFail($id);
    }
    public function delete($id)
    {
         Product::destroy($id);
    }

}

