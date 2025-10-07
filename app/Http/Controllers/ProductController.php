<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $title = '상품 목록';
        $products = Product::searchKeyword();
        return view('product.list', compact('title', 'products'));
    }

    public function input()
    {
        $title = '상품 추가';
        return view('product.input', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products,name',
            'sku' => 'required|string|unique:products,sku',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
        ], [
            'name.required' => '상품명은 필수 입력 입니다.',
            'name.unique' => '이미 등록된 상품명 입니다.',
            'sku.required' => 'sku 는 필수 입력 입니다.',
            'sku.string' => 'sku 는 문자열이어야 합니다.',
            'sku.unique' => '이미 등록된 sku 입니다.',
            'quantity.required' => '수량은 필수 입력 입니다.',
            'quantity.numeric' => '수량은 숫자여야 합니다.',
            'price.required' => '가격은 필수 입력 입니다.',
            'price.numeric' => '가격은 숫자여야 합니다.',
        ]);

        $arr = [
            'name' => $request->input('name'),
            'sku' => $request->input('sku'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
        ];

        // 상품 이미지를 등록한 경우
        if (!empty($request->file('image'))) {
            $request->validate([
                'image' => 'required|file|mimes:jpg,jpeg,gif,png|max:4096',
            ]);
            $path = $request->file('image')->store('uploads', 'public');
            $arr['image'] = $path;
        }

        // 대량 할당
        Product::create($arr);

        return redirect()->route('dashboard')->with('success', '상품 등록이 성공하였습니다.');
    }
}
