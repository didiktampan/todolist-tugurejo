<div class="content-wrapper">
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
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <?php
                                $pin = $this->M_tdDashboard->get_tableid('SDP_COMPLAIN', 'ID_TICKET', $pinjam['ID_TICKET'] ?? "");
                                $no = 1;
                                foreach ($pin as $isi) {
                                    $buku = $this->M_tdDashboard->get_tableid_edit('SDP_COMPLAIN_PIC', 'ID_TICKET', $isi['ID_TICKET']);
                                    echo $no . $buku['ID_TICKET'] . '<br/>';
                                    $no++;
                                }
                                ?>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Ticket</th>
                                        <th>Pic</th>
                                        <th>Job Descripsi</th>
                                        <th>Progres</th>
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
</div>