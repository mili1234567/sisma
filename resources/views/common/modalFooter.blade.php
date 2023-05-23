{{-- </div>
<div class="modal-footer">
<button type="button" wire:click.prevent="resetUI()"  class="btn btn-dark close-btn 
text-info"data-dismiss="modal"
>CERRAR</button> 
@if($selected_id < 1)
<button type="button" wire:click.prevent="Store()"  class="btn btn-dark close-modal"
>GUARDAR</button> 
@else
<button type="button" wire:click.prevent="Update()"  class="btn btn-dark close-modal"
>ACTUALIZAR</button> 
@endif
</div>
</div>
</div>
</div> --}}


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
   @if($selected_id < 1)
<button type="button" wire:click.prevent="Store()"  data-dismiss="modal" class="btn btn-dark close-modal"
>GUARDAR</button> 
@else
<button type="button" wire:click.prevent="Update()"  data-dismiss="modal" class="btn btn-dark close-modal"
>ACTUALIZAR</button> 
@endif</div>
</div>
</div>
</div>