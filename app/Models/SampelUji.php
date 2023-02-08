<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampelUji extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $keyType = 'string';
    protected $table = 'sampel_uji';
    protected $guarded = [];

    public function param()
    {
        return $this->hasOne(Parameter::class, 'id', 'id_parameter');
    }
}
