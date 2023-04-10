@extends('admin.layouts.master')

@section('title')
    Locations
@endsection

@section('css')
@endsection

@section('title_page1')
    Locations
@endsection

@section('title_page2')
    Locations
@endsection


@section('content')
    <!-- Page Heading -->
@section('content')


    <div class="card-body">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="{{ route('locations.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                New Location
            </a>
        </div>
        <div class="table-responsive">
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">

            <table id="myTable">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Location</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                    </tr>
                </thead>
                @forelse($locations as $location)
                    <tr>
                        <td>{{$location->user->name}}</td>
                        <td>{{ $location->name }}</td>
                        <td>{{ $location->latitude }}</td>
                        <td>{{ $location->longitude }}</td>
                        <td>
                            <form action="{{ route('locations.destroy', $location->id) }}" method="POST">
                                <a href="{{ route('locations.show', $location->id) }}" class="btn btn-sm btn-warning">
                                    Show
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
        {{$locations->links()}}
    </div>
@endsection

@section('scripts')
@endsection
