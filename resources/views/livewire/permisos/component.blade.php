<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{ $componentName}} | {{$pageTitle}}</b>
                </h4>
                <ul class="tabs tab-pills">
                    <li>
                        <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" 
                        data-target="#theModal">Agregar</a>
                    </li>
                </ul>
            </div>
            @include('common.searchbox')
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1" >
                        <thead class="text-white" style="background: #3b3f5c">
                            <tr>
                               <th class="table-th text-white ">ID</th> 
                               <th class="table-th text-white text-center">DECRIPCION</th> 
                               <th class="table-th text-white text-center">ACTIONS</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permisos as $permiso)
                                <tr>
                                    <td><h6>{{$permiso->id}}</h6></td>
                                    <td class="text-center">
                                        <h6>{{$permiso->name}}</h6>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)"
                                        wire:click="Edit({{$permiso->id}})" 
                                        class="btn btn-dark mtmobile" title="Editar Registro">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather 
                                        feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 
                                        2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                        </a>
                                        <a href="javascript:void(0)"
                                        onclick="Confirm('{{$permiso->id}}')"
                                        class="btn btn-dark" title="Eliminar Registro">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather 
                                        feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 
                                        1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> 
                   
                </div>
            </div>
        </div>
    </div>
    @include('livewire.permisos.form')
</div>
{{-- .................................................................................................... --}}




{{-- .................................................................................................... --}}


<script>
    document.addEventListener('DOMContentLoaded', function()
    {
        window.livewire.on('permiso-added', msg=>{
            $('#theModal').modal('hide')
            noty(msg)
        });

        window.livewire.on('permiso-updated', msg=>{
            $('#theModal').modal('hide')
            noty(msg)
        });

        window.livewire.on('permiso-deleted', msg=>{
            noty(msg)
        });

        window.livewire.on('permiso-exists', msg=>{
            noty(msg)
        });

        window.livewire.on('permiso-error', msg=>{
            noty(msg)
        });

        window.livewire.on('hide-modal', msg=>{
            $('#theModal').modal('hide')
        });

        window.livewire.on('show-modal', msg=>{
            $('#theModal').modal('show')
        });

    });

    function Confirm(id){
        swal({
            title: 'CONFIRMAR',
            text: '¿CONFIRMAS ELIMINAR  EL REGISTRO',
            type: 'WARNING',
            showCancelButton: true,
            cancelButtonText: 'cerrar',
            cancelButtonColor: '#fff',
            confirmButtonColor: '#3b3f5c',
            confirmButtonText: 'Aceptar'
        }).then(function(result){
            if(result.value){
                window.livewire.emit('destroy',id)
                swal.close()
            }
        })
    }
</script>