<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\HotelFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'name',
        'address',
        'description'
    ];

    /**
     * ファクトリのインスタンスを返す
     * 
     * @return HotelFactory
     */
    protected static function newFactory(): HotelFactory
    {
        return HotelFactory::new();
    }

    /**
     * ホテルに属する部屋群
     * 
     * @return HasMany
     */
    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }
}
