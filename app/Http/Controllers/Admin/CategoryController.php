<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('photoable')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(CategoryRequest $request)
    {
        if (!$request->has('status')) {
            $request->request->add(['status' => 'inactive']);
        } else {
            $request->request->add(['status' => 'active']);
        }

        $inputs = $request->all();

        if ($request->has('photo')) {
            $filePath = time() . '.' . $request->photo->extension();
        }
        $newCategory = Category::create($inputs);
        $inputs['photo'] = Photo::create([
            'src' => $request->file('photo')->move('uploads/categories', $filePath),
            'photoable_type' => 'App\Models\Category',
            'photoable_id' => $newCategory->id,
            'type' => 'photo',
        ]);
        return redirect()->route('category.index')->with('success', 'Category created successfully');
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
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        if (!$request->has('status')) {
            $request->request->add(['status' => 'inactive']);
        } else {
            $request->request->add(['status' => 'active']);
        }

        $inputs = $request->all();

        $old_photo = $category->photoable()->first()->src;

        if ($request->has('photo') && File::exists($old_photo)) {

            File::delete($old_photo);

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('uploads/categories', $fileName);
            $category->photoable()->first()->update([
                'src' => 'uploads/categories/' . $fileName,
            ]);
        }

        $category->update($inputs);

        return redirect()->route('category.index')->with('success', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $photo = $category->photoable()->first()->src;
        if (File::exists($photo))
        {
            File::delete($photo);
        }
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted!');
    }
}
