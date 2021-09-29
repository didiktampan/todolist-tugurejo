<?php
class APIRESPONSE
{
    public static function response($header, $arr)
    {
        $ci =& get_instance();
        if($header !== ''){
            $ci->output->set_status_header($header);
        }
		$ci->output->set_content_type('application/json');
		$ci->output->set_output(json_encode($arr));
    }

    public static function requestMethod()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
            case 'GET':
                $req = 'get';
                break;
            case 'POST':
                $req = 'store';
                break;
            case 'PUT': 
                $req = 'put';
                break;
            case 'DELETE':
                $req = 'delete';
                break;
            default:
                $req = 'get';
                break;
        }
        return $req;
    }
}