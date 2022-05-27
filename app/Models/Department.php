<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'faculty_id',
    ];

    /**
     * A department as many cards
     *
     * @return mixed
     */
    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    /**
     * A department has many users(staffs/students)
     *
     * @return mixed
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * A department belongs to a  faculty
     *
     * @return mixed
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

}
