 @include('common.modalHead')

<div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" wire:model.lazy='name' class="form-control" placeholder='Ejemplo: Curso Laravel'>
            @error('name')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label for="">DESCRIPCION</label>
            <input type="text" wire:model.lazy='description' class="form-control" placeholder='Ejemplo: 100000'>
            @error('description')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

  

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label for="">Precio</label>
            <input type="text" data-type='currency' wire:model.lazy='price' class="form-control" placeholder='Ejemplo: 100000'>
            @error('price')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label for="">Stock</label>
            <input type="number" wire:model.lazy='stock' class="form-control" placeholder='Ejemplo: 100000'>
            @error('stock')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

   



    


    <div class="col-sm-12 col-md-4">
        <div class="form-group custom-file">
            <input type="file" class="custom-file-input form-control" wire:model="image" accept="image/x-png,image/gif,image/jpeg">
            <label class="custom-file-label">imagen {{$image}}</label>
        
            @error('image')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
        </div>
    </div>


    
</div>





@include('common.modalFooter') 













             
             

       