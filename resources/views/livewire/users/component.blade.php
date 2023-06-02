<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">



            <!-- basic table  Start -->

            <!-- basic table  End -->
            <!-- Bordered table  start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h4 style="color: rgb(175, 121, 163)" class=" h4">USUARIOS</h4>
                    </div>

                </div>

                <div class="row">
                    <div class="col-6">
                        @Include('common.searchbox')
                    </div>

                    @can('users.create')
                        <div class="col-6 text-right">
                            <a href="javascript:void(0)" class="btn" style="background-color: rgb(175, 121, 163); color: aliceblue;"
                                data-toggle="modal" data-target="#Medium-modal">Agregar</a>
                        </div>
                    @endcan
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">TELEFONO</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">PERFIL</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">IMAGEN</th>
                            <th scope="col">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $users)
                            <tr>
                                <td>
                                    {{ $users->name }}
                                </td>
                                <td>
                                    {{ $users->phone }}
                                </td>
                                <td>
                                    {{ $users->email }}
                                </td>
                                <td>
                                    {{ $users->profile }}
                                </td>

                                <td class="text-center">
                                    <span
                                        class="badge {{ $users->status == 'ACTIVE' ? 'badge-success' : 'badge-danger' }} text-uppercase">{{ $users->status }}</span>
                                </td>

                                <td class="text-center">
                                    <span>
                                        <img src="{{ asset('storage/usuarios/' . $users->image) }}"alt="imagen"
                                            height="70" width="80" class="rounded">
                                    </span>
                                </td>

                                <td class="text-center">
                                    @can('users.edit')
                                    <a href="javascript:void(0)" style="background-color: rgb(175, 121, 163)"  wire:click.prevent="Edit({{ $users->id }})"
                                        class="btn btn-dark mtmobile" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </a>
                                    @endcan
                                    <a href="javascript:void(0)" onclick="Confirmar('{{ $users->id }}')"
                                        class="btn btn-dark"  style="background-color: rgb(175, 121, 163)" title="Delete">
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



                <div class="collapse collapse-box" id="border-table">
                    <div class="code-box">
                        <div class="clearfix">
                            <a href="javascript:;" class="btn btn-primary btn-sm code-copy pull-left"
                                data-clipboard-target="#border-table-code"><i class="fa fa-clipboard"></i> Copy Code</a>
                            <a href="#border-table" class="btn btn-primary btn-sm pull-right" rel="content-y"
                                data-toggle="collapse" role="button"><i class="fa fa-eye-slash"></i> Hide Code</a>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Contextual classes End -->
        

    @include('livewire.users.form')

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {


        //evento de category ocultar
        window.livewire.on('users-added', msg => {
            alert('hola')
            $('#Medium-modal').modal('hide')
        });
        //evento de categoria actualizar
        window.livewire.on('users-updated', msg => {
            $('#Medium-modal').modal('hide')
        });
        //para escuchar el evento mostrar ventana emergente
        window.livewire.on('users-deleted', msg => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        });
        //evento de categoria actualizar
        window.livewire.on('modal-show', msg => {
            $('#Medium-modal').modal('show')
        });
        //evento de categoria actualizar
        window.livewire.on('modal-hide', msg => {
            $('#Medium-modal').modal('hide')
        });
        //evento de categoria actualizar
        window.livewire.on('hidden.bs.modal', msg => {
            $('.er').css('display', 'none')
        });
    });


    function Confirmar(id) {
    alert('hola');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
    }
</script>

