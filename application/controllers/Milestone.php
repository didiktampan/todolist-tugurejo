<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Milestone extends CI_Controller
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
        $data['id_pic'] = $this->input->get('id_pic');
        $data['id'] = $this->input->get('id');
        $data['token'] = $token = AUTHORIZATION::private_token();
        $this->template->load('layouts/Layouts', 'dashboard/V_milestone', $data);
        //print_r($data);
        // die()
    }

    public function detailpinjam()
    {
        $id = $this->uri->segment(3);
        $final = [];
        $result = [];
        $data =  $this->milestone->getMilestone($id);
        $nomor = 0;
        foreach ($data as $key => $value) {
            $nomor++;
            $card = $this->card->getPic($value->ID_PIC);
            $result[] = [
                'nomor' => $nomor,
                'milestonename' => $value->MILESTONENAME,
                'startdate' => $value->STARTDATE,
                'enddate' => $value->ENDDATE,
                'milsestoneprogres' => $value->MILESTONE_PROGRESS,
                'idticket' => $value->ID_TICKET,
                'desctitle' => $value->DESC_TITLE,
                'ticketprogres' => $value->TICKET_PROGRESS,
                'label' => $value->LABEL,
                'tipe' => $value->TIPE,
                'duedate' => $value->DUEDATE,
                'usfullnm' => $value->USFULLNM,
                'jobdesc' => $value->JOBDESC,
                'picprogres' => $value->PIC_PROGRESS,
                'idpic' => $value->ID_PIC,
                'action' => ' 
                <button class="btn btn-success btn-xs" id="btn-detail-card"
                data-idpic="' . $card->ID_TICKET . '">Card</button>
               
                <button class="btn btn-primary btn-xs" id="detailmilestone"
                >Detail</button>'
            ];
        }
        $final = [
            'aaData' => $result
        ];
        return APIRESPONSE::response('', $final);
    }

    public function getPic()
    {
        $id_pic = $this->input->get('id_pic');
        $final = [];
        $result = [];
        $query =  $this->card->getCard($id_pic);
        // print_r($query);
        // die();
        $nomor = 0;
        foreach ($query as $key => $value) {
            $nomor++;
            $result[] = [
                'nomor' => $nomor,
                'idticket' => $value->ID_TICKET,
                'idcard' => $value->ID_CARD,
                'idpic' => $value->ID_PIC,
            ];
        }

        $final = [
            'aaData' => $result
        ];
        return APIRESPONSE::response('', $final);
    }
}

/* End of file Bangsal.php */
