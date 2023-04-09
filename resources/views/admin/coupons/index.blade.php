@extends('admin.layouts.master')

@section('title')
    Coupone
@endsection

@section('css')
@endsection

@section('title_page1')
    Coupone
@endsection

@section('title_page2')
    Coupone
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
            <a href="{{ route('coupon.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                New Coupon
            </a>
        </div>
        <div class="table-responsive">
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">

            <table id="myTable">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Discount Type</th>
                        <th>Discount Amount</th>
                        <th>Max Uses</th>
                        <th>Start At</th>
                        <th>End At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                @forelse ($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->code }}</td>
                        <td>{{$coupon->discount_type}}</td>
                        <td>{{ $coupon->discount_type === 'percentage' ? $coupon->discount_amount . '%' : $coupon->discount_amount . ' ' . config('app.currency') }}</td>
                        <td>{{$coupon->max_uses}}</td>
                        <td>{{ Carbon\Carbon::parse($coupon->start_date)->format('Y/m/d/H:i') }}</td>
                        <td>{{ Carbon\Carbon::parse($coupon->end_date)->format('Y/m/d/H:i') }}
                        <td>
                            <form action="{{ route('coupon.destroy', $coupon->id) }}" method="POST">
                                <a href="{{ route('coupon.edit', $coupon->id) }}" class="btn btn-sm btn-warning">
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
        {{ $coupons->links() }}
    </div>
@endsection

@section('scripts')
@endsection
