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
            <a href="{{ route('contact.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                Add Contacts
            </a>
        </div>
        <div class="table-responsive">
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">

            <table id="myTable">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>WhatsApp</th>
                        <th>Facebook</th>
                        <th>Instagram</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                @forelse ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone_number }}</td>
                        <td>{{ $contact->whatsApp}}</td>
                        <td>{{ $contact->facebook }}</td>
                        <th>{{$contact->instagram}}</th>
                        <td>
                            <form action="{{ route('contact.destroy', $contact->id) }}" method="POST">
                                <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-sm btn-warning">
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
    </div>
@endsection

@section('scripts')
@endsection
