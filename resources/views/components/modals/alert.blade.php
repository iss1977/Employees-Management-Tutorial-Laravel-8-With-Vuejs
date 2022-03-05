<template id="delete-confirmation-modal">
    <div class="modal-dialog modal-dialog-centered m-0">
        <!-- Modal -->
        <div class="modal fade" id="confirmation-dialog-modal" tabindex="-1" aria-labelledby="confirmation-dialog"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmation-dialog"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="m-0">Are you sure ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger"
                            onclick="executeFormSubmision()">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


@push('scripts')
    <script>
        console.log('Javascript from Alert Component')

    </script>
@endpush
