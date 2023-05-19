<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prioridad extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['nombre', 'color'];

    protected $searchableFields = ['*'];

    public function actions()
    {
        return $this->hasMany(Action::class);
    }
}
