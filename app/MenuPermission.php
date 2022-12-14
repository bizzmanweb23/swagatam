<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuPermission extends Model
{
    protected $primaryKey = 'i_menu_permission_id';
    
    const CREATED_AT = 'dt_created_at';
    const UPDATED_AT = 'dt_updated_at';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'i_role_id', 'i_menu_id'
    ];
    
    public function menu()
    {
        return $this->belongsTo('App\Menu', 'i_menu_id');
    }
    
    public function role()
    {
        return $this->belongsTo('App\Role', 'i_role_id');
    }
}
