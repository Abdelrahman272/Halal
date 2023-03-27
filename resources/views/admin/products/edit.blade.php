@extends('admin.layouts.master')

@section('title')
    Categories
@endsection

@section('css')
@endsection

@section('title_page1')
    Categories Edit
@endsection

@section('title_page2')
    Categories Edit
@endsection


@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <!-- Page Heading -->
    <div class="card-body">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Categories</h1>

            <a href="{{ route('categories.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                Back to cateogries
            </a>
        </div>

        <!-- DataTales Example -->
        <form action="{{ route('categories.update', $category->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input name="id" value="{{$category->id}}" type="hidden">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Edit Category
                    </h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $category->name }}"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ $category->description }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Photo</label>
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" name="photo">
                            <label class="custom-file-label">Choose file...</label>
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <img src="{{ renderImage($category) }}" class="rounded-circle  height-150"
                                    style="width: 200px; alt="صورة القسم ">
                                    </div>
                                </div>
                                @error('photo')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="status"  @if ($category->status == 'active') checked @endif>Active
                                </label>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
@endsection

@section('scripts')
@endsection
