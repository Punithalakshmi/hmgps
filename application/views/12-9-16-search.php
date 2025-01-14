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
<script src="<?php echo base_url();?>assets/js/show_position.js"></script>
    
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
<div class="google-add right-add02">
        <!-- Google ads -->
        
        <ins class="adsbygoogle"
             style="display:block;"
             data-ad-client="ca-pub-3938942410095568"
             data-ad-slot="1328814540"
             data-ad-format="horizontal">
        </ins>
        
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
        
    </div>
    <style type="text/css">
.google-add.right-add02 {
    margin: auto;
    text-align: center;
}
/**
 * div#map {
 *     height: 83vh!Important;
 * }
 */
    </style>
<script>

    //$(document).on("pagecreate",function(event){
         // $(window).on("orientationchange",function(event){
//            var orientat = event.orientation;
//          });                     
   // });

    if($('div[id="header_toggle"]').text())
      $('#header_toggle').hide();

     // Define your locations: HTML content for the info window, latitude, longitude
    var locations       = <?php echo $locations;?>;

    var contents        = <?php echo $contents;?>;
    
    var participant_ct  = <?php echo $participant_count ?>;
       
    var mheader         = '<?php echo $mobile_header; ?>';
    
   // alert(mheader);
    
    var user_id = '<?php echo $user_id;?>';
    
    var sel_group_id = false;

    var markers = new Array();

    var map = '',geocoder = '', savedMapLat='', savedMapLng='', savedMapZoom='';

    var reloadzoomlvl = '';

    var infowindow = new google.maps.InfoWindow({
          maxWidth: 250 
        });
    window.localStorage.removeItem('mapzoom');
    
    
    var trackingUser    = tracker_details("trackinguser");
    var trackedUser     = tracker_details("trackeduser");
    var splitStr        = get_user_changed_position("myMapCookie"); 
    var trackedStr      = get_user_changed_position("trackedUser_position");

    
    map_search(locations,contents,user_id,1);  

    function map_search(locations,contents,user_id,stable){

        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }

        markers = new Array();


        $("#count-participants").html(participant_ct);

        reloadzoomlvl = window.localStorage.getItem('mapzoom');

        
        if(serchval!=''){

           var myInterval = setInterval(function(){
              geolocation();
              user_position_save(user_id);
              clearInterval(myInterval);
            },120000);
        }  

        
        
        //var gotCookieString = getCookie("myMapCookie"); 
        //var splitStr        = gotCookieString.split("_");
         savedMapLat        = (trackedStr!='')?parseFloat(trackedStr[0]):parseFloat(splitStr[0]);
         savedMapLng        = (trackedStr!='')?parseFloat(trackedStr[1]):parseFloat(splitStr[1]);
         savedMapZoom       = (trackedStr!='')?parseFloat(trackedStr[2]):parseFloat(splitStr[2]);
         
        var centerlat = "";
        var centerlon = "";
        var zoomlvl   = "";
        
        if(splitStr!='' || trackedStr!=''){
            centerlat = (savedMapLat!=0)?savedMapLat:38.53;
            centerlon = (savedMapLng!=0)?savedMapLng:-101.42;
            zoomlvl   = (savedMapZoom!=0)?savedMapZoom:3;
        }
        else
        {
            centerlat = (locations[0][1]!=0)?locations[0][1]:38.53;
            centerlon = (locations[0][2]!=0)?locations[0][2]:-101.42;
            zoomlvl   = (locations[0][1]!=0)?20:3;
        }
        //if(locations.length > 0){
