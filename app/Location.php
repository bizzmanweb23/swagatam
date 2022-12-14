<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 
use Kyslik\ColumnSortable\Sortable;

class Location extends Model
{
    use Sortable;
    protected $primaryKey = 'i_location_id'; 
    //
    protected $fillable = ['i_company_id', 's_location_name', 's_iata_code', 's_icao_code', 's_lat','s_long','s_address1','s_address2','s_city','s_state','s_zipcode','i_country_id','e_status','e_is_delete','created_at','updated_at'];
    
    public $sortable = ['s_location_name', 's_iata_code', 's_icao_code', 's_city', 's_state', 's_zipcode'];
     
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
