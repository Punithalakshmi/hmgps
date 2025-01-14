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
       <div class="mobile-section">
     	 <div class="m-overall-section">
      <div class="mobile-logo">
      <a class="m-logo" href="#"><img src="<?php echo base_url();?>assets/image/logo-new.png" class="img-responsive" alt="header-logo"></a>
       <span>Current Joined <img src="<?php echo base_url();?>assets/image/down-arrow.png" alt="down-arrow" /> Map Channel ID</span>
          <!--<div class="m-signup">
            <div class="">
              <span><a href="#">signin</a>/<a href="#">signin</a></span>
            </div>
          </div>-->
          
        </div>
      
        <div class="top-nav">
              <div class="top-menu">
                    <ul class="nav navbar-nav">
                      <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url();?>assets/image/menu.png" class="img-responsive m-menu" alt="mobile-header"></a>
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
                <a data-toggle="modal" data-target="#mobilesearchshare"><img src="<?php echo base_url();?>assets/image/joined-map.png" class="img-responsive" alt="share-icon"></a>
               </div>
               
                 
                
        </div>
        <div class="mobile-login">
        <div class="input-group cureent-chn">
             
              <?php $joined_group =  (isset($user_info['joined_group']) && ($user_info['joined_group'] != $rand_channelid))?$user_info['joined_group']:''; //$joined_group =  (isset($user_info['joined_group']))?$user_info['joined_group']:'';?>
                 <input type="text" id="joined_map" value="<?php echo $joined_group;?>" name="joined_map" class="form-control input-ctrl" placeholder="Joined Map">
                 <p class="m-description">Administrator Private Channel</p>
            </div>
                 
            <div class="input-group m-unsecured">
              <label>Unsecured</label>
                <input type="password" id="map_pwd" placeholder="Not Required" name="map_pwd" class="form-control input-ctrl" ><br />
                <p class="m-description">password</p>
            </div>
        </div>

        
        <div class="clear"></div>

        <input  type="hidden" name="group_id" id="group_id" value="<?php echo $group_id;?>"  />                 
        <input  type="hidden" name="prev_channel" id="prev_channel" value="<?php echo $rand_channelid;?>"  />                

        <div class="chn-id">
           <div class="share-iconn">
           	 <p>Share My User Channel</p>
              <a data-toggle="modal" data-target="#mobilechannelshare"><img src="<?php echo base_url();?>assets/image/channel-id.png" class="img-responsive" alt="share-icon"></a>
             
                <div class="input-group">
                  <input type="text" readonly="" class="map-id form-control input-ctrl" id="phone" name="phone" value="<?php echo $rand_channelid;?>" />
                      <span class="input-group-addon">
                          <span onclick="editName('phone')" class=" glyphicon glyphicon-pencil"></span><br />edit
                      </span>
                </div>
                <p class="edit-uniq m-description">Edit Unique Name or Phone #</p>
                
            </div>
        </div>
        <div class="display-id">
          <div class="">
                <div class="share-iconn">
                    <p class="m-display">Display name</p>
                    <div class="input-group">
                        <input type="text" readonly="" id="display_name" class="map-id form-control input-ctrl" name="display_name" value="<?php echo $display_name;?>" />
                          <span class="input-group-addon">
                              <span onclick="editName('display_name')" class=" glyphicon glyphicon-pencil"></span><br />edit
                          </span>
                    </div>
                     <p class="m-description">If different from User Channel ID</p>
                </div>
          </div>
        </div>

        

        <div class="clear"></div> 
        <div class="mobile-loc">
           
            <div class="m-radio my-locate">
              <div class="radio chk-box-radio first">
                <label>
                    <input type="radio" checked="checked" value="1" id="guest_current" name="guest_pos_type">
                    <span class="cr my-location"><i class="cr-icon fa fa-check"></i></span>
                    <span class="m-keyboard"><img src="<?php echo base_url();?>assets/image/04_maps.png" alt="map" /></span>
                    <span class="allow-locate">Allow my location to be shown if browser permits</span>
                </label>
                
              </div>
            </div>
            <div class="m-update">
              <?php $usrchk = ($user_info['user_id']!='')?'user_update':'guest_registration';?>
              <a role="button" href="javascript:;" onclick="create_map('guest_pos_type',<?php echo $usrchk;?>,'.popover-content #guest_address','manual');" class="col-xs-8 btn btn-lg btn-primary btn-mupdate"><img src="<?php echo base_url();?>assets/image/update-icon.png" alt="update" />Update</a>    
          </div>
            <div class="m-radio m-manuall">
              <div class="radio chk-box-radio">
                <label>
                	
                    <input type="radio" id="guest_manual"  value='2' name="guest_pos_type">
                    <span class="cr my-location" id="popover" rel="popover" data-placement="top"><i class="cr-icon fa fa-check"></i></span>
                    <span class="m-keyboard"><img src="<?php echo base_url();?>assets/image/keyboard.png" alt="keyboard" /></span>
                    <span class="m-manully">Manually Enter Address</span>
                </label>
              </div>
            </div>
            <div id="popover-content" class="hide">
                <textarea class="form-control" id="guest_address" name="guest_address" placeholder="Enter Address"></textarea>
            </div>
            <div class="row">  </div>
        </div>

       <!-- <div class="mobile-loc-updates">
          
        </div>-->

        </div>
        
        <div class="clear"></div> 

        <div class="mobile-search">
        <form method='post' action='<?php echo site_url('search');?>'>
          <div id="adv-search" class="input-group">
              <label>Search</label>
                <input type="text" placeholder="Search here.." value="<?php echo $search_val;?>" name="search" id="search" class="form-control">
                <div class="input-group-btn">
                    <div role="group" class="btn-group">
                        
                        <button class="btn btn-primary btn-msearch" type="submit">
                        <img src="<?php echo base_url();?>assets/image/hand-symbol.png" class="img-responsive" alt="hand-symbol-icon"></button>
                    </div>
                </div>
             
          </div>
        </form>  
        </div>
</div>
    </div>
        
        
  </div>       
       <!-- header-->        
</div>
      
</header> 

