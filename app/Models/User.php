<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    public $timestamps = true;
    protected $table = 'users';
    protected $primaryKey = 'user_id'; 
    public $incrementing = true; 
    protected $keyType = 'int';

    protected $fillable = [
        'user_full_name',
        'user_name',
        'user_email',
        'user_password',
        'user_level',
        'user_area_id', 
        'user_outlet_id', 
        'has_full_access', 
    ];

    protected $hidden = [
        'user_password',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->user_password;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Relasi ke tabel `area`.
     */
    public function area()
    {
        return $this->belongsTo(Area::class, 'user_area_id');
    }

    /**
     * Relasi ke tabel `outlet`.
     */
    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'user_outlet_id');
    }
    

    /**
     * Cek apakah user memiliki akses penuh.
     *
     * @return bool
     */
    public function hasFullAccess()
    {
        return $this->has_full_access;
    }

    /**
     * Dapatkan area terkait jika user tidak memiliki akses penuh.
     *
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function getAccessibleAreas()
    {
        return $this->has_full_access ? Area::all() : $this->area()->get(); 
    }
}
