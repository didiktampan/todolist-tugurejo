<?php
class AUTHORIZATION
{
    public static function validateTimestamp($token)
    {
        $CI =& get_instance();
        $token = self::validateToken($token);
        if ($token != false && (now() - $token->timestamp < ($CI->config->item('token_timeout') * 60))) {
            return $token;
        }
        return false;
    }

    public static function validateToken($token)
    {
        $CI =& get_instance();
		try {
			return JWT::decode($token, $CI->config->item('jwt_key'));
		} catch (Exception $e) {
			return false;
		}
    }

    public static function generateToken($data)
    {
        $CI =& get_instance();
        return JWT::encode($data, $CI->config->item('jwt_key'));
    }

    public static function TimeExpiredToken($token){
        $CI =& get_instance();
        $now = now();
        $token = AUTHORIZATION::validateToken($token);
		if($token !== false){
			$token_timestamp = $token->timestamp;
			$check = $now - $token_timestamp;
			$timeoutversi_new = 1 * 18000;
			//$final = $check < $timeoutversi_new ? $data = array('status' => true, 'token' => $token) : $data = array('status' => false);
			if($check < $timeoutversi_new){
				return $token;
			} else {
				return false;
			}
		} else {
			return false;
		} 
    }
	
	public static function implementation($method, $token){	
		$CI =& get_instance();
		if($_SERVER['REQUEST_METHOD'] === $method ){
			$headers['Authorization'] = $token;
			if($headers['Authorization'] != null ){
				$decodedToken = AUTHORIZATION::TimeExpiredToken($headers['Authorization']);
					if($decodedToken != false){
						$res = true;
					} else {
						header("HTTP/1.1 404");
						$res = [
							'metadata' => ['message' => 'Token Expired', 'code' => 404]
						];
					}
			} else {
				header("HTTP/1.1 400");
				$res = [
					'metadata' => ['message' => 'Bad Request', 'code' => 400]
				];
			}
		} else {
			header("HTTP/1.1 405");
			$res = [
				'metadata' => ['message' => 'Method Not Allowed', 'code' => 405]
			];
		}
		return $res;
	}
	
	public static function getBearerToken($token) {
		$headers = $token;
		// HEADER: Get the access token from the header
		if (!empty($headers)) {
			if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
				return $matches[1];
			}
		}
		return null;
	}
	
	public static function private_token()
	{
		$tokenData = array();
        $tokenData['id'] = 1; //TODO: Replace with data for token
		$tokenData['name'] = 'Tugurejo';
        $tokenData['timestamp'] = now();
        $output = AUTHORIZATION::generateToken($tokenData);
        
        return $output;
    }
	
	public static function authLocal($token, $method){
		$CI =& get_instance();
		$idrs           = "15137";
		$Key            = "rs55ud98tgrj";
		$data           = $idrs;
		$signature   	= hash_hmac('sha256', $data, $Key, true);
		$encSign		= base64_encode($signature);
		if($_SERVER['REQUEST_METHOD'] === $method ){
			if($token != null ){	
				if($encSign === $token){
					$res = TRUE;
				} else {
					header("HTTP/1.1 404");
					$res = [
						'metadata' => ['message' => 'Token Invalid', 'code' => 404]
					];
				}
			} else {
				header("HTTP/1.1 400");
				$res = [
					'metadata' => ['message' => 'Bad Request', 'code' => 400]
				];
			}
		} else {
			header("HTTP/1.1 405");
			$res = [
				'metadata' => ['message' => 'Method Not Allowed', 'code' => 405]
			];
		}
		return $res;
	}
}