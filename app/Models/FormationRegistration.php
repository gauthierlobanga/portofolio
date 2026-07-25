<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormationRegistration extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    public const STATUS_PENDING = 'pending';

    public const STATUS_APPROVED = 'approved';

    public const STATUS_REJECTED = 'rejected';

    public const STATUS_CANCELLED = 'cancelled';

    public const STATUS_WAITLISTED = 'waitlisted';

    public const PAYMENT_FREE = 'free';

    public const PAYMENT_PENDING = 'pending';

    public const PAYMENT_PAID = 'paid';

    public const PAYMENT_FAILED = 'failed';

    public const PAYMENT_REFUNDED = 'refunded';

    public const ATTENDANCE_REGISTERED = 'registered';

    public const ATTENDANCE_ATTENDED = 'attended';

    public const ATTENDANCE_ABSENT = 'absent';

    protected $fillable = [
        'formation_id',
        'user_id',
        'status',
        'payment_status',
        'amount',
        'currency',
        'payment_reference',
        'attendance_status',
        'terms_accepted_at',
        'approved_at',
        'cancelled_at',
        'message',
        'admin_notes',
    ];

    protected $attributes = [
        'status' => self::STATUS_PENDING,
        'payment_status' => self::PAYMENT_FREE,
        'attendance_status' => self::ATTENDANCE_REGISTERED,
        'currency' => 'EUR',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'terms_accepted_at' => 'datetime',
            'approved_at' => 'datetime',
            'cancelled_at' => 'datetime',
        ];
    }

    public function formation(): BelongsTo
    {
        return $this->belongsTo(Formation::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param  Builder<self>  $query
     * @return Builder<self>
     */
    public function scopeActiveForCapacity(Builder $query): Builder
    {
        return $query->whereIn('status', [
            self::STATUS_PENDING,
            self::STATUS_APPROVED,
        ]);
    }

    /**
     * @param  Builder<self>  $query
     * @return Builder<self>
     */
    public function scopeOpen(Builder $query): Builder
    {
        return $query->whereIn('status', [
            self::STATUS_PENDING,
            self::STATUS_APPROVED,
            self::STATUS_WAITLISTED,
        ]);
    }

    public static function statusOptions(): array
    {
        return [
            self::STATUS_PENDING => 'En attente',
            self::STATUS_APPROVED => 'Approuvée',
            self::STATUS_REJECTED => 'Refusée',
            self::STATUS_CANCELLED => 'Annulée',
            self::STATUS_WAITLISTED => 'Liste d’attente',
        ];
    }

    public static function paymentStatusOptions(): array
    {
        return [
            self::PAYMENT_FREE => 'Gratuite',
            self::PAYMENT_PENDING => 'Paiement en attente',
            self::PAYMENT_PAID => 'Payée',
            self::PAYMENT_FAILED => 'Paiement échoué',
            self::PAYMENT_REFUNDED => 'Remboursée',
        ];
    }

    public static function attendanceStatusOptions(): array
    {
        return [
            self::ATTENDANCE_REGISTERED => 'Inscrit',
            self::ATTENDANCE_ATTENDED => 'Présent',
            self::ATTENDANCE_ABSENT => 'Absent',
        ];
    }

    public function isOpen(): bool
    {
        return in_array($this->status, [
            self::STATUS_PENDING,
            self::STATUS_APPROVED,
            self::STATUS_WAITLISTED,
        ], true);
    }
}
