@extends('layouts.main')


{{-- Include flash messages if any --}}
@section('flash-messages')
    @include('partials.flash-message')
@endsection

@section('content')

    <div id="app">
        <exployees-index></exployees-index>
    </div>

@endsection
