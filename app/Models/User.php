<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'other_name',
        'identity_no',
        'uuid',
        'email',
        'password',
        'faculty_id',
        'department_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * A user has many cards
     *
     * @return mixed
     */
    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    /**
     * A user has many transactions
     *
     * @return mixed
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * A user belongs to a faculty
     *
     * @return mixed
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    /**
     * A user belongs to a department
     *
     * @return mixed
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    private static function generateUUID(): string
    {
       $uuid = Str::uuid();
        if (self::where('uuid',$uuid)->first()){
            self::generateUUID();
        }
        return $uuid;
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function($model) {
             $model->uuid = self::generateUUID();
        });
    }

}
