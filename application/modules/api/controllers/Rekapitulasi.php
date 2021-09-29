<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rekapitulasi extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('rekapitulasi_model');
    }
    

    public function index()
    {
        echo 'api rekap';
    }

    public function totalPasientByMonth()
    {
        $month = $this->input->get('bulan');
        $bulan = str_replace('/', '-', $month);
        $token = $this->input->get_request_header('X-private-token');
        $validation = AUTHORIZATION::implementation('GET', $token);
        if(!isset($month) || $month === ''){
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => "Tanggal tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if($validation === true){
            $data = $this->rekapitulasi_model->totalPasientByMonth(date('Y-m', strtotime($bulan)));
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => 'rekap pasien mitigasi'
                ],
                'response' => $data
            ];
        } else {
            $res = $validation;
        }
        return APIRESPONSE::response('', $res);
    }

}

/* End of file Rekapitulasi.php */
