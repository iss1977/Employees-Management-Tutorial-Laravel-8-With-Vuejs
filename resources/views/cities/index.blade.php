@extends('layouts.main')

{{-- Include flash messages if any --}}
@section('flash-messages')
    @include('partials.flash-message')
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 container-fluid">
        <h1 class="h3 mb-0 text-gray-800">Cities</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>

    </div>

    <div class="container">
        <div class="row flex-nowrap">
            <form action="{{ route('cities.index') }}" method="GET">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <label class="sr-only" for="inlineFormInput">City</label>
                        <input type="text" class="form-control mb-2 flex-shrink-1 " id="inlineFormInput"
                            placeholder="search for name of state" name="search" value="{{ $searchValue }}">
                    </div>
                    <div class="col-auto">
                        <input type="submit" class="btn btn-primary mb-2" value="Search" name="searchbutton"></input>
                        <input type="submit" class="btn btn-outline-dark mb-2" value="Reset search"
                            name="resetsearch"></input>
                    </div>
                </div>
            </form>
            <a href="{{ route('cities.create') }}" class="ml-auto btn btn-primary mb-2">
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
                            <th scope="col">City name</th>
                            <th scope="col">State name</th>
                            <th scope="col">Country </th>
                            <th scope="col" style="text-align:center">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cities as $city)
                            <tr>
                                <th scope="row"> {{ $city->id }}</th>
                                <td>{{ $city->name }}</td>
                                <td>{{ $city->state->name }}</td>
                                <td>{{ $city->state->country->name }}</td>
                                <td style="text-align:center" class="d-flex justify-content-center">
                                    <a href="{{ route('cities.edit', ['city' => $city->id]) }}"
                                        class="btn btn-success btn-sm text-center"><i class="fas fa-edit mr-2"></i>Edit </a>
                                    <form method="POST" action="{{ route('cities.destroy', $city->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-danger btn-sm ml-2 text-center delete-button-finder"
                                            onclick="deleteButtonClick(event, this, this.parentElement, '{{ $city->name }}')"
                                            data-confirmation-window-title="{{ __('Confirm city deletion from database') }}"
                                            data-confirmation-window-text="{{ __('Do you want to delete ') . $city->name }}"
                                            data-confirmation-window-button="{{ __('Delete') }}">
                                            <i class="fas fa-trash-alt mr-2"></i>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $cities->links() }}
            </div>
        </div>
    </div>

@endsection
