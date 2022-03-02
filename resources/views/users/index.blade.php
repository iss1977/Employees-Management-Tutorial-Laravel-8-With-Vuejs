@extends('layouts.main')


{{-- Include flash messages if any --}}
@section('flash-messages')
    @include('partials.flash-message')
@endsection



@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 container-fluid">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>


    <div class="container-fluid">

        @if (session()->has('message'))
            <div class="row">
                <div class="alert alert-success w-100 text-center">
                    {{ session('message') }}
                </div>
            </div>
        @endif
        @if (session()->has('warning'))
            <div class="row">
                <div class="alert alert-warning w-100 text-center">
                    {{ session('warning') }}
                </div>
            </div>
        @endif



        <div class="row">
            <div class="card mx-auto col-12 col-md-8 px-0">
                <div class="card-header ">
                    <div class="container d-flex">
                    <a href="{{ route('users.create') }}" class="ml-auto btn btn-sm btn-primary">
                        <i class="fas fa-plus mr-2"></i>Create
                    </a>
                </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="card-body" style="overflow-x:auto;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#Id</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col" style="text-align:center">Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <th scope="row"> {{ $user->id }}</th>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td style="text-align:center" class="d-flex justify-content-center">
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit mr-2"></i>Edit </a>
                                                <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button href="#" type="submit" class="btn btn-danger btn-sm ml-2"><i class="fas fa-trash-alt mr-2"></i>Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
