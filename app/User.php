<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use Sortable;
	
	protected $connection = 'common_database';
	
    protected $primaryKey = 'i_user_id';
    
    //const CREATED_AT = 'dt_created_at';
    //const UPDATED_AT = 'dt_updated_at';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'i_role_id','s_role_key','s_first_name', 's_last_name', 's_email', 'password', 's_phone_number'
    ];
    
    public $sortable = ['s_first_name', 's_last_name', 's_email', 's_role'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    protected $username = 's_username';
    
    public function role()
    {
        return $this->belongsTo('App\Role', 'i_role_id');
    }
	
	public function user_role()
    {
        return $this->belongsTo('App\User_role', 'i_user_id', 'i_user_id');
    }
    
    /*public function is_admin()
    {
        if ($this->admin)
        {
            return true;
        }
        return false;
    }*/
}
