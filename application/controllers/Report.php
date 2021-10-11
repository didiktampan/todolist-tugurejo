<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //validasi jika user belum login
        $this->data['CI'] = &get_instance();
        $this->load->helper(array('form', 'url'));
        $this->load->model('M_tdDashboard');
        if ($this->session->userdata('isLogin') != TRUE) {
            redirect('Auth');
        }
    }

    public function index()
    {
        if ($this->session->userdata('isLogin') != TRUE) {
            redirect('Auth');
        } else {
            $this->data['pinjam'] = $this->db->query("SELECT * FROM SDP_COMPLAIN ORDER BY 'DATE_INPUT' DESC");
            $this->data['OpenComplain'] = $this->db->query("SELECT TOP 10 * FROM SDP_COMPLAIN WHERE STATUS = 'O' ORDER BY DATE_INPUT ASC");
            $this->data['ProgresComplain'] = $this->db->query("SELECT TOP 10 * FROM SDP_COMPLAIN WHERE STATUS = 'P' ORDER BY DATE_INPUT ASC");
            $this->data['ClosedComplain'] = $this->db->query("SELECT TOP 10 * FROM SDP_COMPLAIN WHERE STATUS = 'C' ORDER BY DATE_INPUT ASC");
            $this->template->load('layouts/Layouts', 'dashboard/V_report', $this->data);
        }
        // $data['token'] = $token = AUTHORIZATION::private_token();
        // $this->template->load('layouts/Layouts', 'dashboard/V_report2', $data);
    }

    public function dataReport()
    {
        $final = [];
        $result = [];
        $data = $this->report->getReport();
        $nomor = 0;
        foreach ($data as $key => $value) {
            $nomor++;
            $result[] = [
                'nomor' => $nomor,
                'desctitle' => $value->DESC_TITLE,
                'status' => $value->STATUS,
                'progres' => $value->PROGRESS,
                'datevalid' => $value->DATE_VALID,
                'action' => '
               
             
              '
            ];
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
        $cek = $this->db->get_where('SDP_COMPLAIN', [
            'ID_TICKET' => $id,
            // 'USLOGNM' => $this->session->userdata('USLOGNM')
        ]);

        $data = $cek->num_rows();
        $this->data['komplen'] = $cek->result_array();
        // print_r($data);
        // die();
        if ($data > 0) {
            $this->data['pinjam'] = $this->db->query(
                "SELECT TOP 200 * FROM SDP_COMPLAIN_PIC WHERE ID_TICKET = '$id'"
            )->result_array();

            // print_r($this->data['pinjam']);
            // die();
        } else {
            echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="' . base_url('Report') . '"</script>';
        }
        // } else {
        // $data = $this->M_Admin->CountTableId('sdp_complain', 'ID_TICKET', $id);
        // if ($data > 0) {
        //     $this->data['pinjam'] = $this->db->query("SELECT * FROM sdp_complain WHERE ID_TICKET = '$id'")->row();
        // } else {
        //     echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="' . base_url('transaksi') . '"</script>';
        // }
        // }
        $this->template->load('layouts/Layouts', 'dashboard/V_reportPIC', $this->data);
    }

    public function get_tiket()
    {
        $post = $this->input->post();
        $id = $post['id_ticket'];
        $html = '';

        $query = $this->db->query("SELECT * FROM sdp_complain_card WHERE ID_TICKET='$id' ORDER BY ID_CARD ASC")->result_array();
        $no = 1;
        foreach ($query as $data) {
            $html .= '  <tr>
                            <td>' . $no . '</td>
                            <td>' . $data['TITLE_CARD'] . '</td>
                            <td>' . $data['DESC_CARD'] . '</td>
                            <td>' . $data['ID_SKP'] . '</td>
                        </tr>
            ';
            $no++;
        }
        echo $html;
    }
}
