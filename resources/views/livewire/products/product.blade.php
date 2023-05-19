
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">



            <!-- basic table  Start -->

            <!-- basic table  End -->
            <!-- Bordered table  start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h4 class="text-blue h4">PRODUCTOS</h4>
                    </div>
                    <div class="pull-right">
                        <div id="DataTables_Table_0_filter" class="dataTables_filter">
                            <label>Search:<input type="search" class="form-control form-control-sm"
                                    placeholder="Search" aria-controls="DataTables_Table_0">
                            </label>
                        </div>
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">DESCRIPCION</th>
                            <th scope="col">PRECIO</th>
                            <th scope="col">STOCK</th>
                            <th scope="col">IMAGEN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $product)
                            <tr>
                                <td>
                                    {{ $product->name }}
                                </td>
                                <td>
                                    {{ $product->description }}
                                </td>
                                <td>
                                    {{ $product->price }}
                                </td>
                                <td>
                                    {{ $product->stock }}
                                </td>

                                <td class="text-center">
                                    <span>
                                        <img src="{{ asset('storage/products/' . $product->image) }}"alt="imagen"
                                            height="70" width="80" class="rounded">
                                    </span>
                                </td>
                                <td class="text_center">
                                    <a href="javascript:void(0)" wire:click.prevent='Edit({{ $product->id }})'
                                        class="btn btn_dark mtmobile" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" onclick="Confirm('{{ $product->id }}')"
                                        class="btn btn_dark " title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $data->links() }}
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
        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit
                Hingarajiya</a>
        </div>
    </div>













</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {


        //evento de category ocultar
        window.livewire.on('product-added', msg => {
            $('#theModal').modal('hide')
        });
        //evento de categoria actualizar
        window.livewire.on('product-updated', msg => {
            $('#theModal').modal('hide')
        });
        //para escuchar el evento mostrar ventana emergente
        window.livewire.on('product-deleted', msg => {
            //noty
        });
        //evento de categoria actualizar
        window.livewire.on('modal-show', msg => {
            $('#theModal').modal('show')
        });
        //evento de categoria actualizar
        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide')
        });
        //evento de categoria actualizar
        window.livewire.on('hidden.bs.modal', msg => {
            $('.er').css('display', 'none')
        });
    });
</script>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<!-- buttons for Export datatable -->
	<script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="src/plugins/datatables/js/vfs_fonts.js"></script>
	<!-- Datatable Setting js -->
	<script src="vendors/scripts/datatable-setting.js"></script>