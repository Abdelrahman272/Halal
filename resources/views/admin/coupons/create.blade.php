@extends('admin.layouts.master')

@section('title')
    Coupon
@endsection

@section('css')
@endsection

@section('title_page1')
    Coupon
@endsection

@section('title_page2')
    Coupon
@endsection


@section('content')
    <!-- Page Heading -->
    <div class="card-body">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="{{ route('coupon.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                Back to Coupones
            </a>
        </div>
        <form method="POST" action="{{ route('coupon.store') }}">
            @csrf

            <div class="form-group row">
                <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Coupon Code') }}</label>

                <div class="col-md-6">
                    <input id="code" type="text" class="form-control @error('code') is-invalid @enderror"
                        name="code" value="{{ old('code') }}" required autocomplete="code" autofocus>

                    @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="discount_type" class="col-md-4 col-form-label text-md-right">{{ __('Discount Type') }}</label>

                <div class="col-md-6">
                    <select id="discount_type" class="form-control @error('discount_type') is-invalid @enderror"
                        name="discount_type" required autocomplete="discount_type">
                        <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                        <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Percentage
                        </option>
                    </select>

                    @error('discount_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="discount_amount"
                    class="col-md-4 col-form-label text-md-right">{{ __('Discount Amount') }}</label>

                <div class="col-md-6">
                    <input id="discount_amount" type="number" step="0.01"
                        class="form-control @error('discount_amount') is-invalid @enderror" name="discount_amount"
                        value="{{ old('discount_amount') }}" required autocomplete="discount_amount">

                    @error('discount_amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="max_uses"
                    class="col-md-4 col-form-label text-md-right">{{ __('Max Uses') }}</label>

                <div class="col-md-6">
                    <input id="max_uses" type="number" step="0.01"
                        class="form-control @error('max_uses') is-invalid @enderror" name="max_uses"
                        value="{{ old('max_uses') }}" required autocomplete="max_uses">

                    @error('max_uses')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('Start Date') }}</label>

                <div class="col-md-6">
                    <input id="start_date" type="datetime-local"
                        class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                        value="{{ old('start_date') }}" required autocomplete="start_date">

                    @error('start_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('End Date') }}</label>

                <div class="col-md-6">
                    <input id="end_date" type="datetime-local"
                        class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                        value="{{ old('end_date') }}" required autocomplete="end_date">

                    @error('end_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">Regenerate</button>
                </div>
            </div>

        </form>

    </div>
@endsection

@section('scripts')
@endsection
