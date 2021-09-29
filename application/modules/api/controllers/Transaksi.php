<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function index()
    {
        echo 'API TRANSAKSI';
    }

    public function createIdJurnal()
    {
        $data = $this->transaksi->buatID('JR');
        $res = [ 
            'metadata' => [
                'code' => 200,
                'message' =>' success'
            ],
            'response' => $data
        ];
        return APIRESPONSE::response(200, $res);
    }
    
    public function mutasi()
    {
        $no_registrasi = $this->input->post('no_registrasi');
        $kode_tt_baru = $this->input->post('kodett_baru');
        $jeniskel = $this->input->post('jeniskel');
        $getPasien = SQLBUILDER::getWhere('registrasi', '*', 'no_registrasi', $no_registrasi);

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
        $jurnal_tt = array(
            'id_jurnal' => $this->transaksi->buatID('JR'),
            'no_registrasi' => $no_registrasi,
            'idpasien' => $getPasien[0]->idpasien,
            'kodett_lama' => $getPasien[0]->kode_tt,
            'kodett_baru' => $kode_tt_baru,
            'status' => 'mutasi',
            'status_covid' => 'confirm',
            'userinput' => $this->session->userdata('username'),
            'compinput' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
            'useredit' => $this->session->userdata('username'),
            'compedit' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
        );
       
        $tempat_tidur = array(
            'idpasien' => $getPasien[0]->idpasien,
            'no_registrasi' => $no_registrasi,
            'kode_inden' => '-'
        );

        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
        if($validation === true){
            $checkAvailableTT = $this->tempatTidur->availableTtByKodeTt($kode_tt_baru);
            $jnskel_kmr = $checkAvailableTT[0]->jeniskel_kamar === 'L' ? 'Laki laki' : 'Perempuan';
            if($checkAvailableTT[0]->jeniskel_kamar === 'A'){
                #boleh
                if(count($checkAvailableTT) > 0){
                    $data = $this->transaksi->mutasi($jurnal_tt, $tempat_tidur);
                    $res = [ 
                        'metadata' => [
                            'code' => 200,
                            'message' =>'success'
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
                    $data = $this->transaksi->mutasi($jurnal_tt, $tempat_tidur);
                    $res = [ 
                        'metadata' => [
                            'code' => 200,
                            'message' =>'berhasil pindah kamar'
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

    public function pilihKamar()
    {
        $no_registrasi = $this->input->post('no_registrasi');
        $kode_bangsal = $this->input->post('kode_bangsal');
        $kode_tt = $this->input->post('kode_tt');
        $no_tt = $this->input->post('no_tt');
        $no_kamar = $this->input->post('no_kamar');

        $jeniskel = $this->input->post('jeniskel');
        $getPasien = SQLBUILDER::getWhere('registrasi', '*', 'no_registrasi', $no_registrasi);

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
        $updateRegistrasi = [
            'status' => 'Aproval',
            'kode_bangsal' => $kode_bangsal,
            'kode_tt' => $kode_tt,
            'no_kamar' => $no_kamar,
            'no_tt' => $no_tt,
        ];
        $tempat_tidur = array(
            'idpasien' => $getPasien[0]->idpasien,
            'no_registrasi' => $no_registrasi,
            'kode_inden' => '-'
        );

        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
        if($validation === true){
            $checkAvailableTT = $this->tempatTidur->availableTtByKodeTt($kode_tt);
            $jnskel_kmr = $checkAvailableTT[0]->jeniskel_kamar === 'L' ? 'Laki laki' : 'Perempuan';
            if($checkAvailableTT[0]->jeniskel_kamar === 'A'){
                #boleh
                if(count($checkAvailableTT) > 0){
                    $data = $this->transaksi->pilihKamar($tempat_tidur, $updateRegistrasi, $no_registrasi, $kode_tt);
                    $res = [ 
                        'metadata' => [
                            'code' => 200,
                            'message' =>'berhasil pilih kamar'
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
                    $data = $this->transaksi->pilihKamar($tempat_tidur, $updateRegistrasi, $no_registrasi, $kode_tt);
                    $res = [ 
                        'metadata' => [
                            'code' => 200,
                            'message' =>'success'
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

    public function penolakanPasien()
    {
        $no_registrasi = $this->input->post('no_registrasi');
        $txt_penolakan = $this->input->post('txt_penolakan');
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
        $updateRegistrasi = [
            'status' => 'Ditolak',
            'ket_batal' => $txt_penolakan,
        ];
       
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
        if($validation === true){
            $data = SQLBUILDER::manageSql('registrasi', $updateRegistrasi, 'update', 'no_registrasi', $no_registrasi);
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' =>'berhasil menolak'
                ],
                'response' => $data
            ];
            
        } else {
            $res = $validation;
        }
        return APIRESPONSE::response('', $res);
    }
    
    public function pulang()
    {
        $sts_plg = $this->input->post('sts_plg');
        $no_registrasi = $this->input->post('no_registrasi');
        $kode_tt = $this->input->post('kode_tt');
        $faskes_tujuan = $this->input->post('faskes_tujuan');
        $username = $this->session->userdata('username') === null ? $this->input->post('username'): $this->session->userdata('username');
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
        if(!isset($kode_tt) || $kode_tt === ''){
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => "Kode TT tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        $updateRegistrasi = [
            'status' => $sts_plg,
            'faskes_tujuan' => $faskes_tujuan,
            'updated_at' => date('Y-m-d H:i:s'),
            'useredit' => $username
        ];

        $updateTt = [
            'idpasien' => null,
            'no_registrasi' => null,
            'kode_inden' => null,
            'updated_at' => date('Y-m-d H:i:s'),
            'useredit' => $username
        ];
       
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
        if($validation === true){
            $data = $this->transaksi->pulang($updateRegistrasi, $updateTt, $no_registrasi, $kode_tt);
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' =>'berhasil pulang'
                ],
                'response' => $data
            ];
            
        } else {
            $res = $validation;
        }
        return APIRESPONSE::response('', $res);
    }

    public function getStatusPulang()
    {
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('GET', $token);
        if($validation === true){
            $field = 'kode_rs, nama_rs';
            $data = $this->transaksi->getStatusPulang();
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => 'ambil daftar faskes'
                ],
                'response' => $data
            ];
        } else {
            $res = $validation;
        }
        return APIRESPONSE::response('', $res);
    }

}

/* End of file Transaksi.php */
