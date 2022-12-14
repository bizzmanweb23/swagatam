<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Role extends Model
{
    use Sortable;
    
    protected $primaryKey = 'i_role_id';
    
    const CREATED_AT = 'dt_created_at';
    const UPDATED_AT = 'dt_updated_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        's_role', 's_role_key', 'e_status'
    ];
    
    public $sortable = ['s_role', 'i_location_type'];
    
    public function permission()
    {
        return $this->hasMany('App\MenuPermission', 'i_role_id');
    }
}
