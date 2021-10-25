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
        $data['id'] = $this->input->get('id');
        $data['token'] = $token = AUTHORIZATION::private_token();
        $this->template->load('layouts/Layouts', 'dashboard/V_milestone', $data);
        //print_r($data);
        // die()
    }

    public function detailpinjam()
    {
        // $id = $this->uri->segment(3);
        $final = [];
        $result = [];
        $data =  $this->card->getCard();
        $nomor = 0;
        foreach ($data as $key => $value) {
            $nomor++;
            // $card = $this->card->getCard($value->ID_TICKET);
            $result[] = [
                'nomor' => $nomor,
                'idticket' => $value->ID_TICKET,
                'titlecard' => $value->TITLE_CARD,
                'desccard' => $value->DESC_CARD,
                'idskp' => $value->ID_SKP,

                'action' => ' 
              '
            ];
        }
        // print_r($data);
        // die();
        $final = [
            'aaData' => $result
        ];
        return APIRESPONSE::response('', $final);
    }
    public function get_tiket()
    {
        $post = $this->input->post();
        $id = $post['id_ticket'];
        $html = '';

        $card = $this->card->getCard($id);
        $no = 1;
        foreach ($card as $data) {
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

/* End of file Bangsal.php */
