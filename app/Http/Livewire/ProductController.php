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

   
    public function render()
    {
        $products = Product::paginate($this->pagination);
        
        return view('livewire.products.product', [
            'data'=> $products,
           
        ])
        
        //plantillas que suaremos
        ->extends('layouts.theme.app')
        //el contenido
        ->section('content');
    }

}