//        	centerlat = (locations[0][1]!=0)?locations[0][1]:38.53;
//        	centerlon = (locations[0][2]!=0)?locations[0][2]:-101.42;
//        	zoomlvl   = (locations[0][1]!=0)?13:3;
//        }
        
        //remove the localstroage
        window.localStorage.removeItem('mapzoom'); 

        if(stable == 1){

        map = new google.maps.Map(document.getElementById('map'), {

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
          panControlOptions: { position: google.maps.ControlPosition.TOP_RIGHT
                              },
         
          overviewMapControl:true,
          rotateControl:true,
          rotateControlOptions:{
                                position: google.maps.ControlPosition.LEFT_TOP
                              },
          heading: 90,
          tilt: 45

          
        });

        var geoloccontrol = new klokantech.GeolocationControl(map, 15);

        }
        //loadMapState();
        
        geocoder = new google.maps.Geocoder();   

        google.maps.event.addListener(map, 'dragstart', function() {
          $("#geolocationIcon").css('background-position','0px center');
        }); 
           
       
        /*
        var GeoMarker = new GeolocationMarker(map);
        GeoMarker.setCircleOptions({fillColor: '#FFFFFF',visible:false,radius:5,clickable:true,editable:true});
        */
        
        var iconCounter = 0;

        var colors = ['F08080','C6EF8C'];
        
         var filters = '',filters1 ='', groupname = '', infoindexx = '', partcipanthead = '', clues = '', staticmap = '', markericon='';
        
         groupname = '<?php echo $this->uri->segment(2);?>';
          
          if(groupname == '') {
            groupname = popuptrigger;
          }
     
          /*
          icon:'https://chart.googleapis.com/chart?chst=d_bubble_text_small&chld=edge_bc|'+locations[i][0]+'|'+colors[locations[i][3]]+'|000000'
           icon:'https://chart.googleapis.com/chart?chst=d_map_spin&chld=1|0|ffffff|12|_|'+locations[i][0]
          icon:'https://chart.googleapis.com/chart?chst=d_fnote_title&chld=balloon|2|'+colors[locations[i][3]]+'|h|'+locations[i][0]
          */
        // Add the markers and infowindows to the map

        if(locations.length > 0){

          filters += '<li class="map-list-label"><span class="name">Participant</span> <span>Find</span> <span>Status</span></li>';

        }

        for (var i = 0; i < locations.length; i++) {  
           staticmap = locations[i][7];
          var dat    = new Date((contents[i][1]*1000));
          
          if(staticmap != 'staticmap'){
            markericon = site_url+'/mapicon/index/'+locations[i][0]+'/'+locations[i][3]+'/'+locations[i][4];
          }
          else
          {
            markericon = '';
          }
          
          var marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map,
            animation: google.maps.Animation.DROP,
            title: locations[i][0]+'\nUpdated : '+formattime(dat),
            optimized: false,
            draggable:true,
            icon:markericon
            
          });
          markers.push(marker);

          if(locations[i][1] == 0 || locations[i][2] == 0)
            markers[i].setMap(null);

          google.maps.event.addDomListener(marker, 'click', (function(marker, i) {
            return function() {    
              dat = new Date((contents[i][1]*1000));          
              var cont = contents[i][0].replace("<<lastseen>>",formattime(dat) );
              infowindow.setContent(cont);
              infowindow.open(map, marker);
            }
          })(marker, i));
          
            
          var group_admin_icon = "", invisible_icon = "";

          groupname  = groupname.toLowerCase();
          var locat  = locations[i][5].toLowerCase();
          
          
          if(groupname == locat && staticmap == '') {
            
            sel_group_id = i;

            group_admin_icon= '<span class="group_admin sprite-image">&nbsp;</span>';

            partcipanthead += '<li class="text-center map-admin">Administrator : '+locations[i][0].substring(0,10)+'</li>';

            //centger on current position
            if(splitStr == '' && trackedStr ==''){
                posclick(sel_group_id);
            }
          }
            invisible_icon = '<span class="invisible_icon">&nbsp;</span>';
            
             var invisible = locations[i][6];
             var gpus      = locations[i][0].substring(0,13);
             var ctrack    = locations[i][5].substring(0,13);
             
             
          if(invisible == 0 && staticmap == '') { 
             
             var highlight_classname = '';
             if((user_id == trackingUser) && (gpus == trackedUser || ctrack == trackedUser) ){
               highlight_classname = 'highlight'; 
             }
             else
             {
                highlight_classname = 'sprite-image'; 
             }
             
            filters += '<li><a href="javascript:posclick('+ i + ')"><div class="p-parti"><span class="name"><b>DN: </b> '+gpus+'</span><span class="name"><b>CHID: </b>'+ctrack+'</span></div></a><div class="p-find-iocn">'+group_admin_icon+'<a href="javascript:posclick('+ i + ')" class="myposition '+highlight_classname+'">&nbsp;</a><a href="javascript:myclick('+ i + ',1)" class="statuspop sprite-image">&nbsp;</a></div></li>';
          }
          
          if(invisible == 1 && staticmap == '') { 
            filters1 += '<li><a href="javascript:posclick('+ i + ')"><div class="p-parti"><span class="name"><b>DN: </b>'+gpus+'</span><span class="name"><b>CHID: </b>'+ctrack+'</span></div></a><div class="p-find-iocn">'+group_admin_icon+invisible_icon+'</div></li>';
          }
          
          //clues integration by punitha
          if(invisible =='' && staticmap == 'staticmap') {
            clues += '<li><a href="javascript:posclick('+ i + ')"><div class="p-parti"><span class="name"><b>DN: </b> '+gpus+'</span><span class="name"><b>CHID: </b>'+ctrack+'</span></div></a><div class="p-find-iocn"><a href="javascript:posclick('+ i + ')" class="myposition sprite-image">&nbsp;</a><a href="javascript:myclick('+ i + ',1)" class="statuspop sprite-image">&nbsp;</a></div></li>';
          }
          
        }
        
        google.maps.event.addListener(map, "dblclick", function(event) {
               placeMarker(event.latLng,'dbclick'); 
        });
        
        // this is our gem
        google.maps.event.addDomListener(window, "resize", function() {
         
          // if(mheader == 'yes') {
            google.maps.event.trigger(map, "resize");
            var splitStr        = get_user_changed_position("myMapCookie"); 
            var trackedStr      = get_user_changed_position("trackedUser_position");
            if(splitStr!='' || trackedStr!=''){
              var   savedMapLat        = (trackedStr!='')?parseFloat(trackedStr[0]):parseFloat(splitStr[0]);
              var   savedMapLng        = (trackedStr!='')?parseFloat(trackedStr[1]):parseFloat(splitStr[1]);
              var   savedMapZoom       = (trackedStr!='')?parseFloat(trackedStr[2]):parseFloat(splitStr[2]);
              map.setCenter(new google.maps.LatLng(savedMapLat,savedMapLng));
              map.panBy(20,250);
            }
            else
            {
              map.setCenter(markers[sel_group_id].getPosition());
              map.panBy(20,250);
            }
        });
        
        
        // as a suggestion you could use the event listener to save the state when zoom changes or drag ends
        google.maps.event.addListener(map, 'tilesloaded', tilesLoaded);    
            
        if(filters1){
          filters += '<li class="text-center invisible-head">Invisible Participants</li>';
          filters += filters1;
        } 
        
        //added clues header 
        if(clues){
            filters  += '<li class="text-center invisible-head">Static Maps/Clues</li>'
            filters += clues;
        }
       
        document.getElementById("participants-list").innerHTML = partcipanthead + filters;
      
    }
    
   
    var marker;    
    function placeMarker(location,eventtype = '') {
       
        if(marker){ 
            marker.setPosition(location); 
        }else
        {
           
            if(eventtype != 'dragevent') {
                marker = new google.maps.Marker({ 
                    position: location, 
                    map: map
                });
            } 
        }
        getAddress(location);
    }

    function getAddress(latLng) 
    {
        geocoder.geocode( {'latLng': latLng},
          function(results, status) {
            if(status == google.maps.GeocoderStatus.OK) {
              if(results[0]) {
                $(".popover #guest_address").val(results[0].formatted_address);
              }
              else {
                $(".popover #guest_address").val("No results");
              }
            }
            else {
              $("guest_address").val(status);
            }
          });
     }    
        
    function myclick(i,tag) 
    {
        if(tag == 1 )
         google.maps.event.trigger(markers[i], "click");
            
         var bounds = new google.maps.LatLngBounds();
        
         bounds.extend(markers[i].position);
         map.fitBounds(bounds);
         
         map.setCenter(markers[i].getPosition());
        // var pb = (orientat == 'landscape')?210:160;
         if(mheader == 'yes') {
           // map.panBy(20,pb);
         }  
         //if(reloadzoomlvl==1)
          //map.setZoom(17);   
    }

    function posclick(i) 
    {
         var bounds = new google.maps.LatLngBounds();
         bounds.extend(markers[i].position);
         map.fitBounds(bounds);
         map.setCenter(markers[i].getPosition());
      //   var pb = (orientat == 'landscape')?210:160;
         if(mheader == 'yes') {
           // map.panBy(20,pb);
         } 
    }
   
    function rotate90() {
      var heading = map.getHeading() || 0;
      map.setHeading(heading + 90);
    }


    function closeinfowindow(closeid){
        infowindow.close();
        if(closeid != 1){
           setTimeout(function(){ map.setZoom(16); },2000);
        }
    }
    
 
  $('#sharethis a').click(function(){

      var $scocial = $(this).parents("#sharethis").find('.vertical');

        if($scocial.length){
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
    
        var res = latlon.split(":");

        if(res.length <= 1){
          res[0] = 'noloc';
          res[1] = 'noloc';
        }

        $.post('<?php echo site_url();?>/home/user_position_save/'+user_id+'/'+res[0]+'/'+res[1], {}, function(response){
             
            //ajax_loader(1);
            window.localStorage.setItem('mapzoom', '1');

            var srchkey = $("#search").val();

            if(srchkey!=''){

                $.post('<?php echo site_url();?>/home/search/'+srchkey+'/1', {}, function(response){
                
                    if(response!=''){
                        response = JSON.parse(response);
                        map_search(response.locations,response.contents,response.user_id,0);
                    }
                });
            }              
            
        });
        
      
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
             
                location.href='<?php echo site_url();?>/search/'+channel_id;  
        });     
  }   
  
  function tilesLoaded() {
 
    google.maps.event.clearListeners(map, 'tilesloaded');
    google.maps.event.addListener(map, 'zoom_changed', saveMapState);
    google.maps.event.addListener(map, 'dragend', saveMapState);
}   


