<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kyslik\ColumnSortable\Sortable;

class EmployeeRecords extends Authenticatable 
{
    use Notifiable;
    use Sortable;

    protected $table = 'employees_records';
    protected $primaryKey = 'unique_user_record'; //'CONCAT(i_user_id,"-", s_role_key)';

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



    // public function getAuthPassword()
    // {
    //   return $this->password;
    // }

    protected $username = 's_username';
    
    // public function role()
    // {
    //     return $this->belongsTo('App\Role', 'i_role_id');
    // }









    public function getRememberToken()
    {
        return null; // not supported
    }

    public function setRememberToken($value)
    {
        // not supported
    }

    public function getRememberTokenName()
    {
        return null; // not supported
    }

    /**
    * Overrides the method to ignore the remember token.
    */
    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if (!$isRememberTokenAttribute)
        {
            parent::setAttribute($key, $value);
        }
    }
   
}





// namespace App;

// use Illuminate\Notifications\Notifiable;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Kyslik\ColumnSortable\Sortable;

// class User extends Authenticatable
// {
//     use Notifiable;
//     use Sortable;

//     protected $primaryKey = 'i_user_id';
    
//     //const CREATED_AT = 'dt_created_at';
//     //const UPDATED_AT = 'dt_updated_at';
    
    
//     protected $fillable = [
//         'i_role_id','s_role_key','s_first_name', 's_last_name', 's_email', 'password', 's_phone_number'
//     ];
    
//     public $sortable = ['s_first_name', 's_last_name', 's_email', 's_role'];

//     /**
//      * The attributes that should be hidden for arrays.
//      *
//      * @var array
//      */
//     protected $hidden = [
//         'password'
//     ];

//     protected $username = 's_username';
    
//     public function role()
//     {
//         return $this->belongsTo('App\Role', 'i_role_id');
//     }
// }



