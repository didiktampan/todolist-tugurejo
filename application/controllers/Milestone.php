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
    }

    public function detailpinjam()
    {
        $id = $this->uri->segment(3);
        $final = [];
        $result = [];
        $data =  $this->milestone->getMilestone($id);
        // $card = $this->card->getPic($id_pic);
        // echo json_encode($card);
        // return;
        $nomor = 0;
        foreach ($data as $key => $value) {
            $nomor++;

            // echo json_encode($card[0]->ID_TICKET);
            // return;
            // if ($value->ID_TICKET === 'Open') {
            //     $statusproject = '<span class="badge badge-primary">' . $value->PROJECTSTS . '</span>';
            // } else if ($value->PROJECTSTS === 'Selesai') {
            //     $statusproject = '<span class="badge badge-success">' . $value->PROJECTSTS . '</span>';
            // } else {
            //     $statusproject = '<span class="badge badge-success">' . $value->PROJECTSTS . '</span>';
            // }

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
                data-idpic="' . $value->ID_PIC . '">Card</button>
                <a  href="' . base_url('Card/' . '?id=' . $value->ID_PIC) . '" class="btn btn-success btn-xs" title="detail milestone">
                Card2</a>
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
        // $id_pic = $this->input->get('id_pic');
        $id_pic = $this->uri->segment(4);
        $final = [];
        $result = [];
        $query =  $this->card->getCard($id_pic);
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
                // 'idpic' => $value->ID_PIC,
            ];
        }

        $final = [
            'aaData' => $result
        ];
        return APIRESPONSE::response('', $final);
    }
}

/* End of file Bangsal.php */
