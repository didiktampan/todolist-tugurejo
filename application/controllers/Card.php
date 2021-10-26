<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Card extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('isLogin') != TRUE) {
            redirect('Auth');
        }
    }

    public function index()
    {
        // $data['id_pic'] = $this->input->get('id_pic');
        $data['idd'] = $this->input->get('idd');
        $data['token'] = $token = AUTHORIZATION::private_token();
        $this->template->load('layouts/Layouts', 'dashboard/V_milestone', $data);
        // echo json_encode($data['id_pic']);
        // return;
    }

    public function detailCard()
    {
        $id = $this->uri->segment(3);
        $final = [];
        $result = [];
        $data =  $this->card->getCard($id);
        $nomor = 0;
        foreach ($data as $key => $value) {
            $nomor++;
            $result[] = [
                'nomor' => $nomor,
                'idticket' => $value->ID_TICKET,
                'desctitle' => $value->DESC_TITLE,
                'desccomplain' => $value->DESC_COMPLAIN,
                'progres' => $value->PROGRESS,
                'idcard' => $value->ID_CARD,
                'titlecard' => $value->TITLE_CARD,
                'status' => $value->STATUS,
                'idskp' => $value->ID_SKP,
                'skpdetail' => $value->SKP_DETAIL,
                'action' => ' 
             '
            ];
        }
        $final = [
            'aaData' => $result
        ];
        return APIRESPONSE::response('', $final);
    }


    public function getPic()
    {
        $idd = $this->uri->segment(3);
        $final = [];
        $result = [];
        $query =  $this->card->getCard($idd);
        echo json_encode($query);
        return;
        // print_r($query);
        // die();
        $nomor = 0;
        foreach ($query as $key => $value) {
            $nomor++;
            $result[] = [
                'nomor' => $nomor,
                'idticket' => $value->ID_TICKET,
                'idcard' => $value->ID_CARD,
            ];
        }

        $final = [
            'aaData' => $result
        ];
        return APIRESPONSE::response('', $final);
    }
}

/* End of file Bangsal.php */
