<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Monolog\Logger;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_types_id',
        'document',
        'name',
        'email',
        'password',
        'roles_id',
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

    public static function findForPassport($username)
    {
        return static::where('document', $username)->first();
    }

    public function getBusinessList($request)
    {
        $filter = $request->filter;
        $businessList = $this->where('roles_id', 1);
        if (isset($filter)) {
            $businessList->where(function ($query) use ($filter) {
                $query->where('document', 'LIKE', "%$filter%")
                    ->orWhere('name', 'LIKE', "%$filter%");
            });
        }
        $businessList = $businessList->orderBy('name', 'asc')->get();
        return $businessList;
    }
}
