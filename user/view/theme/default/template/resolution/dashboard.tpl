
<?php echo $header;?>
<?php echo $column_left;  //print_r($pagination); ?>
<style type="text/css">
    .btn-default {
    background-color: #d4eaf7;
    border-color: #d4eaf7;
    color: #53acdf;
    padding: 10px 10px;
    text-align: center;
}
.col-md-4 , .col-md-8 {
    position: relative;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
    padding-top: 10px;
}
</style>
    
<div id="content">
  <div class="top-bar clearfix">
    <div class="page-title">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <a href="<?php echo $breadcrumb['href']; ?>">
        <?php echo $breadcrumb['text'].'/'; ?>
      </a>
      <?php } ?>
    </div>
    <ul class="right-stats hidden-xs" id="mini-nav-right">
      <button type="button" onclick="backbtn();"   data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default">
        <i class="fa fa-reply">
        </i>
      </button>
    <!--  <button type="button" onclick="download()"   data-toggle="tooltip" title="Download" class="btn btn-download">
        <i class="fa fa-download">
        </i>
      </button>-->
    </ul>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger">
      <i class="fa fa-exclamation-circle">
      </i> 
      <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;
      </button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success">
      <i class="fa fa-check-circle">
      </i> 
      <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;
      </button>
    </div>
    <?php } ?>
<div   class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <div style="font-size: 24px;font-weight: bold;font-family: cursive;color: #3366cc;">RESOLUTION AUTHORITY - CASES</div>
            </div>
            <div class="col-sm-6">
                
                <?php               
                // print_r( $callData);              
                $all = $callData['ALLCASE'];
                $my = $callData['MYCASE'];
                $pen = $callData['PENDING'];
                $clo = $callData['CLOSED'];
                $pro = $callData['PROGRESS'];
                $dataset="['Task', 'Hours per Day'],['MY CASES (".$my.")', ".$my."],['ALL CASES (".$all.")', ".$all."],['PENDING CASES (".$pen.")', ".$pen."],['RESOLVED (".$clo.")', ".$clo."],['IN-PROGRESS (".$pro.")', ".$pro."]";          
              
                ?>
                <div id="Aasit-IN" style="width:600px; height: 500px;"></div>
            </div>
            <div class="col-sm-6">
               
                <?php 
                // print_r( $callData); 
                $tot = count($catData);
                $str="['Task', 'Hours per Day']";
                foreach($catData as $cat){
                $str.=",['".$cat['COMP_SUB_NAME']."(".$cat['COMP_SUB_COUNT'].")',".$cat['COMP_SUB_COUNT']."]";
                }
                ?>
                <div id="Aasit-IN2" style="width:600px; height: 500px;"></div>
            </div>
        </div>  
    </div>
</div>
</div>
</div> 
<?php echo $footer; ?>
<script src="user/view/javascript/bootstrap/js/select2.js"></script>
<link href="user/view/javascript/bootstrap/css/select2.css" rel="stylesheet" type="text/css"/>

<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          <?php echo $dataset; ?>
        ]);
        
        var options = {
          title: 'DATA BY CASE STATUS',
          legend: 'left',
          is3D: true,
        };
      
        var chart = new google.visualization.PieChart(document.getElementById('Aasit-IN'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart2);
      function drawChart2() {
        var data2 = google.visualization.arrayToDataTable([
          <?php echo $str; ?>
        ]);
        
        var options = {
          title: 'DATA BY COMPLAINTS TYPE',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('Aasit-IN2'));
        chart.draw(data2, options);
      }
    </script>
<script>
  function backbtn(){
    url = 'index.php?route=common/dashboard';
    location = url;
  }
</script> 
