<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Milestone<?php
                                    $projectname = $this->session->userdata('projectname');
                                    $projectid = $this->session->userdata('projectid');
                                    echo $projectname;
                                    ?></h1>
                </div>
                <input type="hidden" value="<?php echo $id ?>" id="id_project" name="id_project">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Daftar Milestone</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- modal terbaru -->
    <div class="modal fade show" id="modalBangsal" aria-modal="true">
        <div class="modal-dialog modal-lg" style="max-width:1200px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Milestone</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tbProject2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Milestone Name</th>
                                    <th>Description</th>
                                    <th col width="10%">Due Date</th>

                                </tr>
                            </thead>
                            <tbody></tbody>

                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Milestone Name</th>
                                    <th>Description</th>
                                    <th>Due Date</th>

                                </tr>
                            </tfoot>
                        </table>
                        <div>
                            <a class="btn btn-sm btn-primary" href="<?php echo site_url('Project') ?>">Back</a>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="modal-footer text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary" id="btn-update">Save changes</button> -->
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
                            <h3 class="card-title">Data Milestone</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tbProject" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>ID Ticket</th>
                                            <th>Description</th>
                                            <th>Complain</th>
                                            <th>Progress</th>
                                            <th>ID Card</th>
                                            <th>Title Card</th>
                                            <th>Status</th>
                                            <th>ID Skp</th>
                                            <th>Detail Skp</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>ID Ticket</th>
                                            <th>Description</th>
                                            <th>Complain</th>
                                            <th>Progress</th>
                                            <th>ID Card</th>
                                            <th>Title Card</th>
                                            <th>Status</th>
                                            <th>ID Skp</th>
                                            <th>Detail Skp</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div>
                                    <a class="btn btn-sm btn-primary" href="<?php echo site_url('Milestone') ?>">Back</a>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
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
<!-- Modal Add -->



<!-- jQuery -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.dataTables.js' ?>"></script>
<script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
    $(function() {
        let awal = $('#tglawal_text').val();
        let akhir = $('#tglakhir_text').val();
        const id_project = $('#id_project').val();
        const id_card = $('#id_card').val();
        // $('#btn_export').attr('href', '<?php echo base_url('Vaksinjateng/exportdata') ?>?awal=' + awal + '&akhir=' + akhir);
        $('#tglawal').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $('#tglakhir').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $('#datevaksin1').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $('#datevaksin2').datetimepicker({
            format: 'DD/MM/YYYY'
        });

        $('#tanggal_lahir').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $('#alsntunda').on('keyup', function() {
            let alasan = $(this).val();
            $('#alasanbatal').val(alasan);
        })

        $('#alsnbtl1').on('keyup', function() {
            let alasan = $(this).val();
            $('#alasanbatal').val(alasan);
        })




        const showTable = (awal, akhir, id) => {

            let tableBangsal = $('#tbProject').DataTable({

                "destroy": true,
                "bProcessing": true,
                "bAutoWidth": false,
                "bFilter": true,
                "bSort": true,
                "bserverSide": true,
                "scrollX": true,
                "scrollY": true,
                "sAjaxSource": '<?php echo base_url('Card/detailCard') ?>/' + id,
                "aoColumns": [{
                        "mData": "nomor",
                        className: "text-center"
                    },

                    {
                        "mData": "idticket"
                    },
                    {
                        "mData": "desctitle"
                    },
                    {
                        "mData": "desccomplain"
                    },
                    {
                        "mData": "progres"
                    },
                    {
                        "mData": "idcard"
                    },
                    {
                        "mData": "titlecard"
                    },
                    {
                        "mData": "status"
                    },
                    {
                        "mData": "idskp"
                    },
                    {
                        "mData": "skpdetail"
                    },
                    {
                        "mData": "action"
                    }
                ],
                "fixedColumns": false
            });
        }
        showTable(awal, akhir, id_project)

        const ManageBangsal = (url, dataObj) => {
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
                    response.response === true && $('#modalAdd').modal('hide');

                },
                error: function(error) {
                    swal('Maaf', 'server bermasalah', 'error')
                }
            })
        }

        $('#btn-tambah').on('click', function() {
            $('#title').html('Tambah Milestone')
            $('#milestoneid_edt').val('');
            $('#milestonename').val('');
            $('#modalAdd').modal('show');
        })

        $('#tbProject').on('click', '#btn-detail-card', function() {
            // const milestoneid = $(this).data('milestoneid');
            // const milestonename = $(this).data('milestonename');
            // const projectid = $(this).data('projectid');
            // const projectname = $(this).data('projectname');
            // $('#title').html('Edit Milestone')
            // $('#milestoneid_edt').val(milestoneid);
            // $('#milestonename').val(milestonename);
            // $('#projectid').select2("val", "");
            // $('#modalBangsal').modal('show');

            const showTable = (awal, akhir, id) => {

                let tableBangsal2 = $('#tbProject2').DataTable({

                    "destroy": true,
                    "bProcessing": true,
                    "bAutoWidth": false,
                    "bFilter": true,
                    "bSort": true,
                    "bserverSide": true,
                    "scrollX": true,
                    "scrollY": true,
                    "sAjaxSource": '<?php echo base_url('Milestone/getPic') ?>/' + id,
                    "aoColumns": [{
                            "mData": "nomor",
                            className: "text-center"
                        },

                        {
                            "mData": "idticket"
                        },

                        {
                            "mData": "idcard"
                        },
                        {
                            "mData": "idpic"
                        }
                    ],
                    "fixedColumns": false
                });
            }
            showTable(awal, akhir, id_card)
            $('#modalBangsal').modal('show');
        })


        $('#tbBangsal').on('click', '#btn-delete', function() {
            const milestoneid = $(this).data('milestoneid');
            const url = '<?php echo base_url('api/bangsal/deleteBangsal') ?>';
            const data = {
                milestoneid: milestoneid
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
                        ManageBangsal(url, data);
                        showTable();
                    } else {
                        swal("Cancel");
                    }
                });
        });


        $('#btn_save').on('click', function() {
            let milestoneid = $('#milestoneid_edt').val();
            let milestonename = $('#milestonename').val();
            // let projectid;
            // if (rs !== '') {
            //   projectid = rs
            // } else {
            //   projectid = $('#projectid').val();
            // }
            let data;
            let url;
            if (milestoneid !== '') {
                data = {
                    milestoneid: milestoneid,
                    milestonename: milestonename,
                    // projectid: projectid
                }
                url = '<?php echo base_url('api/bangsal/updateBangsal') ?>'
                ManageBangsal(url, data);
                showTable();
                return;
            }
            data = {
                milestonename: milestonename,
                // projectid: projectid
            };
            url = '<?php echo base_url('api/bangsal/addBangsal') ?>'
            ManageBangsal(url, data)
            showTable();
        })

        $('#btnsearch').on('click', function() {
            awal = $('#tglawal_text').val();
            akhir = $('#tglakhir_text').val();
            showTable(awal, akhir);
            // $('#btn_export').attr('href', '<?php echo base_url('Vaksinjateng/exportdata') ?>?awal=' + awal + '&akhir=' + akhir + '&search=' + search);
            // $('#btn_export_lansia').attr('href', '<?php echo base_url('Vaksinjateng/exDataLansia') ?>?awal=' + awal + '&akhir=' + akhir);
            // $('#btn_export_nonlansia').attr('href', '<?php echo base_url('Vaksinjateng/exDataNonLansia') ?>?awal=' + awal + '&akhir=' + akhir);
        });

    });
</script>