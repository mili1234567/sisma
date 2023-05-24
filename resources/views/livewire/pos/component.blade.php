<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>CATALOGO DE PRODUCTOS</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">UI Cards Hover</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Fade-in effect -->
            <h5 class="h4 text-blue mb-10">Fade-in effect</h5>
            <p class="mb-30">You can use by default <code>.da-overlay</code></p>
            <div class="row clearfix">
            @foreach($lista_productos as $p)
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="da-card">
                        <div class="da-card-photo">
                            <img src="{{asset('storage/products/' .$p->image) }}" alt="">
                            <div class="da-overlay">
                                <div class="da-social">
                                    <ul class="clearfix">
                                        <li><a wire:click="ScanCode({{$p->id}})" href="#"><i class="fa fa-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="da-card-content">
                            <h5 class="h5 mb-10">{{$p->name}}</h5>
                            <p class="mb-0">{{$p->description}}</p>
                        </div>
                    </div>
                </div>
              @endforeach
            </div>

            <!-- Slide Left effect -->
            <h5 class="h4 text-blue mb-10">Slide Left effect</h5>
            <p class="mb-30">You can use by default <code>.da-overlay .da-slide-left</code></p>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                    <div class="da-card">
                        <div class="da-card-photo">
                            @if($total > 0)

            <div class="table-reponsive tblscroll" style="max-height: 650px; overflow: hidden">
                <table class="table table-bordered table-striped mt-1">
                    <thead class="text-white" style="background: #3B3F5C">
                        <tr>
                            <th width="10%"></th>
                            <th class="table-th text-left text-white">DESCRIPCION</th>
                            <th class="table-th text-center text-white">PRECIO</th>
                            <th width="13% class="table-th text-center text-white">CANT</th>
                            <th class="table-th text-center text-white">IMPORTE</th>
                            <th class="table-th text-center text-white">ACTIONS</th>
                        </tr>
                    </thead>
                    <Tbody>
                        @foreach($cart as $item)
                        <tr>
                            <td class="text-center table-th">
                                @if(count($item->attributes) > 0)
                                <span>
                                    <img src="{{asset('storage/products/' .$item->attributes[0]) }}" alt="imagen
                                    de producto" height="90" width="90" class="rounded">
                                </span>
                                @endif
                            </td>
                                <td><h6>{{$item->name}}</h6></td>
                                <td class="text-center">${{number_format($item->price,2)}}</td>
                                <td>
                                    <input type="number" id="r{{$item->id}}"
                                    wire:change="updateQty({{$item->id}},$('#r' + {{$item->id}}).val())"
                                    style="font-size: 1rem!important"
                                    class="form-control text-center"
                                    value="{{$item->quantity}}"
                                    >

                                </td>
                                <td class="text-center">
                                    <h6>
                                        ${{number_format($item->price * $item->quantity,2)}}
                                    </h6>
                            </td>
                            <td class="text-center">
                                <button onclick="Confirm('{{$item->id}}', 'removeItem', 'CONFIRMAS ELIMINAR EL  REGISTRO?')" class="btn btn-dark mbmobile">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                </button>
                                <button wire:click.prevent="decreaseQty({{$item->id}})" class="btn btn-dark mbmobile">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                </button>
                                <button wire:click.prevent="increaseQty({{$item->id}})" class="btn btn-dark mbmobile">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td class="text-center table-th">TOTAL</td>
                            <td colspan="2"></td>
                            <td class="text-center table-th">
                                <h6><b>  {{$this->itemsQuantity}}</b></h6>
                               </td>
                            <td class="text-center table-th">
                             <h6><b>  {{$this->total}}</b></h6>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-success">
                                    GUARDAR
                                </button>
                            </td>
                        </tr>
                    </Tbody>
                    
                </table>
            </div>
            @else
            <h5 class="text-center text-muted">Agregar productos a la venta</h5>
            @endif
                        </div>
                       
                    </div>
                </div>
                
            </div>

            <!-- Slide Right effect -->
            <h5 class="h4 text-blue mb-10">Slide Right effect</h5>
            <p class="mb-30">You can use by default <code>.da-overlay .da-slide-right</code></p>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="da-card">
                        <div class="da-card-photo">
                            <img src="vendors/images/photo1.jpg" alt="">
                            <div class="da-overlay da-slide-right">
                                <div class="da-social">
                                    <ul class="clearfix">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="da-card-content">
                            <h5 class="h5 mb-10">Don H. Rabon</h5>
                            <p class="mb-0">Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="da-card">
                        <div class="da-card-photo">
                            <img src="vendors/images/photo2.jpg" alt="">
                            <div class="da-overlay da-slide-right">
                                <div class="da-social">
                                    <ul class="clearfix">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="da-card-content">
                            <h5 class="h5 mb-10">Don H. Rabon</h5>
                            <p class="mb-0">Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="da-card">
                        <div class="da-card-photo">
                            <img src="vendors/images/photo3.jpg" alt="">
                            <div class="da-overlay da-slide-right">
                                <div class="da-social">
                                    <ul class="clearfix">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="da-card-content">
                            <h5 class="h5 mb-10">Don H. Rabon</h5>
                            <p class="mb-0">Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="da-card">
                        <div class="da-card-photo">
                            <img src="vendors/images/photo4.jpg" alt="">
                            <div class="da-overlay da-slide-right">
                                <div class="da-social">
                                    <ul class="clearfix">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="da-card-content">
                            <h5 class="h5 mb-10">Don H. Rabon</h5>
                            <p class="mb-0">Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide Top effect -->
            <h5 class="h4 text-blue mb-10">Slide Top effect</h5>
            <p class="mb-30">You can use by default <code>.da-overlay .da-slide-top</code></p>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="da-card">
                        <div class="da-card-photo">
                            <img src="vendors/images/photo1.jpg" alt="">
                            <div class="da-overlay da-slide-top">
                                <div class="da-social">
                                    <ul class="clearfix">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="da-card-content">
                            <h5 class="h5 mb-10">Don H. Rabon</h5>
                            <p class="mb-0">Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="da-card">
                        <div class="da-card-photo">
                            <img src="vendors/images/photo2.jpg" alt="">
                            <div class="da-overlay da-slide-top">
                                <div class="da-social">
                                    <ul class="clearfix">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="da-card-content">
                            <h5 class="h5 mb-10">Don H. Rabon</h5>
                            <p class="mb-0">Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="da-card">
                        <div class="da-card-photo">
                            <img src="vendors/images/photo3.jpg" alt="">
                            <div class="da-overlay da-slide-top">
                                <div class="da-social">
                                    <ul class="clearfix">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="da-card-content">
                            <h5 class="h5 mb-10">Don H. Rabon</h5>
                            <p class="mb-0">Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="da-card">
                        <div class="da-card-photo">
                            <img src="vendors/images/photo4.jpg" alt="">
                            <div class="da-overlay da-slide-top">
                                <div class="da-social">
                                    <ul class="clearfix">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="da-card-content">
                            <h5 class="h5 mb-10">Don H. Rabon</h5>
                            <p class="mb-0">Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide Bottom effect -->
            <h5 class="h4 text-blue mb-10">Slide Bottom effect</h5>
            <p class="mb-30">You can use by default <code>.da-overlay .da-slide-bottom</code></p>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="da-card">
                        <div class="da-card-photo">
                            <img src="vendors/images/photo1.jpg" alt="">
                            <div class="da-overlay da-slide-bottom">
                                <div class="da-social">
                                    <ul class="clearfix">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="da-card-content">
                            <h5 class="h5 mb-10">Don H. Rabon</h5>
                            <p class="mb-0">Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="da-card">
                        <div class="da-card-photo">
                            <img src="vendors/images/photo2.jpg" alt="">
                            <div class="da-overlay da-slide-bottom">
                                <div class="da-social">
                                    <ul class="clearfix">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="da-card-content">
                            <h5 class="h5 mb-10">Don H. Rabon</h5>
                            <p class="mb-0">Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="da-card">
                        <div class="da-card-photo">
                            <img src="vendors/images/photo3.jpg" alt="">
                            <div class="da-overlay da-slide-bottom">
                                <div class="da-social">
                                    <ul class="clearfix">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="da-card-content">
                            <h5 class="h5 mb-10">Don H. Rabon</h5>
                            <p class="mb-0">Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="da-card">
                        <div class="da-card-photo">
                            <img src="vendors/images/photo4.jpg" alt="">
                            <div class="da-overlay da-slide-bottom">
                                <div class="da-social">
                                    <ul class="clearfix">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="da-card-content">
                            <h5 class="h5 mb-10">Don H. Rabon</h5>
                            <p class="mb-0">Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
        </div>
    </div>
</div>