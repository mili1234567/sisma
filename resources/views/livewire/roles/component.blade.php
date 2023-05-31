<div class="main-container">
    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-20">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Basic Tables</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Basic Tables</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                       
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Export List</a>
                                <a class="dropdown-item" href="#">Policies</a>
                                <a class="dropdown-item" href="#">View Assets</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
            <!-- Striped table start -->
            <div class="pd-20 card-box mb-600">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h4 class="text-blue h4">ROLES TABLAS</h4>
                      
                    </div>
                 
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">DESCRIPTION</th>
                            <th scope="col">ACTION</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>
                                    <h6>{{ $role->id }}</h6>
                                </td>
                                <td class="text-center">
                                    <h6>{{ $role->name }}</h6>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" wire:click="Edit({{ $role->id }})"
                                        class="btn btn-dark mtmobile" title="Editar Registro">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0)" onclick="Confirm('{{ $role->id }}')"
                                        class="btn btn-dark" title="Eliminar Registro">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-trash-2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path
                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                            </path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="collapse collapse-box" id="striped-table">
                    <div class="code-box">
                        <div class="clearfix">
                            <a href="javascript:;" class="btn btn-primary btn-sm code-copy pull-left"
                                data-clipboard-target="#striped-table-code"><i class="fa fa-clipboard"></i> Copy
                                Code</a>
                            <a href="#striped-table" class="btn btn-primary btn-sm pull-right" rel="content-y"
                                data-toggle="collapse" role="button"><i class="fa fa-eye-slash"></i> Hide Code</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        @include('livewire.roles.form')
    </div>








    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.livewire.on('role-added', Msg => {
                $('#theModal').modal('hide')
                noty(Msg)
            })
            window.livewire.on('role-updated', Msg => {
                $('#theModal').modal('hide')
                noty(Msg)
            })
            window.livewire.on('role-deleted', Msg => {
                noty(Msg)
            })
            window.livewire.on('role-exists', Msg => {
                noty(Msg)
            })
            window.livewire.on('role-error', Msg => {
                noty(Msg)
            })
            window.livewire.on('hide-modal', Msg => {
                $('#theModal').modal('hide')
            })
            window.livewire.on('show-modal', Msg => {
                $('#theModal').modal('show')
            })
            window.livewire.on('hidden.bs.modal', Msg => {
                $('.er').css('display', 'none')
            })
        });

        function Confirm(id) {
            swal({
                title: 'CONFIRMAR',
                text: "CONFIRMAS ELIMINAR EL REGISTRO?",
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                cancelButtonColor: '#fff',
                confirmButtonColor: '#3B3F5C',
                confirmButtonText: 'Aceptar'
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('deleteRow', id)
                    swal.close()

                }
            });
        }
    </script>