// functions below

function saveMapState() 
{ 
    
    var mapZoom   = map.getZoom(); 
    var mapCentre = map.getCenter(); 
    
    var mapLat = mapCentre.lat(); 
    var mapLng = mapCentre.lng(); 
    var cookiestring=mapLat+"_"+mapLng+"_"+mapZoom; 
    setCookie("myMapCookie",cookiestring, 30); 
    
    var trackedUser_zoom_update = get_user_changed_position("trackedUser_position");
   if(trackedUser_zoom_update!='') {
        var cookie_zoom = trackedUser_zoom_update[0]+"_"+trackedUser_zoom_update[1]+"_"+mapZoom;
        setCookie("trackedUser_position",cookie_zoom, 30);
    }
    placeMarker(mapCentre,'dragevent'); 
} 

function loadMapState() 
{ 
    var gotCookieString = getCookie("myMapCookie"); 
    var splitStr        = gotCookieString.split("_");
    var savedMapLat     = parseFloat(splitStr[0]);
    var savedMapLng     = parseFloat(splitStr[1]);
    var savedMapZoom    = parseFloat(splitStr[2]);
    if ((!isNaN(savedMapLat)) && (!isNaN(savedMapLng)) && (!isNaN(savedMapZoom))) {
        map.setCenter(new google.maps.LatLng(savedMapLat,savedMapLng));
        map.setZoom(savedMapZoom);
    }
}

