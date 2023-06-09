<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category', 'photoable'])->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        if (!$request->has('status')) {
            $request->request->add(['status' => 'inactive']);
        } else {
            $request->request->add(['status' => 'active']);
        }
        $inputs = $request->all();
        $inputs['sku'] = '';
        $newProduct = Product::create($inputs);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $filename = now()->timestamp . '_' . $photo->getClientOriginalName();
                $filePath = "uploads/products/" . $filename;
                $photo->move('uploads/products', $filename);

                Photo::create([
                    'src' => $filePath,
                    'photoable_type' => 'App\Models\Product',
                    'photoable_id' => $newProduct->id,
                    'type' => 'photo',
                ]);
            }
        }
        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('category')->findOrFail($id);
        // $categories = Category::all();
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        if (!$request->has('status')) {
            $request->request->add(['status' => 'inactive']);
        } else {
            $request->request->add(['status' => 'active']);
        }

        $inputs = $request->all();

        if ($request->hasFile('photos')) {
            $old_photo = $product->photoable()->first()->src;

            if (File::exists($old_photo)) {

                File::delete($old_photo);
            }
            foreach ($request->file('photos') as $photo) {
                $filename = now()->timestamp . '_' . $photo->getClientOriginalName();
                $filePath = "uploads/products/" . $filename;
                $photo->move('uploads/products', $filename);

                $product->photoable()->first()->update([
                    'src' => 'uploads/products/' . $filename,
                ]);
            }
        }

        $product->update($inputs);

        return redirect()->route('product.index')->with('success', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $photo = $product->photoable()->first();
        if (File::exists($photo)) {
            File::delete($photo);
        }
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted!');
    }
}
