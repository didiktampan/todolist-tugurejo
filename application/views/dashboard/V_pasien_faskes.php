<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Mitigasi <?php echo $this->session->userdata('nama_faskes') ?></h1>
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
                        <input type="hidden" name="kode_faskes" id="kode_faskes" value="<?php echo $this->session->userdata('kode_faskes')?>">
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
                    <th>Rs Darurat</th>
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
                    <th>Rs Darurat</th>
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
    const kode_faskes = $('#kode_faskes').val();
    $('#btn_export').attr('href', '<?php echo base_url('Registrasi/exportData')?>?awal='+awal+'&akhir='+akhir);
    $('#tglawal').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    $('#tglakhir').datetimepicker({
        format: 'DD/MM/YYYY'
    });

    const kode_rs = '<?php echo $this->session->userdata('kode_rs')?>';
    const showTable = (awal, akhir) => {
      let url = `<?php echo base_url('Faskes/getDataPasien')?>?awal=${awal}&akhir=${akhir}&kode_faskes=${kode_faskes}`
      let tabelpasien =  $('#tbPasien').DataTable({
          "destroy": true,
          "bProcessing": true,
          "bAutoWidth": false,
          "bFilter": true, 
          "bSort": true,
          "bserverSide": true,
          "scrollX": true,
          "scrollY": true,
          "sAjaxSource": url,
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
              "mData": "rs_darurat"
            },
            {
              "mData": "tglswab_akhir"
            }
          ],
          "fixedColumns": false
        });
      }
      showTable(awal, akhir);

      $('#btnsearch').on('click', function(){
        awal = $('#tglawal_text').val();
        akhir = $('#tglakhir_text').val();
        showTable(awal, akhir);
        $('#btn_export').attr('href', '<?php echo base_url('Registrasi/exportData')?>?awal='+awal+'&akhir='+akhir);
      });
  });
</script>