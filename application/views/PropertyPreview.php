<?php
	$blankClass = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Property Preview</title>
	
	 <link rel="icon" href="<?php echo base_url('assests/plp/');?>./images/favicon.ico" type="image/x-icon" />
    <link href="<?php echo base_url('assests/plp/');?>/styles/common.css" rel="stylesheet">
    <link href="<?php echo base_url('assests/plp/');?>/styles/project-details.css" rel="stylesheet">
    <script src="<?php echo base_url('assests/plp/');?>/js/jquery-1.9.1.min.js"></script>
    
    <script src="<?php echo base_url('assests/plp/');?>/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assests/plp/');?>/js/modernizr-latest.js"></script>
    
    <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <script src="js/html5shiv.min.js"></script>
    <![endif]-->	
   
<script type="text/javascript">
	var AbsoluteURL = '<?php echo $this->config->item('base_url') . "index.php/";?>';
</script>
<script src="<?php echo base_url('assests/');?>/js/script.js"></script>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="250"> 
    <div id="outer">
	<input type="hidden" value="<?php echo $property[0]->propertyID?>" name="propertyid" id="propertyid" />
        <!--START:CommonTopmenu.tpl-->
        <a id="nav-expander" class="nav-expander icon"></a>
    <!--Start: Nav -->
        <nav class="menunav">
         <!--Start:Navigation-->
            <ul class="list-unstyled menu-bar">
            <li class="top-menu">
             <ul >
                 <li><a href="ProjectListing.html"> Buy property</a></li>
                 <li><a href="PropertyListing.html"> Rent Property</a></li>
                 <li><a href="ProjectListing.html"> Discover Projects</a></li>
                 <li><a href="post-your-property.html"> Post Your Property</a></li>
                 <li><a href="posted-requirments.html"> Post Your Requirements</a></li>
             </ul>
            </li>
            <li class="bottom-menu">
             <ul >  
                 <li><a href="calculator-hw.html"> Calculators</a></li>
                 <li><a href="#"> Stories</a></li>
                 <li><a href="#"> Local Experts</a></li>
                 <li><a href="#"> Agents</a></li>
                 <li><a href="#"> FAQ’s</a></li>
             </ul> 
            </li>
             </ul>
         <!--End:Navigation-->         
            <h3 class="bpfc">Need Any Help ?</h3>  
            <a href="mailto:support@homeonline.com" class="support-link">support@homeonline.com</a>
            <ul class="support list-unstyled">
             <li>
                 <span>Toll Free Number</span>
                 <i class="sprite-bf support-phone">1800 1800 1800</i>
             </li>
             <li>
                 <span>International Helpline Number</span>
                 <i class="sprite-bf support-mob">(+91) 9876 543 210</i>
             </li>
         </ul>
            <ul class="social list-unstyled">
            <span>Follow Us</span>
            <li>
                <a href="#" class="sprite fb"></a>
            </li>
            <li>
                <a href="#" class="sprite twitter"></a>
            </li>
            <li>
                <a href="#" class="sprite linked"></a>
            </li>
        </ul>
        </nav>
    <!--End: Nav --> 
    <!--END:CommonTopmenu.tpl-->    
    <!--Start: Header -->  
        <header id="header" class="header">
               <!--START:CommonTop.tpl-->
                <div class="container-fluid top-head">
                    <div class="row">
                        <div class="col-xs-3">
                            <a href="#" class="logo">
                                <img src="<?php echo base_url('assests/plp/') ?>/images/logo.png" alt="DPCorp logo" title="DPCorp logo" class="img-responsive" width="234" height="54">
                            </a>
                        </div>
                        <div class="col-xs-8 pull-right head-right">
                          <!--button class="sprite-bf post" id="synchan">Synch</button-->
                            <div class="dropdown pull-right lang">
                                <a href="" class="sprite-af  dropdown-toggle" data-toggle="dropdown" id="language-selection">English <span class="caret"></span></a>
                                <ul class="dropdown-menu" aria-labelledby="language-selection">
                                <li><a href="#">Hindi</a></li>
                                <li><a href="#">Tamil</a></li>
                                <li><a href="#">Malayalam</a></li>
                              </ul>
                            </div>
                                <a href="#" class="sprite-bf post" id="synchan">Sync</a>
                            <div class="account">
                                <a href="javascript:void(0);" class="login">Login</a> /
                                <a href="javascript:void(0);" class="signup">Sign Up</a>
                            </div>
                        </div>
                    </div>
                </div>
               <!--END:CommonTop.tpl-->     
            </header>
    <!--End: Header -->
    <!--Start: Content container -->  
    <div id="content-container" class="content fixed-width">
       <ul class="breadcrumb style2">
          <li><a href="index.html">Home</a></li>
          <li><a href="stories-list.html">
		  <?php
			if(!empty($cityname[0]->cityName)){
				echo $cityname[0]->cityName;
			}
		  ?></a></li>
          <li class="active">
		  <?php
			if(!empty($propertyLoc[0]->cityLocName)){
				$propertyLoc[0]->cityLocName;
			}
		  ?>
		  </li>
      </ul>
	  
        <!--//.bread-crump -->
        <div class="fix--top" data-spy="affix">
            <div class="header-project">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-5 col-xs-4">
                            <a href="#" class="logo"></a>
                            <div class="land-mark">
                                <small><?php //echo ucfirst(strtolower($projectInfo[0]->projectName)).' by '.$projectInfo[0]->userCompanyName;
            ?></small> <i class="locations icon">
			<?php 
				if(!empty($propertyLoc[0]->cityLocName))
					echo $propertyLoc[0]->cityLocName;
			?>
			</i>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-4 text-right project-info">
                            <ul class="row">
                                <li class="col-xs-4">2BHK<span>Bed</span></li>
                                <li class="col-xs-4">
                                     <?php 
            if($propertyPrice[0]->propertyPrice<99999 || $propertyPrice[0]->propertyPrice<99999.00){
              echo $propertyPrice[0]->propertyPrice;
              //echo " K";
            }else{
              echo ($propertyPrice[0]->propertyPrice/100000);
              echo " Lac";
            }
             
             ?> 
                <span>Price</span>

                                </li>
                                <li class="col-xs-4"><?php 
                                   foreach ($PropertySpecInfo as $key => $value) {
                                    if($value->attrName=="Built Up Area"){
                                      echo $value->attrDetValue;
                                    }
                                  }                                 

                                   ?> Sqft<span>Area</span></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-xs-4 text-right pull-right user--ctrl-1">
                            <a href="#" class="shortlist icon">Shortlist</a>
                            <button type="submit" class="btn" id="synchan">Sync</button>
							 <!--button class="sprite-bf post" id="synchan">Synch</button-->
                        </div>
                    </div>
                </div>
            </div>
            
            <nav id="myNavbar" class="nav--1 nav--2 navbar">
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav"> 
                    <li class="active"><a href="#description">Description</a></li>
                    <li><a href="#amenities">Amenities</a></li>
                    <li><a href="#additionalinfo">Additional Information</a></li>
                    <!--li><a href="#locationmap">Location Map</a></li-->
                    <!--li><a href="#emi">EMI</a></li-->
                   
                </ul>
                </div>
            </nav>
            
            <!--//.nav -->
        </div>
        <div class="container-fluid property-top-detail">
                    <div class="top-del">
                    <h3><?php 
                    //echo "<li>".$propertyPrice[0]->propertyPrice;
                    //echo "<pre>";print_r($property);echo "</pre>";
                    echo $property[0]->propertyName;?>
   <?php //echo ucfirst(strtolower($projectInfo[0]->projectName)).' by '.$projectInfo[0]->userCompanyName;
            ?></h3>
                    <i class="locations icon">
					<?php 
						if(!empty($propertyLoc[0]->cityLocName))
						echo $propertyLoc[0]->cityLocName;
					?>
					</i>
                       <div class="pull-right price ruppy"><i class="fa-icon rupee"></i> 
					   <?php 
						if($propertyPrice[0]->propertyPrice<99999 || $propertyPrice[0]->propertyPrice<99999.00){
							echo $propertyPrice[0]->propertyPrice;
							//echo " K";
						}else{
							echo ($propertyPrice[0]->propertyPrice/100000);
							echo " Lac";
						}
					   
					   ?> 
					   <span> (<?php if(!empty($property[0]->isNegotiable)){?>Negotiable<?php }else{?>Not Negotiable<?php } ?>)</span></div>
                   </div>
                   <div class="row">
				   <?php //echo "<pre>";print_r($propertyImage);echo "</pre>";
					if(count($propertyImage)>0){
				   ?>
                       <div class="col-xs-7 col-lg-6">
                            <ul class="property-img-slider imgadjust">
                             <?php 
                                foreach ($propertyImage as $key => $value) {
							 ?>
                              <li>
									<img src="<?=base_url();?>propertyImages/<?php echo $value->propertyImageName;?>" title="" />
							 </li>                            
                                <?php
									}
								?>
                            </ul>
                            <div id="slide-counter"></div>
                       </div>
					   <?php 
					}else{
					   ?>
					   
					    <div class="col-xs-7 col-lg-6">
                            <ul class="property-img-slider imgadjust">
                             
                              <li>
									<img src="http://dbproperties.ooo/vhosts/homeadmin/assests/property/noimg.jpg" title="No Image" />
							 </li>                            
                                
                            </ul>
                            <div id="slide-counter"></div>
                       </div>
					   
					<?php }?>
			   
                       <div class="col-xs-5 col-lg-6">
                           <ul class="type-des">
                               <li>
							   <?php
									if($type[0]->propertyName==''){
										$blankClass = "blanckarea";
									}
								?>
                                   <span class="<?php echo $blankClass;?>">Type</span> <?php 
                                     echo $type[0]->propertyName;
                                  ?> 
                               </li>
                               <li>
								
								<?php 
                                   foreach ($PropertySpecInfo as $key => $value) {
                                    if($value->attrName=="Built Up Area"){
									  if($value->attrDetValue==''){
											$blankClass = "blanckarea";
										}
                                    }
                                  }
								?>
                               <span class="<?php echo $blankClass;?>">Builtup Area  Sq. ft </span>
                               <?php 
                                   foreach ($PropertySpecInfo as $key => $value) {
                                    if($value->attrName=="Built Up Area"){
                                      echo $value->attrDetValue;
									  echo ' sq.ft';
                                    }
                                  }                                 
                               ?>
                               </li>
                               <li>
							   <?php 
                                   foreach ($PropertySpecInfo as $key => $value) {
                                    if($value->attrName=="Built Up Area"){
									  if($value->attrDetValue==''){
											$blankClass = "blanckarea";
										}
									}
                                  }
								?>
                               <span class="<?php echo $blankClass;?>">Price  Sq. ft </span><i class="fa-icon rupee"></i> 
                               <?php 
                                   foreach ($PropertySpecInfo as $key => $value) {
                                    if($value->attrName=="Built Up Area"){
                                      echo floor($propertyPrice[0]->propertyPrice/$value->attrDetValue);
                                    }
                                  }                                 
                                   ?>
                               </li>
                           </ul>
						   
                           <div class="specs">
                               <div class="row">
                                   <div class="col-xs-4 col-lg-3 col-type">
								    <?php 
									   foreach ($PropertySpecInfo as $key => $value) {
										  
										if($value->attrName=="Furnishing Status"){											
										  if($value->attrDetValue==''){
												$blankClass = "blanckarea";
											}else{
												$blankClass = "";
											}
										}
									  }
									 
									?>
                                       <span class="<?php echo $blankClass;?>">Furnishing Status</span>
                                   </div>
                                   <div class="col-xs-8 col-lg-9">
                                       <?php 
											foreach ($PropertySpecInfo as $key => $value) {
												if($value->attrName=="Furnishing Status"){
													echo $value->attrDetValue;
												}else{
												$blankClass = "";
											}
											}
										?>
                                   </div>
                               </div>
                               <div class="row">
							   <?php 
							   //echo "<li>----> ".$property[0]->propertyCurrentStatus;
									if($property[0]->propertyCurrentStatus==''){
										$blankClass = "blanckarea";
									}else{
												$blankClass = "";
											}
								?>
                                   <div class="col-xs-4 col-lg-3 col-type <?php echo $blankClass;?>">
                                       Property Status
                                   </div>
                                   <div class="col-xs-8 col-lg-9">
                                       <?php echo $property[0]->propertyCurrentStatus;?>
                                   </div>
                               </div>
                               <div class="row">
							   <?php 
									if($property[0]->propertyAddress1==''){
										$blankClass = "blanckarea";
									}else{
												$blankClass = "";
											}
								?>
                                   <div class="col-xs-4 col-lg-3 col-type <?php echo $blankClass?>">
                                       Address
                                   </div>
                                   <div class="col-xs-8 col-lg-9">
                                    <?php 
                                      //echo $userAddress[0]->userAddress1.'<br/>'.$userAddress[0]->userAddress2;
                                      echo $property[0]->propertyAddress1.'<br>'.$property[0]->propertyAddress2;
                                   ?>
                                   </div>
                               </div>
                                 
                               <!-- <div class="row">
                                   <div class="col-xs-4 col-lg-3 col-type">
                                       Listed By
                                   </div>
                                   <div class="col-xs-8 col-lg-9"> 
                                    Need to ask
                                       <?php //echo $projectInfo[0]->userCompanyName;?>
                                   </div>
                               </div> -->
                               <div class="row mt-20">
                                   <div class="col-xs-4 col-lg-3 col-type">
                                        <a href="#" class="shortlist icon">Shortlist</a>  
                                   </div>
                                   <div class="col-xs-8 col-lg-9">
                                       <button type="submit" class="btn btn-primary btn-lg">Contact  Agent</button>
                                   </div>
                               </div>
                               
                               <div class="row mt-20">
                                   <div class="col-xs-4 col-lg-3 col-type">
                                        <a href="#" class="share icon">Share this</a>
                                   </div>
                                   <div class="col-xs-8 col-lg-9">
                                       <div class="row">
                                           <div class="col-xs-6 status">
                                              
                                               <ul>
                                                   <li><span>Property ID:</span> <?php echo $property[0]->propertyKey; ?></li>
                                                   <!-- <li><span>Status:</span> <?php echo $property[0]->propertyCurrentStatus;?></li> -->
                                               </ul>
                                           </div> 
                                           <div class="col-xs-6">
                                               <a href="#" class="report icon pull-right">Report a Problem</a>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       
                   </div> 
               </div> 
               
       <div class="" id="description">
               
        <section class="project-m-wrap">
            <div class="inner-content text-center cnt--abt">
                <h2>About Prestige Englave</h2>
                <p><?php echo $property[0]->propertyDescription;?></p>
            </div>
        </section>
        </div>
        
        <div id="amenities">
        
        <section  class="block--2">
            <div class="inner-content">
                <h2>Amenities</h2>
                <ul class="list--1 text-center">
                  <?php                   
					foreach($PropertyAmenitiesInfo as $key=>$value){
                  ?>
                  <li>
						<span class="<?php echo $value->attrClassName; ?>"></span>
                  </li>
				<?php
                      }
                ?>
                </ul>
            </div>
        </section>
        
        </div>
        <!--//.block-2 -->
        <!--//.block-5 -->
        
        <div id="additionalinfo">
        <section class="block--5" >
            <h2>Additional Information</h2>
            <div class="inner-content specs--1 detail-specs">
                <div class="container-fluid elm--center">
                    <div class="row">
                      
                      <?php
                      $string = '<div class="col-xs-4 add-info-bx ullist"><ul >';
                      $i = $s = 0;

                      //echo "<pre>";print_r(count($PropertySpecInfo));echo '</pre>';
                      foreach ($PropertySpecInfo as $key => $value) {
                        if($value->attrName!="Amenities"){
                                      
                        if($i%12==0 and $s == 12){
                          echo "</ul><ul >";
                          echo "</div>";
                          $s = 0;
                          //echo "End<br/>";
                        }
                        if ($i%12 == 0) {
                          echo '<div class="col-xs-4 add-info-bx ullist"><ul>';
                          $s = 0;
                          $ch = $i%12;
                          //echo "Start {$ch}<br/>";
                        } ?>
                        <li class="clearfix ullist">
                            <span class=" ullist span"><?php echo $value->attrName ?></span>
                            <span class="colr--1 ullist span"><?php echo $value->attrDetValue ?></span>
                        </li>

                        <?php                          
                          $i++;
                          $s++;
                        }
                      }
                        echo "</ul><ul>";
                        echo "</div>";
                        //echo "End<br/>";
                        ?>                       
                        
                    </div>
                </div>
            </div>
        </section>
        </div>
        <!--start location -->
       <div id="locationmap">
        <section class="block--map">
            <h2>Location Map</h2>
            <div class="map">
             <div class="maprajan">
				<ul>		
					<li>				
					<div class="checkbox mapchkrajan">
                       <label for="school">
                        <input type="checkbox" name="mytype" class="chkbox1" id="school"  value="school" />School
                       </label>
					</div>
					</li>	 
					<li>				
					<div class="checkbox mapchkrajan">
                       <label for="restaurant">
                        <input type="checkbox" name="mytype" class="chkbox1" id="restaurant"  value="restaurant"/>Restaurant
                       </label>
					</div>
					</li>
					<li>				
					<div class="checkbox mapchkrajan">
                       <label for="hospital">
                       <input type="checkbox" name="mytype" class="chkbox1"  id="hospital"  value="hospital"/>Hospital
                       </label>
					</div>
					</li>
					<li>				
					<div class="checkbox mapchkrajan">
                       <label for="bus_station">
                       <input type="checkbox" name="mytype"  class="chkbox1" id="bus_station"  value="bus_station"/>Bus Stop
                       </label>
					</div>
					</li>
					<li>				
					<div class="checkbox mapchkrajan">
                       <label for="park">
                       <input type="checkbox" name="mytype"  class="chkbox1" id="park"  value="park"/>Park
                       </label>
					</div>
					</li>
					<li>				
					<div class="checkbox mapchkrajan">
                       <label for="bank">
                       <input type="checkbox" name="mytype"  class="chkbox1" id="bank"  value="bank"/>Bank
                       </label>
					</div>
					</li>
					<!-- <li>				
					<div class="checkbox mapchkrajan">
                       <label for="bar">
                       <input type="checkbox" name="mytype"  class="chkbox1" id="bar"  value="bar"/>Bar
                       </label>
					</div>
					</li> -->
					<li>				
					<div class="checkbox mapchkrajan">
                       <label for="movie_theater">
                       <input type="checkbox" name="mytype"  class="chkbox1" id="movie_theater"  value="movie_theater"/>Movies
                       </label>
					</div>
					</li>
					<!-- <li>				
					<div class="checkbox mapchkrajan">
                       <label for="night_club">
                       <input type="checkbox" name="mytype"  class="chkbox1" id="night_club"  value="night_club"/>Night Club
                       </label>
					</div>
					</li> -->
					<!-- <li>				
					<div class="checkbox mapchkrajan">
                       <label for="zoo">
                      <input type="checkbox" name="mytype"  class="chkbox1" id="zoo"  value="zoo"/>Zoo
                       </label>
					</div>
					</li> -->
					
					<li>				
					<div class="checkbox mapchkrajan">
                       <label for="gym">
                       <input type="checkbox" name="mytype"  class="chkbox1" id="gym"  value="gym"/>Gym
                       </label>
					</div>
					</li>
					<li>				
					<div class="checkbox mapchkrajan">
                       <label for="atm">
                      <input type="checkbox" name="mytype"  class="chkbox1" id="atm"  value="atm"/>ATM
                       </label>
					</div>
					</li>
          <li>        
          <div class="checkbox mapchkrajan">
                       <label for="airport">
                      <input type="checkbox" name="mytype"  class="chkbox1" id="airport"  value="airport"/>Airport
                       </label>
          </div>
          </li>
					
					<!-- <li>				
					<div class="checkbox mapchkrajan">
                       <label for="spa">
                      <input type="checkbox" name="mytype"  class="chkbox1" id="spa"  value="spa"/>Spa
                       </label>
					</div>
					</li> -->
          <li>        
          <div class="checkbox mapchkrajan">
                       <label for="hindu_temple">
                      <input type="checkbox" name="mytype"  class="chkbox1" id="hindu_temple"  value="hindu_temple"/>Temple
                       </label>
          </div>
          </li>
           <li>        
          <div class="checkbox mapchkrajan">
                       <label for="shopping_mall">
                      <input type="checkbox" name="mytype"  class="chkbox1" id="shopping_mall"  value="shopping_mall"/>Shopping Mall
                       </label>
          </div>
          </li>
           <li>        
          <div class="checkbox mapchkrajan">
                       <label for="pharmacy">
                      <input type="checkbox" name="mytype"  class="chkbox1" id="pharmacy"  value="pharmacy"/>Pharmacy
                       </label>
          </div>
          </li>
          <li>        
          <div class="checkbox mapchkrajan">
                       <label for="train_station">
                      <input type="checkbox" name="mytype"  class="chkbox1" id="train_station"  value="train_station"/>Station
                       </label>
          </div>
          </li>
				</ul>

        </div>
        <!--label>Address: </label><input id="address"  type="text" style="width:400px;" value="Bhubaneswar,odisha,india"/>
        <input type="button" value="submit" id="btn" onClick="showMap();"/-->
        <br/>
        <div id="map"></div>
        <input type="text" id="latitude" style="display:none;" placeholder="Latitude"/>
        <input type="text" id="longitude" style="display:none;" placeholder="Longitude"/>
       <!-- <input type="button"  id="hide_btn" value="hide markers" onClick="clearMarkers();" />-->
        <input type="button" id="show_btn" value="show  markers" onClick="showMarkers();" style="display:none;" />

        <div id="test"></div>
				
				
            </div>
        </section>
        </div>
       <!--- end locatiion-->
    <footer id="footer">
        <div class="footer-container">
        </div>
        <div class="footer-container bg">
            <div class="container-fluid footer-middle">
                <div class="row">
                    <div class="col-xs-8">
                        <ul>
                            <li class="col-xs-4">
                                <span>Resources</span>
                                <ul>
                                    <li>Agencies</li>
                                    <li>Property Advice</li>
                                    <li>Property Rates & Trending</li>
                                    <li>DB on Mobile</li>
                                    <li>All Projects</li>
                                    <li>Sell/Rent</li>
                                </ul>
                            </li>
                            <li class="col-xs-4">
                                <span>Company</span>
                                <ul>
                                    <li>About Us</li>
                                    <li>Contact US</li>
                                    <li>Terms& Conditions</li>
                                    <li>Privacy Policy</li>
                                </ul>
                            </li>
                            <li class="col-xs-4">
                                <span>Get in Touch</span>
                                <ul>
                                    <li><span class="mail-cont sprite-bf comn-disp"></span> <span class="comn">contact@Homeonline.com</span>
                                    </li>
                                    <li> <span class="mail-loc sprite-bf comn-disp"></span><span class="comn">Bungalow C12 B Sector Vidyanaghar
