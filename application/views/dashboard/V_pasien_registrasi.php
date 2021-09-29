<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Mitigasi <?php echo $this->session->userdata('nama_rs') ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Daftar Pasien</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <div class="modal fade show" id="modalTransaksi" aria-modal="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Form TT</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title" id="title">Tambah TT</h3>
                </div>
                <div class="card-body">
                  <div class="col-md-12">
                    <div class="form-group filter-bangsal">
                      <label>Nama Bangsal :</label>
                        <select id="kode_bangsal" name="kode_bangsal" class="form-control selectpicker" data-live-search="true" title="-- Pilih Bangsal --" required="required" >
                        </select>
                    </div>
                  </div>
                  <div class="col-sm-12">
                      <div class="form-group filter-tt">
                          <label>TT :</label>
                          <select id="kode_tt" name="kode_tt" class="form-control selectpicker color-text reset validate" data-live-search="true" title="-- Pilih No. TT --" required="required" >
                          </select>
                          <input type="hidden" id="no_registrasi" name="no_registrasi">
                          <input type="hidden" id="jeniskel" name="jeniskel">
                          <input type="hidden" id="no_kamar" name="no_kamar">
                          <input type="hidden" id="no_tt" name="no_tt">
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer text-right">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btn_save">Save</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <div class="modal fade show" id="modalPenolakan" aria-modal="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Form Penolakan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                </div>
                <div class="card-body">
                  <div class="col-md-12">
                    <div class="form-group filter-bangsal">
                      <label>Alasan penolakan :</label>
                        <input type="hidden" id="no_reg_penolak" name="no_reg_penolak">
                        <textarea name="txt_penolakan" id="txt_penolakan" class="form-control" ></textarea>
                    </div>
                  </div>                
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer text-right">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btn_penolakan">Save</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Pasien</h3> &nbsp; <a class="btn btn-primary btn-sm" href="<?php echo base_url('registrasi')?>">Tambah</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                        <label>Tanggal Awal:</label>
                        <div class="input-group date" id="tglawal" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input color-text vaksin1" value="<?php echo date('d/m/Y')?>" data-target="#tglawal" name="tglawal_text" id="tglawal_text" placeholder="Tanggal Awal"/>
                            <div class="input-group-append" data-target="#tglawal" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <label>Tanggal Akhir:</label>
                        <div class="input-group date" id="tglakhir" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input color-text vaksin1" value="<?php echo date('d/m/Y')?>"  data-target="#tglakhir" name="tglakhir_text" id="tglakhir_text" placeholder="Tanggal Awal"/>
                            <div class="input-group-append" data-target="#tglakhir" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-3" style="padding-top: 35px;">
                    <button class="btn btn-primary btn-sm" id="btnsearch"><i class="fa fa-search"></i></button>
                  </div>
                </div>
                <table id="tbPasien" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Action</th>
                    <th>Keterangan</th>
                    <th>Id Pasien</th>
                    <th>No Registrasi</th>
                    <th>Nama</th>
                    <th>Jenis Kel.</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Telp.</th>
                    <th>Ket Ditolak</th>
                    <th>Faskes Asal</th>
                    <th>Swab Terakhir</th>
                  </tr>
                  </thead>
                  <tbody></tbody>
                  <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Action</th>
                    <th>Keterangan</th>
                    <th>Id Pasien</th>
                    <th>No Registrasi</th>
                    <th>Nama</th>
                    <th>Jenis Kel.</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Telp.</th>  
                    <th>Ket Ditolak</th>
                    <th>Faskes Asal</th>
                    <th>Swab Terakhir</th>
                  </tr>
                  </tfoot>
                </table>
                <div>
                  <a class="btn btn-sm btn-success" href="#" target="_blank" id="btn_export">Export Data</a>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
  <!-- /.content -->
