<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

Route::get('/', function () {
    return view(('home'));
});

Route::get('/products', function () {
    $products = array(
        array(
            'id' => 1,
            'name' => "Sản phẩm 1",
            'description' => "Mô tả sản phẩm 1, rất chất lượng và đáng mua.",
            'price' => 500000,
            'image' => "http://picsum.photos/id/1/300/300"
        ),
        array(
            'id' => 2,
            'name' => "Sản phẩm 2",
            'description' => "Mô tả sản phẩm 2, chất lượng tốt và giá phải chăng.",
            'price' => 300000,
            'image' => "http://picsum.photos/id/2/300/300"
        ),
        array(
            'id' => 3,
            'name' => "Sản phẩm 3",
            'description' => "Mô tả sản phẩm 3, sản phẩm cao cấp và nhiều tính năng.",
            'price' => 1000000,
            'image' => "http://picsum.photos/id/3/300/300"
        )
    );
    return response()->json($products);
});
Route::prefix('api')->group(function () {
    Route::resource('categories', CategoryController::class);
});

// Route::post('/categories', [CategoryController::class, 'store']);    