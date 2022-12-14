<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class User_role extends Model
{
    use Sortable;
    
    protected $primaryKey = 'i_user_role_id';
    
    const CREATED_AT = 'dt_created_at';
    const UPDATED_AT = 'dt_updated_at';
}