</div>
<!-- jQuery -->
<script src="<?php echo base_url()?>assets/plugins/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
  $(function () {
    let token = "<?php echo $token?>"
    let awal = $('#tglawal_text').val();
    let akhir = $('#tglakhir_text').val();
    const faskes = "<?php echo $this->session->userdata('bridging_dkk')?>";
    $('#btn_export').attr('href', '<?php echo base_url('Registrasi/exportData')?>?awal='+awal+'&akhir='+akhir);
    $('#tglawal').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    $('#tglakhir').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    const listBangsal = (data) => {
      let list = '';
      data.map((value, key) => {
        list += `<option value="${value.kode_bangsal}">${value.nama_bangsal}</option>`
      })
      $('#kode_bangsal').html(list);
    }
    const listTT = (data) => {
      let list = '';
      if(data.length > 0){
        data.map((value, key) => {
          list += `<option value="${value.kode_tt}" data-no_kamar="${value.no_kamar}" data-no_tt="${value.no_tt}">Kamar ${value.no_kamar} | No TT ${value.no_tt}</option>`
        })
      } else {
        list += `<option></option>`;
      }
      $('#kode_tt').html(list);
    }
    const Bangsal = (nama_rs) => {
      $.ajax({
        url: '<?php echo base_url()?>Bangsal/select2RS?search=',
        type: 'GET',
        dataType: 'json',
        async: 		true,
        success : function(response){
          listBangsal(response)
          $('#kode_bangsal').selectpicker('refresh');
        },
        error: function(){
          swal("Error", "", "error");
        }
      })		
    }

    const availableTT = (kode_rs, kode_bangsal) => {
      $.ajax({
        url: `<?php echo base_url()?>api/TempatTidur/availableTtByBangsal?kode_rs=${kode_rs}&kode_bangsal=${kode_bangsal}`,
        type: 'GET',
        dataType: 'json',
        async: 		true,
        headers: {"X-token": token},
        success : function(response){
          response.response.length > 0 && listTT(response.response);
          response.response.length === 0 && swal('Maaf', 'Tidak ada kamar pada bangsal ini', 'info');
          response.response.length === 0 && $('#kode_tt').html(`<option></option>`);
          $('#kode_tt').selectpicker('refresh');
        },
        error: function(){
          swal("Error", "", "error");
        }
      })		
    }

    $('#kode_bangsal').selectpicker('refresh');
    Bangsal('')
    $('#kode_bangsal').on('change', function(){
      let kode_bangsal = $(this).val();
      availableTT(kode_rs, kode_bangsal)
    });

    $('#kode_tt').on('change', function(){
      let no_tt = $(this).find(':selected').data('no_tt')
      let no_kamar = $(this).find(':selected').data('no_kamar')
      $('#no_kamar').val(no_kamar);
      $('#no_tt').val(no_tt);
    });
    const kode_rs = '<?php echo $this->session->userdata('kode_rs')?>';
    const showTable = (awal, akhir) => {
      let tabelpasien =  $('#tbPasien').DataTable({
          "destroy": true,
          "bProcessing": true,
          "bAutoWidth": false,
          "bFilter": true, 
          "bSort": true,
          "bserverSide": true,
          "scrollX": true,
          "scrollY": true,
          "sAjaxSource": '<?php echo base_url('Registrasi/getDataPasien')?>?awal='+awal+'&akhir='+akhir,
          "aoColumns": [
            {
              "mData": "no",
              className: "text-center"
            },
            {
              "mData": "action"
            },
            {
              "mData": "sts"
            },
            {
              "mData": "id_pasien"
            },
            {
              "mData": "no_registrasi"
            },
            {
              "mData": "nama"
            },
            {
              "mData": "jeniskel"
            },
            {
              "mData": "tgllahir"
            },
            {
              "mData": "alamat"
            },
            {
              "mData": "notelp"
            },
            {
              "mData": "ket_batal"
            },
            {
              "mData": "faskes_asal"
            },
            {
              "mData": "tglswab_akhir"
            }
          ],
          "fixedColumns": false
        });
      }
      showTable(awal, akhir);

      $('#tbPasien').on('click', '#btn-pilih', function(){
        const no_registrasi = $(this).data('no_registrasi');
        const jeniskel = $(this).data('jeniskel')
        const no_kamar = $(this).data('no_kamar');
        if(no_kamar !== ''){
          swal('maaf', 'anda sudah memilih kamar', 'info');
          return;
        }
        $('#title').html('Pilih Kamar')
        $('#no_registrasi').val(no_registrasi);
        $('#jeniskel').val(jeniskel);
        $('#modalTransaksi').modal('show');
      });

      $('#tbPasien').on('click', '#btn-tolak', function(){
        const no_registrasi = $(this).data('no_registrasi');
        const no_kamar = $(this).data('no_kamar');
        // if(no_kamar !== ''){
        //   swal('maaf', 'anda sudah memilih kamar', 'info');
        //   return;
        // }
        $('#modalPenolakan').modal('show');
        $('#no_reg_penolak').val(no_registrasi)
      });
      
      $('#tbPasien').on('click', '#btn-hapus', function(){
        const idpasien = $(this).data('idpasien');
        const no_registrasi = $(this).data('no_registrasi');
        const no_kamar = $(this).data('no_kamar');
        if(no_kamar !== ''){
          swal('sudah memilih kamar', 'tidak bisa di hapus', 'info');
          return;
        }
        const url = '<?php echo base_url('api/Registrasi/deletePasien')?>';
        const dataObj = {
          no_registrasi: no_registrasi
        }
        swal({
            title: "Anda yakin hapus data ini ?",
            text: '', 
            icon: "warning",
            buttons: true,
            dangerMode: true,
			  })
        .then((willDelete) => {
          if (willDelete) {
            ManageBangsal(url, dataObj);
          } else {
            swal("Cancel");
          }
        });
      })

      const ManageBangsal = (url, dataObj) => {
        $.ajax({
          method: 'POST',
          url: url,
          dataType: 'JSON',
          headers: { 'X-token': token },
          data: dataObj,
          success: function(response){
            response.metadata.code === 200 && swal('Sukses', response.metadata.message, 'success');
            response.metadata.code !== 200 && swal('Gagal', response.metadata.message, 'info');
            response.metadata.code === 200 && $('.modal').modal('hide');
            showTable(awal, akhir);
          }, error: function(error){
            swal('Maaf', 'server bermasalah', 'error')
          }
        })
      }

      $('#btn_save').on('click', function(){
        let no_registrasi = $('#no_registrasi').val();
        let jeniskel = $('#jeniskel').val();
        let kode_bangsal = $('#kode_bangsal').val();
        let kode_tt = $('#kode_tt').val();
        let no_kamar = $('#no_kamar').val();
        let no_tt = $('#no_tt').val();
        let data = {
            no_registrasi: no_registrasi, 
            jeniskel: jeniskel, 
            kode_bangsal: kode_bangsal,
            kode_tt: kode_tt, 
            no_kamar: no_kamar,
            no_tt: no_tt
        }
        let url;
        url = '<?php echo base_url('api/Transaksi/pilihKamar')?>'
        ManageBangsal(url, data)
        $('.selectpicker').selectpicker('val','')
      });

      $('#btn_penolakan').on('click', function(){
        let no_registrasi = $('#no_reg_penolak').val();
        let txt_penolakan = $('#txt_penolakan').val();
        let data = {
            no_registrasi: no_registrasi, 
            txt_penolakan: txt_penolakan, 
        }
        let url;
        url = '<?php echo base_url('api/Transaksi/penolakanPasien')?>'
        ManageBangsal(url, data)
        $('.selectpicker').selectpicker('val','')
      });

      $('#btnsearch').on('click', function(){
        awal = $('#tglawal_text').val();
        akhir = $('#tglakhir_text').val();
        showTable(awal, akhir);
        $('#btn_export').attr('href', '<?php echo base_url('Registrasi/exportData')?>?awal='+awal+'&akhir='+akhir);
      });
  });
</script>