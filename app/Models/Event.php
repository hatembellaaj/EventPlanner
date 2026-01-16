<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    use HasFactory;

    protected $table = 'ba_events';

    protected $primaryKey = 'ba_id';

    public $timestamps = true;

    public const CREATED_AT = 'ba_created_at';

    public const UPDATED_AT = 'ba_updated_at';

    protected $fillable = [
        'ba_title',
        'ba_description',
        'ba_start_date',
        'ba_end_date',
        'ba_place',
        'ba_capacity',
        'ba_price',
        'ba_is_free',
        'ba_image',
        'ba_status',
        'ba_category_id',
        'ba_created_by',
    ];

    protected $casts = [
        'ba_start_date' => 'datetime',
        'ba_end_date' => 'datetime',
        'ba_is_free' => 'boolean',
        'ba_capacity' => 'integer',
        'ba_price' => 'decimal:2',
        'ba_created_at' => 'datetime',
        'ba_updated_at' => 'datetime',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'ba_created_by', 'ba_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'ba_category_id', 'ba_id');
    }

    public function attendees()
    {
        return $this->belongsToMany(User::class, 'ba_registrations', 'ba_event_id', 'ba_user_id', 'ba_id', 'ba_id')
            ->withTimestamps();
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'ba_event_id', 'ba_id');
    }

    public function remainingSeats(): int
    {
        $capacity = (int) $this->ba_capacity;

        return max(0, $capacity - $this->registrations()->count());
    }

    public function isFull(): bool
    {
        return $this->remainingSeats() <= 0;
    }

    public function imageUrl(): ?string
    {
        if (! $this->ba_image) {
            return null;
        }

        return Storage::disk('public')->url($this->ba_image);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('ba_status', 'active');
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('ba_start_date', '>=', now());
    }

    public function scopeFilterByQuery(Builder $query, ?string $search): Builder
    {
        if (! $search) {
            return $query;
        }

        return $query->where(function (Builder $innerQuery) use ($search) {
            $innerQuery->where('ba_title', 'like', "%{$search}%")
                ->orWhere('ba_description', 'like', "%{$search}%")
                ->orWhere('ba_place', 'like', "%{$search}%");
        });
    }

    public function scopeFilterByCategory(Builder $query, ?int $categoryId): Builder
    {
        if (! $categoryId) {
            return $query;
        }

        return $query->where('ba_category_id', $categoryId);
    }

    public function scopeFilterFree(Builder $query, ?bool $isFree): Builder
    {
        if ($isFree === null) {
            return $query;
        }

        return $query->where('ba_is_free', $isFree);
    }
}
