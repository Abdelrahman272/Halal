@extends('admin.layouts.master')

@section('title')
    Cities
@endsection

@section('css')
@endsection

@section('title_page1')
    Cities
@endsection

@section('title_page2')
    Cities
@endsection


@section('content')
    <!-- Page Heading -->
@section('content')


    <div class="card-body">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
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
            <a href="{{ route('city.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                New City
            </a>
        </div>
        <div class="table-responsive">
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">

            <table id="myTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                @forelse ($cities as $city)
                    <tr>
                        <td>{{ $city->name }}</td>
                        <td>
                            <form action="{{ route('city.destroy', $city->id) }}" method="POST">
                                <a href="{{ route('city.edit', $city->id) }}" class="btn btn-sm btn-warning">
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
        {{ $cities->links() }}
    </div>
@endsection

@section('scripts')
@endsection