function setCookie(c_name,value,exdays) {
    var exdate=new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
    document.cookie=c_name + "=" + c_value;
}

function getCookie(c_name) {
    var i,x,y,ARRcookies=document.cookie.split(";");
   
    for (i=0;i<ARRcookies.length;i++)
    {
      x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
      y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
      x=x.replace(/^\s+|\s+$/g,"");
      
       if (x==c_name){
        
        return unescape(y);
       }
      }
    return "";
} 

function trackuser()
{
    
   var already_tracked = tracker_details("trackeduser");
    
       if(!$(".track_userr").is(":checked")){
         if(confirm("Do you want to cancel track this member: "+already_tracked)) {
             document.cookie="trackeduser=;expires=Mon, 01 Jan 2015 00:00:00 GMT";
             document.cookie="trackinguser=;expires=Mon, 01 Jan 2015 00:00:00 GMT";
             document.cookie="trackmapID=;expires=Mon, 01 Jan 2015 00:00:00 GMT";
             document.cookie="trackedUser_position=;expires=Mon, 01 Jan 2015 00:00:00 GMT";
             return true;
         }
       }
       else
       {
         
           $("input[type='checkbox']").prop( "checked", function( i, val ) {
            
                  var uid = $(".track_userr").attr("data-uid");
                  var sid = $(".track_userr").attr("data-mapsearch");
                  var cid = $(".track_userr").attr("data-chid");
              
                  var al_uid = getCookie("trackinguser");
                  
                  var mapZoom   = map.getZoom(); 
                  var mapCentre = map.getCenter(); 
                
                  var mapLat = mapCentre.lat(); 
                  var mapLng = mapCentre.lng(); 
                  var cookiestring = mapLat+"_"+mapLng+"_"+mapZoom;
                  setCookie("trackedUser_position",cookiestring, 30);
                      
                  if(uid == al_uid) {
                    if(confirm("Do you want to cancel track this member "+tracker_details("trackeduser"))) {
                      setCookie("trackeduser",cid,2);
                    }
                  }
                  else
                  {
                    if(confirm("Do you want to track this member: "+cid)) {
                         setCookie("trackeduser",cid,2);
                         setCookie("trackinguser",uid,2);
                         setCookie("trackmapID",sid,2);
                         alert("You are now tracking map member: "+cid);
                         return true; 
                    } 
                  }
                 
           });
    }
}

function get_user_changed_position(cookie_name) {
    var trackeduserpos  = getCookie(cookie_name);
    var posstr = trackeduserpos.split("_");
    return posstr;
}

function tracker_details(cookie_name) {
    var trackdet  = getCookie(cookie_name);
    return trackdet;
}


</script>
