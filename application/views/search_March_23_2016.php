<style>
	.martop{ margin-top:10px !important;}
	.gm-style-iw + div {left: 10px;}

  /*.gm-style-iw + div { height:30px !important; width:30px !important; border:1px solid red;}
  .gm-style-iw + div:before { content:"x"; font-weight:bold; font-size:18px; padding:0 10px }*/
  .gm-style-iw + div, 
  .gm-style-iw + div img { display: none}

  [data-role="close"] {
    background: red none repeat scroll 0 0;
    border: 1px solid red;
    border-radius: 50%;
    color: #fff;
    cursor: pointer;
    font-size: 14px;
    font-weight: bold;
    height: 20px;
    left: 0;
    line-height: 10px;
    padding: 5px;
    position: absolute;
    text-align: center;
    top: 0;
    width: 20px;
}

</style>

<script src="<?php echo base_url();?>assets/js/geolocationmarker-compiled.js"></script>

<div class="container-fluid search"><!-- Content area Start-->
      <div class="row participant">
          <div id="latlang" style=""></div>
      		<div id="map" style="width:100%; height: 600px;"></div>

          <div class="btn-group btn-participant">
            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Participants(<span id="count-participants">0</span>) <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" id="participants-list">
              
            </ul>
          </div>

      </div>
</div>

<div class="modal fade" id="error_throw">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Error</h4>
      </div>
      <div class="modal-body">
        <div style="color:#a94442;"><?php echo $service_resp['message']; ?></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

     // Define your locations: HTML content for the info window, latitude, longitude
    var locations = <?php echo $locations;?>;

    $("#count-participants").html(locations.length);

    var contents = <?php echo $contents;?>;

    var user_id = '<?php echo $user_id;?>';
    
    var sel_group_id = false;

    var reloadzoomlvl = window.localStorage.getItem('mapzoom');

    
    if(serchval!=''){
	     setInterval(function(){
         user_position_save(user_id);
         
      }, 60000);
     }  

    var centerlat = 40.71;
    var centerlon = -74.00;
    var zoomlvl = 2;

    if(locations.length > 0){
    	centerlat = locations[0][1];
    	centerlon = locations[0][2];
    	zoomlvl = 13;

    }
    
    //remove the localstroage
    window.localStorage.removeItem('mapzoom'); 

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: zoomlvl,
      center: new google.maps.LatLng(centerlat, centerlon),
      mapTypeControl: true,
      mapTypeControlOptions: {
                                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                                mapTypeIds: [                                
                                  google.maps.MapTypeId.ROADMAP,
                                  google.maps.MapTypeId.SATELLITE,
                                  google.maps.MapTypeId.TERRAIN

                                ]
                              },
      streetViewControl: true,
      zoomControl: true,
      zoomControlOptions: {
          position: google.maps.ControlPosition.LEFT_TOP,
      },
      streetViewControlOptions: {
        position: google.maps.ControlPosition.LEFT_TOP
      },
      scaleControl:true,
      scrollwheel:true,
      panControl: true,
      panControlOptions: {
                            position: google.maps.ControlPosition.TOP_RIGHT
                          },
     
      overviewMapControl:true,
      rotateControl:true,
      rotateControlOptions:{
                            position: google.maps.ControlPosition.LEFT_TOP
                          },
      heading: 90,
      tilt: 45

      
    });
        
       
    var GeoMarker = new GeolocationMarker(map);
    GeoMarker.setCircleOptions({fillColor: '#FFFFFF',visible:false,radius:5,clickable:true,editable:true});

    var infowindow = new google.maps.InfoWindow({
      maxWidth: 250
    });

    var markers = new Array();
    
    var iconCounter = 0;

    var colors = ['F08080','C6EF8C'];
    
    //map.setMyLocationEnabled(true);

     var filters = '', groupname = '', infoindexx = '';
    
     groupname = '<?php echo $this->uri->segment(2);?>';
      
      if(groupname == '') {
        groupname = popuptrigger;
      }
 
   

    // Add the markers and infowindows to the map
    for (var i = 0; i < locations.length; i++) {  

      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        animation: google.maps.Animation.DROP,
        title:locations[i][0],
        icon:site_url+'/mapicon/index/'+locations[i][0]+'/'+locations[i][3]+'/'+locations[i][4]
        //icon:'https://chart.googleapis.com/chart?chst=d_bubble_text_small&chld=edge_bc|'+locations[i][0]+'|'+colors[locations[i][3]]+'|000000'
         //icon:'https://chart.googleapis.com/chart?chst=d_map_spin&chld=1|0|ffffff|12|_|'+locations[i][0]
        //icon:'https://chart.googleapis.com/chart?chst=d_fnote_title&chld=balloon|2|'+colors[locations[i][3]]+'|h|'+locations[i][0]
      });
      markers.push(marker);

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          var dat = new Date((contents[i][1]*1000));
          var cont = contents[i][0].replace("<<lastseen>>",formattime(dat) );
          infowindow.setContent(cont);
          infowindow.open(map, marker);
        }
      })(marker, i));


      filters += '<li><a href="javascript:myclick('+ i + ')">'+locations[i][0]+'</a></li>';
      
      if(groupname == locations[i][5]) {
        
        sel_group_id = i;
      }
    }


    document.getElementById("participants-list").innerHTML = filters;

    function myclick(i) 
    {
        
         google.maps.event.trigger(markers[i], "click");

         var bounds = new google.maps.LatLngBounds();
        
         bounds.extend(markers[i].position);
         map.fitBounds(bounds);

         map.setCenter(markers[i].getPosition());

         if(reloadzoomlvl==1)
          map.setZoom(3);
         
    }
   
    function rotate90() {
      var heading = map.getHeading() || 0;
      map.setHeading(heading + 90);
    }


    function closeinfowindow(){
        infowindow.close();
    }
    
   
  
    /*
    function autoCenter() {
      //  Create a new viewpoint bound
      var bounds = new google.maps.LatLngBounds();
      //  Go through each...
      for (var i = 0; i < markers.length; i++) {  
        bounds.extend(markers[i].position);
      }
      //  Fit these bounds to the map
      map.fitBounds(bounds);
    }
    autoCenter();
    */
 
