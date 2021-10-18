<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
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

        $data['token'] = $token = AUTHORIZATION::private_token();
        $this->template->load('layouts/Layouts', 'dashboard/V_project', $data);
        // $this->template->load('layouts/Layouts', 'dashboard/td_Dashboard', $data);
    }

    // public function select2RS()
    // {
    //     $projectname = $this->input->get('search');
    //     $projectid = $this->session->userdata('projectid');
    //     $data = $this->bangsal->searchBangsal($projectname, $projectid);
    //     // $result = [];
    //     // foreach ($data as $key => $value) {
    //     //     $result[] = ['id' => $value->kode_bangsal, 'text' => $value->nama_bangsal];
    //     // }
    //     return APIRESPONSE::response('', $data);
    // }

    public function dataProject()
    {
        // $id = $this->input->get('id');
        // $tglawal = $this->input->get('awal');
        // $awal = str_replace('/', '-', $tglawal);
        // $tglakhir = $this->input->get('akhir');
        // $akhir = str_replace('/', '-', $tglakhir);
        // $search = $this->input->get('search');
        // $data = $this->project->getDataPasien(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir)),);

        $final = [];
        $result = [];
        $data = $this->project->getProject();
        $nomor = 0;

        foreach ($data as $key => $value) {
            $nomor++;
            $detail = $this->project->getProjectdetail($value->PROJECTID);
            if ($value->PROJECTSTS === 'Open') {
                $statusproject = '<span class="badge badge-primary">' . $value->PROJECTSTS . '</span>';
            } else if ($value->PROJECTSTS === 'Selesai') {
                $statusproject = '<span class="badge badge-success">' . $value->PROJECTSTS . '</span>';
            } else {
                $statusproject = '<span class="badge badge-success">' . $value->PROJECTSTS . '</span>';
            }

            $value->PROGRESS === 100.00;
            if ($value->PROGRESS > 75.00) {
                $progres = '<div class="progress progress-sm">
                            <div class="progress-bar bg-success" style="width:' . $value->PROGRESS . '%">  
                        </div>
                    </div>';
            } else if ($value->PROGRESS > 50.00) {
                $progres = '<div class="progress progress-sm">
                            <div class="progress-bar bg-primary" style="width:' . $value->PROGRESS . '%">
                        </div>
                    </div>';
            } else if ($value->PROGRESS > 25.00) {
                $progres = '<div class="progress progress-sm">
                            <div class="progress-bar bg-primary" style="width:' . $value->PROGRESS . '%">
                        </div>
                    </div>';
            } else if ($value->PROGRESS > 0) {
                $progres = '<div class="progress progress-sm">
                            <div class="progress-bar bg-primary" style="width:' . $value->PROGRESS . '%">
                        </div>
                    </div>';
            } else if ($value->PROGRESS < 1) {
                $progres = '<div class="progress progress-sm">
                            <div class="progress-bar bg-danger" style="width:0%">
                        </div>
                    </div>';
            }

            $value->STARTDATE === $tanggalmulai = date('d/m/Y', strtotime($value->STARTDATE));
            $value->ENDDATE === $tanggalselesai = date('d/m/Y', strtotime($value->ENDDATE));
            $value->PROJECTSTS === 'O' ? $open = 'Open' : $open = 'Open';

            $result[] = [
                'nomor' => $nomor,
                'projectid' => $value->PROJECTID,
                'projectname' => $value->PROJECTNAME,
                'pic' => $value->PIC,
                'projectsts' => $statusproject,
                'progress' => $progres,
                'enginer' => $value->ENGINEER,
                'startdate' => $value->STARTDATE,
                'enddate' => $value->ENDDATE,
                'action' => '
                <a  href="' . base_url('Milestone/detailpinjam/' . $value->PROJECTID . '?pinjam=yes') . '" class="btn btn-primary btn-xs" title="detail pinjam">
                    <i class="fa fa-eye"></i></a>
                    <button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Detail"
                    id="btn-detail"
                    data-projectid="' . $detail->PROJECTID . '"
                    data-projectname="' . $detail->PROJECTNAME . '"
                    data-projectdesc="' . $detail->PROJECTDESC . '"
                    data-tglsuratmasuk="' . $detail->TGLSURATMASUK . '"
                    data-nosurat="' . $detail->NOSURAT . '"
                    data-tglsurat="' . $detail->TGLSURAT . '"
                    data-pic="' . $detail->PIC . '"
                    data-progres="' . $detail->PROGRESS . '"
                    data-projectsts="' . $open . '"
                    data-startdate="' . $tanggalmulai . '"
                    data-enddate="' . $tanggalselesai . '">
                <i class="fa fa-book-open"></i>'
            ];
            // print_r($detail);
            // die();
        }
        $final = [
            'aaData' => $result
        ];
        return APIRESPONSE::response('', $final);
    }

    public function detailpinjam()
    {

        $id = $this->uri->segment(3);
        // echo $id;
        // return;
        // $this->data['idbo'] = $this->session->userdata('ses_id');
        // $id = $this->db->get('ID_TICKET');
        // if ($this->session->userdata('TIPUSER') == 'DEV') {
        // $cek = $this->db->get_where('SDP_PROJECT', [
        //     'PROJECTID' => $id,
        // ]);

        $final = [];
        $result = [];
        $data =  $this->project->getMilestone($id);
        $nomor = 0;
        foreach ($data as $key => $value) {
            $nomor++;
            $result[] = [
                'nomor' => $nomor,
                'milestonename' => $value->MILESTONENAME,
                'idticket' => $value->ID_TICKET,
                'action' => ''
            ];
        }
        $final = [
            'aaData' => $result
        ];
        return APIRESPONSE::response('', $final);



        // $data = $cek->num_rows();
        // $this->data['komplen'] = $cek->result_array();
        // print_r($data);
        // die();
        // if ($data > 0) {
        // $this->data['pinjam'] = $this->db->query(
        // "SELECT TOP 200 * FROM SDP_COMPLAIN_PIC WHERE ID_TICKET = '$id'"
        // )->result_array();

        // print_r($this->data['pinjam']);
        // die();
        // } else {
        // echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="' . base_url('Project') . '"</script>';
        // }
        // } else {
        // $data = $this->M_Admin->CountTableId('sdp_complain', 'ID_TICKET', $id);
        // if ($data > 0) {
        //     $this->data['pinjam'] = $this->db->query("SELECT * FROM sdp_complain WHERE ID_TICKET = '$id'")->row();
        // } else {
        //     echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="' . base_url('transaksi') . '"</script>';
        // }
        // }
        // $this->template->load('layouts/Layouts', 'dashboard/V_reportPIC', $this->data);
    }
}

/* End of file Bangsal.php */
