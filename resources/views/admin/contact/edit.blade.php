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

            <a href="{{ route('contact.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                Back to Contact
            </a>
        </div>

        <!-- DataTales Example -->
        <form action="{{ route('contact.update', $contact->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        New Contact
                    </h6>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{$contact->email}}" class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>phone Number</label>
                        <input type="tel" name="phone_number" value="{{$contact->phone_number}}" class="form-control @error('phone') is-invalid @enderror">
                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>WhatsApp</label>
                        <input type="tel" name="whatsApp" value="{{$contact->whatsapp}}" class="form-control @error('whatsApp') is-invalid @enderror">
                        @error('whatsApp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Facebook</label>
                        <input type="text" name="facebook" value="{{$contact->facebook}}" class="form-control @error('facebook') is-invalid @enderror">
                        @error('facebook')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>instagram</label>
                        <input type="text" name="instagram" value="{{$contact->instagram}}" class="form-control @error('instagram') is-invalid @enderror">
                        @error('instagram')
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
