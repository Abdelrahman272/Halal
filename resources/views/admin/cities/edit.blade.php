@extends('admin.layouts.master')

@section('title')
    Cites
@endsection

@section('css')
@endsection

@section('title_page1')
    Cites
@endsection

@section('title_page2')
    Cites
@endsection


@section('content')
    <!-- Page Heading -->
    <div class="card-body">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cities</h1>

            <a href="{{ route('city.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                Back to Cities
            </a>
        </div>

        <!-- DataTales Example -->
        <form action="{{ route('city.update' , $city->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Edit City
                    </h6>
                </div>
                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{$city->name}}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
@endsection
