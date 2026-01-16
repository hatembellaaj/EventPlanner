<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'ba_users';

    protected $primaryKey = 'ba_id';

    public $timestamps = true;

    public const CREATED_AT = 'ba_created_at';

    public const UPDATED_AT = 'ba_updated_at';

    protected $fillable = [
        'ba_name',
        'ba_email',
        'ba_password',
        'ba_role',
    ];

    protected $hidden = [
        'ba_password',
    ];

    protected $casts = [
        'ba_created_at' => 'datetime',
        'ba_updated_at' => 'datetime',
    ];

    public function getAuthPassword(): string
    {
        return $this->ba_password;
    }

    public function createdEvents()
    {
        return $this->hasMany(Event::class, 'ba_created_by', 'ba_id');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'ba_registrations', 'ba_user_id', 'ba_event_id', 'ba_id', 'ba_id')
            ->withTimestamps();
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'ba_user_id', 'ba_id');
    }
}
