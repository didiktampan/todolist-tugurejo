<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Mitigasi <?php echo $this->session->userdata('fullname') ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Daftar Faskes</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- modal bangsal -->
  <div class="modal fade show" id="modalFaskes" aria-modal="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Form Faskes</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title" id="title">Tambah Faskes</h3>
                </div>
                <div class="card-body">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Kode Faskes :</label>
                      <input type="text" placeholder="Kode Faskes" name="kode_faskes" id="kode_faskes" autocomplete="off" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Nama Faskes :</label>
                      <input type="text" placeholder="Nama Faskes" name="nama_faskes" id="nama_faskes" autocomplete="off" class="form-control">
                      <input type="hidden" name="kode_faskesedt" id="kode_faskesedt">
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
  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Faskes</h3> &nbsp; <a class="btn btn-primary btn-xs" href="#" id="btn-tambah">Tambah</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tbFaskes" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Faskes</th>
                    <th>Faskes</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody></tbody>
                  <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Kode Faskes</th>
                    <th>Faskes</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
               
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
    const showTable = () => {
      let tableRS =  $('#tbFaskes').DataTable({
          "destroy": true,
          "bProcessing": true,
          "bAutoWidth": false,
          "bFilter": true, 
          "bSort": true,
          "bserverSide": true,
          "scrollX": true,
          "scrollY": true,
          "sAjaxSource": '<?php echo base_url('Faskes/dataFaskes')?>',
          "aoColumns": [
            {
              "mData": "nomor",
              className: "text-center"
            },
            {
              "mData": "kode_faskes"
            },
            {
              "mData": "nama_faskes"
            },
            {
              "mData": "action"
            }
          ],
          "fixedColumns": false
        });
      }
      showTable()

      const ManageRS = (url, dataObj) => {
        $.ajax({
          method: 'POST',
          url: url,
          dataType: 'JSON',
          headers: { 'X-token': token },
          data: dataObj,
          success: function(response){
            response.response === true && swal('Sukses', response.metadata.message, 'success');
            response.response === false && swal('Gagal', response.metadata.message, 'info');
            response.response === true && $('#modalFaskes').modal('hide');
            showTable();
          }, error: function(error){
            swal('Maaf', 'server bermasalah', 'error')
          }
        })
      }

      $('#btn-tambah').on('click', function(){
        $('#title').html('Tambah Faskes')
        $('#kode_faskes').val('');
        $('#nama_faskes').val('');
        $('#kode_faskesedt').val('');
        $('#kode_faskes').prop('readonly', false);
        $('#modalFaskes').modal('show');
      })

      $('#tbFaskes').on('click', '#btn-edit', function(){
        const kode_faskes = $(this).data('kode_faskes')
        const nama_faskes = $(this).data('nama_faskes');
        $('#title').html('Edit Faskes')
        $('#kode_faskes').prop('readonly', true);
        $('#kode_faskes').val(kode_faskes)
        $('#nama_faskes').val(nama_faskes)
        $('#modalFaskes').modal('show');
      })

      $('#tbFaskes').on('click', '#btn-delete', function(){
        const kode_faskes = $(this).data('kode_faskes');
        const url = '<?php echo base_url('api/Faskes/deleteFaskes')?>';
        const data = {kode_faskes: kode_faskes};
        swal({
            title: "Anda yakin hapus data ini ?",
            text: '', 
            icon: "warning",
            buttons: true,
            dangerMode: true,
			  })
        .then((willDelete) => {
          if (willDelete) {
            ManageRS(url, data);
            showTable();
          } else {
            swal("Cancel");
          }
        });
      });

      $('#btn_save').on('click', function(){
        let kode_faskes = $('#kode_faskes').val();
        let nama_faskes = $('#nama_faskes').val();
        let kode_faskesedt = $('#kode_faskesedt').val();
        let data;
        let url;
        if(kode_faskesedt !== ''){
          data = {kode_faskes: kode_faskesedt, nama_faskes: nama_faskes}
          url = '<?php echo base_url('api/Faskes/updateFaskes')?>'
          ManageRS(url, data);
          return;
        }
        data = {kode_faskes: kode_faskes, nama_faskes: nama_faskes};
        url = '<?php echo base_url('api/Faskes/addFaskes')?>'
        ManageRS(url, data)
      })

  });
</script>