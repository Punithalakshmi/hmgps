   <?php $search_val  = ($map_search_key)?$map_search_key:get_cookie('map_search'); 
      $rand_channelid =  (isset($user_info['channel_id']))?$user_info['channel_id']:'';
      $display_name   =  (isset($user_info['display_name']) && $user_info['display_name']!='')?$user_info['display_name']:$rand_channelid;
      $group_id       =  (isset($user_info['group_id']) && $user_info['group_id']!='')?$user_info['group_id']:'';
   
    ?>
   
    <header class="cf"><!-- Header area Start-->
      
      <div class="container cf"><!-- Container area Start-->

       <div class="row"> 

            <div class=" col-xs-12 col-sm-2 col-md-2 logo"> 
                <a href="<?php echo site_url('home');?>"><img src="<?php echo base_url();?>assets/image/header-logo.png" class="img-responsive" alt="Responsive image"></a>
            </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 mrb ">    

          <div class="row"> 
     
              <div class="header-section-one clearfix">
                    <div class="col-md-9 pal">         
                      <div class="header-inner-top">
                			   <span>
                              <img class="logo" class="logo-by" src="<?php echo base_url();?>assets/image/logo.png" class="img-responsive" alt="logo">
                              <h3>911GPS.me</h3> 
                              <h1>Quickly find anyone or be found. put yourself on a live map!</h1>
                              <img class="powered" class="logo-by" src="<?php echo base_url();?>assets/image/powered-img.jpg" class="img-responsive" alt="powered-img"> 
                           </span>
                      </div>
                    </div> 
                 
                    <div class="col-md-3 top-nav">
                 
                      <div class="top-menu">
                            <ul class="nav navbar-nav">
                              <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                  <li class="active-current"><a href="<?php echo site_url('home');?>">Home</a></li>
                                  <li><a href="<?php echo site_url('search');?>">Search </a></li>
                                  <li><a href="<?php echo site_url('aboutus');?>">About Us</a></li>
                                  <li><a href="<?php echo site_url('help');?>">Help</a></li>
                                  <li><a href="<?php echo site_url('tellus');?>">Tell Us Your Story</a></li>
                                  
                                </ul>
                              </li>
                            </ul>
                        </div>
                   
                    </div> 
                </div>    
       
                <div class="desktop-header">
                                 
                  <div class="col-md-3 section-one box-border"> 

                      <div class="sec-1"> <img src="<?php echo base_url();?>assets/image/search.png" class="img-responsive" alt="Responsive image" ><h4>Quick Search</h4></div> 
                      
                      <form method='post' action='<?php echo site_url('search');?>'>
                          
                          <div class="sec-2"> <img src="<?php echo base_url();?>assets/image/04_maps.png" class="img-responsive" alt="Responsive image"  >
                              <div id="custom-search-input">
                                    <div class="input-group">
                                        <input type="text"  value="<?php echo $search_val;?>" name="search" id="search" class="  search-query form-control" placeholder="Search"/>
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger" type="submit" data-toggle="tooltip" data-placement="top" title="Channel search">
                                                <span class=" glyphicon glyphicon-search"></span>
                                            </button>
                                        </span>
                                    </div>
                              </div>
                          </div> 

                          <div class="sec-3"> <img src="<?php echo base_url();?>assets/image/unlock_green.png" class="img-responsive" alt="Responsive image" >
                            <input type="password" value="" name="pwd" id="pwd" placeholder="Enter password if Required">
                            
                          </div> 
                      </form>    

                      <div class="sec-last"> 
                          <ul>
                              <li><p>get the app!</p></li>
                              <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Download Android App"><img src="<?php echo base_url();?>assets/image/android.png" class="img-responsive" alt="android" ></a></li>
                              <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Download iPhone App"><img src="<?php echo base_url();?>assets/image/apple.png" class="img-responsive" alt="/apple" ></a></li>
                          </ul>

                      </div> 

                  </div>  
                       
                  <div class="col-md-5 box-border section-tow">  

                      <input  type="hidden" name="group_id" id="group_id" value="<?php echo $group_id;?>"  />                 
                      <input  type="hidden" name="prev_channel" id="prev_channel" value="<?php echo $rand_channelid;?>"  />                

                   		 <h2>welcome HMGPS-Guest User</h2>                      
                       
                        <div class="sec-5 clearfix"> 
                           <p> This is your guest Map Channel ID</p>
                            <div class="input-group">
                                <input type="text"  id="phone" value="<?php echo $rand_channelid;?>" name="phone" class="map-id form-control" readonly/>
                                <span class="input-group-addon">
                                    <span class=" glyphicon glyphicon-pencil" onclick="editName('phone')"></span>
                                </span>
                            </div>
                            <a href="javascript:void(0);" onclick="editName('phone')"><b>Click to edit ID</b></a>
                        </div> 

                        <div class="sec-4 clearfix"> 
                           <p>Enter a Display Name(optional)</p>
                           <input class="display-name" type="text" name="display_name" id="display_name" value="<?php echo $display_name;?>" placeholder="Display Name" />                 
                        </div> 

                        <div class="clear"></div>

                        <div class="sec-6"> 
                          <!--
                            <label for="guest_current">
                              <input  name="guest_pos_type" id="guest_current" value='1' type="radio" checked="checked">                      
                              <img src="<?php echo base_url();?>assets/image/my-accout.png" class="img-responsive" alt="my-accout"> 
                            </label>
                            -->
                            <div class="radio chk-box-radio">
                                <label>
                                    <input type="radio" name="guest_pos_type" id="guest_current" value='1' type="radio" checked="checked">
                                    <span class="cr my-location"><i class="cr-icon fa fa-check"></i></span>
                                   
                                </label>
                            </div>
                            <h3>Allow my location to be shownit browser permits</h3>
                            <!--
                            <label for="guest_manual">
                              <input  name="guest_pos_type" id="guest_manual"  value='2' type="radio">
                            	<img src="<?php echo base_url();?>assets/image/keyboard.png" class="img-responsive" alt="keyboard" id="popover" rel="popover" data-placement="bottom" height="40" width="40">
                            </label>
                            -->
                             <div class="radio chk-box-radio">
                                <label>
                                    <input type="radio" name="guest_pos_type" id="guest_manual" value='2' >
                                    <span class="cr manual-address" id="popover" rel="popover" data-placement="bottom"><i class="cr-icon fa fa-check"></i></span>
                                   
                                </label>
                            </div>
                              <?php $usrchk = ($user_info['user_id']!='')?'user_update':'guest_registration';?>
                              <button type="submit" onclick="create_map('guest_pos_type',<?php echo $usrchk;?>,'.popover-content #guest_address','manual');" class="btn btn-info">
                                <span class="glyphicon glyphicon-arrow-right"></span>
                              </button>

                            <div id="popover-content" class="hide">
                              <textarea class="form-control" id="guest_address" name="guest_address" placeholder="Enter Address"></textarea>
                            </div> 

                       </div> 
                      
                  </div>
                       
                  <div class="col-md-4 box-border section-three"> 
                       <!--
                        <div class="sec-7 clearfix"> 
                           <a href="javascript:;" id="quickshareicon"><img src="<?php echo base_url();?>assets/image/share-icon.png" class="img-responsive" alt="share-icon"></a>
                            <span class="Quick-share" id="create-map">Quick Share</span> 
                        </div> 
                        -->
                         <div class="sec-8 clearfix"> 
                            <a href="#"><img src="<?php echo base_url();?>assets/image/067661-yellow-comment-bubbles-icon-people-things-speech.png" class="img-responsive" alt="speech" ></a>
                            <b> To verbally Share Use this ID</b>
                            <h3><?php echo $search_val;?></h3>
                         </div> 

                         <div class="sec-9 clearfix"> 
                              <a href="javascript:;" onclick="copyToClipboard('#search')" data-toggle="tooltip" data-placement="top" title="<?php echo site_url('/search/'.$search_val);?>" >
                                <img src="<?php echo base_url();?>assets/image/copy.png"  class="img-responsive" alt="copy">
                                <p>Copy Link to cliboard</p>
                              </a>
                         </div>
                         
                         <div id="socialquickshare" class="sec-10 social"></div>
                        
                  </div>
              </div>
        </div>
      </div>
</header>  