<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="shortcut icon" type="png" href="<?php echo base_url()?>assets/images/pemprov.png">
  <title>Mitigasi-19 | PROVINSI JAWA TENGAH</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css');?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.min.css');?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/style.css');?>">
 
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css'); ?>">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/adminlte.min.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <?php $this->load->view('Navbar') ?>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0 text-dark"> Form <small>Deteksi Awal</small></h1> -->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	<div class="content">
      <div class="container">
        <div class="overlay">
            <div class="overlay-content">
                <div class="loader"></div>
            </div>
        </div>
	    <div class="alert alert-primary alert-dismissible">
          <marquee onmouseout="this.start()" onmouseover="this.stop()"><h5><i class="icon fas fa-exclamation-triangle"></i> Mencegah itu lebih baik, mari segera lakukan vaksinasi demi kebaikan bersama dan keluarga</h5></marquee>
        </div>
	   </div>
	</div>
    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">

		  <!-- /.col-md-12 -->
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-header" style="text-align: center;align-items: center;display: grid;font-family: fantasy;">
                <h1 class="card-title m-0" style="text-align: center;font-size: 34px;">" Kesembuhan dan Kepuasan Anda adalah Kebahagiaan Kami "</h1>
              </div>
            <div class="card-body">
              <div class="img-people"></div>
              <form id="regForm">
             
              <!-- One "tab" for each step in the form: -->
              <div class="">
              <u><h2>Data Diri</h2></u><code>(* Jika data tidak ada, cukup isi yang berwarna KUNING ) </code>
                <div class="row">
                    <div class="col-md-5 col-sm-10 col-xs-12">
                      <div class="form-group">
                          <label>No KTP : <code style="font-size: 12px;">(* Silahkan cari atau isi secara manual ) </code> </label>
                          <input type="text" placeholder="No. KTP" name="ktp" id="ktp" autocomplete="off"  maxlength="16" class="form-control color-text validate" required autofocus>
                      </div>
                    </div>
                    <div class="col-md-1 col-sm-2 text-left">
                      <div class="form-group btn-cari">
                          <a href="javaScript:void(0)" class="btn btn-primary" id="btnupdate">Cari</a>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                          <label>Nama :</label>
                          <input type="text" placeholder="Nama" name="nama" id="nama" class="form-control color-text reset validate">
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>Tanggal Lahir:</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input color-text" data-target="#reservationdate" name="ttl" id="ttl" placeholder="Tanggal Lahir"/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label>Jenis Kelamin :</label>
                          <input type="text" placeholder="Jenis Kelamin" name="jeniskel" id="jeniskel" autocomplete="off" class="form-control color-text reset validate">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label>Provinsi :</label>
                          <input type="text" placeholder="Provinsi" name="prov" id="prov" autocomplete="off" class="form-control color-text reset validate">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                      <label>Kota :</label>
                          <input type="text" placeholder="Kota" name="kota" id="kota" autocomplete="off" class="form-control color-text reset validate">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                      <label style="background-color: white;">Kelurahan :</label>
                          <input type="text" placeholder="Kelurahan" name="kel" id="kel" autocomplete="off" class="form-control color-text reset validate">
                      </div>
                    </div>  
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label>Kecamatan :</label>
                          <input type="text" placeholder="Kecamatan" name="kec" id="kec" autocomplete="off" class="form-control color-text reset validate">
                      </div>
                    </div>             
                </div>
                <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                          <label>RT :</label>
                          <input type="text" placeholder="RT" name="rt" id="rt" autocomplete="off" class="form-control color-text reset validate">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                          <label>RW :</label>
                          <input type="text" placeholder="RW" name="rw" id="rw" autocomplete="off" class="form-control color-text reset validate">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label>Alamat :</label>
                          <input type="text" placeholder="Alamat" name="alamat" id="alamat" autocomplete="off" class="form-control color-text reset validate">
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label>Pekerjaan :</label>
                          <input type="text" placeholder="Pekerjaan" name="pekerjaan" id="pekerjaan" autocomplete="off" class="form-control color-text reset validate">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label>No Telp :</label>
                          <input type="text" placeholder="No. Telp" name="telp" id="telp" autocomplete="off" maxlength="14" class="form-control color-text reset validate">
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label>Alamat Domisili :</label>
                          <textarea placeholder="Alamat Domisili" name="almt_domisili" id="almt_domisili" autocomplete="off" class="form-control color-text reset validate"></textarea>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                          <label>Kelurahan Domisili:</label>
                          <input type="text" placeholder="Kelurahan Domisili" name="klrhn_domisili" id="klrhn_domisili" autocomplete="off" class="form-control color-text reset validate">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                          <label>Kecamatan Domisili:</label>
                          <input type="text" placeholder="Kecamatan Domisili" name="kcmtn_domisili" id="kcmtn_domisili" autocomplete="off" class="form-control color-text reset validate">
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>Tanggal Swab terakhir :</label>
                        <div class="input-group date" id="tglswab_akhir" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input color-text" data-target="#tglswab_akhir" name="tglswab_txt" id="tglswab_txt" placeholder="Tanggal Swab Terakhir"/>
                            <div class="input-group-append" data-target="#tglswab_akhir" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label>Kontak person pasien :</label>
                          <input type="text" placeholder="Kontak person pasien" name="cp_pasien" id="cp_pasien" autocomplete="off" class="form-control color-text reset validate">
                      </div>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Faskes asal :</label>
                    <?php if($this->session->userdata('rsd') === true){?>
                      <input type="text" placeholder="Faskes asal" name="faskes_asal" id="faskes_asal" autocomplete="off" class="form-control color-text reset validate">
                    <?php } else {?>
                      <input type="text" value="<?php echo $this->session->userdata('nama_faskes')?>" readonly placeholder="Faskes asal" name="faskes_asal" id="faskes_asal" autocomplete="off" class="form-control color-text reset validate">
                      <input type="hidden" value="<?php echo $this->session->userdata('kode_faskes')?>" name="kode_faskes" id="kode_faskes">
                    <?php } ?>
                  </div>
                </div>
                <?php if($this->session->userdata('rsd') !== true){?>
                <div class="col-md-6">
                    <div class="form-group filter-rsd">
                      <label>Rumah Sakit :</label>
                        <select id="kode_rs" name="kode_rs" class="form-control selectpicker" data-live-search="true" title="-- Pilih Rumah Sakit Darurat --" required="required" >
                        </select>
                    </div>
                </div>
                <?php } ?>
              </div>
              <div style="overflow:auto;">
                <div style="float:right;">
                  <button type="button" class="btn btn-primary" id="submitvaksin">Submit</button>
                </div>
              </div>
              <!-- Circles which indicates the steps of the form: -->
            </form>
              </div>
            </div>
          </div>
          <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
  <footer class="main-footer text-center">
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021 <a href="https://rstugurejo.jatengprov.go.id">SIMRS TUGUREJO</a> v.1.1.1</strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js');?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<!-- bs-custom-file-input -->
<script src="<?php echo base_url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js');?>"></script>
<script src="<?php echo base_url()?>assets/plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.min.js');?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?php echo base_url('assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') ; ?>"></script>
<!-- InputMask -->
<script src="<?php echo base_url('assets/plugins/moment/moment.min.js') ; ?>"></script>
<script src="<?php echo base_url('assets/plugins/inputmask/jquery.inputmask.min.js') ; ?>"></script>
<!-- date-range-picker -->
<!-- bootstrap color picker -->
<script src="<?php echo base_url('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') ; ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ; ?>"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo base_url('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') ; ?>"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
  $(function () {
    const token = '<?php echo $token ?>';
    const rsd = '<?php $this->session->userdata('rsd') ?>';
    <?php if($this->session->userdata('rsd')=== true ){ ?>
      let kode_rs = "<?php echo $this->session->userdata('kode_rs')?>";
    <?php } else { ?>
      let kode_rs = $('#kode_rs').val();
    <?php } ?>

    const urlParams = new URLSearchParams(window.location.search);
    const paramKodeRs = urlParams.get('kode_rs');
    $('#reservationdate').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    $('#tglswab_akhir').datetimepicker({
        format: 'DD/MM/YYYY'
    })

    $(window).scroll(function() {
      if ($(this).scrollTop() > 100) {
        $('.back-to-top').fadeIn('slow');
      } else {
        $('.back-to-top').fadeOut('slow');
      }
    });
    $('.back-to-top').click(function(){
      $('html, body').animate({scrollTop : 0},1500);
      return false;
    });

    $('#nama').on('keyup', function(){
      //$('.color-text').css('background', 'transparent')
      var nama = $(this).val();
      if(!/^[a-zA-Z\s0-9]*$/.test(nama)){
        $('#nama').val('')
      }
      $('#nama_lengkap').html(nama)
    });

    $('#alamat').on('keyup', function(){
      var alamat = $(this).val();
      if(/[`~<>;':"/[\]|{}()=_+]/.test(alamat)){
        $('#alamat').val('')
      }
      $('#alamat_lengkap').html(alamat)
    });

    const listRsDarurat = (data) => {
      let list = '';
      data.filter((data) => data.kode_rs !== 'all').map((value, key) => {
        return list += `<option value="${value.kode_rs}">${value.nama_rs}</option>`
      });
      $('#kode_rs').html(list);
    }

    const rsDarurat = (kodeRs) => {
      $.ajax({
        url: '<?php echo base_url()?>api/RumahSakit/getRsByKodeRs?kode_rs='+kodeRs,
        type: 'GET',
        dataType: 'json',
        async: 		true,
        headers: {
          'X-token': token
        },
        success : function(response){
          listRsDarurat(response.response)
          $('#kode_rs').selectpicker('refresh');
        },
        error: function(){
          swal("Error", "", "error");
        }
      })		
    }
    let kodeRs = paramKodeRs === null ? '' : paramKodeRs;
    rsDarurat(kodeRs)

    const getJs = (ktp) => {
      const url =  "<?php echo base_url('api/registrasi/searchNik')?>";
      $.ajax({
        type: "POST",
        url: url,
        data: {ktp : ktp},
        dataType: "json",
        beforeSend: function() {
          $('.overlay').css('display', 'block');
        },
        success: function (response) { 
          $('.overlay').css('display', 'none');
          if(response == null || response == ""){
            $('.reset').val('');
            $('.reset').css('background-color', "yellow");
          } else if(response.content[0].RESPONSE_CODE) {
            $('.reset').val('');
            $('.reset').css('background-color', "yellow");
          } else {
            $('#nama').val(response.content[0].NAMA_LGKP)
            var ttl = moment(response.content[0].TGL_LHR).format('DD/MM/YYYY')
            $('#ttl').val(ttl)
            $('#prov').val(response.content[0].PROP_NAME)
            $('#kota').val(response.content[0].KAB_NAME)
            $('#kec').val(response.content[0].KEC_NAME)
            $('#kel').val(response.content[0].KEL_NAME)
            $('#alamat').val(response.content[0].ALAMAT)
            $('#rt').val(response.content[0].NO_RT)
            $('#rw').val(response.content[0].NO_RW)
            $('#jeniskel').val(response.content[0].JENIS_KLMIN)
            $('#pekerjaan').val(response.content[0].JENIS_PKRJN)
            $('#almt_domisili').html(response.content[0].ALAMAT)
            $('#klrhn_domisili').val(response.content[0].KEL_NAME)
            $('#kcmtn_domisili').val(response.content[0].KEC_NAME)
            $('#telp').focus()
          }
        }
      });
    }

    $('#ktp').keyup(function(e){
        e.preventDefault();
        var ktp = $(this).val();
        $('.color-text').css('background', 'transparent')
        if(e.keyCode == 13){
          if(ktp == ""){
            swal('Maaf', 'KTP & Tanggal Lahir harus di isi', 'info');
          } else {
            getJs(ktp);
          }
        }
    })

    $('#btncari').on('click',function(){
      var ktp = $('#ktp').val();
      if(ktp == ""){
        swal('Maaf', 'KTP & Tanggal Lahir harus di isi', 'info');
      } else {
        getJs(ktp);
      }
    });

    $('#btnupdate').on('click', function(){
      var ktp = $('#ktp').val();
      if(ktp == ""){
        swal('Maaf', 'KTP & Tanggal Lahir harus di isi', 'info');
      } else {
        getJs(ktp);
      }
    });

    const submitRegistrasi = () => {
      var obj = document.forms.namedItem("regForm")
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('api/Registrasi/indenRegistrasi') ?>",
        processData:false,
        contentType:false,
        cache:false,
        async:true,
        crossOrigin : true,
        data: new FormData(obj),
        dataType: "json",
        headers: {"X-token": token},
        beforeSend: function() {
          $('.overlay').css('display', 'block');
        },
        success: function (response) {
          $('.overlay').css('display', 'none');
          if(response.metadata.code !== 200){
            swal('Maaf', response.metadata.message, 'info');
          }else {     
            <?php if($this->session->userdata('rsd')=== true ){ ?>    
            window.location =  '<?php echo base_url('registrasi/data_pasien')?>'
            <?php } else { ?> 
            window.location =  '<?php echo base_url('faskes/data_pasien')?>'
            <?php } ?>
          }
        }, error : function(error){
          swal('Maaf', 'terjadi kesalahan', 'error')
        }
      });
    }

    $('#submitvaksin').on('click', function(){
      const ktp = $('#ktp').val();
      const pekerjaan = $('#pekerjaan').val();
      const ttl = $('#ttl').val();
      const tglswab_akhir = $('#tglswab_txt').val();
      const cp_pasien = $('#cp_pasien').val();
      const faskes_asal = $('#faskes_asal').val();
      const almt_domisili = $('#almt_domisili').val();
      if(almt_domisili === ""){
        swal('Maaf', 'Alamat domisili harus terisi', 'info');
        return;
      }
      if(tglswab_akhir === ""){
        swal('Maaf', 'Tanggal swab akhir harus terisi', 'info');
        return;
      }
      if(cp_pasien === ""){
        swal('Maaf', 'Kontak person harus terisi', 'info');
        return;
      }
      if(faskes_asal === ""){
        swal('Maaf', 'Faskes asal harus terisi', 'info');
        return;
      }
      if(pekerjaan === ""){
        swal('Maaf', 'Pekerjaan harus terisi', 'info');
        return;
      }
      if(ktp === ""){
        swal('Maaf', 'Ktp harus terisi', 'info');
        return;
      }
      if(ttl === ""){
        swal('maaf', 'tanggal lahir harus terisi', 'info');
        return;
      }
      submitRegistrasi();
    })
  });
</script>
</body>
</html>
