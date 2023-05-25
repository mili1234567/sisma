@include('common.modalHead')
<div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <h6>Nombre</h6>
            <input type="text" wire:model.lazy="name" class="form-control">
            @error('name')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <h6>Teléfono</h6>
            <input type="text" wire:model.lazy="phone" class="form-control" maxlength="8">
            @error('phone')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <h6>Email</h6>
            <input type="text" wire:model.lazy="email" class="form-control" placeholder="ej: correo@correo.com">
            @error('email')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" date-type='currency' wire:model.lazy="password" 
            class="form-control" >
            @error('password')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Estatus</label>
            <select wire:model.lazy="status" class="form-control">
                <option value="Elegir" selected>Elegir</option>
                <option value="Active" selected>Activo</option>
                <option value="Locked" selected>Bloqueado</option>
            </select>
            @error('status') <span class="text-danger er">{{$message}}</span>@enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Asignar Role</label>
            <select wire:model.lazy='profile' class="form-control">
                <option value="Elegir"  selected>Elegir</option>
                <option value="Admin" selected>Administrador</option>
                <option value="Employee" selected>Empleado</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
            @error('profile')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    
    <div class="col-sm-12 col-md-12">
        <div class="form-group custom-file">
            <input type="file" class="custom-file-input form-control" wire:model="image"
                accept="image/x-png,image/gif,image/jpeg">
            <label class="custom-file-label">Imagen {{ $image }}</label>
        </div>
    </div>
</div>

@include('common.modalFooter')
