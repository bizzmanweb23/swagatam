<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $primaryKey = 'i_menu_id';
    
    const CREATED_AT = 'dt_created_at';
    const UPDATED_AT = 'dt_updated_at';
    
    public function parent_menu()
    {
        return $this->hasOne('App\Menu', 'i_menu_id', 'i_parent_id');
    }
}
