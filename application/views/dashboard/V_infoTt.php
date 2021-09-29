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
            <li class="breadcrumb-item active"> Ketersediaan TT</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- modal bangsal -->
  
  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Ketersediaan Tempat Tidur (TT) Semua Rumah Sakit</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tbInfoTt" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Rumah Sakit</th>
                    <th>Kapasitas</th>
                    <th>TT terpakai</th>
                    <th>TT Kosong</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody></tbody>
                  <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Rumah Sakit</th>
                    <th>Kapasitas</th>
                    <th>TT terpakai</th>
                    <th>TT Kosong</th>
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
    <?php if($this->session->userdata('rsd') === true){?>
      let kode_rs = "<?php echo $this->session->userdata('kode_rs')?>";
    <?php } else {?>
      let kode_rs = 'all';
    <?php } ?>
    const showTable = () => {
      let tbInfoTt =  $('#tbInfoTt').DataTable({
          "destroy": true,
          "bProcessing": true,
          "bAutoWidth": false,
          "bFilter": true, 
          "bSort": true,
          "bserverSide": true,
          "scrollX": true,
          "scrollY": true,
          "sAjaxSource": '<?php echo base_url('rumahSakit/dataInfoTt')?>?kode_rs='+kode_rs,
          "aoColumns": [
            {
              "mData": "nomor",
              className: "text-center"
            },
            {
              "mData": "nama_rs"
            },
            {
              "mData": "total"
            },
            {
              "mData": "tt_terpakai"
            },
            {
              "mData": "tt_kosong"
            },
            {
              "mData": "action"
            }
          ],
          "fixedColumns": false
        });
      }
      showTable()

  });
</script>