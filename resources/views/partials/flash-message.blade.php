<!-- Blade for Toast messages  -->
<!-- $notifications must be an array of associative arrays -->

<?php
    $notifications = Session::get('notifications', []);
?>



<div class="container-fluid position-relative p-0 m-0 d-flex  flex-column align-items-center"
    style="width:100%; height:0;z-index:5000; overflow:visible">

    <div class="toast-alerts-container">

        @if (isset($notifications) && is_array($notifications))
            @foreach ($notifications as $notification)
                @if (is_array($notification))

                    {{-- Toaster card --}}
                    <div class="toast fade show">
                        <div class="toast-header">
                            @if (array_key_exists('type', $notification))
                                @switch($notification['type'])
                                    @case('success')
                                        <i class="fas fa-check-circle text-success"></i>
                                    @break

                                    @case('danger')
                                        <i class="fas fa-exclamation-circle text-danger"></i>
                                    @break

                                    @case('warning')
                                        <i class="fas fa-exclamation-triangle text-warning"></i>
                                    @break

                                    @case('info')
                                        <i class="fas fa-info-circle text-info"></i>
                                    @break

                                    @default
                                        <i class="fas fa-braille"></i>
                                @endswitch
                            @endif

                            @if (array_key_exists('title', $notification))
                                <strong class="ml-2 text-primary">{{ $notification['title'] }}</strong>
                            @else
                                <strong class="ml-2 text-primary">{{ config('app.name') }}</strong>
                            @endif

                            <button type="button" class="ml-auto mb-1 close" data-dismiss="toast">×</button>
                        </div>
                        <div class="toast-body">
                            @if (array_key_exists('message', $notification))
                                {{ $notification['message'] }}
                            @else
                                {{ config('app.name') }}
                            @endif
                        </div>
                    </div>

                    {{-- End toaster card --}}
                @endif
            @endforeach
        @endif
    </div>
</div>

{{-- scripts to be added to the main blade --}}
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.toast').toast({
                animation: true,
                autohide: true,
                delay: 3000
            });
            $('.toast').toast('show');
        });
    </script>
@endpush

{{-- style to be added to the main blade --}}
@push('other-css')
    <style>
        .toast-alerts-container {
            min-width: 480px;
            width: max-content;
            margin-top: 1rem;
        }
    </style>
@endpush
