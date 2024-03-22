<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_path',
        'attachable_id',
        'attachable_type',
    ];
    public function attachable()
    {
        return $this->morphTo();
    }

    public function getFilePathAttribute($value)
    {
        return Storage::url($value);
    }
}
