<div class="main-container">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}}</b>
                </h4>
            </div>
            
            <div class="">
                <div class="form-inline">
                    <div class="form-group mr-5">
                        <select wire:model="role" class="form-control">
                            <option value="Elegir" selected>== Seleccione el Role ==</option>
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button wire:click.prevent="SyncALL()" type="button" 
                    class="btn btn-dark mbmobile inblock mr-5" style="background-color: rgb(175, 121, 163)">Sincronizar Todos</button>

                    <button onclick="Revocar()" type="button" 
                    class="btn btn-dark mbmobile mr-5" style="background-color: rgb(175, 121, 163)">Revocar Todos</button>
                </div>

                <div class="row mt-3">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table striped mt-1" >
                                <thead class="text-white" style="background-color: rgb(175, 121, 163)">
                                    <tr>
                                       <th class="table-th text-white text-center">ID</th> 
                                       <th class="table-th text-white text-center">PERMISO</th> 
                                       <th class="table-th text-white text-center">ROLES CON EL PERMISO</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($permisos as $permiso)
                                    <tr>
                                        <td><h6 class="text-center">{{$permiso->id}}</h6></td>
                                        <td class="text-center">
                                            <div class="n-check">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                    <input type="checkbox"
                                                    wire:change="syncPermiso($('#p' + {{$permiso->id}}).is(':checked'),
                                                     '{{$permiso->name}}' )"
                                                    id="p{{$permiso->id}}"
                                                    value="{{$permiso->id}}"
                                                    class="new-control-input"
                                                    {{$permiso->checked == 1 ? 'checked' : '' }}
                                                    >
                                                    <span class="new-control-indicator"></span>
                                                    <h6>{{$permiso->name}}</h6>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <h6>{{ \App\Models\User::permission($permiso->name)->count() }}</h6>
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
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        window.livewire.on('sync-error', msg=>{
            noty(msg)
        });

        window.livewire.on('permi', msg=>{
            noty(msg)
        });

        window.livewire.on('syncall', msg=>{
            noty(msg)
        });

        window.livewire.on('removeall', msg=>{
            noty(msg, 3)
        });
    });

    function Revocar(){
        swal({
            title: 'CONFIRMAR',
            text: '¿CONFIRMAS REVOCAR TODO LOS PERMISOS',
            type: 'WARNING',
            showCancelButton: true,
            cancelButtonText: 'cerrar',
            cancelButtonColor: '#fff',
            confirmButtonColor: '#3b3f5c',
            confirmButtonText: 'Aceptar'
        }).then(function(result){
            if(result.value){
                window.livewire.emit('revokeall')
                swal.close()
            }
        })
    }
</script>

