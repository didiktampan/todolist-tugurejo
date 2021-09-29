<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faskes extends CI_Controller {

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
        $this->template->load('layouts/Layouts', 'dashboard/V_faskes', $data);
    }

    public function dataFaskes(){
        $final = [];
        $result = [];
        $data = SQLBUILDER::getWhere('faskes','*', 'status_data', 0);
        $nomor = 0;
        foreach($data as $key => $value){
            $nomor++;
            $result[] = [
                'nomor' => $nomor,
                'kode_faskes' => $value->kode_faskes,
                'nama_faskes' => $value->nama_faskes,
                'faskes_bpjs' => $value->faskes_bpjs,
                'action' => '
                    <button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Edit"
                    id="btn-edit"
                    data-kode_faskes="'.$value->kode_faskes.'"
                    data-nama_faskes="'.$value->nama_faskes.'"
                    data-faskes_bpjs="'.$value->faskes_bpjs.'">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="Delete"
                    id="btn-delete"
                    data-kode_faskes="'.$value->kode_faskes.'"
                    data-nama_faskes="'.$value->nama_faskes.'">
                        <i class="fa fa-trash"></i>
                    </button>'
            ];
        }
        $final = [
            'aaData' => $result
        ];
        return APIRESPONSE::response('', $final);
    }

    public function user()
    {
        $data['token'] = $token = AUTHORIZATION::private_token();
        $this->template->load('layouts/Layouts', 'dashboard/V_faskes_user', $data);
    }

    public function dataFaskesUser(){
        $final = [];
        $result = [];
        $kode_faskes = $this->session->userdata('rsd') === false ? 
        $this->session->userdata('kode_faskes') : $this->input->get('kode_faskes');
        $data = $this->faskes->getListUser($kode_faskes);
        $nomor = 0;
        foreach($data as $key => $value){
            $nomor++;
            $result[] = [
                'nomor' => $nomor,
                'nik' => $value->nik,
                'username' => $value->username,
                'fullname' => $value->fullname,
                'kode_faskes' => $value->kode_faskes,
                'nama_faskes' => $value->nama_faskes,
                'faskes_bpjs' => $value->faskes_bpjs,
                'action' => '
                    <button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Edit"
                    id="btn-edit"
                    data-username="'.$value->username.'"
                    data-fullname="'.$value->fullname.'"
                    data-nik="'.$value->nik.'"
                    data-kode_faskes="'.$value->kode_faskes.'"
                    data-nama_faskes="'.$value->nama_faskes.'"
                    data-faskes_bpjs="'.$value->faskes_bpjs.'">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="Delete"
                    id="btn-delete"
                    data-username="'.$value->username.'">
                        <i class="fa fa-trash"></i>
                    </button>'
            ];
        }
        $final = [
            'aaData' => $result
        ];
        return APIRESPONSE::response('', $final);
    }

    public function data_pasien()
    {
        $data['token'] = $token = AUTHORIZATION::private_token();
        $this->template->load('layouts/Layouts', 'dashboard/V_pasien_faskes', $data);
    }

    public function getDataPasien(){
        $tglawal = $this->input->get('awal');
        $awal = str_replace('/', '-', $tglawal);
        $tglakhir = $this->input->get('akhir');
        $akhir = str_replace('/', '-', $tglakhir);
        $final = [];
        $result = [];
        $kode_faskes = $this->input->get('kode_faskes');
        $data = $this->faskes->getPasien(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir)), $kode_faskes);
        $nomor = 0;
        foreach($data as $key => $value){
            $nomor++;
            $waktu = $value->tglswab_akhir === null ? '-':
            date_diff(date_create($value->tglswab_akhir), date_create('now'))->d.' hari lalu';
            switch ($value->status) {
                case 'Inap':
                    $sts = '<span class="right badge badge-warning">Inap</span>';
                    break;
                case 'Pulang Sehat':
                    $sts = '<span class="right badge badge-success">Pulang Sehat</span>';
                    break;
                case 'Meninggal':
                    $sts = '<span class="right badge badge-danger">Meninggal</span>';
                    break;
                case 'PAPS':
                    $sts = '<span class="right badge badge-warning">Pulang Paksa</span>';
                    break;
                case 'Inden':
                    $sts = '<span class="right badge badge-success">Inden</span>';
                    break;
                case 'Aproval':
                    $sts = '<span class="right badge badge-primary">Aproval</span>';
                    break;
                case 'Ditolak':
                    $sts = '<span class="right badge badge-danger">Ditolak</span>';
                    break;
                case 'Daftar':
                    $sts = '<span class="right badge badge-danger">Belum dapat kamar</span>';
                    break;
                default:
                    $sts = '<span class="right badge badge-danger">Belum dapat kamar</span>';
                    break;
            }
            
            $jeniskel = $value->jeniskel === 'L' ? 'Laki laki' : 'Perempuan';
            $result[] = [
                'no' => $nomor,
                'sts' => $sts,
                'nama_rs' => $value->nama_rs,
                'id_pasien' => $value->idpasien,
                'no_registrasi' => $value->no_registrasi,
                'nama' => $value->nama,
                'tgllahir' => date('d M Y', strtotime($value->tgllahir)),
                'jeniskel' => $jeniskel,
                'alamat' => $value->alamat_ktp,
                'notelp' => $value->notelp,
                'status' => $value->status,
                'status_co' => $value->status_covid,
                'ket_batal' => $value->ket_batal,
                'rs_darurat' => $value->nama_rs,
                'tglswab_akhir' => $waktu,
                'action' => '
                    <a class="btn btn-primary btn-xs" data-toggle="tooltip" 
                    data-placement="bottom" title="Pilih Kembali Rumah Sakit Darurat"
                    id="btn-pilih"
                    href="'.base_url('umum/infoTt').'">Pilih kembali </a>'
            ];
        }
        $final = [
            'aaData' => $result
        ];
        return APIRESPONSE::response('', $final);
    }
}

/* End of file Faskes.php */
