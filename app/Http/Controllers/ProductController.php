<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function input()
    {
        $title = '상품 추가';
        return view('product.input', compact('title'));
    }
}
