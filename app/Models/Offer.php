<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public function offers()
    {
        return get.table('ofertas');
    }
}