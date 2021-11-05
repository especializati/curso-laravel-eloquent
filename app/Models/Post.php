<?php

namespace App\Models;

use App\Accessors\DefaultAccessors;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, DefaultAccessors;

    protected $fillable = ['user_id', 'title', 'body', 'date'];

    protected $casts = [
        'date' => 'datetime:d/m/Y',
        'active' => 'boolean'
    ];

    // protected $table = 'postagens';
    // protected $primaryKey = 'id_postagem';
    // protected $keyType = 'string';
    // protected $incrementing = false;
    // protected $timestamps = true;
    // const CREATED_AT = 'data_criacao';
    // const UPDATED_AT = 'data_atualizacao';
    // protected $dateFormat = 'd/m/Y';
    // protected $connection = 'pgsql';
    // protected $attributes = [
    //     'active' => true
    // ];

    // public function getTitleAttribute($value)
    // {
    //     return strtoupper($value);
    // }

    // public function getTitleAndBodyAttribute()
    // {
    //     return $this->title . ' - ' . $this->body; 
    // }

    // public function getDateAttribute($value)
    // {
    //     return Carbon::make($value)->format('d/m/Y');
    // }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::make($value)->format('Y-m-d');
    }
}
