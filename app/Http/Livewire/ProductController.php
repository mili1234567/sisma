<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
class ProductController extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $name, $description, $price, $stock, $search, $image, $selected_id, $PageTitle, $componentName;

    private $pagination = 100;

    public function mount()
    {
        $this->PageTitle = 'listado';
        $this->componentName = 'productos';
        
    }
    public function render()
    {
        if (strlen($this->search) > 0){
        $products = Product::select('products.*','name')
        ->where('products.name','like','%' . $this->search . '%')
        ->orWhere('products.description','like','%' . $this->search . '%')
        ->orderBy('products.name','asc')
        ->paginate($this->pagination);}
        else $products = Product::
        select('products.*','name')
        ->orderBy('products.name','asc')
        ->paginate($this->pagination);
        
        return view('livewire.products.product', [
            'data'=> $products,
           
        ])
        
        //plantillas que suaremos
        ->extends('layouts.theme.app')
        //el contenido
        ->section('content');
    }
    
    //store
    public function Store(){
        $rule=[
            'name' => 'required|unique:products|min:3',
           
            'price' => 'required',
            'stock' => 'required',
            
            

        ];
        
        $messages=[

            'name.required'=>'nombre del producto requerido',
            'name.unique'=>'Ya existe el nombre del producto',
            'name.min'=>'el nombre del producto debe btener almenos 3 caracteres',
            'price.required'=>'el precio es requerido',
            'stock.required'=>'el stok es requerido',
        ];

        $this->validate($rule,$messages);
       
        $product = Product::create([
            'name'=>$this->name,
            'description'=>$this->description,
            'price'=>$this->price,
            'stock'=>$this->stock,
        ]);

        if($this->image)
        {
            
            $customFileName=uniqid() .'_.' .$this->image->extension();
            $this->image->storeAs('public/products',$customFileName);
            $product->image=$customFileName;
            $product->save();
        }
        $this->resetUI();
      //  $this->emit('product-added','producto registrado');
    }
    
   
    public function resetUI(){

    }


}
