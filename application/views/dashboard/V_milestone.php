<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Project<?php
                                $projectname = $this->session->userdata('projectname');
                                $projectid = $this->session->userdata('projectid');
                                echo $projectname; ?></h1>
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

    <!-- modal terbaru -->
    <div class="modal fade show" id="modalBangsal" aria-modal="true">
        <div class="modal-dialog modal-lg" style="max-width:1200px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Project</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formVaksinasi">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Project</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>ID Project :</label>
                                                <input type="text" placeholder="ID Project" name="projectid_edt" id="projectid_edt" autocomplete="off" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama Project :</label>
                                                <input type="text" placeholder="Nama Project" name="projectname" id="projectname" autocomplete="off" class="form-control" readonly>
                                                <!-- <input type="hidden" name="projectid_edt" id=""> -->
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Deskripsi Project :</label>
                                                <textarea class="form-control" type="text" aria-label="With textarea" placeholder="Deskripsi Project" name="projectdesc" id="projectdesc" autocomplete="off" class="form-control" readonly></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>PIC Project :</label>
                                                <input type="text" placeholder="PIC Project" name="pic" id="pic" autocomplete="off" class="form-control" readonly>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Progres</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Tanggal Mulai :</label>
                                                        <input type="text" placeholder="Tanggal Mulai" name="startdate" id="startdate" autocomplete="off" class="form-control" readonly>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Tanggal Selesai :</label>
                                                        <input type="text" placeholder="Tanggal Selesai" name="enddate" id="enddate" autocomplete="off" class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Status Project :</label>
                                                <input type="text" placeholder="Status Project" name="projectsts" id="projectsts" autocomplete="off" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Progres Project :</label>
                                                <input type="text" placeholder="Nama Project" name="progres" id="progres" autocomplete="off" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Surat</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Tanggal Surat :</label>
                                                        <input type="text" placeholder="Tidak Ada" name="tglsurat" id="tglsurat" autocomplete="off" class="form-control" readonly>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Tanggal Surat Masuk :</label>
                                                        <input type="text" placeholder="Tidak Ada" name="tglsuratmasuk" id="tglsuratmasuk" autocomplete="off" class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nomor Surat :</label>
                                                <input type="text" placeholder="Tidak Ada" name="nosurat" id="nosurat" autocomplete="off" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
                            <h3 class="card-title">Data Project</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">All Project</span>
                                            <span class="info-box-number">13,648</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <div class="col-md-3 col-sm-6 col-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success"><i class="far fa-copy"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Finished Project</span>
                                            <span class="info-box-number">13,648</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <div class="col-md-3 col-sm-6 col-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Open Project</span>
                                            <span class="info-box-number">13,648</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <table id="tbProject" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th col width="5%">No.</th>
                                            <th col width="25%">Nama Project</th>
                                            <th col width="8%">PIC</th>

                                            <th col width="5%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Project</th>
                                            <th>PIC</th>

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
<div class="modal fade show" id="modalAdd" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Milestone Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title" id="title">Tambah Milestone </h3>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">ID</label>
                                        <div class="col-xs-9">
                                            <!-- <input name="Mid" id="milestoneid" value="<?php echo $no; ?>" class="form-control" type="text" s required> -->
                                            <input name="Mid" id="milestoneid" class="form-control" type="text" placeholder="Isi ID Milestone" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Nama Milestone</label>
                                        <div class="col-xs-9">
                                            <input name="Mname" id="milestonename" class="form-control" type="text" placeholder="Isi Nama Milestone" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Deskripsi</label>
                                        <div class="col-xs-9">
                                            <textarea class="form-control" aria-label="With textarea" name="Mdesc" id="Milestonedesc" type="text" placeholder="Isi Deskripsi Milestone"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Tanggal Mulai</label>
                                        <div class="input-group date" id="tglmulai" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicke" value="<?php echo date('Y/m/d') ?>" data-target="#tglmulai" name="Sdate" id="Startdate" placeholder="Tanggal Mulai Tugas" />
                                            <div class="input-group-append" data-target="#tglmulai" data-toggle="datetimepicker">
                                                <div class="input-group-text "><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Tanggal Selesai</label>
                                        <div class="input-group date" id="tglakhir" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicke" value="<?php echo date('Y/m/d') ?>" data-target="#tglakhir" name="Edate" id="Enddate" placeholder="Tanggal Mulai Tugas" />
                                            <div class="input-group-append" data-target="#tglakhir" data-toggle="datetimepicker">
                                                <div class="input-group-text "><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Status</label>
                                        <div class="col-xs-9">
                                            <input name="Msts" id="Milestonests" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Document</label>
                                        <div class="input-group date" id="tgldoc" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicke" value="<?php echo date('Y/m/d') ?>" data-target="#tgldoc" name="Mdoc" id="Milestonedoc" placeholder="Tanggal Mulai Tugas" />
                                            <div class="input-group-append" data-target="#tgldoc" data-toggle="datetimepicker">
                                                <div class="input-group-text "><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-3 ">Project</label>
                                        <div class="col-xs-9">
                                            <select name="PROJECTID" class="form-control" id="PROJECTID" placeholder="Pilih Project" type="text" required>
                                                <option> </option>
                                                <?php foreach ($project as $da) : ?>
                                                    <option value="<?php echo $da->PROJECTID ?>"><?php echo $da->PROJECTNAME ?> </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class="btn btn-info" id="btn_simpan">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Add -->
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

        const rs = "<?php echo $this->session->userdata('projectid') ?>"
        const token = '<?php echo $token ?>';

        $('#projectid').select2()
        $('#projectid').select2({
            minimumInputLength: 3,
            allowClear: true,
            placeholder: 'Rumah Sakit',
            ajax: {
                url: '<?php echo base_url() ?>RumahSakit/select2RS',
                dataType: 'json',
                type: 'GET',
                delay: 500,
                data: function(params) {
                    return {
                        search: params.term
                    }
                },
                processResults: function(data, page) {
                    return {
                        results: data
                    };
                }
            }
        })
        const showTable = (awal, akhir) => {
            let tableBangsal = $('#tbProject').DataTable({
                "destroy": true,
                "bProcessing": true,
                "bAutoWidth": false,
                "bFilter": true,
                "bSort": true,
                "bserverSide": true,
                "scrollX": true,
                "scrollY": true,
                "sAjaxSource": '<?php echo base_url('Project/dataProject') ?>?awal=' + awal + '&akhir=' + akhir,
                "aoColumns": [{
                        "mData": "nomor",
                        className: "text-center"
                    },
                    {
                        "mData": "milestonename"
                    },
                    {
                        "mData": "idticket"
                    },
                    {
                        "mData": "action"
                    }
                ],
                "fixedColumns": false
            });
        }
        showTable(awal, akhir)

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

        $('#tbProject').on('click', '#btn-detail', function() {
            const projectid = $(this).data('projectid');
            const projectname = $(this).data('projectname');
            const projectdesc = $(this).data('projectdesc');
            const tglsuratmasuk = $(this).data('tglsuratmasuk');
            const nosurat = $(this).data('nosurat');
            const tglsurat = $(this).data('tglsurat');
            const pic = $(this).data('pic');
            const progres = $(this).data('progres');
            const projectsts = $(this).data('projectsts');
            const startdate = $(this).data('startdate');
            const enddate = $(this).data('enddate');
            $('#title').html('Detail Project')
            $('#projectid_edt').val(projectid);
            $('#projectname').val(projectname);
            $('#projectdesc').val(projectdesc);
            $('#tglsuratmasuk').val(tglsuratmasuk);
            $('#nosurat').val(nosurat);
            $('#tglsurat').val(tglsurat);
            $('#pic').val(pic);
            $('#progres').val(progres);
            $('#projectsts').val(projectsts);
            $('#startdate').val(startdate);
            $('#enddate').val(enddate);
            // $('#projectid').select2("val", "");
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