<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Branch;

class Section extends Model implements HasMedia
{

    use InteractsWithMedia;

    protected $fillable = [
        'section_name',
        'branch_id',
        'description',
        'status',
        'pic',
        'Created_by',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }


}
