<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Balance extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'amount',
        'date',
        'user_id',
        'type',
        'place',
        'updated_at',
        'created_at'
    ];

    /**
     * Get the monthly summary of entries and exits grouped by month.
     *
     * @param int $userId
     * @return \Illuminate\Support\Collection
     */
    public static function getBalanceSummary(int $userId)
    {
        return self::selectRaw("
        SUM(CASE WHEN type = 'E' THEN amount ELSE 0 END) AS expense,
        SUM(CASE WHEN type = 'P' THEN amount ELSE 0 END) AS revenue,
        SUM(amount) AS balance")
            ->where('user_id', $userId)
            ->get();
    }

    public static function getBalanceByMonth(int $userId)
    {
        return self::selectRaw("
        SUM(CASE WHEN type = 'E' THEN amount ELSE 0 END) AS expense,
        SUM(CASE WHEN type = 'P' THEN amount ELSE 0 END) AS revenue,
        MONTH(date) AS month")
            ->where('user_id', $userId)
            ->groupBy('month')
            ->get();
    }
}
