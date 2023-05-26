<?php

namespace App\Http\Livewire;

use App\Models\Denomination;
use App\Models\Product;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Livewire\Component;
use DB;
use Exception;
use Illuminate\Support\Facades\Redirect;

class PosController extends Component
{
    public $total,$itemsQuantity, $efectivo, $change;

    public function mount()
    {
        $this->efectivo =0;
        $this->change =0;
        $this->total= cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
    }

    public function render()
    {
        $lista_productos=Product::all();
        return view('livewire.pos.component',[
            'lista_productos' =>$lista_productos, 
            'cart' => Cart::getContent()->sortBy('name')
        ])
        -> extends('layouts.theme.app')
        ->section('content');
    }

    public function ACash($value)
    {
        $this->efectivo += ($value == 0 ? $this->total : $value);
        $this->change = ($this->efectivo - $this->total);
    }

    protected $listeners =[
        'scan-code' => 'ScanCode',
        'removeItem' => 'removeItem',
        'clearCart' => 'clearCart',
        'saveSale' => 'saveSale'
    ];

    public function ScanCode($idproducto, $cant = 1)
    {
        
        
        $product = product::find($idproducto);
        if($product == null /* || empty($empty) */)
        {
            $this->emit('scan-notfound','El producto no esta registrado');
        }
        else
        {
            if($this->InCart($product->id))
            {
                $this->increaseQty($product->id);
                return;
            }
            if($product->stock < 1)
            {
                $this->emit('no-stock','Stock insuficiente :(');
                return;
            }
            
            cart::add($product->id, $product->name, $product->price, $cant, $product->image);
            //metodo del carrito que devuelve el total precio
            $this->total = cart::getTotal();

            $this->emit('scan-ok','Producto agregado');
        }
    }

    public function InCart($productId)
    {
        $exit = Cart::get($productId);
        if($exit)
        return true;
        else
        return false;
    }

    public function increaseQty($productId, $cant = 1)
    {
        $title='';
        $product = Product::find($productId);
        $exist = Cart::get($productId);
        if($exist)
        $title = 'cantidad actualizada';
        else
        $title = 'producto agregado';

        if($exist)
        {
            if($product->stock < ($cant + $exist->quantity))
            {
                $this->emit('no-stock','stock insuficiente :(');
            }
        }

        Cart::add($product->id, $product->name, $product->price, $cant, $product->image);

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', $title);

    }

    public function updateQty($productId,$cant = 1)
    {
        $title='';
        $product = Product::find($productId);
        $exist = Cart::get($productId);
        if($exist)
        $title = 'cantidad actualizada';
        else
        $title = 'producto agregado';

        if($exist)
        {
            if($product->stock < $cant)
            {
                $this->emit('no-stock','Stock insuficiente :(');
                return;
            }
        }

        $this->removeItem($productId);
        
        if($cant > 0)
        {
            cart::add($product->id, $product->name, $product->price, $cant, $product->image);

            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();

            $this->emit('scan-ok', $title);

        }
    }

    public function removeItem($productId)
    {
        Cart::remove($productId);

        $this->total = cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', 'Producto eliminado');
    }

    public function decreaseQty($productId)
    {
        $item = Cart::get($productId);
        Cart::remove($productId);

        $newQty = ($item->quantity) - 1;

        if($newQty > 0)
            Cart::add($item->id, $item->name, $item->price, $newQty, $item->attributes[0]);


        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok', 'Cantidad actualizada');
    }

    public function clearCart()
    {
        cart::clear();
        $this->efectivo =0;
        $this->change =0;
        $this->total = cart::getTotal();
        $this->itemsQuantity = cart::getTotalQuantity();

        $this->emit('scan-ok','carrito vacio');
    }

    public function saveSale()
    {
        if($this->total <=0)
        {
            $this->emit('sale-error','AGREGAR PRODUCTOS A LA VENTA');
            return;
        }
        if($this->efectivo <=0)
        {
            $this->emit('sale-error','INGRESA EL EFECTIVO');
            return;
        }
        if($this->total > $this->efectivo)
        {
            $this->emit('sale-error','EL EFECTIVO DEBE SER MAYOR O IGUAL AL TOTAL');
            return;
        }
        DB::beginTransaction();

        try{
            $sale = sale:: create([
                'total' => $this->total,
                'items' => $this->itemsQuantity,
                'cash' => $this->efectivo,
                'change' => $this->change,
                'user_id' => Auth()->user()->id
            ]);
            if($sale)
            {
                $items = Cart::getcontent();
                foreach ($items as $item) {
                    SaleDetail::create([
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'product_id' => $item->id,
                        'sale_' => $sale->id,
                    ]);
                    
                    //update stock
                    $product = product::find($item->id);
                    $product->stoxk = $product->stock - $item->quantity;
                    $product->save();
                }
            }

            DB::commit();

            Cart::clear();
            $this->efectivo =0;
            $this->change =0;
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('sale-ok','Venta registrada con exito');
            $this->emit('print-ticket', '$sale->id');

        } catch (Exception $e) {
            DB::rollback();
            $this->emit('sale-error',$e->getMessage());
        }
    }

    public function printTicket($sale)
    {
        return Redirect::to("print://$sale->id");
    }
    
    //selecciona el p;roducto para anadir al carritpo
    public function guardarcarrito()
    {
        dd('hola');
    }
}
