<!DOCTYPE html>
<html lang="en">
  <?php include VIEWPATH .'includes/headerweb.php'; ?>
    <body>

    	<!-- menu for mobile -->
    	<div class="mobile-menu">

    		<div class="menu-cont">
    			<button onclick="toggleMobileMenu('hide')"><i class="fa fa-xmark"></i></button>
    			<ul>
	    				<a class="btns" href="#home">Home</a>
	    				<li class="dropdown"> 
	    					<a href="#categories" class="btns">Categories</a> 
	    					<!-- <div class="dropdown-content"> 
	    						<a href="#">Category 1</a> 
	    						<a href="#">Category 2</a> 
	    						<a href="#">Category 3</a> 
	    					</div> --> 
	    				</li>
	    				<a class="btns" href="#contactus">Contact us</a>
	    				<div class="btn-div">
	    					<a class="btns register" href="">Register</a>
	    					<a class="btns login" href="">Login</a>
	    				</div>
	    				
	    			</ul>
    		</div>
    	</div>
    	<!-- end menu for mobile -->

    	<!-- wrapper -->
    	<div class="wrapper">

	    	<!-- topbar -->
	    	<div class="topbar">

	    		<div class="logo">
	    			<img src="<?=base_url()?>assetsWeb/img/logo.png">
	    		</div>

	    		<div class="right">
	    			<ul>
	    				<a class="btns" href="#home">Home</a>
	    				<li class="dropdown"> 
	    					<a href="#categories" class="btns">Categories</a> 
	    					<!-- <div class="dropdown-content"> 
	    						<a href="#">Category 1</a> 
	    						<a href="#">Category 2</a> 
	    						<a href="#">Category 3</a> 
	    					</div>  -->
	    				</li>
	    				<a class="btns" href="#contactus">Contact us</a>
	    				<a class="btns register" href="">Register</a>
	    				<a class="btns login" href="">Login</a>
	    			</ul>
	    			<button onclick="toggleMobileMenu('show')"><i class="fas fa-bars"></i></button>
	    		</div>
	    		
	    	</div>
	    	<!-- end topbar -->

	    	<!-- container -->
	    	<div class="maincontainer">

	    	<!-- landing -->
	    		<div class="landing" id="home">

	    			<div class="lcard">

	    				<h3>Welcome to the one and only <span class="lbadge">SwiftPos BI</span></h3>

	    				<p>Get the best pos related softwares with <span>SwiftPos BI</span> and manage your businesses with ease in total security. Do flawless billing and employees management with our top-tier softwares.</p>

	    				<div class="btn-div">
	    					<a class="btns b" href="<?=base_url()?>web/order">Get started</a>
	    				<a class="btns" href="">Sign in</a>
	    				</div>

	    			</div>

	    			<div class="lcard">

	    				<div class="right">

	    					<div class="bottom">
	    					
	    					<img class="main-img" src="<?=base_url()?>assetsWeb/img/landing-front.jpg">


	    					<div class="tickets-div">
	    						<div class="ticket"><span class="text">Reliability</span>
	    							<span class="dot"></span>
	    						</div>

	    						<div class="ticket c"><span class="dot"></span>
	    							<span class="text">Security</span>
	    						</div>
	    						<div class="ticket"><span class="text">Durability</span>
	    							<span class="dot"></span>
	    						</div>

	    						<div class="ticket"><span class="dot"></span>
	    							<span class="text">Accuracy</span>
	    						</div>
	    					</div>


	    				</div>

	    				<div class="top">
	    					<img src="<?=base_url()?>assetsWeb/img/landing-side.jpg">
	    				</div>
	    					
	    				</div>
	    				
	    			</div>

	    		</div>
	    		<!-- end landing -->

	    		<!-- categories -->
	    		<div class="cat-cont" id="categories">
	    		
	    		<div class="header"><label>Categories</label>
	    			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	    		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	    		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	    		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	    		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	    		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	    		</div>

	    		<div class="cats-div">
	    			
	    			<?php for ($i=1; $i <= 10; $i++) { ?>

	    				<div class="cat-card" onclick="modal('infoModal','show');">
	    				<i class="fa fa-utensils icon"></i>
	    				<h6>Categorie <?php echo $i ?></h6>
	    				<p>consequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur.</p>
	    			<span class="price-tag">300 000 BIF</span>
	    			<a href=""><i class="fa fa-shopping-cart"></i>Order software</a>
	    			</div>

	    				
	    			<?php } ?>
	    		</div>
	    		
	    			

	    		</div>
	    		<!-- end categories -->

	    		<!-- contact us -->

	    		<div class="contact-cont" id="contactus">
	    			
	    			<div class="header"><label>Contact us</label>
	    			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	    		tempor incididunt ut labore et dolore magna aliqua.</p>
	    		</div>

	    		<div class="contact-div">

	    			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7965.886367411208!2d29.378818999999993!3d-3.364062999999992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2sbi!4v1736948731047!5m2!1sfr!2sbi" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

	    			<div class="form">
	    					
	    			<h4>Send us your message</h4>

            <div class="row">
                       
              <div class="form-group col-lg-6">
								<label>First name<span style="color: red;">*</span></label>
									<input type="text" class="form-control" placeholder="ex: John">
									<div id="form-error" style="color:red"></div>
           		</div>

           		 <div class="form-group col-lg-6">
								<label>Last name<span style="color: red;">*</span></label>
									<input type="text" class="form-control" placeholder="ex: Doe">
									<div id="form-error" style="color:red"></div>
           		</div>
                    	
          	</div>

          	  <div class="row">
                       
              <div class="form-group col-lg-12">
								<label>Email<span style="color: red;">*</span></label>
									<input type="email" class="form-control" placeholder="ex: john@gmail.com">
									<div id="form-error" style="color:red"></div>
           		</div>
                    	
          	</div>

          	 <div class="row">
                       
              <div class="form-group col-lg-12">
								<label>Message<span style="color: red;">*</span></label>
									<textarea class="form-control" placeholder="Type your message here"></textarea>
									<div id="form-error" style="color:red"></div>
           		</div>
                    	
          	</div>

          	<button><i class="fa fa-paper-plane"></i>Envoyer votre message</button>

	    			</div>
	    			
	    		</div>

	    		</div>

	    		<!-- end contact us -->

	    	</div>
	    	<!-- end container -->
    		
    	</div>

    	<!-- end wrapper -->


	</body>


	<div class="cmodal" id="infoModal">

			<div class="cmodal-scroll">

				<div class="cmodal-top">
					
					<div class="cmodal-cont">
					<button class="close" onclick="modal('infoModal','hide');"><i class="fa fa-xmark"></i></button>
					<div class="cmodal-cont-content">
						<div class="ccard lt">
							<i class="fa fa-utensils icon"></i>
							<h4>Categorie 1</h4>
							<h6>Main Functionalities</h6>
							<div class="func-cont">
								<?php 	for ($i	=1; $i <=5; $i	++) { ?>

									<div class="func">
									<i class="fa fa-gear"></i>
									<label>Functionality <?php echo $i ?></label>
								</div>

								<?php } ?>
								
							</div>
						</div>

						<div class="ccard">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</p>
							<span class="price-tag">300 000 BIF</span>
	    			<a href=""><i class="fa fa-shopping-cart"></i>Order software</a>
						</div>
					</div>
				</div>

				</div>
			</div>
			
	</div>

	<?php include VIEWPATH . 'includes/footerweb.php'; ?>
</html>