Bhopal, Madhya Pradesh </span>
                                    </li>
                                </ul>
                                <ul class="social">
                                    <span>Follow Us</span>
                                    <li>
                                        <a href="#" class="sprite fb"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="sprite twitter"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="sprite linked"></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-4 contacts">
                        <ul>
                            <span> Customer Servise</span>
                            <li>
                                <div class="number">1800 0000 0000 <small>Toll Free</small>
                                </div>
                            </li>
                            <li>
                                <div class="number">(+91) 09 87 654 321<small>International Helpline</small>
                                </div>
                            </li>
                        </ul>
                        <ul class="app-dwnld">
                            <li><img src="images/android.png" alt="" class="img-responsive"  width="197px" height="51px"> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-container">
            <div class="container-fluid footer-bottom">
                <h3>Why Home Online</h3>
                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, velit! Id et perspiciatis quae natus eos iusto ad laboriosam. Autem repudiandae voluptatum enim eum eaque, quos quod necessitatibus ea maiores. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam quidem minima incidunt deserunt, sapiente recusandae expedita rerum. Illum ipsam adipisci esse, temporibus a? Quod consequatur, iusto nobis cumque tempore, fugit. </p>
                <h3>Group Portals</h3>
                <ul>
                    <li><a href="#">www.website1.com</a>
                    </li>
                    <li><a href="#">www.website2.com</a>
                    </li>
                    <li><a href="#">www.website3.com</a>
                    </li>
                    <li><a href="#">www.website4.com</a>
                    </li>
                    <li><a href="#">www.website5.com</a>
                    </li>
                    <li><a href="#">www.website6.com</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-container">
            <div class="container-fluid footer-copy">
                <img src="images/logo-footer.jpg" alt="" width="180px" height="40px">
                <p>Copyright © 2015 homeonline.com. All Rights Reserved. </p>
            </div>
        </div>
        <div class="sticky-bottom">
            <div class="container-fluid pos-rel">
                <!--span class="sticky-arrow sprite-af">my activity</span-->
                <ul class="_bar row">
                    <li class="col-xs-3 pop-container"><a href="javascript:void(0);" class="talk sprite-bf">Talk To Experts</a> </li>
                    <li class="col-xs-3 pop-container">
                        <a href="javascript:void(0);" class="compare sprite-bf pop-trigger">Compare <span>7</span></a>
                        <section class="pop_up">
                            <div class="pop_hd">
                                <ul>
                                    <li><a href="" class="active">Properties<span class="count">5</span></a></li>
                                    <li><a href="">Projects<span class="count">2</span></a></li>
                                </ul>
                            </div>
                            <div class="scroll_wrp">
                            <div class="pop_bd">
                                <ul class="pdt-list">
                                    <li class="clearfix">
                                        <a href="#" class="thumb"><img src="images/pdt-image-small-01.jpg" alt=""></a>
                                        <div class="dtl-blk">
                                            <h4 class="ttl">3 BHK Apartment</h4>
                                            <p class="location">Kolar Road, Bhopal</p>
                                            <p class="features">
                                                <span>₹ 35.6 Lac</span>
                                                <span>1650 sqft</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <a href="#" class="thumb"><img src="images/pdt-image-small-01.jpg" alt=""></a>
                                        <div class="dtl-blk">
                                            <h4 class="ttl">3 BHK Apartment</h4>
                                            <p class="location">Kolar Road, Bhopal</p>
                                            <p class="features">
                                                <span>₹ 35.6 Lac</span>
                                                <span>1650 sqft</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <a href="#" class="thumb"><img src="images/pdt-image-small-01.jpg" alt=""></a>
                                        <div class="dtl-blk">
                                            <h4 class="ttl">3 BHK Apartment</h4>
                                            <p class="location">Kolar Road, Bhopal</p>
                                            <p class="features">
                                                <span>₹ 35.6 Lac</span>
                                                <span>1650 sqft</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <a href="#" class="thumb"><img src="images/pdt-image-small-01.jpg" alt=""></a>
                                        <div class="dtl-blk">
                                            <h4 class="ttl">3 BHK Apartment</h4>
                                            <p class="location">Kolar Road, Bhopal</p>
                                            <p class="features">
                                                <span>₹ 35.6 Lac</span>
                                                <span>1650 sqft</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <a href="#" class="thumb"><img src="images/pdt-image-small-01.jpg" alt=""></a>
                                        <div class="dtl-blk">
                                            <h4 class="ttl">3 BHK Apartment</h4>
                                            <p class="location">Kolar Road, Bhopal</p>
                                            <p class="features">
                                                <span>₹ 35.6 Lac</span>
                                                <span>1650 sqft</span>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            </div>
                            <div class="pop_bt clearfix">
                                <a href="" class="btn btn-primary">Compare</a>
                                <a href="" class="btn rmv-all">Remove All</a>
                            </div>
                        </section>
                    </li>
                    <li class="col-xs-3 pop-container">
                        <a href="javascript:void(0);" class="shortlist  sprite-bf pop-trigger">My Shortlists <span>7</span></a>
                        <section class="pop_up">
                            <div class="pop_hd">
                                <ul>
                                    <li><a href="" class="active">Properties<span class="count">5</span></a></li>
                                    <li><a href="">Projects<span class="count">2</span></a></li>
                                </ul>
                            </div>
                            <div class="scroll_wrp">
                            <div class="pop_bd">
                                <ul class="pdt-list">
                                    <li class="clearfix">
                                        <a href="#" class="thumb"><img src="images/pdt-image-small-01.jpg" alt=""></a>
                                        <div class="dtl-blk">
                                            <h4 class="ttl">3 BHK Apartment</h4>
                                            <p class="location">Kolar Road, Bhopal</p>
                                            <p class="features">
                                                <span>₹ 35.6 Lac</span>
                                                <span>1650 sqft</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <a href="#" class="thumb"><img src="images/pdt-image-small-01.jpg" alt=""></a>
                                        <div class="dtl-blk">
                                            <h4 class="ttl">3 BHK Apartment</h4>
                                            <p class="location">Kolar Road, Bhopal</p>
                                            <p class="features">
                                                <span>₹ 35.6 Lac</span>
                                                <span>1650 sqft</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <a href="#" class="thumb"><img src="<?php echo base_url('assests/plp/')?>/images/pdt-image-small-01.jpg" alt=""></a>
                                        <div class="dtl-blk">
                                            <h4 class="ttl">3 BHK Apartment</h4>
                                            <p class="location">Kolar Road, Bhopal</p>
                                            <p class="features">
                                                <span>₹ 35.6 Lac</span>
                                                <span>1650 sqft</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <a href="#" class="thumb"><img src="<?php echo base_url('assests/plp/')?>/images/pdt-image-small-01.jpg" alt=""></a>
                                        <div class="dtl-blk">
                                            <h4 class="ttl">3 BHK Apartment</h4>
                                            <p class="location">Kolar Road, Bhopal</p>
                                            <p class="features">
                                                <span>₹ 35.6 Lac</span>
                                                <span>1650 sqft</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <a href="#" class="thumb"><img src="<?php echo base_url('assests/plp/')?>/images/pdt-image-small-01.jpg" alt=""></a>
                                        <div class="dtl-blk">
                                            <h4 class="ttl">3 BHK Apartment</h4>
                                            <p class="location">Kolar Road, Bhopal</p>
                                            <p class="features">
                                                <span>₹ 35.6 Lac</span>
                                                <span>1650 sqft</span>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            </div>
                            <div class="pop_bt clearfix">
                                <a href="" class="btn btn-primary view_all">View All</a>
                            </div>
                        </section>
                        </li>
                    <li class="col-xs-3 pop-container">
                        <a href="javascript:void(0);" class="email sprite-bf pop-trigger">Email Basket <span>4</span></a>
                        <section class="pop_up">
                            <div class="pop_hd">
                                <ul>
                                    <li class="fullwidth">
                                        <a href="" class="active">Email Basket<span class="count">4</span></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="scroll_wrp">
                            <div class="pop_bd">
                                <ul class="pdt-list">
                                    <li class="clearfix">
                                        <a href="#" class="thumb"><img src="<?php echo base_url('assests/plp/')?>/images/pdt-image-small-01.jpg" alt=""></a>
                                        <div class="dtl-blk">
                                            <h4 class="ttl">3 BHK Apartment</h4>
                                            <p class="location">Kolar Road, Bhopal</p>
                                            <p class="features">
                                                <span>₹ 35.6 Lac</span>
                                                <span>1650 sqft</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <a href="#" class="thumb"><img src="<?php echo base_url('assests/plp/')?>/images/pdt-image-small-01.jpg" alt=""></a>
                                        <div class="dtl-blk">
                                            <h4 class="ttl">3 BHK Apartment</h4>
                                            <p class="location">Kolar Road, Bhopal</p>
                                            <p class="features">
                                                <span>₹ 35.6 Lac</span>
                                                <span>1650 sqft</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <a href="#" class="thumb"><img src="<?php echo base_url('assests/plp/')?>/images/pdt-image-small-01.jpg" alt=""></a>
                                        <div class="dtl-blk">
                                            <h4 class="ttl">3 BHK Apartment</h4>
                                            <p class="location">Kolar Road, Bhopal</p>
                                            <p class="features">
                                                <span>₹ 35.6 Lac</span>
                                                <span>1650 sqft</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <a href="#" class="thumb"><img src="<?php echo base_url('assests/plp/')?>/images/pdt-image-small-01.jpg" alt=""></a>
                                        <div class="dtl-blk">
                                            <h4 class="ttl">3 BHK Apartment</h4>
                                            <p class="location">Kolar Road, Bhopal</p>
                                            <p class="features">
                                                <span>₹ 35.6 Lac</span>
                                                <span>1650 sqft</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <a href="#" class="thumb"><img src="<?php echo base_url('assests/plp/')?>/images/pdt-image-small-01.jpg" alt=""></a>
                                        <div class="dtl-blk">
                                            <h4 class="ttl">3 BHK Apartment</h4>
                                            <p class="location">Kolar Road, Bhopal</p>
                                            <p class="features">
                                                <span>₹ 35.6 Lac</span>
                                                <span>1650 sqft</span>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            </div>
                            <div class="pop_bt clearfix">
                                <a href="" class="btn btn-primary">Send Mail</a>
                                <a href="" class="btn rmv-all">Remove All</a>
                            </div>
                        </section>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
    </div>
	
	<script type="text/javascript" src="<?php echo base_url('assests/')?>/js/jqueryan.js"></script>
	<script>var jQuery132 = $.noConflict(true);</script>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
        <style type="text/css">
            #map {
                height: 600px;
                width: 1358px;
                border: 1px solid #333;
                margin-top: 0.6em;
            }
        </style>

        <script type="text/javascript">
            $(function(){
                jQuery132('.chkbox1').click(function(){
                    jQuery132(':checkbox').attr('checked',false);
                    jQuery132('#'+jQuery132(this).attr('id')).attr('checked',true);
                    search_types(map.getCenter());
                });
                
            });
            
            var map;
            var infowindow;
            var markersArray = [];
            var pyrmont = new google.maps.LatLng(23.233713, 77.430145);
            var marker;
            var geocoder = new google.maps.Geocoder();
            var infowindow = new google.maps.InfoWindow();
            // var waypoints = [];                  
            function initialize() {
                map = new google.maps.Map(document.getElementById('map'), {
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    center: pyrmont,
                    zoom: 14
                });
                infowindow = new google.maps.InfoWindow();
                //document.getElementById('directionsPanel').innerHTML='';
                search_types();
               }

            function createMarker(place,icon) {
                var placeLoc = place.geometry.location;
                var marker = new google.maps.Marker({
                    map: map,
                    position: place.geometry.location,
                    icon: icon,
                    visible:true  
                    
                });
                
                markersArray.push(marker);
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.setContent("<b>Name:</b>"+place.name+"<br><b>Address:</b>"+place.vicinity+"<br><b>Reference:</b>"+place.reference+"<br><b>Rating:</b>"+place.rating+"<br><b>Id:</b>"+place.id);
                    infowindow.open(map, this);
                });
               
            }
            var source="";
            var dest='';
            
            function search_types(latLng){
                clearOverlays(); 
              
                if(!latLng){
                    var latLng = pyrmont;
                }
                var type = jQuery132('.chkbox1:checked').val();
				//alert(type);
                var icon = "<?php echo base_url('assests/');?>/images/"+type+".png";
                
	 
                var request = {
                    location: latLng,
                    radius: 2000,
                    types: [type] //e.g. school, restaurant,bank,bar,city_hall,gym,night_club,park,zoo
                };
               
                var service = new google.maps.places.PlacesService(map);
                service.search(request, function(results, status) {
                    map.setZoom(14);
                    if (status == google.maps.places.PlacesServiceStatus.OK) {
                        for (var i = 0; i < results.length; i++) {
                            results[i].html_attributions='';
                            createMarker(results[i],icon);
                        }
                    }
                });
                
             }
            
            
            // Deletes all markers in the array by removing references to them
            function clearOverlays() {
                if (markersArray) {
                    for (i in markersArray) {
                        markersArray[i].setVisible(false)
                    }
                    //markersArray.length = 0;
                }
            }
            google.maps.event.addDomListener(window, 'load', initialize);
            
            function clearMarkers(){
                jQuery132('#show_btn').show();
                jQuery132('#hide_btn').hide();
                clearOverlays()
            }
            function showMarkers(){
                jQuery132('#show_btn').hide();
                jQuery132('#hide_btn').show();
                if (markersArray) {
                    for (i in markersArray) {
                        markersArray[i].setVisible(true)
                    }
                     
                }
            }
            
           /* function showMap(){
                
                var imageUrl = 'http://chart.apis.google.com/chart?cht=mm&chs=24x32&chco=FFFFFF,008CFF,000000&ext=.png';
                var markerImage = new google.maps.MarkerImage(imageUrl,new google.maps.Size(24, 32));
                var input_addr=$('#address').val();
                geocoder.geocode({address: input_addr}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var latitude = results[0].geometry.location.lat();
                        var longitude = results[0].geometry.location.lng();
                        var latlng = new google.maps.LatLng(latitude, longitude);
                        if (results[0]) {
                            map.setZoom(14);
                            map.setCenter(latlng);
                            marker = new google.maps.Marker({
                                position: latlng, 
                                map: map,
                                icon: markerImage,
                                draggable: true 
                                
                            }); 
                            $('#btn').hide();
                            $('#latitude,#longitude').show();
                            $('#address').val(results[0].formatted_address);
                            $('#latitude').val(marker.getPosition().lat());
                            $('#longitude').val(marker.getPosition().lng());
                            infowindow.setContent(results[0].formatted_address);
                            infowindow.open(map, marker);
                            search_types(marker.getPosition());
                            google.maps.event.addListener(marker, 'click', function() {
                                infowindow.open(map,marker);
                                
                            });
                        
                        
                            google.maps.event.addListener(marker, 'dragend', function() {
                              
                                geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
                                    if (status == google.maps.GeocoderStatus.OK) {
                                        if (results[0]) {
                                            $('#btn').hide();
                                            $('#latitude,#longitude').show();
                                            $('#address').val(results[0].formatted_address);
                                            $('#latitude').val(marker.getPosition().lat());
                                            $('#longitude').val(marker.getPosition().lng());
                                        }
                                        
                                        infowindow.setContent(results[0].formatted_address);
                                        var centralLatLng = marker.getPosition();
                                        search_types(centralLatLng);
                                        infowindow.open(map, marker);
                                    }
                                });
                            });
                            
                        
                        } else {
                            alert("No results found");
                        }
                    } else {
                        alert("Geocoder failed due to: " + status);
                    }
                });
                
            } */  
           
        </script>
	

	
    <script src="<?php echo base_url('assests/plp/')?>/js/jquery.bxslider.min.js"></script>
    <script src="<?php echo base_url('assests/plp/')?>/js/chosen.jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assests/plp/')?>/js/enscroll-min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/helpers/jquery.fancybox-thumbs.js"></script>
    
    
    <script>
        $(document).ready(function () {
            $('.fancybox-thumbs').fancybox({
                padding : 0,
                prevEffect : 'none',
                nextEffect : 'none',

                closeBtn  : true,
                arrows    : true,
                nextClick : true,

                helpers : {
                    thumbs : {
                        width  : 129,
                        height : 86
                    }
                }
            });
            $(window).scroll(function () {
                if ($(this).scrollTop() > 500) {
                    $('.search').fadeIn();
                } else {
                    $('.search').fadeOut();
                }
            });
             $(".my_select_box, .my_select_box1").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "75%"
              });
            $('.sticky-arrow').click(function () {
                if ($(this).hasClass('up')) {
                    $(this).removeClass('up');
                    $('.sticky-bottom .showpopup').removeClass('showpopup');
                    $('.sticky-bottom').animate({
                        bottom: "-40px"
                    });
                } else {
                    $(this).addClass('up');
                    $('.sticky-bottom').animate({
                        bottom: "0px"
                    });
                }
            });
            $('.sticky-bottom .pop-trigger').click(function (){
                $(this).parent().siblings().removeClass('showpopup');
                $(this).parent().toggleClass('showpopup');
            });
            $('.pop_up .pop_bd').enscroll({
                scrollIncrement: 60
            });
             $('.footer-link').bxSlider({
                minSlides: 1,
                maxSlides: 1,
                slideWidth: 1000,
                pager: false,
                 infiniteLoop:false,
                hideControlOnEnd:true 
            });
            $('.bxslider').bxSlider({
                slideWidth: 210,
                minSlides: 2,
                maxSlides: 4,
                pager: false,
                slideMargin:22,
                //adaptiveHeight: true,   
              });
            
            $('.property-img-slider').bxSlider({
              mode: 'fade',
              captions: true,
                pager: false,
                onSliderLoad: function (currentIndex){
                $('#slide-counter .current-index').text(currentIndex + 1);
                },
                onSlideBefore: function ($slideElement, oldIndex, newIndex){
                    $('#slide-counter .current-index').text(newIndex + 1);
                }
                
            });
             $('#slide-counter').prepend('<i class="current-index">1</i> of ');
             $('#slide-counter').append(<?php echo count($propertyImage);?>);
            
            
        });
        $(document).ready(function(){
            
       												
       //Navigation Menu Slider
        $('#nav-expander').on('click',function(e){
      		e.preventDefault();
      		$('body').toggleClass('nav-expanded');
      	});
      	$('.nav-close').on('click',function(e){
      		e.preventDefault();
      		$('body').removeClass('nav-expanded');
      	});
        
        $('.search-field input[type="text"]').attr("placeholder","Enter Keyword..."); 
        $('.fix--top').affix({
            offset: {
                top: $('.fix--top').offset().top
            }
        }); 
      });
    </script>
    
    
    <script>
$(document).ready(function(){
  // Add scrollspy to <body>
  $('body').scrollspy({target: ".navbar", offset: 80});   

  // Add smooth scrolling on all links inside the navbar
  $("#myNavbar a").on('click', function(event) {

    // Prevent default anchor click behavior
    event.preventDefault();

    // Store hash
    var hash = this.hash;

    // Using jQuery's animate() method to add smooth page scroll
    // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
    $('html, body').animate({
      scrollTop: $(hash).offset().top
    }, 800, function(){
   
      // Add hash (#) to URL when done scrolling (default click behavior)
      window.location.hash = hash;
    });
  });
});
</script>
    
</body>
</html>