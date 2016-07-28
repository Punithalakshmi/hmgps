<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport"  content="initial-scale=1.0, user-scalable=no">
<meta charset="utf-8">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Hmgps</title>
<!-- Bootstrap -->
<link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/social-buttons-share.css">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="<?php echo base_url();?>assets/js/jquery-1.10.2.js"></script> 

<script src="<?php echo base_url();?>assets/js/social-buttons-share.js"></script>

<script src="http://maps.google.com/maps/api/js?v=3.exp&sensor=true"></script>
<script>
 var service_resp = <?php echo json_encode($service_resp);?>;

 var user_info = <?php echo json_encode($user_info);?>;

 var site_url = '<?php echo site_url();?>';

 var  serchval = '<?php echo ($map_search_key)?$map_search_key:get_cookie("map_search"); ?>';

 (function() {
  geolocation();

 })();

      //var accuracy = position.coords.accuracy;
      //var speed = position.coords.speed;
      
 function showLocation(position) {
      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;

      $("#latlang").val(latitude + ":" + longitude);
   }

function errorHandler(err) {
      if(err.code == 1) {
         //alert("Error: Access is denied!");
         $("#latlang").val(1);
      }
      
      else if( err.code == 2) {
         //alert("Error: Position is unavailable!");
         $("#latlang").val(2);
      }
   }

function geolocation() {
   
      if(navigator.geolocation){
         // timeout at 60000 milliseconds (60 seconds)
         var options = {};
         navigator.geolocation.getCurrentPosition(showLocation, errorHandler, options);
      }
      
      else{
         //alert("Sorry, browser does not support geolocation!");
         $("#latlang").val(0);
      }
}


</script>

</head>
<body>
<div class="overlaybg">&nbsp;</div>
<div class="loader"><img src="<?php echo base_url();?>assets/image/loader.gif" ></div>
<div class="container-fluid cf">
  <div class="row">
    <input  value="" name="latlang" id="latlang" type="hidden">
    <input class="form-control" value="" name="map_pos" id="map_pos" type="hidden">
    
  <!-- Modal -->
  <div class="modal fade" id="searchshare" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Quick Share Search Map</h4>
        </div>
        <div class="modal-body">
          <div id="searchmapshare"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>