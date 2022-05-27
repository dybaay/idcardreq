<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * A faculty has many departments
     * @return mixed
     */
    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    /**
     * A faculty has many users(students/staffs)
     * @return mixed
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * A faculty has many cards
     * @return mixed
     */
    public function cards()
    {
        return $this->hasMany(Card::class);
    }

}