$('#sharethis a').click(function(){

      var $scocial = $(this).parents("#sharethis").find('.vertical');

        if( $scocial.length )
        {
          $scocial.remove();
        }
        else
        {
            $("#sharethis").socialButtonsShare({
              socialNetworks: ["facebook", "twitter", "googleplus", "pinterest", "tumblr"],
              url: '<?php echo site_url();?>/search/'+serchval,
              text: "Here's My GPS",
              sharelabel: false,
              sharelabelText: "SHARE",
              verticalAlign: true
            });
        }
        
      });


  
  function user_position_save(user_id){
     
      var latlon = $("#latlang").val();

      if(latlon!='' && latlon!=0 && latlon!=1 && latlon!=2){

        var res = latlon.split(":");

        $.post('<?php echo site_url();?>/home/user_position_save/'+user_id+'/'+res[0]+'/'+res[1], {}, function(response){
             //var reval = confirm("Do you want to reload this page");
             // if(reval == true) {
                window.localStorage.setItem('mapzoom', '1');
                location.href='<?php echo base_url();?>search'; 
             // }
             map.setZoom(2);
        });
        
      }
      else
      {
        location.href='<?php echo base_url();?>search'; 
      }  
      
    }

    function formattime(date) {

    var days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';

    var month = (date .getMonth()+1);
    month = month < 10 ? '0'+month : month;

    var day = days[date.getDay()];
    var fulldate = date .getDate()+"-"+ month +"-"+date .getFullYear();

    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;

    var strTime = hours + ':' + minutes + ' ' + ampm + ' '+ day + ' ' + fulldate;

    return strTime;
  }
    
  
  function group_user_delete(group_id,user_id,channel_id){
     
        $.post('<?php echo site_url();?>/home/delete_member/'+user_id+'/'+group_id, {}, function(response){
             
                location.href='<?php echo base_url();?>search/'+channel_id;  
        });
        
  }

      
    
</script>