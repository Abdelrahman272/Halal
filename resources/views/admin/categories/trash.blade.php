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


    <div class="card-body">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="{{ route('category.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                Back To Category
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
                            <form action="{{ route('category.restore', $category->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-sm btn-outline-info">Restore</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('category.force-delete', $category->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Force Delete</button>
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
