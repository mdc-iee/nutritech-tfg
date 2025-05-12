<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Recipe extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'instructions'
    ];

    /**
     * Relation with User where it may or may not belong to a user
     */
    public function user() {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * Relation ManyToMany with Ingredient
     */
    public function ingredients() {
        return $this->belongsToMany(Ingredient::class)->withTimestamps();
    }
}
