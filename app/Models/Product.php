<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'stock', 'image'];


    public function getImagenAttribute()

    {
        if ($this->image != null)
            return (file_exists('storage/products/' . $this->image) ? $this->image :'noimg.jpg');
        else {
            return 'noimg.jpg';
        }
    }
}
