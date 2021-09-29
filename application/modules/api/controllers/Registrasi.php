<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }    

    public function index()
    {
        echo 'API Registrasi';
    }

    public function searchNik()
    {
        $nik = $this->input->post('ktp');
        $url = 'http://172.16.160.43:8080/dukcapil/get_json/33/dinkes_33/call_nik';
        $obj = array(
            'nik' => $nik,
            'user_id' => '14472020051810bambang_supangkat',
            'password' => '4Sehat5Sempurna',
            'ip_user' => '10.33.0.30'
        );
        $field = json_encode($obj);
        $header = array(
            'Content-Type: application/json'
        );
        $ex = WEBSERVICES::postCors($url, $field, $header);
        echo $ex;
    }

    public function createNoReg()
    {
        $data = $this->registrasi->buatID();
        $res = [ 
            'metadata' => [
                'code' => 200,
                'message' =>' success'
            ],
            'response' => $data
        ];
        return APIRESPONSE::response(200, $res);
    }

    public function deletePasien()
    {
        $no_registrasi = $this->input->post('no_registrasi');
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
       
        if(!isset($no_registrasi) || $no_registrasi === ''){
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => "No Registrasi tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        $obj = [
            'status_data' => 1
        ];
        if($validation === true){
            $data = SQLBUILDER::manageSql('registrasi', $obj, 'update', 'no_registrasi', $no_registrasi);
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => 'berhasil menghapus'
                ],
                'response' => $data
            ];
        } else {
            $res = $validation;
        }
        return APIRESPONSE::response('', $res);
    }

    public function saveRegistrasi()
    {
        $ktp = $this->input->post('ktp');
        $rt = $this->input->post('rt');
        $rw = $this->input->post('rw');
        $tgllhir = str_replace('/', '-', $this->input->post('ttl'));
        $kode_rs = $this->session->userdata('kode_rs');
        $jeniskel = $this->input->post('jeniskel') === 'Laki-Laki' ? 'L' : 'P';
        $no_registrasi = $this->registrasi->buatID();
        $tglswab_akhir = $this->input->post('tglswab_akhir');
        $cp_pasien = $this->input->post('cp_pasien');
        $faskes_asal = $this->input->post('faskes_asal');
        if(!isset($ktp) || $ktp === ''){
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => "KTP tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        $master = array(
            'idpasien' =>  $ktp,
            'kode_rs' => $kode_rs,
            'tgllahir' => date('Y-m-d', strtotime($tgllhir)),
            'nama' => $this->input->post('nama'),
            'jeniskel' => $jeniskel,
            'alamat_ktp' => $this->input->post('alamat'),
            'rt' => $rt,
            'rw' => $rw,
            'kelurahan_ktp' => $this->input->post('kel'),
            'kecamatan_ktp' => $this->input->post('kec'),
            'kota_ktp' => $this->input->post('kota'),
            'provinsi_ktp' => $this->input->post('prov'),
            'alamat_domisili' => $this->input->post('almt_domisili'),
            'kelurahan_domisili' => $this->input->post('klrhn_domisili'),
            'kecamatan_domisili' => $this->input->post('kcmtn_domisili'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'notelp' => $this->input->post('telp'),
            'userinput' => $this->session->userdata('username'),
            'compinput' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
            'useredit' => $this->session->userdata('username'),
            'compedit' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
        );
        $registrasi = array(
            'idpasien' => $ktp,
            'kode_rs' => $kode_rs,
            'no_registrasi' => $no_registrasi,
            'kode_bangsal' => $this->input->post('kode_bangsal'),
            'kode_tt' => $this->input->post('kode_tt'),
            'no_kamar' => $this->input->post('no_kamar'),
            'no_tt' => $this->input->post('no_tt'),
            'status' => 'inap',
            'status_covid' => 'confirm',
            'tglswab_akhir' => $tglswab_akhir,
            'cp_pasien' => $cp_pasien,
            'faskes_asal' => $faskes_asal,
            'userinput' => $this->session->userdata('username'),
            'compinput' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
            'useredit' => $this->session->userdata('username'),
            'compedit' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
        );
       
        $tempat_tidur = array(
            'idpasien' => $ktp,
            'no_registrasi' => $no_registrasi,
            'kode_inden' => '-'
        );

        $jurnal_tt = array(
            'id_jurnal' => $this->transaksi->buatID('JR'),
            'no_registrasi' => $no_registrasi,
            'idpasien' => $ktp,
            'kodett_lama' => '',
            'kodett_baru' => $this->input->post('kode_tt'),
            'status' => 'inap',
            'status_covid' => 'confirm',
            'userinput' => $this->session->userdata('username'),
            'compinput' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
            'useredit' => $this->session->userdata('username'),
            'compedit' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
        );
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
        if($validation === true){
            $checkIdpasien = SQLBUILDER::checkDuplicated('pasien', 'idpasien', $ktp);
            $checkAvailableTT = $this->tempatTidur->availableTtByKodeTt($registrasi['kode_tt']);
            $jnskel_kmr = $checkAvailableTT[0]->jeniskel_kamar === 'L' ? 'Laki laki' : 'Perempuan';
            if($checkAvailableTT[0]->jeniskel_kamar === 'A'){
                #boleh
                if(count($checkAvailableTT) > 0){
                    $data = count($checkIdpasien) > 0 ?
                    $this->registrasi->saveRegistrasi('', $registrasi, $tempat_tidur, $jurnal_tt):
                    $this->registrasi->saveRegistrasi($master, $registrasi, $tempat_tidur, $jurnal_tt);
                    $res = [ 
                        'metadata' => [
                            'code' => 200,
                            'message' =>'berhasil mendaftar'
                        ],
                        'response' => $data
                    ];
                } else {
                    $res = [ 
                        'metadata' => [
                            'code' => 200,
                            'message' => 'TT sudah digunakan'
                        ],
                        'response' => false
                    ];
                }
            } else if($jeniskel === $checkAvailableTT[0]->jeniskel_kamar){
                if(count($checkAvailableTT) > 0){
                    $data = count($checkIdpasien) > 0 ?
                    $this->registrasi->saveRegistrasi('', $registrasi, $tempat_tidur):
                    $this->registrasi->saveRegistrasi($master, $registrasi, $tempat_tidur);
                    $res = [ 
                        'metadata' => [
                            'code' => 200,
                            'message' =>'berhasil mendaftar'
                        ],
                        'response' => $data
                    ];
                } else {
                    $res = [ 
                        'metadata' => [
                            'code' => 200,
                            'message' => 'TT sudah digunakan'
                        ],
                        'response' => false
                    ];
                }
            } else {
                $res = [ 
                    'metadata' => [
                        'code' => 200,
                        'message' => 'TT hanya digunakan untuk '.$jnskel_kmr
                    ],
                    'response' => false
                ];
            }
            
        } else {
            $res = $validation;
        }
        return APIRESPONSE::response('', $res);
    }

    public function indenRegistrasi()
    {
        $ktp = trim($this->input->post('ktp'));
        $rt = $this->input->post('rt');
        $rw = $this->input->post('rw');
        $tgllhir = str_replace('/', '-', $this->input->post('ttl'));
        $kode_rs = $this->session->userdata('kode_rs') === null ? $this->input->post('kode_rs'): $this->session->userdata('kode_rs');
        $username = $this->session->userdata('username') === null ? $this->input->post('username'): $this->session->userdata('username');
        $jeniskel = $this->input->post('jeniskel') === 'Laki-Laki' ? 'L' : 'P';
        $tglswab_akhir = str_replace('/', '-', $this->input->post('tglswab_txt'));
        $cp_pasien = $this->input->post('cp_pasien');
        $faskes_asal = $this->input->post('faskes_asal');
        $kdfaskes = $this->input->post('kode_faskes');
        $no_registrasi = $this->registrasi->buatID();
        if(!isset($ktp) || $ktp === ''){
            $res = [ 
                'metadata' => [
                    'code' => 300,
                    'message' => "KTP tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        $kode_faskes = !isset($kdfaskes) || $kdfaskes === '' ? NULL : $kdfaskes;
        $master = array(
            'idpasien' =>  $ktp,
            'kode_rs' => $kode_rs,
            'tgllahir' => date('Y-m-d', strtotime($tgllhir)),
            'nama' => $this->input->post('nama'),
            'jeniskel' => $jeniskel,
            'alamat_ktp' => $this->input->post('alamat'),
            'rt' => $rt,
            'rw' => $rw,
            'kelurahan_ktp' => $this->input->post('kel'),
            'kecamatan_ktp' => $this->input->post('kec'),
            'kota_ktp' => $this->input->post('kota'),
            'provinsi_ktp' => $this->input->post('prov'),
            'alamat_domisili' => $this->input->post('almt_domisili'),
            'kelurahan_domisili' => $this->input->post('klrhn_domisili'),
            'kecamatan_domisili' => $this->input->post('kcmtn_domisili'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'notelp' => $this->input->post('telp'),
            'userinput' => $username,
            'compinput' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
            'useredit' => $username,
            'compedit' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
        );
        $registrasi = array(
            'idpasien' => $ktp,
            'kode_rs' => $kode_rs,
            'no_registrasi' => $no_registrasi,
            'status' => 'Daftar',
            'status_covid' => 'confirm',
            'kontak_person_pasien' => $cp_pasien,
            'tglswab_akhir' => date('Y-m-d', strtotime($tglswab_akhir)),
            'faskes_asal' => $faskes_asal,
            'kode_faskes' => $kode_faskes,
            'userinput' => $username,
            'compinput' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
            'useredit' => $username,
            'compedit' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
        );

        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
        if($validation === true){
            $checkStatusPasien = $this->registrasi->checkStatusPasien($ktp);
            if($checkStatusPasien->num_rows() > 0){
                $res = [ 
                    'metadata' => [
                        'code' => 300,
                        'message' =>'pasien sudah terdaftar silahkan cek'
                    ],
                    'response' => new stdClass()
                ];
                return APIRESPONSE::response('', $res);
            } else {
                $checkIdpasien = SQLBUILDER::checkDuplicated('pasien', 'idpasien', $ktp);
                $data = count($checkIdpasien) > 0 ?
                $this->registrasi->indenRegistrasi('', $registrasi):
                $this->registrasi->indenRegistrasi($master, $registrasi);
                $res = [ 
                    'metadata' => [
                        'code' => 200,
                        'message' =>'berhasil mendaftar'
                    ],
                    'response' => [
                        'nama' => $this->input->post('nama'),
                        'idpasien' => $ktp,
                        'kode_rs' => $kode_rs,
                        'no_registrasi' => $no_registrasi
                    ]
                ];
            }
        } else {
            $res = $validation;
        }
        return APIRESPONSE::response('', $res);
    }

    public function getDataPasien()
    {
        $tglawal = $this->input->get('awal');
        $awal = str_replace('/', '-', $tglawal);
        $tglakhir = $this->input->get('akhir');
        $akhir = str_replace('/', '-', $tglakhir);
        $kode_rs = $this->session->userdata('kode_rs') === null ? $this->input->get('kode_rs'): $this->session->userdata('kode_rs');
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('GET', $token);
        if($validation === true){
            $data = $this->registrasi->getPasien(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir)), $kode_rs);
            $tmp = [];
            foreach ($data as $key => $value) {
                $tmp[] = [
                    'idpasien' => $value->nama,
                    'no_registrasi' => $value->no_registrasi,
                    'nama' => $value->nama,
                    'jeniskel' => $value->jeniskel,
                    'tgllahir' => date('d-M-Y', strtotime($value->tgllahir)),
                    'alamat' => $value->alamat_ktp,
                    'telp' => $value->notelp,
                    'faskes_asal' => $value->faskes_asal,
                    'tglswab_akhir' => date('d-M-Y', strtotime($value->tglswab_akhir)),
                    'ket_ditolak' => $value->ket_batal,
                    'kontak_person' => $value->kontak_person_pasien,
                    'status' => $value->status,
                    'kode_rs' => $value->kode_rs,
                    'nama_rs' => $value->nama_rs,
                    'kode_bangsal' => $value->kode_bangsal,
                    'nama_bangsal' => $value->nama_bangsal,
                    'kode_tt' => $value->kode_tt,
                    'no_kamar' => $value->no_kamar,
                    'no_tt' => $value->no_tt,
                    'created_at' => $value->created_at                    
                ];
            }
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => 'daftar pasien'
                ],
                'response' => [
                    'data' => $tmp,
                    'total' => count($data)
                ]
            ];
        } else {
            $res = $validation;
        }
        return APIRESPONSE::response('', $res);
    }

    public function getDataPasienByUsername()
    {
        $username = $this->input->get('username');
        $kode_rs = $this->session->userdata('kode_rs') === null ? $this->input->get('kode_rs'): $this->session->userdata('kode_rs');
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('GET', $token);
        if($validation === true){
            $data = $this->registrasi->getDataPasienByUsername($username, $kode_rs);
            $tmp = [];
            foreach ($data as $key => $value) {
                $tmp[] = [
                    'idpasien' => $value->nama,
                    'no_registrasi' => $value->no_registrasi,
                    'nama' => $value->nama,
                    'jeniskel' => $value->jeniskel,
                    'tgllahir' => date('d-M-Y', strtotime($value->tgllahir)),
                    'alamat' => $value->alamat_ktp,
                    'telp' => $value->notelp,
                    'faskes_asal' => $value->faskes_asal,
                    'tglswab_akhir' => date('d-M-Y', strtotime($value->tglswab_akhir)),
                    'ket_ditolak' => $value->ket_batal,
                    'kontak_person' => $value->kontak_person_pasien,
                    'status' => $value->status,
                    'kode_rs' => $value->kode_rs,
                    'nama_rs' => $value->nama_rs,
                    'kode_bangsal' => $value->kode_bangsal,
                    'nama_bangsal' => $value->nama_bangsal,
                    'kode_tt' => $value->kode_tt,
                    'no_kamar' => $value->no_kamar,
                    'no_tt' => $value->no_tt,
                    'created_at' => $value->created_at                    
                ];
            }
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => 'daftar pasien'
                ],
                'response' => [
                    'data' => $tmp,
                    'total' => count($data)
                ]
            ];
        } else {
            $res = $validation;
        }
        return APIRESPONSE::response('', $res);
    }

}

/* End of file Registrasi.php */
