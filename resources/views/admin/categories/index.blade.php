@extends('admin.layouts.master')

@section('title')
    Categories
@endsection

@section('css')
@endsection

@section('title_page1')
    Categories
@endsection

@section('title_page2')
    Categories
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
            <a href="{{ route('category.create') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                New Category
            </a>
        </div>
        <div class="table-responsive">
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">

            <table id="myTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Status</th>
                        <th>Discription</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td><img src="{{ renderImage($category) }}" style="width: 200px;" /></td>
                        <td>{{ $category->getActive() }}</td>
                        <td>{{ Str::words($category->description, 5) }}</td>
                        <td>
                            <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                <a href="{{ route('category.show', $category->id) }}" class="btn btn-sm btn-info">
                                    View
                                </a>

                                <a href="{{ route('category.edit', $category->id) }}"
                                    class="btn btn-sm btn-warning">
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
        {{ $categories->links() }}
    </div>
@endsection

@section('scripts')
@endsection
