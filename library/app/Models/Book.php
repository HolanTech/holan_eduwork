<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{

    public function publisher()
    {

        return $this->belongsTo('App\Models\Publisher', 'publisher_id');
    }
    public function author()
    {

        return $this->belongsTo('App\Models\Author', 'author_id');
    }
    public function catalog()
    {

        return $this->belongsTo('App\Models\Author', 'catalog_id');
    }
}
