<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class CategoriesController extends Controller
{
    use ResponseTrait;


    public function index()
    {
        $categories = CategoryResource::collection(Category::with('photoable')->get());
        return $this->apiResponse($categories, 'Categories retrieved successfully', 200);
    }

    public function show($id)
    {
        // dd(Category::with('photos')->find($id)->toArray());
        $category = Category::with('photoable')->find($id);

        if ($category)
        {
            return $this->apiResponse(new CategoryResource($category), 'Categories retrieved successfully', 200);
        }
        return $this->apiResponse(null,'The post Not Found',404);
    }

}
