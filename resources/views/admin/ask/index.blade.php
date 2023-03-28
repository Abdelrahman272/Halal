@extends('admin.layouts.master')

@section('title')
    Asks
@endsection

@section('css')
@endsection

@section('title_page1')
    Asks
@endsection

@section('title_page2')
    Asks
@endsection


@section('content')
    <!-- Page Heading -->
@section('content')


    <div class="card-body">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            {{-- @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif --}}
        </div>
        <div class="table-responsive">
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">

            <table id="myTable">
                <thead>
                    <tr>
                        <th>Posts</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                @forelse ($asks as $ask)
                    <tr>
                        <td>{{ $ask->posts }}</td>
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
        {{ $asks->links() }}
    </div>
@endsection

@section('scripts')
@endsection
