   <?php $search_val  = ($map_search_key)?$map_search_key:get_cookie('map_search'); 
      $rand_channelid =  (isset($user_info['channel_id']))?$user_info['channel_id']:'';
      $display_name   =  (isset($user_info['display_name']) && $user_info['display_name']!='')?$user_info['display_name']:$rand_channelid;
      $group_id       =  (isset($user_info['group_id']) && $user_info['group_id']!='')?$user_info['group_id']:'';
    ?>
   
    <header class="cf"><!-- Header area Start-->
      
      <div class="container cf"><!-- Container area Start-->

       <div class="">     
       
      <!-- header-->  
       <div class="mobile-header">
      <div class="m-overall-section">
        <div class="top-nav">
              <div class="top-menu">
                    <ul class="nav navbar-nav">
                      <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url();?>assets/image/mobile-header.png" class="img-responsive" alt="mobile-header"></a>
                        <ul class="dropdown-menu">
                          <li class="active-current"><a href="<?php echo site_url('home');?>">Home</a></li>
                          <li><a href="<?php echo site_url('search');?>">Search </a></li>
                          <li><a href="<?php echo site_url('aboutus');?>">About Us</a></li>
                          <li><a href="<?php echo site_url('help');?>">Help</a></li>
                          <li><a href="<?php echo site_url('tellus');?>">Tell Us Your Story</a></li>
                          
                        </ul>
                      </li>
                    </ul>
                </div>
               <div class="share-icon">
                <a href="#"><img src="<?php echo base_url();?>assets/image/share.png" class="img-responsive" alt="share-icon"></a>
               </div>
                
        </div>
        <div class="mobile-login">
            <div class="input-group cureent-chn">
              <label>Current Joined Channel</label>
              <?php  $joined_group =  (isset($user_info['joined_group']))?$user_info['joined_group']:'';?>
                 <input type="text" value="<?php echo $joined_group;?>" name="joined_map" class="form-control" id="joined_map" placeholder="Joined Map">
            </div>      
            <div class="input-group">
              <label>Password</label>
                <input type="password" placeholder="Password" name="map_pwd" class="form-control" id="map_pwd">
            </div>
        </div>

        <div class="mobile-logo">
          <div class="m-signup">
            <div class="">
               <!-- <span><a href="#">signin</a>/<a href="#">signin</a></span>-->
            </div>
          </div>
          <a href="#"><img src="<?php echo base_url();?>assets/image/powered-img.jpg" class="img-responsive" alt="header-logo"></a>
        </div>
        <div class="clear"></div>

        <input  type="hidden" name="group_id" id="group_id" value="<?php echo $group_id;?>"  />                 
        <input  type="hidden" name="prev_channel" id="prev_channel" value="<?php echo $rand_channelid;?>"  />                

        <div class="chn-id">
           <div class="share-iconn">
              <a href="#"><img src="<?php echo base_url();?>assets/image/share.png" class="img-responsive" alt="share-icon"></a>
              <p>Channel ID</p>
                <div class="input-group">
                  <input type="text" readonly="" class="map-id form-control" name="phone" value="<?php echo $rand_channelid;?>" id="phone">
                      <span class="input-group-addon">
                          <span onclick="editName('phone')" class=" glyphicon glyphicon-pencil"></span><br />edit
                      </span>
                </div>
            </div>
        </div>

        <div class="mobile-loc">
            <p>Allow my location to be shownit browser permits</p>
            <div class="m-radio">
              <div class="radio chk-box-radio first">
                <label>
                    <input type="radio" checked="checked" value="1" id="guest_current" name="guest_pos_type">
                    <span class="cr my-location"><i class="cr-icon fa fa-check"></i></span>My Location
                </label>
              </div>
              <div class="radio chk-box-radio">
                <label>
                    <input type="radio" id="guest_manual"  value='2' name="guest_pos_type">
                    <span class="cr my-location" id="popover" rel="popover" data-placement="top"><i class="cr-icon fa fa-check"></i></span>Manual Address
                </label>
              </div>
            </div>
            <div id="popover-content" class="hide">
                <textarea class="form-control" id="guest_address" name="guest_address" placeholder="Enter Address"></textarea>
            </div>
            <div class="row">  </div>
        </div>

        <div class="clear"></div> 
        <div class="display-id">
          <div class="">
                <div class="share-iconn">
                    <p>Display name</p>
                    <div class="input-group">
                        <input type="text" readonly="" class="map-id form-control" name="display_name" value="<?php echo $display_name;?>" id="display_name">
                          <span class="input-group-addon">
                              <span onclick="editName('display_name')" class=" glyphicon glyphicon-pencil"></span><br />edit
                          </span>
                    </div>
                </div>
          </div>
        </div>

        <div class="mobile-loc-updates">
          <div class="">
              <?php $usrchk = ($user_info['user_id']!='')?'user_update':'guest_registration';?>
              <a role="button" href="javascript:;" onclick="create_map('guest_pos_type',<?php echo $usrchk;?>,'.popover-content #guest_address','manual');" class="col-xs-8 btn btn-lg btn-primary btn-mupdate">Update</a>    
          </div>
        </div>

        </div>
        
        <div class="clear"></div> 

        <div class="mobile-search">
        <form method='post' action='<?php echo site_url('search');?>'>
          <div id="adv-search" class="input-group">
              <label>Search</label>
                <input type="text" placeholder="Search here.." value="<?php echo $search_val;?>" name="search" id="search" class="form-control">
                <div class="input-group-btn">
                    <div role="group" class="btn-group">
                        <label>Go</label>
                        <button class="btn btn-primary btn-msearch" type="submit">
                        <img src="<?php echo base_url();?>assets/image/hand-symbol.png" class="img-responsive" alt="hand-symbol-icon"></button>
                    </div>
                </div>
             
          </div>
        </form>  
        </div>

    </div>
        
        
  </div>       
       <!-- header-->        
</div>
      
</header> 

