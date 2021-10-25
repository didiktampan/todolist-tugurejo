<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>PIC Complain</h1>
                </div>
                <div class="col-sm-6 d-none d-sm-block">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">PIC Complain</li>
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
                            <h3 class="card-title">Daftar PIC Complain</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="list">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Ticket</th>
                                        <th>Pic</th>
                                        <th>Job Descripsi</th>
                                        <th>Progres</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($pinjam as $isi) {
                                        // $pinjam = $this->M_tdDashboard->get_tableid_edit('SDP_COMPLAIN_PIC', 'ID_TICKET', $isi['ID_TICKET']);
                                    ?>
                                        <td><?= $no; ?></td>
                                        <td><?= $isi['ID_TICKET']; ?></td>
                                        <td><?= $isi['PIC']; ?></td>
                                        <td><?= $isi['JOBDESC']; ?></td>
                                        <td>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-primary" style="width: <?= $isi['PROGRESS']; ?>%"></div>
                                            </div><?= $isi['PROGRESS']; ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <button type="button" class="btn btn-default btn-modal btn-xs" data-id="<?= $isi['ID_TICKET'] ?>" data-toggle="modal" data-target="#modal-xl">
                                                <i class="fas fa-book-open"></i>
                                            </button>
                                            <!-- <a href="<?= base_url('Report/detailpinjam/' . $isi['ID_TICKET'] . '?pinjam=yes'); ?>" class="btn btn-primary btn-sm" title="detail pinjam"><i class="fa fa-eye"></i></button></a> -->

                                        </td>
                                        </tr>
                                    <?php $no++;
                                    } ?>
                                </tbody>
                            </table>


                            <!-- <div class="pull-right">
                                <a href="<?= base_url('report'); ?>" class="btn btn-danger btn-md">Kembali</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
    </section>
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
                                            <table class="table table-bordered table-hover" id="card">
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
    </div>
</div>

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
        $('#card').dataTable()
    })
    $(document).ready(function() {

        // $(".btn-modal").on('click', function() {
        //     var id_ticket = $(this).data('id');

        //     $.ajax({
        //         url: '<?= base_url('Dashboard/get_tiket') ?>',
        //         type: 'POST',
        //         async: true,
        //         dataType: 'HTML',
        //         data: {
        //             id_ticket: id_ticket
        //         },
        //         success: function(response) {
        //             $("#table-modal").html(response);
        //         }

        //     });

        // });
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