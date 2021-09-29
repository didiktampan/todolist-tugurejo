<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TempatTidur extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status_log') != TRUE) {
			redirect('signin');
		}
    }
    
    public function index()
    {
        $data['token'] = $token = AUTHORIZATION::private_token();
        $this->template->load('layouts/Layouts', 'dashboard/V_tempattidur', $data);
    }

    public function dataTT($kode_rs){
        $final = [];
        $result = [];
        $data = $this->tempatTidur->getListTT($kode_rs);
        $nomor = 0;
        foreach($data as $key => $value){
            if($value->jeniskel_kamar === 'P'){
                $jeniskel_kamar = 'Perempuan';
            } else if($value->jeniskel_kamar === 'L'){
                $jeniskel_kamar = 'Laki laki';
            } else {
                $jeniskel_kamar = 'All';
            }
            $nomor++;
            $result[] = [
                'nomor' => $nomor,
                'kode_tt' => $value->kode_tt,
                'kode_rs' => $value->kode_rs,
                'no_kamar' => $value->no_kamar,
                'no_tt' => $value->no_tt,
                'id_pasien' => $value->idpasien,
                'no_registrasi' => $value->no_registrasi,
                'kode_bangsal' => $value->kode_bangsal,
                'nama_bangsal' => $value->nama_bangsal,
                'nama_rs' => $value->nama_rs,
                'jeniskel_kamar' => $jeniskel_kamar,
                'action' => '
                    <button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Edit"
                    id="btn-edit"
                    data-kode_tt="'.$value->kode_tt.'"
                    data-no_kamar="'.$value->no_kamar.'"
                    data-no_tt="'.$value->no_tt.'"
                    data-idpasien="'.$value->idpasien.'"
                    data-no_registrasi="'.$value->no_registrasi.'"
                    data-kode_bangsal="'.$value->kode_bangsal.'"
                    data-nama_bangsal="'.$value->nama_bangsal.'"
                    data-kode_rs="'.$value->kode_rs.'"
                    data-nama_rs="'.$value->nama_rs.'">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="Delete"
                    id="btn-delete"
                    data-kode_tt="'.$value->kode_tt.'">
                        <i class="fa fa-trash"></i>
                    </button>'
            ];
        }
        $final = [
            'aaData' => $result
        ];
        return APIRESPONSE::response('', $final);
    }

}

/* End of file TempatTidur.php */
