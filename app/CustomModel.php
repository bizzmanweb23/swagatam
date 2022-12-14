<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomModel extends Model 
{


	public function get_where_raw( $sql = '' )
	{
		if( $sql )
		{
			$results = DB::select($sql);

			if( count( $results ) > 0 )
			{
				if( is_array( $results ) )
					return $results;
				else
					return $results->toArray();
			}
		}
		return [];
	}


	public function insert_data( $table = '', $data = [] )
	{
		if( !empty( $data ) && $table != '' )
		{
      		$user_id = DB::table($table)->insertGetId( $data );

      		return $user_id;
		}

		return false;
	}


	public function update_data( $table = '', $id = 0, $data = [] )
	{
		if( $id && !empty( $data ) && $table )
		{
			$results = DB::table( $table )
                     ->where( ['i_id'=>$id] )
                     ->update( $data );

		    return $results;
		}
		return fasle;
	}


	public function delete_data( $table = '' ,$id = '' ,$condition = '')
	{
		if( $table && $condition && $id)
		{
			$results = DB::table($table)
                     ->where( ['i_id'=>$id] )
                     ->update($field);

		    return $results;
		
		}
		return false;
	}



	public function insert_where_raw( $sql = '' )
	{
		if( $sql )
		{
			$results = DB::insert($sql);

			if( $results->count() > 0 )
			{
				if( is_array( $results ) )
					return $results;
				else
					return $results->toArray();
			}
		}
		return [];
	}


	


	public function update_item( $table = '' ,$field = '' ,$condition = '')
	{
		if( $table && $condition && $field)
		{
			$results = DB::table($table)
                     ->where($condition)
                     ->update($field);

		    return $results;
		
		}
		return false;
	}


	public function delete_item( $table = '' ,$field = '' ,$condition = '')
	{
		if( $table && $condition && $field)
		{
			$results = DB::table($table)
                     ->where($condition)
                     ->update($field);

		    return $results;
		
		}
		return false;
	}

}
