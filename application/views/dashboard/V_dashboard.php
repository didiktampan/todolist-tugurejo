<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300&display=swap" rel="stylesheet">
<!-- open sans -->
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<!-- Resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
<style>
    .chartdiv{
        width: 100%;
        height: 500px;
    }
</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Sivico-19 <?php echo $this->session->userdata('fullname')?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
 <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <div class="row" style="display: none;">
            <div class="col-sm-3">
                <div class="form-group">
                  <input type="hidden" id="private_token" name="private_token" value="<?php echo $token ?>">
                    <div class="input-group date" id="datevaksin1" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input color-text vaksin1" data-target="#datevaksin1" name="awal" id="awal" value="<?php echo '22/02/2021' ?>" placeholder="Tanggal"/>
                        <div class="input-group-append" data-target="#datevaksin1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
              <div class="form-group text-center mt-1">
                <h5>sampai</h5>
              </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <div class="input-group date" id="datevaksin2" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input color-text vaksin1" data-target="#datevaksin2" name="akhir" id="akhir" value="<?php echo date('d/m/Y') ?>" placeholder="Tanggal"/>
                        <div class="input-group-append" data-target="#datevaksin2" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
               <button class="btn btn-primary" id="btn-refresh"><i class="fa fa-sync"></i></button> 
            </div>
        </div>
    </div>
  </section> 
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
              <div class="card-header">
                  <h3 class="card-title">Rekap Perbulan</h3>
                  <div class="card-tools">
                      <button tye="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                      <button tye="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
              </div>
              <div class="card-body">
                  <div id="chartRekapBulan" class="chartdiv"></div>
              </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card card-primary">
              <div class="card-header">
                  <h3 class="card-title">Vaksin Pertama</h3>
                  <div class="card-tools">
                      <button tye="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                      <button tye="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
              </div>
              <div class="card-body">
                  <div id="chartVaksinPertama" class="chartdiv"></div>
              </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card card-primary">
              <div class="card-header">
                  <h3 class="card-title">Vaksin Kedua</h3>
                  <div class="card-tools">
                      <button tye="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                      <button tye="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
              </div>
              <div class="card-body">
                  <div id="chartVaksinKedua" class="chartdiv"></div>
              </div>
          </div>
        </div>
        <div class="col-md-4">
          <!-- Calendar -->
          <div class="card bg-gradient-primary">
            <div class="card-header border-0">

              <h3 class="card-title">
                <i class="far fa-calendar-alt"></i>
                Calendar
              </h3>
              <!-- tools card -->
              <div class="card-tools">
                <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-primary btn-sm" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body pt-0">
              <!--The calendar -->
              <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-8">
          <div class="card card-primary">
              <div class="card-header">
                  <h3 class="card-title">Kategori Pekerjaan</h3>
                  <div class="card-tools">
                      <button tye="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                      <button tye="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
              </div>
              <div class="card-body">
                  <div id="chartPekerjaan" class="chartdiv"></div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- jQuery -->
