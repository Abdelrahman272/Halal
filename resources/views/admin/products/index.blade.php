@extends('admin.layouts.master')

@section('title')
    Products
@endsection

@section('css')
@endsection

@section('title_page1')
    Products
@endsection

@section('title_page2')
    Products
@endsection


@section('content')
    <!-- Page Heading -->
@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card-body">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="{{ route('product.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                New Product
            </a>
        </div>
        <div class="table-responsive">
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">

            <table id="myTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Photo</th>
                        <th>Status</th>
                        <th>Discription</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{$product->price}}</td>
                        <td><img src="{{ renderImage($product) }}" style="width: 200px;" /></td>
                        <td>{{ $product->getActive() }}</td>
                        <td>{{ Str::words($product->description, 5) }}</td>
                        <td>
                            <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-info">
                                    View
                                </a>

                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <div class="alert alert-danger" role="alert">
                                No Data Found!
                            </div>
                        </td>
                    </tr>
                @endforelse
            </table>
        </div>
        {{ $products->links() }}
    </div>
@endsection

@section('scripts')
@endsection
