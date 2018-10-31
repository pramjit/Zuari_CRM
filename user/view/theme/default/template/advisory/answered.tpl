<?php 
echo $header;
echo $column_left;
?>
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
    
    <div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12" >
                <div id="profile" style="font-size: 18px;font-weight: bold;color: #337ab7;"></div>
                <div class="clearfix"></div>
                <div class="table-responsive">
                <table id="example" class="table table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>CASE ID</th>
                    <th>MOBILE</th>
                    <th>CALL PIN</th>
                    <th>CALL DATE</th>
                    <th>RESET PIN</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($AdvData as $result){
                    echo "<tr>";
                    echo "<td>".$result['CASE_ID']."</td>";
                    echo "<td>".$result['FAR_MOB']."</td>";
                    echo "<td>".$result['CASE_PIN']."</td>";
                    echo "<td>".date('d M, Y', strtotime($result['CR_DATE']))."</td>";
                    echo "<td><div class='btn btn-warning btn-block' style='cursor: pointer;' onclick='ResetPin(".$result['CASE_ID'].','.$result['FAR_MOB'].");'>Reset</div></td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>CASE ID</th>
                    <th>MOBILE</th>
                    <th>CALL PIN</th>
                    <th>CALL DATE</th>
                    <th>RESET PIN</th>
                </tr>
                </tfoot>
                </table>
                </div>
            </div>
        </div>  
    </div>
    </div>
    </div>
</div> 
<?php echo $footer; ?>
<style type="text/css">
.abc{   color: #F00;
        padding-top: 10px;
        position: absolute;
        left: 5px;
        font-size: 20px;
}
</style>
<script src="user/view/javascript/bootstrap/js/select2.js"></script>
<link href="user/view/javascript/bootstrap/css/select2.css" rel="stylesheet" type="text/css"/>
<script src="user/view/javascript/alertify/alertify.js"></script>
<link href="user/view/javascript/alertify/alertify.css" rel="stylesheet" type="text/css"/>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#example").dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
            "bSort" : false,
            "dom": '<"top"f>rt<"bottom"p><"clear">',
            "oLanguage": {
            "sSearch": "Search&nbsp;&nbsp;:&nbsp;&nbsp;"}
        });
    });
  //*************** Back to Dashboard *****************//
   function ResetPin(CID,MOB){
       
        if (confirm("Are you sure to reset PIN for Mobile: "+MOB)) {
                $.ajax({
                type: "POST",
                url: "index.php?route=advisory/answered/ResetPin",
                data:  { CID: CID, MOB: MOB },
                dataType: "text",
                success: function(data){
                    alert(data);
                    location.reload("index.php?route=advisory/advisory");
                }
           });
        } else {
            
        }
        return false;
        alert(CID);
            
            
        
    }
</script> 
