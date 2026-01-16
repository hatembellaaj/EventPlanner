<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $table = 'ba_registrations';

    protected $primaryKey = 'ba_id';

    public $timestamps = true;

    public const CREATED_AT = 'ba_created_at';

    public const UPDATED_AT = 'ba_updated_at';

    protected $fillable = [
        'ba_user_id',
        'ba_event_id',
    ];

    protected $casts = [
        'ba_created_at' => 'datetime',
        'ba_updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ba_user_id', 'ba_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'ba_event_id', 'ba_id');
    }
}
