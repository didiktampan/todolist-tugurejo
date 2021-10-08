  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/assets2/plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/assets2/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/assets2/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <?php if (!defined('BASEPATH')) exit('No direct script acess allowed'); ?>

  <div class="content-wrapper ">
      <section class="content-header">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-sm-6">
                      <h1>Complain</h1>
                  </div>
                  <div class="col-sm-6 d-none d-sm-block">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Complain</li>
                      </ol>
                  </div>
              </div>
          </div>
      </section>
      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-header">
                              <!-- <h3 class="card-title">Daftar Project</h3> &nbsp; <a class="btn btn-primary btn-xs" href="#" id="btn-tambah">Tambah</a> -->
                              <h3 class="card-title">Daftar Complain</h3>

                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                              <table class="table table-bordered table-hover">
                                  <thead>
                                      <tr>
                                          <th col width="5%">No</th>
                                          <th>Complain</th>
                                          <th col width="10%">Status</th>
                                          <th col width="20%">Progres</th>
                                          <!-- <th>Start Date</th> -->
                                          <th col width="10%">Release Date</th>
                                          <!-- <th>Deskripsi</th> -->
                                          <th col width="7%">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                        $no = 1;
                                        foreach ($pinjam->result_array() as $isi) {
                                            $ID_TICKET = $isi['ID_TICKET'];
                                        ?>

                                          <tr>
                                              <td><?= $no; ?></td>
                                              <td><?= $isi['DESC_TITLE']; ?></td>
                                              <td>
                                                  <?php
                                                    if ($isi['STATUS']  == 'O') {
                                                        echo "<span class='badge badge-secondary'>Open</span>";
                                                    } elseif ($isi['STATUS'] == 'P') {
                                                        echo "<span class='badge badge-primary'>On-Progress</span>";
                                                    } elseif ($isi['STATUS']  == 'C') {
                                                        echo "<span class='badge badge-success'>Closed</span>";
                                                    }
                                                    ?>
                                              </td>
                                              <td>
                                                  <div class="progress progress-sm">
                                                      <div class="progress-bar bg-primary" style="width: <?= $isi['PROGRESS']; ?>%"></div>
                                                  </div><?= $isi['PROGRESS']; ?>
                                              </td>
                                              <!-- <td><?= $isi['DATE_VALID']; ?></td> -->
                                              <td><?= $isi['DUEDATE']; ?></td>
                                              <!-- <td><?= $isi['DESC_COMPLAIN']; ?></td> -->
                                              <td style="text-align:center;">

                                                  <!-- <button type="button" class="btn btn-default btn-modal btn-xs" data-id="<?= $isi['ID_TICKET'] ?>" data-toggle="modal" data-target="#modal-xl">
                                                      <i class="fas fa-book-open"></i>
                                                  </button> -->
                                                  <a href="<?= base_url('Report/detailpinjam/' . $isi['ID_TICKET'] . '?pinjam=yes'); ?>" class="btn btn-primary btn-sm" title="detail pinjam"><i class="fa fa-eye"></i></button></a>

                                              </td>
                                          </tr>
                                      <?php $no++;
                                        } ?>
                                  </tbody>
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

  </div>
  <div class="modal fade show" id="modal-xl" aria-modal="true">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Data Card</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="card card-primary">
                              <div class="card-header">
                                  <h3 class="card-title" id="title">Card</h3>
                              </div>
                              <div class="card-body">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <table class="table table-bordered table-hover">
                                              <thead>
                                                  <tr>
                                                      <th>NO</th>
                                                      <th>TITLE CARD</th>
                                                      <th>DESKRIPSI</th>
                                                      <th>SKP</th>
                                                  </tr>
                                              </thead>
                                              <tbody id="table-modal">
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer text-right">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- jQuery -->

  <!-- Ekko Lightbox -->
  <script src="<?php echo base_url() ?>assets/assets2/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo base_url() ?>assets/assets2/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- Filterizr-->
  <script src="<?php echo base_url() ?>assets/assets2/plugins/filterizr/jquery.filterizr.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>
  <script>
      $(document).ready(function() {
          $('#list').dataTable()
          $('.new_productivity').click(function() {
              uni_modal("<i class='fa fa-plus'></i> New Progress for: " + $(this).attr('data-task'), "manage_progress.php?pid=" + $(this).attr('data-pid') + "&tid=" + $(this).attr('data-tid'), 'large')
          })
      })
      $(document).ready(function() {

          $(".btn-modal").on('click', function() {
              var id_ticket = $(this).data('id');

              $.ajax({
                  url: '<?= base_url('Dashboard/get_tiket') ?>',
                  type: 'POST',
                  async: true,
                  dataType: 'HTML',
                  data: {
                      id_ticket: id_ticket
                  },
                  success: function(response) {
                      $("#table-modal").html(response);
                  }

              });

          });
      });
      $(document).ready(function() {
          $(".btn-modal").on('click', function() {
              var id_ticket = $(this).data('id');

              $.ajax({
                  url: '<?= base_url('Dashboard/get_tiket') ?>',
                  type: 'POST',
                  async: true,
                  dataType: 'HTML',
                  data: {
                      id_ticket: id_ticket
                  },
                  success: function(response) {
                      $("#table-modal").html(response);
                  }

              });

          });
      });
  </script>