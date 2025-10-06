@extends('layout')

@section('main')
    <div class="py-4">
        <h2 class="mb-4 text-center">📝 상품 추가</h2>

        @if(session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif

        <form method="post" action='/product/input' enctype="multipart/form-data" class="mx-auto" style="max-width: 600px;">
            @csrf
            <div class="mb-3">
                <label class="form-label">상품명</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">SKU</label>
                <input type="text" name="sku" class="form-control" value="{{ old('sku') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">수량</label>
                <input type="number" name="quantity" class="form-control" value="" required>
            </div>
            <div class="mb-3">
                <label class="form-label">가격 (원)</label>
                <input type="number" step="0.01" name="price" class="form-control" value="" required>
            </div>
            <div class="mb-3">
                <label class="form-label">상품 이미지</label>
                <input type="file" name="image" class="form-control">
                <div class="mt-2">
                    <img src="이미지" alt="상품 이미지" style="max-width: 150px;">
                </div>
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-success">저장</button>
                <a href="products.php" class="btn btn-outline-secondary">취소</a>
            </div>
        </form>
    </div>
@endsection
