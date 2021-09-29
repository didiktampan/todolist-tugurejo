<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Project<?php
                      $nama_rs = $this->session->userdata('nama_rs');
                      $kode_rs = $this->session->userdata('kode_rs');
                      echo $nama_rs; ?></h1>
          <!-- <h1>Project <?php echo $this->session->userdata('fullname') ?></h1> -->
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Daftar Project</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- modal bangsal -->
  <div class="modal fade show" id="modalBangsal" aria-modal="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Form Project</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title" id="title">Tambah Project</h3>
                </div>
                <div class="card-body">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Nama Project :</label>
                      <input type="text" placeholder="Nama Rumah Sakit" name="projectname" id="projectname" autocomplete="off" class="form-control">
                      <input type="hidden" name="projectid_edt" id="projectid_edt">
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
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Project</h3> &nbsp; <a class="btn btn-primary btn-xs" href="#" id="btn-tambah">Tambah</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tbRS" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>ID Project</th>
                    <th>Nama Project</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>ID Project</th>
                    <th>Nama Project</th>
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
<script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
  $(function() {
    const token = '<?php echo $token ?>';
    const showTable = () => {
      let tableRS = $('#tbRS').DataTable({
        "destroy": true,
        "bProcessing": true,
        "bAutoWidth": false,
        "bFilter": true,
        "bSort": true,
        "bserverSide": true,
        "scrollX": true,
        "scrollY": true,
        "sAjaxSource": '<?php echo base_url('rumahSakit/dataRS') ?>',
        "aoColumns": [{
            "mData": "nomor",
            className: "text-center"
          },
          {
            "mData": "projectid"
          },
          {
            "mData": "projectname"
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
        headers: {
          'X-token': token
        },
        data: dataObj,
        success: function(response) {
          response.response === true && swal('Sukses', response.metadata.message, 'success');
          response.response === false && swal('Gagal', response.metadata.message, 'info');
          response.response === true && $('#modalBangsal').modal('hide');
        },
        error: function(error) {
          swal('Maaf', 'server bermasalah', 'error')
        }
      })
    }

    $('#btn-tambah').on('click', function() {
      $('#title').html('Tambah Rumah Sakit')
      $('#projectid_edt').val('');
      $('#projectname').val('');
      $('#modalBangsal').modal('show');
    })

    $('#tbRS').on('click', '#btn-edit', function() {
      const projectid = $(this).data('projectid')
      const projectname = $(this).data('projectname');
      $('#title').html('Edit Rumah Sakit')
      $('#projectid_edt').val(projectid)
      $('#projectname').val(projectname)
      $('#modalBangsal').modal('show');
    })

    $('#tbRS').on('click', '#btn-delete', function() {
      const projectid = $(this).data('projectid');
      const url = '<?php echo base_url('api/rumahSakit/deleteRS') ?>';
      const data = {
        projectid: projectid
      };
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

    $('#btn_save').on('click', function() {
      let projectid = $('#projectid_edt').val();
      let projectname = $('#projectname').val();
      let data;
      let url;
      if (projectid !== '') {
        data = {
          projectid: projectid,
          projectname: projectname
        }
        url = '<?php echo base_url('api/rumahSakit/updateRS') ?>'
        ManageRS(url, data);
        showTable();
        return;
      }
      data = {
        projectname: projectname
      };
      url = '<?php echo base_url('api/rumahSakit/addRS') ?>'
      ManageRS(url, data)
      showTable();
    })

  });
</script>