<?php

namespace App\Models;

use App\Models\Rekening;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataTarget extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $keyType = 'string';
    protected $table = 'data_target';
    protected $guarded = [];

    public function rekening()
    {
        return $this->belongsTo(Rekening::class, 'id_rek', 'id');
    }
}
