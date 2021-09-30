<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //validasi jika user belum login
        $this->data['CI'] = &get_instance();
        $this->load->helper(array('form', 'url'));
        $this->load->model('M_tdDashboard');
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function index()
    {
        if ($this->session->userdata('is_login') == FALSE) {
            redirect('signin', 'refresh');
        } else {
            $this->data['pinjam'] = $this->db->query("SELECT TOP 10 * FROM sdp_complain  ORDER BY 'ID_TICKET' DESC");
            // $this->data['komplen'] = $this->db->query("SELECT * FROM sdp_complain_card ORDER BY 'ID_TICKET'");
            // echo json_encode($this->data['komplen']->result());
            // return;
            // $this->data['pinjam'] = $this->db->query(
            //     "SELECT * FROM sdp_complain_card WHERE ID_TICKET => '$id'"
            // );
            // $this->data['komplen'] = $this->db->get_where('sdp_complain', ['ID_TICKET' => $id])->result_array();
            $this->template->load('layouts/Layouts', 'dashboard/td_Dashboard', $this->data);
        }
    }



    public function detailpinjam()
    {
        $id = $this->uri->segment(3);
        // echo $id;
        // return;
        // $this->data['idbo'] = $this->session->userdata('ses_id');
        // $id = $this->db->get('ID_TICKET');
        // if ($this->session->userdata('TIPUSER') == 'DEV') {
        $cek = $this->db->get_where('sdp_complain', [
            'ID_TICKET' => $id,
            // 'USLOGNM' => $this->session->userdata('USLOGNM')
        ]);

        $data = $cek->num_rows();
        $this->data['komplen'] = $cek->result_array();
        // print_r($data);
        // die();
        if ($data > 0) {
            $this->data['pinjam'] = $this->db->query(
                "SELECT * FROM SDP_COMPLAIN_CARD WHERE ID_TICKET = '$id'"
            )->result_array();

            // print_r($this->data['pinjam']);
            // die();
        } else {
            echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="' . base_url('transaksi') . '"</script>';
        }
        // } else {
        // $data = $this->M_Admin->CountTableId('sdp_complain', 'ID_TICKET', $id);
        // if ($data > 0) {
        //     $this->data['pinjam'] = $this->db->query("SELECT * FROM sdp_complain WHERE ID_TICKET = '$id'")->row();
        // } else {
        //     echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="' . base_url('transaksi') . '"</script>';
        // }
        // }
        $this->template->load('layouts/Layouts', 'dashboard/detailComplaincard', $this->data);
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
