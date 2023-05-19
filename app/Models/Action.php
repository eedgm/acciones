<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Action extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'numero',
        'accion',
        'descripcion',
        'statu_id',
        'fecha',
        'prioridad_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function accion()
    {
        return Str::limit($this->accion, 50);
    }

    public function excerpt()
    {
        return Str::limit($this->descripcion, 50);
    }

    public function statu()
    {
        return $this->belongsTo(Statu::class);
    }

    public function prioridad()
    {
        return $this->belongsTo(Prioridad::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function agrupacions()
    {
        return $this->belongsToMany(Agrupacion::class);
    }
}
