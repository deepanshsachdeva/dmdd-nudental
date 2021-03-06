<?php

namespace App\Models;

use DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "user";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = "user_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getIsAdminAttribute() {
        $result = DB::select("select user_id from [user] inner join role on [user].role_id = role.role_id where [user].user_id = ? and role.name = ?", [$this->user_id, 'System Admin']);
        
        return head($result);
    }

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['role'];

    /**
     * Relationships
     * 
     */
    public function role() {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }
}
