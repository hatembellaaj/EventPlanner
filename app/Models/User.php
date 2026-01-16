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
}
