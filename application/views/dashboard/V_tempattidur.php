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
            <li class="breadcrumb-item active">Daftar TT</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- modal bangsal -->
  <div class="modal fade show" id="modalTT" aria-modal="true">
    <div class="modal-dialog">
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
                      <input type="hidden" name="kode_tt" id="kode_tt" class="reset">
                      <select id="kode_bangsal" name="kode_bangsal" class="form-control selectpicker" data-live-search="true" title="-- Pilih Bangsal --" required="required" >
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Nama Kamar :</label>
                      <input type="text" placeholder="Nama Kamar" name="no_kamar" id="no_kamar" autocomplete="off" class="form-control reset">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>No TT :</label>
                      <input type="text" placeholder="No TT" name="no_tt" id="no_tt" autocomplete="off" class="form-control reset">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Jenis Kelamin Kamar :</label>
                      <select name="jeniskel_kamar" id="jeniskel_kamar" class="form-control reset">
                        <option value="A">All</option>
                        <option value="L">Laki laki</option>
                        <option value="P">Perempuan</option>
                      </select>
                    </div>
                  </div>
                  
                  <?php if($kode_rs === 'all'){?>
                  <div class="col-md-12">
                    <div class="form-group">
                        <label>Rumah Sakit</label>
                        <select class="form-control reset select2" style="width: 100%;" id="kode_rs" name="kode_rs">
                        </select>
                    </div>
                  </div>
                  <?php } ?>
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
  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Tempat Tidur (TT)</h3> &nbsp; <a class="btn btn-primary btn-xs" href="#" id="btn-tambah">Tambah</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tbTT" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Rumah Sakit</th>
                    <th>Bangsal</th>
                    <th>No Kamar</th>
                    <th>Jenis Kamar</th>
                    <th>No TT</th>
                    <th>Id Pasien</th>
                    <th>No Registrasi</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody></tbody>
                  <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Rumah Sakit</th>
                    <th>Bangsal</th>
                    <th>No Kamar</th>
                    <th>Jenis Kamar</th>
                    <th>No TT</th>
                    <th>Id Pasien</th>
                    <th>No Registrasi</th>
                    <th>Action</th>
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
    const token = '<?php echo $token ?>';
    let sess_kode_rs = '<?php echo $this->session->userdata('kode_rs')?>'
    const listBangsal = (data) => {
      let list = '';
      data.map((value, key) => {
        list += `<option value="${value.kode_bangsal}">${value.nama_bangsal}</option>`
      })
      $('#kode_bangsal').html(list);
    }
    const Bangsal = (bangsal) => {
      $.ajax({
        url: '<?php echo base_url()?>Bangsal/select2RS?search='+bangsal,
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
    Bangsal('');
    $('#kode_bangsal').selectpicker('refresh');
    $('.filter-bangsal .bs-searchbox input').on('keyup',function(event) {
				event.preventDefault();
				var bangsal = $(this).val();
				// if(nama_rs.length > 4 ){
				// 	Bangsal(nama_rs);
				// }
		});
    const showTable = () => {
      let tbTT =  $('#tbTT').DataTable({
          "destroy": true,
          "bProcessing": true,
          "bAutoWidth": false,
          "bFilter": true, 
          "bSort": true,
          "bserverSide": true,
          "scrollX": true,
          "scrollY": true,
          "sAjaxSource": '<?php echo base_url('TempatTidur/dataTT')?>/'+sess_kode_rs,
          "aoColumns": [
            {
              "mData": "nomor",
              className: "text-center"
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
              "mData": "jeniskel_kamar"
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
              "mData": "action"
            }
          ],
          "fixedColumns": false
        });
      }
      showTable()

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
            response.response === true && $('#modalTT').modal('hide');
            showTable();
          }, error: function(error){
            swal('Maaf', 'server bermasalah', 'error')
          }
        })
      }

      $('#btn-tambah').on('click', function(){
        $('#title').html('Tambah TT')
        $('.reset').val('');
        $('#modalTT').modal('show');
      })

      $('#tbTT').on('click', '#btn-edit', function(){
        const kode_bangsal = $(this).data('kode_bangsal')
        const nama_bangsal = $(this).data('nama_bangsal');
        const kode_rs = $(this).data('kode_rs');
        const nama_rs = $(this).data('nama_rs');
        const kode_tt = $(this).data('kode_tt');
        const no_kamar = $(this).data('no_kamar');
        const no_tt = $(this).data('no_tt');
        const idpasien = $(this).data('idpasien');
        const no_registrasi = $(this).data('no_registrasi');

        $('#title').html('Edit TT')
        $('#kode_bangsal_edt').val(kode_bangsal);
        $('#nama_bangsal').val(nama_bangsal);
        $('#kode_rs').select2("val", "0");
        $('#kode_tt').val(kode_tt);
        $('#no_kamar').val(no_kamar);
        $('#no_tt').val(no_tt);
        $('#idpasien').val(idpasien);
        $('#no_registrasi').val(no_registrasi);
        $('#modalTT').modal('show');
      })

      $('#tbTT').on('click', '#btn-delete', function(){
        const kode_tt = $(this).data('kode_tt');
        const url = '<?php echo base_url('api/TempatTidur/deleteTT')?>';
        const data = {kode_tt: kode_tt};
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
        let kode_tt = $('#kode_tt').val();
        let kode_bangsal = $('#kode_bangsal').val();
        let no_kamar = $('#no_kamar').val();
        let no_tt = $('#no_tt').val();
        let jeniskel_kamar = $('#jeniskel_kamar').val();
        let kode_rs = sess_kode_rs === 'all' ? $('#kode_rs').val() : sess_kode_rs ;
        
        let data = {
            kode_tt: kode_tt, 
            kode_bangsal: kode_bangsal, 
            no_kamar: no_kamar, 
            no_tt: no_tt,
            kode_rs: kode_rs,
            jeniskel_kamar: jeniskel_kamar
        }
        let url;
        if(kode_tt !== ''){
          url = '<?php echo base_url('api/TempatTidur/updateTT')?>'
          ManageBangsal(url, data);
          return;
        }
        url = '<?php echo base_url('api/TempatTidur/addTT')?>'
        ManageBangsal(url, data)
      })

  });
</script>