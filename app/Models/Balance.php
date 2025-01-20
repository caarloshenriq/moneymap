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
    public static function getMonthlySummary(int $userId)
    {
        return self::selectRaw("
                DATE_FORMAT(date, '%Y-%m') as month,
                SUM(CASE WHEN type = 'P' THEN amount ELSE 0 END) as total_entries,
                SUM(CASE WHEN type = 'E' THEN amount ELSE 0 END) as total_exits
            ")
            ->where('user_id', $userId)
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->get();
    }
}
