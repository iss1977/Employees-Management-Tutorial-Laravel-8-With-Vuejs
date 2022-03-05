@extends('layouts.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 container-fluid">
        <h1 class="h3 mb-0 text-gray-800">Countries</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>{{ __('Modify Country Data') }}</div>
                        <a href="{{ URL::previous() }}">Back</a>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('countries.update', $country->id) }}">
                            @csrf
                            @method('PUT')
                            <!-- country code -->
                            <div class="row mb-3">
                                <label for="country_code"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Country Code') }}</label>
                                <div class="col-md-6">
                                    <input id="country_code" type="text"
                                        class="form-control @error('country_code') is-invalid @enderror" name="country_code"
                                        value="{{ old('country_code', $country->country_code) }}" required autocomplete="country_code"
                                        autofocus>

                                    @error('country_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- country name -->
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', $country->name) }}" required
                                        autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col col-md-8 mt-4">
                <form method="POST" action="{{ route('countries.destroy', $country->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">
                        {{ __('Delete') }} {{ $country->name }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
