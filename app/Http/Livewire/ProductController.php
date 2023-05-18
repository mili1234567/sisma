<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductController extends Component
{
    public function render()
    {
        $products ='';
        
        return view('livewire.products.product', [
            'data'=> $products,
           
        ])
        
        //plantillas que suaremos
        ->extends('layouts.theme.app')
        //el contenido
        ->section('content');
    }

}
