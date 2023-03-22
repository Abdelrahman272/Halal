<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

class ProductController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductResource::collection(Product::with('photoable')->get());
        return $this->apiResponse($products, 'Products retrieved successfully', 200);
    }

    public function show($id)
    {
        $category = Product::with('photoable')->find($id);

        if ($category)
        {
            return $this->apiResponse(new ProductResource($category), 'Products retrieved successfully', 200);
        }
        return $this->apiResponse(null,'The post Not Found',404);
    }

}