<script src="<?php echo base_url()?>assets/plugins/jquery/jquery.min.js"></script>
<script>
  $(document).ready(function () {
    $('#calendar').datetimepicker({
      format: 'L',
      inline: true
    });
  });
  am4core.ready(function() { 
    let private_token = document.getElementById("private_token").value
    let awal = document.getElementById("awal").value 
    $('#datevaksin1').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    let akhir = document.getElementById("akhir").value 
    $('#datevaksin2').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    const button = document.getElementById("btn-refresh");
    button.addEventListener("click", function(){
        awal = document.getElementById("awal").value 
        akhir = document.getElementById("akhir").value 
        private_token = document.getElementById("private_token").value
        vaksin(awal, akhir, private_token);
        pekerjaan(awal, akhir, private_token);
        rekapPerBulan(awal, akhir, private_token);
    });
    const rekapPerBulan = (awal, akhir, private_token) => {
       
        fetch(`<?php echo base_url('api/rekapitulasi/totalPasientByMonth') ?>?bulan=2021`, {
          method: "get",
          headers: {
              'X-private-token': private_token
          }
        })
        .then(res => res.json())
        .then(res => {
          rekapBulan(res.response);
        })
        .catch(error => alert(error)); 
    }
    const vaksin = (awal, akhir, private_token) => {
        let formData = new FormData();
        formData.append('awal', awal);
        formData.append('akhir', akhir);
        fetch("<?php echo base_url('Apisivico/getAge') ?>", {
            body: formData,
            method: "post",
            headers: {
              'X-private-token': private_token
            }
        })
        .then(res => res.json())
        .then(res => {
            chartVaksinPertama(res.data.vaksin1);
            chartVaksinKedua(res.data.vaksin2);
        })
        .catch(error => alert(error)); 
    }

    const pekerjaan = (awal, akhir, private_token) => {
        let formData = new FormData();
        formData.append('awal', awal);
        formData.append('akhir', akhir);
        fetch("<?php echo base_url('Apisivico/getPekerjaan') ?>", {
          body: formData,
          method: "post",
          headers: {
              'X-private-token': private_token
          }
        })
        .then(res => res.json())
        .then(res => {
          chartPekerjaan(res.data);
        })
        .catch(error => alert(error)); 
    }
    pekerjaan(awal, akhir, private_token);
    rekapPerBulan(awal, akhir, private_token);
    vaksin(awal, akhir, private_token);
    //rekapBulan();
    function rekapBulan(data){
      // Themes begin
      am4core.useTheme(am4themes_animated);
      // Themes end

      // Create chart instance
      const chart = am4core.create("chartRekapBulan", am4charts.XYChart);
      chart.legend = new am4charts.Legend();
      // Create axes
      var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
      dateAxis.renderer.minGridDistance = 50;
      //dateAxis.dateFormats.setKey("day", "MMMM dt");
      
      var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
      //valueAxis.logarithmic = true;
      valueAxis.renderer.minGridDistance = 20;
        // Set up data source
      chart.data = data;
      var series = chart.series.push(new am4charts.LineSeries());
      series.dataFields.valueY = "terlaksana";
      series.dataFields.dateX = "bulan";
      series.name = 'Lanjut';
      //series.tensionX = 0.8;
      series.strokeWidth = 3;
      series.minBulletDistance = 10;
      series.tooltipText = "{valueY}";
      series.tooltip.pointerOrientation = "vertical";
      series.tooltip.background.cornerRadius = 20;
      series.tooltip.background.fillOpacity = 0.5;
      series.tooltip.label.padding(12,12,12,12);

      // var series1 = chart.series.push(new am4charts.LineSeries());
      // series1.dataFields.valueY = "terlaksana";
      // series1.dataFields.dateX = "bulan";
      // series1.name = 'Lanjut';
      // series1.stroke = am4core.color("#28a745");
      // //series1.tensionX = 0.8;
      // series1.strokeWidth = 3;
      // series1.minBulletDistance = 10;
      // series1.tooltipText = "{valueY}";
      // series1.tooltip.pointerOrientation = "vertical";
      // series1.tooltip.background.cornerRadius = 20;
      // series1.tooltip.background.fillOpacity = 0.5;
      // series1.tooltip.label.padding(12,12,12,12);

      var series2 = chart.series.push(new am4charts.LineSeries());
      series2.dataFields.valueY = "ditunda";
      series2.dataFields.dateX = "bulan";
      series2.name = 'Ditunda';
      series2.stroke = am4core.color("#4ae65e");
      //series2.tensionX = 0.8;
      series2.strokeWidth = 3;
      series2.minBulletDistance = 10;
      series2.tooltipText = "{valueY}";
      series2.tooltip.pointerOrientation = "vertical";
      series2.tooltip.background.cornerRadius = 20;
      series2.tooltip.background.fillOpacity = 0.5;
      series2.tooltip.label.padding(12,12,12,12);

      var series3 = chart.series.push(new am4charts.LineSeries());
      series3.dataFields.valueY = "batal";
      series3.dataFields.dateX = "bulan";
      series3.name = 'Tidak diberikan';
      series3.stroke = am4core.color("#e64a67");
      //series3.tensionX = 0.8;
      series3.strokeWidth = 3;
      series3.minBulletDistance = 10;
      series3.tooltipText = "{valueY}";
      series3.tooltip.pointerOrientation = "vertical";
      series3.tooltip.background.cornerRadius = 20;
      series3.tooltip.background.fillOpacity = 0.5;
      series3.tooltip.label.padding(12,12,12,12);

      var bullet = series.bullets.push(new am4charts.CircleBullet());
      bullet.circle.fill = am4core.color("#fff");
      bullet.circle.strokeWidth = 3;
      var bullet = series2.bullets.push(new am4charts.CircleBullet());
      bullet.circle.fill = am4core.color("#fff");
      bullet.circle.strokeWidth = 3;
      var bullet = series3.bullets.push(new am4charts.CircleBullet());
      bullet.circle.fill = am4core.color("#fff");
      bullet.circle.strokeWidth = 3;

      // Add cursor
      chart.cursor = new am4charts.XYCursor();
      chart.cursor.fullWidthLineX = true;
      chart.cursor.xAxis = dateAxis;
      chart.cursor.lineX.strokeWidth = 0;
      chart.cursor.lineX.fill = am4core.color("#000");
      chart.cursor.lineX.fillOpacity = 0.1;

      // Add scrollbar
      chart.scrollbarX = new am4charts.XYChartScrollbar();
      chart.scrollbarX.series.push(series);
    }
    
    function chartVaksinPertama(data){
      // Themes begin
      am4core.useTheme(am4themes_animated);
      // Themes end
      const chart = am4core.create("chartVaksinPertama", am4charts.PieChart3D);
      chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
      chart.legend = new am4charts.Legend();
      // Set up data source
      chart.data = data;

      // Add and configure Series
      var series = chart.series.push(new am4charts.PieSeries3D());
      series.dataFields.value = "value";
      series.dataFields.category = "label";
      series.colors.list = [
        am4core.color("#eaf53f"),
        am4core.color("#4a3ff5"),
        am4core.color("#f53f3f"),
        am4core.color("#4af53f"),
        am4core.color("#3fe4f5"),
      ];
    }

    function chartVaksinKedua(data){
     // Themes begin
     am4core.useTheme(am4themes_animated);
      // Themes end
      const chart = am4core.create("chartVaksinKedua", am4charts.PieChart3D);
      chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
      chart.legend = new am4charts.Legend();
      // Set up data source
      chart.data = data;

      // Add and configure Series
      var series = chart.series.push(new am4charts.PieSeries3D());
      series.dataFields.value = "value";
      series.dataFields.category = "label";
      series.colors.list = [
        am4core.color("#4af53f"),
        am4core.color("#3fe4f5"),
        am4core.color("#eaf53f"),
        am4core.color("#4a3ff5"),
        am4core.color("#f53f3f"),
      ];
    }
    
    function chartPekerjaan(data){
      am4core.useTheme(am4themes_animated);
      var chart = am4core.create("chartPekerjaan", am4charts.XYChart);
      chart.padding(40, 40, 40, 40);
      chart.cursor = new am4charts.XYCursor();
      var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
      categoryAxis.renderer.grid.template.location = 0;
      categoryAxis.dataFields.category = "pekerjaan";
      categoryAxis.renderer.minGridDistance = 1;
      categoryAxis.renderer.inversed = true;
      categoryAxis.renderer.grid.template.disabled = true;

      var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
      valueAxis.min = 0;

      var series = chart.series.push(new am4charts.ColumnSeries());
      series.dataFields.categoryY = "pekerjaan";
      series.dataFields.valueX = "total";
      series.tooltipText = "{valueX.value}"
      series.columns.template.strokeOpacity = 0;
      series.columns.template.column.cornerRadiusBottomRight = 5;
      series.columns.template.column.cornerRadiusTopRight = 5;

      var labelBullet = series.bullets.push(new am4charts.LabelBullet())
      labelBullet.label.horizontalCenter = "left";
      labelBullet.label.dx = 10;
      labelBullet.label.text = "{values.valueX.workingValue.formatNumber('#.0as')}";
      labelBullet.locationX = 1;

      // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
      series.columns.template.adapter.add("fill", function(fill, target){
        return chart.colors.getIndex(target.dataItem.index);
      });

      categoryAxis.sortBySeries = series;
      chart.data = data
    }
  });
</script>