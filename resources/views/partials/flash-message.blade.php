<div class="container-fluid position-relative p-0 m-0 d-flex  flex-column align-items-center"
    style="width:100%; height:0;z-index:5000; overflow:visible">

    <div class="toast-alerts-container">
        <div class="toast fade " >
            <div class="toast-header">
                <strong class="mr-auto text-primary">Toast Header</strong>
                <small class="text-muted">5 mins ago</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">×</button>
            </div>
            <div class="toast-body">
                Some text inside the toast body that will determin how wide the toast is
            </div>
        </div>
    </div>

    <div class="toast-alerts-container">
        <div class="toast fade " >
            <div class="toast-header">
                <strong class="mr-auto text-primary">Toast Header</strong>
                <small class="text-muted">5 mins ago</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">×</button>
            </div>
            <div class="toast-body">
                Some text inside the toast body that will determin how wide the toast is
            </div>
        </div>
    </div>


</div>

<div>
<p>
    The value of session Hello is {{ $request->session()->get('hello', 'world'); }}
</p>

<hr>
@foreach (Session::get('array2sendtoview') as $arrayElement)
    {{$arrayElement}}
@endforeach


</div>



@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        Please check the form below for errors
    </div>
@endif


@push('scripts')
    {{-- <script>
        $(document).ready(function() {
            $(".alert").delay(3000).slideUp(300);

            $('.toast').toast('show');

        });
        console.log('Hide');
    </script> --}}

    <script>
        $(document).ready(function() {
            $('.toast').toast({
                animation: true,
                autohide: true,
                delay : 3000
                });
            $('.toast').toast('show');
        });
    </script>
@endpush

@push('other-css')
<style>
    .toast-alerts-container {
        width: max-content;
        margin-top: 1rem;
    }

</style>
@endpush
