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
            <li class="breadcrumb-item active">Faskes User</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- modal bangsal -->
  <div class="modal fade show" id="modalRS" aria-modal="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Form User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title" id="title">Tambah Bangsal</h3>
                </div>
                <div class="card-body">
                <form id="formUser">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Username :</label>
                      <input type="hidden" name="username_edt" id="username_edt" class="reset">
                      <input type="text" placeholder="Username" name="username" id="username" autocomplete="off" class="form-control reset">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Fullname :</label>
                      <input type="text" placeholder="Fullname" name="fullname" id="fullname" autocomplete="off" class="form-control reset">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>NIK :</label>
                      <input type="text" placeholder="NIK" name="nik" id="nik" autocomplete="off" class="form-control reset">
                    </div>
                  </div>
                  <div class="col-md-12" id="password-container">
                    <div class="form-group">
                      <label>Password :</label>
                      <input type="password" placeholder="Password" name="password" id="password" autocomplete="off" class="form-control reset">
                    </div>
                  </div>
                  <?php if($this->session->userdata('kode_faskes') === 'all'){?>
                  <div class="col-md-12">
                    <div class="form-group filter-faskes">
                      <label>Nama Faskes :</label>
                        <select id="kode_faskes" name="kode_faskes" class="form-control selectpicker" data-live-search="true" title="-- Pilih Faskes --" required="required" >
                        </select>
                    </div>
                  </div>
                  <?php } ?>
                </form>
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
                <h3 class="card-title">Daftar Faskes User</h3> &nbsp; <a class="btn btn-primary btn-xs" href="#" id="btn-tambah">Tambah</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tbUser" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Nik</th>
                    <th>Faskes</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody></tbody>
                  <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Nik</th>
                    <th>Rumah Sakit</th>
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
    let kode_faskes = '<?php echo $this->session->userdata('kode_faskes')?>'
    <?php if($this->session->userdata('kode_faskes') === 'all'){?>
      kode_faskes = $('#kode_faskes').val();
    <?php } ?>
    const listFaskes = (data) => {
      let list = '';
      data.map((value, key) => {
        return list += `<option value="${value.kode_faskes}">${value.nama_faskes}</option>`
      })
      $('#kode_faskes').html(list);
    }

    const Faskes = () => {
      $.ajax({
        url: '<?php echo base_url()?>api/Faskes/getFaskes',
        type: 'GET',
        dataType: 'json',
        async: 		true,
        headers: {
          'X-token': token
        },
        success : function(response){
          listFaskes(response.response)
          $('#kode_faskes').selectpicker('refresh');
        },
        error: function(){
          swal("Error", "", "error");
        }
      })		
    }

    Faskes()
    const showTable = () => {
      let tbUser =  $('#tbUser').DataTable({
          "destroy": true,
          "bProcessing": true,
          "bAutoWidth": false,
          "bFilter": true, 
          "bSort": true,
          "bserverSide": true,
          "scrollX": true,
          "scrollY": true,
          "sAjaxSource": '<?php echo base_url('Faskes/dataFaskesUser')?>',
          "aoColumns": [
            {
              "mData": "nomor",
              className: "text-center"
            },
            {
              "mData": "username"
            },
            {
              "mData": "fullname"
            },
            {
              "mData": "nik"
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
            response.response === true && $('#modalRS').modal('hide');
          }, error: function(error){
            swal('Maaf', 'server bermasalah', 'error')
          }
        })
      }

      $('#btn-tambah').on('click', function(){
        $('#title').html('Tambah User')
        $('#username').prop('readonly', false);
        $('.reset').val('')
        $('#modalRS').modal('show');
      })

      $('#tbUser').on('click', '#btn-edit', function(){
        const username = $(this).data('username')
        const fullname = $(this).data('fullname');
        const nik = $(this).data('nik');
        const kode_faskes = $(this).data('kode_faskes');
        $('#username').prop('readonly', true);
        $('#title').html('Edit User');
        $('#username').val(username);
        $('#username_edt').val(username);
        $('#fullname').val(fullname);
        $('#nik').val(nik);
        $('#kode_faskes').val(kode_faskes);
        $('#modalRS').modal('show');
      })

      $('#tbUser').on('click', '#btn-delete', function(){
        const username = $(this).data('username');
        const url = '<?php echo base_url('api/Faskes/deleteUser')?>';
        const data = {username: username};
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
        let username = $('#username').val();
        let username_edt = $('#username_edt').val();
        let fullname = $('#fullname').val();
        let password = $('#password').val();
        let nik = $('#nik').val();
        let data;
        let url;
        if(username_edt !== ''){
          data = {username: username, password: password, fullname: fullname, nik: nik, kode_faskes: kode_faskes}
          url = '<?php echo base_url('api/Faskes/updateUser')?>'
          ManageRS(url, data);
          showTable();
          return;
        }
        data = {username: username, password: username, fullname: fullname, nik: nik, kode_faskes: kode_faskes}
        url = '<?php echo base_url('api/Faskes/addUser')?>'
        ManageRS(url, data)
        showTable();
      })

  });
</script>