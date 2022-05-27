<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class Tours extends Model
{
    use SoftDeletes;
    use Filterable;
    protected $dates = ['deleted_at'];
    protected $table = 'tours';
    protected $fillable = ['start', 'end', 'price'];
    private static $whiteListFilter =['start', 'end', 'price'];
}

