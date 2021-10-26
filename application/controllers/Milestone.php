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
        // $data['idd'] = $this->input->get('idd');
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

            $value->TICKET_PROGRESS === 100.00;
            if ($value->TICKET_PROGRESS > 75.00) {
                $progresmilestone = '<div class="progress-group">Ticket Progress
                        <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width:' . $value->TICKET_PROGRESS . '%"></div>  
                        </div>
                        <span class="float-right">' . $value->TICKET_PROGRESS . '/100.00</span>
                    </div>
                    ';
            } else if ($value->TICKET_PROGRESS > 50.00) {
                $progresmilestone = '<div class="progress-group">Ticket Progress
                        <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width:' . $value->TICKET_PROGRESS . '%"></div>  
                        </div>
                        <span class="float-right">' . $value->TICKET_PROGRESS . '/100.00</span>
                    </div>
                    ';
            } else if ($value->TICKET_PROGRESS > 25.00) {
                $progresmilestone = '<div class="progress-group">Ticket Progress
                        <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width:' . $value->TICKET_PROGRESS . '%"></div>  
                        </div>
                        <span class="float-right">' . $value->TICKET_PROGRESS . '/100.00</span>
                    </div>
                    ';
            } else if ($value->TICKET_PROGRESS > 0) {
                $progresmilestone = '<div class="progress-group">Ticket Progress
                <div class="progress progress-sm">
                <div class="progress-bar bg-danger" style="width:' . $value->TICKET_PROGRESS . '%"></div>  
                </div>
                <span class="float-right">' . $value->TICKET_PROGRESS . '/100.00</span>
            </div>
            ';
            } else if ($value->TICKET_PROGRESS < 1) {
                $progresmilestone = '<div class="progress-group">Ticket Progress
                        <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width:' . $value->TICKET_PROGRESS . '%"></div>  
                        </div>
                        <span class="float-right">' . $value->TICKET_PROGRESS . '/100.00</span>
                    </div>
                    ';
            }

            if ($value->MILESTONENAME = 'null') {
                $milestonename = '<span class="btn btn-outline-secondary btn-xs disabled">Empty Data' . '</span>';
            }

            $value->STARTDATE === $tanggalmulai = date('d/m/Y', strtotime($value->STARTDATE));
            $value->ENDDATE === $tanggalselesai = date('d/m/Y', strtotime($value->ENDDATE));
            $value->DUEDATE === $finished = date('d/m/Y', strtotime($value->DUEDATE));

            $result[] = [
                'nomor' => $nomor,
                'milestonename' => $milestonename,
                'startdate' => $tanggalmulai,
                'enddate' => $tanggalselesai,
                'milsestoneprogres' => $progresmilestone,
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
                <button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Detail"
                id="btn-detail"
                data-milestonename="' . $value->MILESTONENAME . '"
                data-startdate="' . $value->STARTDATE . '"
                data-enddate="' . $value->ENDDATE . '"
                data-milestoneprogres="' . $value->MILESTONE_PROGRESS . '"
                data-idticket="' . $value->ID_TICKET . '"
                data-desctitle="' . $value->DESC_TITLE . '"
                data-ticketprogres="' . $value->TICKET_PROGRESS . '"
                data-label="' . $value->LABEL . '"
                data-tipe="' . $value->TIPE . '"
                data-usfullnm="' . $value->USFULLNM . '"
                data-jobdesc="' . $value->JOBDESC . '"
                data-picprogres="' . $value->PIC_PROGRESS . '"
                data-idpic="' . $value->ID_PIC . '"
                data-duedate="' . $finished . '"
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
        $idd = $this->input->get('id_pic');
        $final = [];
        $result = [];
        $query =  $this->card->getCard($idd);
        // echo json_encode($query);
        // return;
        $nomor = 0;
        foreach ($query as $key => $value) {
            $nomor++;

            $value->PROGRESS === 100.00;
            if ($value->PROGRESS > 75.00) {
                $progres = '<div class="progress-group">Card Progress
                <div class="progress progress-sm">
                <div class="progress-bar bg-success" style="width:' . $value->PROGRESS . '%"></div>  
                </div>
                <span class="float-right">' . $value->PROGRESS . '/100.00</span>
            </div>
            ';
            } else if ($value->PROGRESS > 50.00) {
                $progres = '<div class="progress-group">Card Progress
                <div class="progress progress-sm">
                <div class="progress-bar bg-primary" style="width:' . $value->PROGRESS . '%"></div>  
                </div>
                <span class="float-right">' . $value->PROGRESS . '/100.00</span>
            </div>
            ';
            } else if ($value->PROGRESS > 25.00) {
                $progres = '<div class="progress-group">Card Progress
                <div class="progress progress-sm">
                <div class="progress-bar bg-warning" style="width:' . $value->PROGRESS . '%"></div>  
                </div>
                <span class="float-right">' . $value->PROGRESS . '/100.00</span>
            </div>
            ';
            } else if ($value->PROGRESS > 0) {
                $progres = '<div class="progress-group">Card Progress
                <div class="progress progress-sm">
                <div class="progress-bar bg-danger" style="width:' . $value->PROGRESS . '%"></div>  
                </div>
                <span class="float-right">' . $value->PROGRESS . '/100.00</span>
            </div>
            ';
            } else if ($value->PROGRESS < 1) {
                $progres = '<div class="progress-group">Card Progress
                <div class="progress progress-sm">
                <div class="progress-bar bg-danger" style="width:' . $value->PROGRESS . '%"></div>  
                </div>
                <span class="float-right">' . $value->PROGRESS . '/100.00</span>
            </div>
            ';
            }

            $result[] = [
                'nomor' => $nomor,
                'desctitle' => $value->DESC_TITLE,
                'desccomplain' => $value->DESC_COMPLAIN,
                'progres' => $progres,
                'idcard' => $value->ID_CARD,
                'titlecard' => $value->TITLE_CARD,
                'status' => $value->STATUS,
                'skpdetail' => $value->SKP_DETAIL,
            ];
        }

        $final = [
            'aaData' => $result
        ];
        return APIRESPONSE::response('', $final);
    }
}

/* End of file Bangsal.php */
