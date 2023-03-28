@extends('admin.layouts.master')

@section('title')
    Polices
@endsection

@section('css')
@endsection

@section('title_page1')
    Polic
@endsection

@section('title_page2')
    Polic
@endsection


@section('content')
    <!-- Page Heading -->
    <div class="card-body">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Policies</h1>

            <a href="{{ route('policy.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                Back to Policies
            </a>
        </div>

        <!-- DataTales Example -->
        <form action="{{ route('policy.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        New Polices
                    </h6>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label>Policies</label>
                        <textarea class="form-control" name="posts" id="exampleFormControlTextarea1" rows="3"></textarea>
                        @error('posts')
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
