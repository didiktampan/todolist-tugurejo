<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Mitigasi <?php 
          $kode_rs = $this->session->userdata('kode_rs'); 
          echo $this->session->userdata('nama_rs') ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Daftar Ketersediaan TT</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <div class="modal fade show" id="modalPulang" aria-modal="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Form Pulang</h4>
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
                      <label>Status Pulang :</label>
                        <input type="hidden" id="no_reg_plg" name="no_reg_plg">
                        <input id="kode_tt_plg" type="hidden" name="kode_tt_plg">
                        <select name="sts_plg" id="sts_plg" class="form-control">     
                        </select>
                    </div>
                    <div class="form-group" style="display: none;" id="div-faskes-tujuan">
                      <label for="faskes_tujuan">RS Rujukan</label>
                      <input type="text" id="faskes_tujuan" name="faskes_tujuan" class="form-control">
                    </div>
                  </div>                
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer text-right">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btn_pulang">Save</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- modal mutasi -->
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
                  <h3 class="card-title" id="title">Mutasi TT</h3>
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
          <button type="button" class="btn btn-primary" id="btn_save">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <div class="modal fade show" id="modalPasien" aria-modal="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Data Pasien</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <table id="tbPasien" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>No.</th>
            <th>Pilih</th>
            <th>Id Pasien</th>
            <th>No Registrasi</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Telp</th>
            <th>Status</th>
          </tr>
          </thead>
          <tbody></tbody>
        </table>
        </div>
        <div class="modal-footer text-right">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                <h3 class="card-title">Data Ketersediaan Tempat Tidur (TT)</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tbTransaksi" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Action</th>
                    <th>Rumah Sakit</th>
                    <th>Bangsal</th>
                    <th>No Kamar</th>
                    <th>No TT</th>
                    <th>Id Pasien</th>
                    <th>No Registrasi</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Telp</th>
                    <th>Status</th>
                    <th>Swab Terakhir</th>
                    <th>Faskes Asal</th>
                  </tr>
                  </thead>
                  <tbody></tbody>
                  <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Action</th>
                    <th>Rumah Sakit</th>
                    <th>Bangsal</th>
                    <th>No Kamar</th>
                    <th>No TT</th>
                    <th>Id Pasien</th>
                    <th>No Registrasi</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Telp</th>
                    <th>Status</th>
                    <th>Swab Terakhir</th>
                    <th>Faskes Asal</th>
                  </tr>
                  </tfoot>
                </table>
                <!-- <div>
                  <a class="btn btn-sm btn-success" href="#" target="_blank" id="btn_export">Export Data</a>
                  <a class="btn btn-sm btn-primary" href="#" target="_blank" id="btn_export_lansia">Export Data Lansia</a>
                  <a class="btn btn-sm btn-primary" href="#" target="_blank" id="btn_export_nonlansia">Export Data Non Lansia</a>
                </div> -->
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
    let kode_rs = "<?php echo $this->session->userdata('kode_rs')?>";
    const token = '<?php echo $token ?>';

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
        list += `<option></option>`
      }
      $('#kode_tt').html(list);
    }

    const listStsPlg = (data) => {
      let list = '';
      if(data.length > 0){
        data.map((value, key) => {
          list += `<option value="${value.keterangan}" ">${value.keterangan}</option>`
        })
      } else {
        list += `<option></option>`
      }
      $('#sts_plg').html(list);
    }

    const stsPlg = () => {
      $.ajax({
        url: `<?php echo base_url()?>api/transaksi/getStatusPulang`,
        type: 'GET',
        dataType: 'json',
        async: 		true,
        headers: {"X-token": token},
        success : function(response){
          response.response.length > 0 && listStsPlg(response.response);
          response.response.length === 0 && swal('Maaf', 'Tidak ada status pulang', 'info');
          response.response.length === 0 && listStsPlg(response.response);
          $('#kode_tt').selectpicker('refresh');
        },
        error: function(){
          swal("Error", "", "error");
        }
      })		
    }
    stsPlg();

    const Bangsal = () => {
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
          response.response.length === 0 && listTT(response.response);
          $('#kode_tt').selectpicker('refresh');
        },
        error: function(){
          swal("Error", "", "error");
        }
      })		
    }

    $('#kode_bangsal').selectpicker('refresh');
    Bangsal()
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

    $('#sts_plg').on('change', function() {
      let sts_plg = $(this).val();
      sts_plg === 'Rujuk' && $('#div-faskes-tujuan').css('display', 'block');
      sts_plg !== 'Rujuk' && $('#div-faskes-tujuan').css('display', 'none');
    });

    const showTable = () => {
      let tbTransaksi =  $('#tbTransaksi').DataTable({
          "destroy": true,
          "bProcessing": true,
          "bAutoWidth": false,
          "bFilter": true, 
          "bSort": true,
          "bserverSide": true,
          "scrollX": true,
          "scrollY": true,
          "sAjaxSource": '<?php echo base_url('Transaksi/availableTt')?>',
          "aoColumns": [
            {
              "mData": "nomor",
              className: "text-center"
            },
            {
              "mData": "action"
            },
            {
              "mData": "nama_rs"
            },
            {
              "mData": "nama_bangsal"
            },
            {
              "mData": "no_kamar"
            },
            {
              "mData": "no_tt"
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
              "mData": "tgllahir"
            },
            {
              "mData": "jeniskel"
            },
            {
              "mData": "alamat"
            },
            {
              "mData": "notelp"
            },
            {
              "mData": "status"
            },
            {
              "mData": "tglswab_akhir"
            },
            {
              "mData": "faskes_asal"
            }
          ],
          "fixedColumns": false
        });
      }
      showTable()

      const showPasien = () => {
        let tbPasien =  $('#tbPasien').DataTable({
          "destroy": true,
          "bProcessing": true,
          "bAutoWidth": false,
          "bFilter": true, 
          "bSort": true,
          "bserverSide": true,
          "scrollX": true,
          "scrollY": true,
          "sAjaxSource": '<?php echo base_url('Transaksi/getPasien')?>',
          "aoColumns": [
            {
              "mData": "nomor",
              className: "text-center"
            },
            {
              "mData": "action"
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
              "mData": "tgllahir"
            },
            {
              "mData": "jeniskel"
            },
            {
              "mData": "alamat"
            },
            {
              "mData": "notelp"
            },
            {
              "mData": "status"
            }
          ],
          "fixedColumns": false
        });
      }
      const ManageBangsal = (url, dataObj) => {
        $.ajax({
          method: 'POST',
          url: url,
          dataType: 'JSON',
          headers: { 'X-token': token },
          data: dataObj,
          success: function(response){
            response.response === true && swal('Sukses', response.metadata.message, 'success');
            response.response === false && swal('Gagal', response.metadata.message, 'info');
            response.response === true && $('.modal').modal('hide');
            showTable();
          }, error: function(error){
            swal('Maaf', 'server bermasalah', 'error')
          }
        })
      }

      $('#tbTransaksi').on('click', '#btn-pulang', function(){
        const no_registrasi = $(this).data('no_registrasi');
        const kode_tt = $(this).data('kode_tt');
        $('#kode_tt_plg').val(kode_tt);
        $('#no_reg_plg').val(no_registrasi);
        $('#modalPulang').modal('show');
      })

      $('#tbTransaksi').on('click', '#btn-mutasi', function(){
        const no_registrasi = $(this).data('no_registrasi');
        const jeniskel = $(this).data('jeniskel')
        $('#title').html('Pindah Kamar')
        $('#no_registrasi').val(no_registrasi);
        $('#jeniskel').val(jeniskel);
        $('#modalTransaksi').modal('show');
      })

      $('#tbTransaksi').on('click', '#btn-delete', function(){
        const kode_bangsal = $(this).data('kode_bangsal');
        const url = '<?php echo base_url('api/bangsal/deleteBangsal')?>';
        const data = {kode_bangsal: kode_bangsal};
        swal({
            title: "Anda yakin hapus data ini ?",
            text: '', 
            icon: "warning",
            buttons: true,
            dangerMode: true,
			  })
        .then((willDelete) => {
          if (willDelete) {
            ManageBangsal(url, data);
            showTable();
          } else {
            swal("Cancel");
          }
        });
      });

      $('#btn_save').on('click', function(){
        let no_registrasi = $('#no_registrasi').val();
        let jeniskel = $('#jeniskel').val();
        let kodett_baru = $('#kode_tt').val();
        if(kodett_baru === ''){
          swal('maaf', 'TT belum di pilih', 'info');
          return;
        }
        let data = {
            no_registrasi: no_registrasi, 
            jeniskel: jeniskel, 
            kodett_baru: kodett_baru, 
        }
        let url;
        url = '<?php echo base_url('api/Transaksi/mutasi')?>'
        ManageBangsal(url, data)
      });
      $('#btn_pulang').on('click', function(){
        let no_registrasi = $('#no_reg_plg').val();
        let kode_tt_plg = $('#kode_tt_plg').val();
        let sts_plg = $('#sts_plg').val();
        let faskes_tujuan = $('#faskes_tujuan').val();
        let data = {
            no_registrasi: no_registrasi, 
            sts_plg: sts_plg, 
            kode_tt: kode_tt_plg,
            faskes_tujuan: faskes_tujuan
        }
        let url;
        url = '<?php echo base_url('api/transaksi/pulang')?>'
        ManageBangsal(url, data)
      })

  });
</script>