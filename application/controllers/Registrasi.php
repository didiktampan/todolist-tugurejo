<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require FCPATH . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Registrasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status_log') != TRUE) {
            redirect('signin');
        }
    }

    public function index()
    {
        $data['token'] = AUTHORIZATION::private_token();
        $this->load->view('V_registrasi', $data);
    }

    public function data_pasien()
    {
        if ($this->session->userdata('rsd') != TRUE) {
            redirect('umum/infoTt');
            return;
        }
        $data['token'] = $token = AUTHORIZATION::private_token();
        $this->template->load('layouts/Layouts', 'dashboard/V_pasien_registrasi', $data);
    }

    public function test($tgl)
    {
        $hasil = date_diff(date_create($tgl), date_create('now'))->d;
        echo $hasil;
        $mac = system('arp -an');
        echo '<pre>';
        print_r($mac);
        echo $mac;
    }

    public function getDataPasien()
    {
        $tglawal = $this->input->get('awal');
        $awal = str_replace('/', '-', $tglawal);
        $tglakhir = $this->input->get('akhir');
        $akhir = str_replace('/', '-', $tglakhir);
        $final = [];
        $result = [];
        $kode_rs = $this->session->userdata('kode_rs') === null ? $this->input->get('kode_rs') : $this->session->userdata('kode_rs');
        $data = $this->registrasi->getPasien(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir)), $kode_rs);
        $nomor = 0;
        foreach ($data as $key => $value) {
            $nomor++;
            $waktu = $value->tglswab_akhir === null ? '-' :
                date_diff(date_create($value->tglswab_akhir), date_create('now'))->d . ' hari lalu';
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
                case 'Rujuk':
                    $sts = '<span class="right badge badge-success">Di rujuk ke ' . $value->faskes_tujuan . '</span>';
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
                'faskes_asal' => $value->faskes_asal,
                'tglswab_akhir' => $waktu,
                'action' => '
                    <button class="btn btn-primary btn-xs" data-toggle="tooltip" 
                    data-placement="bottom" title="Pilih Kamar"
                    id="btn-pilih"
                    data-no_registrasi="' . $value->no_registrasi . '"
                    data-jeniskel="' . $value->jeniskel . '"
                    data-no_kamar="' . $value->no_kamar . '">Pilih Kamar </button>
                    <button class="btn btn-warning btn-xs" data-toggle="tooltip"
                    data-placement="bottom" title="Tolak"
                    id="btn-tolak"
                    data-no_registrasi="' . $value->no_registrasi . '"
                    data-no_kamar="' . $value->no_kamar . '">Ditolak</button>
                    <button class="btn btn-danger btn-xs" data-toggle="tooltip"
                    id="btn-hapus"
                    data-placement="bottom" title="Hapus"
                    data-idpasien="' . $value->idpasien . '"
                    data-no_registrasi="' . $value->no_registrasi . '"
                    data-no_kamar="' . $value->no_kamar . '">Hapus</button>'
            ];
        }
        $final = [
            'aaData' => $result
        ];
        return APIRESPONSE::response('', $final);
    }

    public function exportData()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'ID Pasien');
        $sheet->setCellValue('C1', 'No Registrasi');
        $sheet->setCellValue('D1', 'Nama');
        $sheet->setCellValue('E1', 'Jenis Kelamin');
        $sheet->setCellValue('F1', 'Alamat');
        $sheet->setCellValue('G1', 'Tanggal Lahir');
        $sheet->setCellValue('H1', 'Usia');
        $sheet->setCellValue('I1', 'Telp');
        $sheet->setCellValue('J1', 'Ket. Ditolak');
        $sheet->setCellValue('K1', 'Faskes Asal');
        $sheet->setCellValue('L1', 'Swab Terakhir');
        $sheet->setCellValue('M1', 'Status');
        $sheet->setCellValue('N1', 'RS');
        $sheet->setCellValue('O1', 'Gedung');
        $sheet->setCellValue('P1', 'Kamar');

        $tglawal = $this->input->get('awal');
        $awal = str_replace('/', '-', $tglawal);
        $tglakhir = $this->input->get('akhir');
        $akhir = str_replace('/', '-', $tglakhir);
        $search = $this->input->get('search');
        $data = $this->registrasi->getPasien(date('Y-m-d', strtotime($awal)), date('Y-m-d', strtotime($akhir)), $search);
        // return APIRESPONSE::response('', $data);
        $nomor = 1;
        foreach ($data as $key => $value) {
            $value->tgllahir === null ? $age = '-' : $age = date_diff(date_create($value->tgllahir), date_create('now'))->y;
            $tgllahir = date('d-m-Y', strtotime($value->tgllahir));
            $waktu = $value->tglswab_akhir === null ? '-' :
                date_diff(date_create($value->tglswab_akhir), date_create('now'))->d . ' hari lalu';
            $nomor++;
            $sheet->setCellValue('A' . $nomor, $nomor - 1);
            $sheet->setCellValue('B' . $nomor, "'" . $value->idpasien);
            $sheet->setCellValue('C' . $nomor, $value->no_registrasi);
            $sheet->setCellValue('D' . $nomor, $value->nama);
            $sheet->setCellValue('E' . $nomor, $value->jeniskel);
            $sheet->setCellValue('F' . $nomor, $value->alamat_ktp);
            $sheet->setCellValue('G' . $nomor, $tgllahir);
            $sheet->setCellValue('H' . $nomor, $age);
            $sheet->setCellValue('I' . $nomor, $value->notelp);
            $sheet->setCellValue('J' . $nomor, $value->ket_batal);
            $sheet->setCellValue('K' . $nomor, $value->faskes_asal);
            $sheet->setCellValue('L' . $nomor, $waktu);
            $sheet->setCellValue('M' . $nomor, $value->status);
            $sheet->setCellValue('N' . $nomor, $value->nama_rs);
            $sheet->setCellValue('O' . $nomor, $value->nama_bangsal);
            $sheet->setCellValue('P' . $nomor, 'Kamar ' . $value->nokmr . ' No' . $value->no_tt);
        }

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->getStyle('A1:P' . $nomor)->applyFromArray($styleArray);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="mitigasi-' . $awal . '-' . $akhir . '-' . time() . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}

/* End of file Registrasi.php */
