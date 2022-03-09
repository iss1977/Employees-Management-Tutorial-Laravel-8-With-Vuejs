@extends('layouts.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 container-fluid">
        <h1 class="h3 mb-0 text-gray-800">Cities</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register new city') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('cities.store') }}">
                            @csrf

                            <!-- Country List-->
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Country') }}</label>
                                <div class="col-md-6">
                                    <!-- Countries Dropdown -->
                                    <select id='select_country' name='country_id' class="custom-select" required
                                        onchange="fetchStates(~~this.value)">
                                        <option value=''>-- Select country --</option>
                                        <!-- Read Countries -->
                                        @foreach ($countries['data'] as $country)
                                            <option class="remove-on-update" value='{{ $country->id }}'>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-none align-items-center" id="country-list-spinner"> <!-- will be displayed via javascript -->
                                    <div class="spinner-border spinner-border-sm" role="status" >
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>

                            <!-- States list -->
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('State') }}</label>
                                <div class="col-md-6">
                                    <!-- States Dropdown -->
                                    <select id='select-state' name='state_id' class="custom-select" required>
                                        <option value='' required disabled selected>-- Select state --</option>
                                    </select>
                                </div>
                            </div>

                            <!-- State name -->
                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('City name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="city_name" autofocus>

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
                                        {{ __('Creaate') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function fetchStates(countryId) {
            $("#country-list-spinner").addClass("d-flex").removeClass("d-none");
            /**
             * once the country was changed, there is no way back if the request fails anyway.
             * first, will remove any state from select > option ( identified by class "remove-on-update")
             * then, build the select > option when response arrives, adding the "remove-on-update" class again for next selection
            */
            $( "#select-state option" ).remove(".remove-on-update");

            if (typeof(countryId) !== 'number') {
                return; //spinner will stay - but it's an error
            }

            $.ajax({
                type: 'POST',
                url: "{{ route('statesofcountry') }}",
                dataType:'json',
                data: {
                    countryId: countryId
                },
                success: function(response) {
                    var len = 0;
                    if (response.states != null) {
                        len = response.states.length;
                    }

                    if (len > 0) {
                        for (var i = 0; i < len; i++) {
                            var id = response.states[i].id;
                            var name = response.states[i].name;
                            var option = `<option value=" ${id}" class="remove-on-update"> ${name} </option>`;
                            $("#select-state").append(option);
                        }
                    }
                    $("#country-list-spinner").addClass("d-none").removeClass("d-flex");
                },
                error: function(response) {
                    console.error(response);
                }
            });
        } // end function
    </script>
@endpush
