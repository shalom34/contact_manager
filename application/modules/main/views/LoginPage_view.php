<!DOCTYPE html>
<html lang="en">
  <?php include VIEWPATH .'includes/header.php'; ?>
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/login.css">
    <body>

    	<img class="login_background" src="<?=base_url()?>assets/img/login_back.jpg">

    	<div class="login_container">
    		
    			<div class="container">
    				
    				<div class="left_side">
    					
    					<img class="left_back" src="<?=base_url()?>assets/img/login_img2.jpg">

    				</div>

    				<div class="right_side">

    					<div class="right_cont">
    						<span class="line_loader"></span>
    						<div class="reg_link_btn">
    						<label>New here?</label> <button onclick="navigate_forms()">Create account</button>
    					</div>
    					
    					<div class="logo_div">
    						<img class="logo" src="<?=base_url()?>assets/img/logo.png">
    						<h3>Contact manager</h3>	
    					</div>
    					
    					<h6 class="header">Login to your account</h6>

    					<form method="POST">

    						<!-- start for login form div -->
    						<div class="form_child_cont login">
    						
    						<h6>Fill out your informations to login to your account.</h6>

    						<div class="row">
    							
    							 <div class="form-group multi-group col-lg-12">
												<label>Username</label>
												<div class="input_div">
													<i class="fa fa-user"></i>
													<input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
												</div>
												<span class="error" id="username"  style="color:red"></span>
													
				           </div>

    						</div>

    						<div class="row">
    							
    							 <div class="form-group multi-group col-lg-12">
												<label>Password</label>
												<div class="input_div">
													<i class="fa fa-lock"></i>
													<input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
													<i onclick="toggle_password(this)" class="bt_icon fa fa-eye"></i>
												</div>
												<span class="error" id="password"  style="color:red"></span>
												
													
				           </div>

    						</div>

    						<button onclick="send_data(this,event)">Login<span class="btn_load"></span></button>


    					</div>
    						<!-- end for login form div -->

    						<!-- start for register form div -->
    						<div class="form_child_cont register">
    						
    						<h6>Fill out your informations to create your account.</h6>

    						<div class="row">
    							
    							 <div class="form-group multi-group col-lg-12">
												<label>Username</label>
												<div class="input_div">
													<i class="fa fa-user"></i>
													<input type="text" class="form-control" id="username_register" name="username_register" placeholder="Ex: Joe Main">
												</div>
												<span class="error" id="username_register"  style="color:red"></span>
												
													
				           </div>

    						</div>

    						<div class="row">
    							
    							 <div class="form-group multi-group col-lg-12">
												<label>Password</label>
												<div class="input_div">
													<i class="fa fa-lock"></i>
													<input type="password" class="form-control" id="password_register" name="password_register" placeholder="Enter your password">
													<i onclick="toggle_password(this)" class="bt_icon fa fa-eye"></i>
												</div>
												<span class="error" id="password_register"  style="color:red"></span>
												
													
				           </div>

    						</div>

    						<button onclick="send_data(this,event)">Create account <span class="btn_load"></span></button>


    					</div>
    						<!-- end for login form div -->    						

    						
    					</form>
    						
    					</div>
    					

    				</div>

    			</div>

    	</div>

    </body>

	<!-- end new/edit contact modal -->
	

	<!-- this is the custom toast -->
    <div class="ctoast">
        <div class="top">
         <div class="title">
             <i class="icon fa "></i> 
             <h6>Toast title</h6>   
         </div> 
         <i class="close fas fa-xmark" onclick="close_toast()"></i> 
        </div>

        <p>Toast will be message</p>
    </div>
  <script src="<?=base_url()?>assets/js/jquery-3.7.1.min.js"></script>

    <script type="text/javascript">
  	var baseUrl = "<?php echo base_url(); ?>";
  </script>

  <script src="<?=base_url()?>assets/js/login.js"></script>

</html>



