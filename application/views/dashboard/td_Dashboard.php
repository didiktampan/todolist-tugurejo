  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <?php if (!defined('BASEPATH')) exit('No direct script acess allowed'); ?>

  <div class="content-wrapper kanban">
      <section class="content-header">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-sm-6">
                      <h1>DashBoard</h1>
                  </div>
                  <div class="col-sm-6 d-none d-sm-block">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Dashboard</li>
                      </ol>
                  </div>
              </div>
          </div>
      </section>
      <section class="content pb-3">
          <div class="container-fluid h-100">
              <div class="card card-row card-secondary">
                  <div class="card-header">
                      <h3 class="card-title">
                          Daftar Complain
                      </h3>
                  </div>
                  <div class="card-body">
                      <?php
                        $no = 1;
                        foreach ($pinjam->result_array() as $isi) {
                            $ID_TICKET = $isi['ID_TICKET'];
                        ?>
                          <div class="card card-info card-outline">
                              <div class="card-header">
                                  <h5 class="card-title"> <?php
                                                            if ($isi['STATUS']  == 'O') {
                                                                echo "<span class='badge badge-secondary'>Open</span>";
                                                            } elseif ($isi['STATUS'] == 'P') {
                                                                echo "<span class='badge badge-primary'>On-Progress</span>";
                                                            } elseif ($isi['STATUS']  == 'C') {
                                                                echo "<span class='badge badge-success'>Closed</span>";
                                                            }
                                                            ?></td>
                                  </h5>
                                  <div class="card-tools">
                                      <!-- <a href="#" class="btn btn-tool btn-link"></a> -->
                                      <a href="#" class="btn btn-tool">
                                          <button type="button" class="btn btn-default btn-modal btn-xs" data-id="<?= $isi['ID_TICKET'] ?>" data-toggle="modal" data-target="#modal-xl">
                                              <i class="fas fa-book-open"></i>
                                          </button>

                                      </a>
                                  </div>
                              </div>
                              <div col width="10%" class="card-body">
                                  <!-- <td><?= $no; ?></td> -->
                                  <?= $isi['DESC_TITLE']; ?>
                                  <!-- <button type="button" class="btn btn-default btn-modal btn-xs" data-id="<?= $isi['ID_TICKET'] ?>" data-toggle="modal" data-target="#modal-xl">
                                      <i class="fas fa-book-open"></i>
                                  </button> -->
                              </div>
                          </div>
                      <?php $no++;
                        } ?>
                  </div>

              </div>

              <div class="card card-row card-primary">
                  <div class="card-header">
                      <h3 class="card-title">
                          Open Complain
                      </h3>
                  </div>
                  <div class="card-body">
                      <?php
                        foreach ($OpenComplain->result_array() as $isi) {
                            $ID_TICKET = $isi['ID_TICKET'];
                        ?>
                          <div class="card card-primary card-outline">
                              <div class="card-header">
                                  <h5 class="card-title">
                                      <?php
                                        if ($isi['STATUS']  == 'O') {
                                            echo "<span class='badge badge-secondary'>Open</span>";
                                        } elseif ($isi['STATUS'] == 'P') {
                                            echo "<span class='badge badge-primary'>On-Progress</span>";
                                        } elseif ($isi['STATUS']  == 'C') {
                                            echo "<span class='badge badge-success'>Closed</span>";
                                        }
                                        ?>
                                  </h5>
                                  <div class="card-tools">
                                      <!-- <a href="#" class="btn btn-tool btn-link">#2</a> -->
                                      <a href="#" class="btn btn-tool">
                                          <i class="fas fa-pen"></i>
                                      </a>
                                  </div>
                              </div>
                              <div class="card-body">
                                  <?= $isi['DESC_TITLE']; ?>
                              </div>
                          </div>
                      <?php $no++;
                        } ?>
                  </div>
              </div>
              <div class="card card-row card-default">
                  <div class="card-header bg-info">
                      <h3 class="card-title">
                          Progress Complain
                      </h3>
                  </div>
                  <div class="card-body">
                      <?php
                        foreach ($ProgresComplain->result_array() as $isi) {
                            $ID_TICKET = $isi['ID_TICKET'];
                        ?>
                          <div class="card card-light card-outline">
                              <div class="card-header">
                                  <h5 class="card-title"> <?php
                                                            if ($isi['STATUS']  == 'O') {
                                                                echo "<span class='badge badge-secondary'>Open</span>";
                                                            } elseif ($isi['STATUS'] == 'P') {
                                                                echo "<span class='badge badge-primary'>On-Progress</span>";
                                                            } elseif ($isi['STATUS']  == 'C') {
                                                                echo "<span class='badge badge-success'>Closed</span>";
                                                            }
                                                            ?></h5>
                                  <div class="card-tools">
                                      <!-- <a href="#" class="btn btn-tool btn-link"></a> -->
                                      <a href="#" class="btn btn-tool">
                                          <i class="fas fa-pen"></i>
                                      </a>
                                  </div>
                              </div>
                              <div class="card-body">
                                  <?= $isi['DESC_TITLE']; ?>
                              </div>
                          </div>
                      <?php } ?>
                  </div>
              </div>
              <div class="card card-row card-success">
                  <div class="card-header">
                      <h3 class="card-title">
                          Closed Complain
                      </h3>
                  </div>
                  <div class="card-body">
                      <?php
                        foreach ($ClosedComplain->result_array() as $isi) {
                            $ID_TICKET = $isi['ID_TICKET'];
                        ?>
                          <div class="card card-primary card-outline">
                              <div class="card-header">
                                  <h5 class="card-title"><?php
                                                            if ($isi['STATUS']  == 'O') {
                                                                echo "<span class='badge badge-secondary'>Open</span>";
                                                            } elseif ($isi['STATUS'] == 'P') {
                                                                echo "<span class='badge badge-primary'>On-Progress</span>";
                                                            } elseif ($isi['STATUS']  == 'C') {
                                                                echo "<span class='badge badge-success'>Closed</span>";
                                                            }
                                                            ?></h5>
                                  </h5>
                                  <div class="card-tools">
                                      <!-- <a href="#" class="btn btn-tool btn-link">#4</a> -->
                                      <a href="#" class="btn btn-tool">
                                          <i class="fas fa-pen"></i>
                                      </a>
                                  </div>
                              </div>
                              <div class="card-body">
                                  <td><?= $isi['DESC_TITLE']; ?></td>
                              </div>
                          </div>
                      <?php } ?>
                  </div>
              </div>
          </div>
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
  <script src="<?php echo base_url() ?>assets/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- Filterizr-->
  <script src="<?php echo base_url() ?>assets/plugins/filterizr/jquery.filterizr.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>
  <script>
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