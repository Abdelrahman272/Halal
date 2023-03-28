@extends('admin.layouts.master')

@section('title')
    Contacts
@endsection

@section('css')
@endsection

@section('title_page1')
    Contacts
@endsection

@section('title_page2')
    Contacts
@endsection


@section('content')
    <!-- Page Heading -->
    <div class="card-body">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Contact</h1>

            <a href="{{ route('account.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                Back to Contact
            </a>
        </div>

        <!-- DataTales Example -->
        <form action="{{ route('account.update', $account->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Edit Account
                    </h6>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label>IBAN</label>
                        <input type="number" name="IBAN" value="{{$account->IBAN}}" class="form-control @error('IBAN') is-invalid @enderror">
                        @error('IBAN')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Account Number</label>
                        <input type="number" name="AccuntNumber" value="{{$account->AccuntNumber}}" class="form-control @error('AccuntNumber') is-invalid @enderror">
                        @error('AccuntNumber')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
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
