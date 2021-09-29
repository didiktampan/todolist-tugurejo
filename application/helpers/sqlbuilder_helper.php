<?php

class SQLBUILDER
{
    public static function manageSql($table, $obj, $request, $key, $value){
        $CI =& get_instance();
        if($request === 'post'){
            $ex = $CI->db->insert($table, $obj);
        } else if($request === 'update'){
            $ex = $CI->db->where($key, $value)->update($table, $obj);
        } else if($request === 'delete') {
            $ex = $CI->db->where($key, $value)->delete($table);
        } else {
            $ex = $CI->db->select($key)->get($table)->result();
        }
        return $ex;
    }

    public static function checkDuplicated($table, $key, $value)
    {
        $CI =& get_instance();
        $count = $CI->db->where($key, $value)->get($table)->result();
        return $count;
    }

    public static function getWhere($table, $field, $key, $value)
    {
        $CI =& get_instance();
        $CI->db->select($field);
        if($value !== 'all'){
            $CI->db->like($key, $value, 'both');
        }
        $count = $CI->db->get($table)->result();
        return $count;
    }
    
}