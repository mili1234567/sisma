<div wire:ignore.self class="modal fade" id="Medium-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">{{ $componentName }} |
                    {{ $selected_id > 0 ? 'EDITAR' : 'crear' }}</h4>
                <h6 class="text-center text-warning"wire:loading>PORFAVOR ESPERE</h6>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
