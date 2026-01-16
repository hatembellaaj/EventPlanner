<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'ba_categories';

    protected $primaryKey = 'ba_id';

    public $timestamps = true;

    public const CREATED_AT = 'ba_created_at';

    public const UPDATED_AT = 'ba_updated_at';

    protected $fillable = [
        'ba_name',
    ];

    protected $casts = [
        'ba_created_at' => 'datetime',
        'ba_updated_at' => 'datetime',
    ];

    public function events()
    {
        return $this->hasMany(Event::class, 'ba_category_id', 'ba_id');
    }
}
