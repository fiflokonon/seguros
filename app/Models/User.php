<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\CustomVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'profile_picture',
        'sex',
        'city',
        'role_id',
        'district',
        'province',
        'id_passport',
        'address',
        'password',
        'verified_email',
        'status'
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

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function permissions()
    {
        if ($this->role) {
            return $this->role->permissions;
        }

        return collect(); // Retourner une collection vide si l'utilisateur n'a pas de rôle défini.
    }

    public function permissionCodes()
    {
        return $this->permissions()->pluck('code')->unique()->toArray();
    }

    public function canDo(string $code)
    {
        if (in_array($code, $this->permissionCodes()))
            return true;
        else
            return false;
    }

    public function is_admin()
    {
        if ($this->role()->code == 'admin'){
            return true;
        }else{
            return false;
        }
    }

    public function is_active()
    {
        if ($this->status){
            return true;
        }else{
            return false;
        }
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
}
