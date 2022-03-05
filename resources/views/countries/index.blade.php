@extends('layouts.main')


{{-- Include flash messages if any --}}
@section('flash-messages')
    @include('partials.flash-message')
@endsection



@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 container-fluid">
        <h1 class="h3 mb-0 text-gray-800">Countries</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>

    </div>

    <div class="container">
        <div class="row flex-nowrap">
            <form action="{{route('countries.index')}}" method="GET">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <label class="sr-only" for="inlineFormInput">Country</label>
                        <input type="text" class="form-control mb-2 flex-shrink-1 " id="inlineFormInput"
                            placeholder="search for name of country" name="search" value = "{{ $searchValue }}">
                    </div>
                    <div class="col-auto">
                        <input type="submit" class="btn btn-primary mb-2" value="Search" name="searchbutton"></input>
                        <input type="submit" class="btn btn-outline-dark mb-2" value="Reset search" name="resetsearch"></input>
                    </div>
                </div>
            </form>
            <a href="{{ route('countries.create') }}" class="ml-auto btn btn-primary mb-2">
                <i class="fas fa-plus mr-2"></i>Create
            </a>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="w-100" style="overflow-x:auto;">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#Id</th>
                            <th scope="col">Country code</th>
                            <th scope="col">Country name</th>
                            <th scope="col" style="text-align:center">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($countries as $country)
                            <tr>
                                <th scope="row"> {{ $country->id }}</th>
                                <td>{{ $country->country_code }}</td>
                                <td>{{ $country->name }}</td>
                                <td style="text-align:center" class="d-flex justify-content-center">
                                    <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-success btn-sm text-center"><i
                                            class="fas fa-edit mr-2"></i>Edit </a>
                                    <form method="POST" action="{{ route('countries.destroy', $country->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm ml-2 text-center delete-button-finder"
                                        onclick="deleteButtonClick(event, this, this.parentElement, '{{ $country->name }}')"
                                        data-confirmation-window-title="{{__('Confirm country deletion from database')}}"
                                        data-confirmation-window-text="{{__('Do you want to delete ').$country->name}}"
                                        data-confirmation-window-button="{{__('Delete')}}">
                                            <i class="fas fa-trash-alt mr-2"></i>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$countries->links()}}
            </div>
        </div>
    </div>
@endsection
