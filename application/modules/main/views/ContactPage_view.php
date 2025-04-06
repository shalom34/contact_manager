<!DOCTYPE html>
<html lang="en">
  <?php include VIEWPATH .'includes/header.php'; ?>
   <link rel="stylesheet" href="<?=base_url()?>assets/css/form_style.css">
    <body>

    	<!-- start wrapper -->
    	<div class="wrapper">

    		<!-- start main container -->

    		<div class="main_container">
    		

    		<!-- start container -->
    		<div class="container">

    			<!-- <div class="close_div">
    				<button onclick="show()"><i class="fas fa-xmark"></i></button>
    			</div> -->

    			<!-- start	top bar -->
    			<div class="top_bar">
    				
    				<h3 class="title"><span id="total_number"></span>Contacts</h3>

    				<div class="right">

    					<div class="main_btns">
    						<button class="primary_btn oval_btn fas fa-plus" onclick="modal('contact_modal','show');"></button>
    						<button class="search_btn oval_btn fas fa-search" onclick="show_box(this,'search_box')"></button>
    					</div>
    					

    						<div class="search_box close">

    					<div class="search_types">
    						<button class="all selected" value="0">All</button>
    						<button value="1">Name</button>
    						<button value="2">Number</button>
    						<button value="3">Email</button>
    						<button value="4">tag</button>
    					</div>

    					<div class="search_input">
    						<i class="fas fa-search"></i>
    						<input type="text" id="search_input" placeholder="Search" name="">
    					</div>
    					
    				</div>
    					
    				</div>
    			

    			</div>
    			<!-- end search bar -->


    			<!-- start filter bar -->

    			<div class="filter_bar">
    				


    			</div>

    			<!-- end filter bar -->

    			<!-- start table container -->

    			<div class="table_container">
    				
    				<table>
    					
    					<tbody>
    						
    						<!-- don't delete the tbody, this is where contacts are stored -->

    					</tbody>

    				</table>



    			</div>

    			<!-- end table container -->



    			
    		</div>
    		<!-- end container -->

    		<!-- start info_container -->
    		<div class="info_container">
    			
    		<!-- If no contact selected -->
    		<div class="empty_infos">
    			
    			<i class="fas fa-folder-open"></i>
    			<div class="text">
    				No contact selected
    				<span>Select contact simply by clicking on it or <i class="fas fa-ellipsis-h"></i> to get its informations.</span>
    			</div>

    		</div>
    		<!-- end no contact selected -->

    		<div class="contact_infos">
    			
    			<div>
    				<button class="arrow_right" onclick="close_infos();"><i class="fas fa-arrow-left"></i></button>
    			</div>
    			

    			<div class="header">
    				
    				<div class="about">
    					
    					<div class="image_div">
    						<div class="icon" id="photo_letters">CA</div>
    						<img src="" class="icon" id="photo_img">
    					</div>

    					<div class="names">
    						<div class="top">
    						<h6 id="fullname">Full name </h6>
	    					<div class="right">
	    					<button class="oval_btn"><i class="fas fa-pencil"></i></button>
	    					</div>	
    						</div>
    						
    						<label id="description">Description here</label>
    					</div>


    				</div>

    				<div class="buttons">
    					<button><i class="fas fa-phone"></i></button>
    					<button><i class="fas fa-envelope"></i></button>
    					<button><i class="fas fa-comment"></i></button>
    				</div>

    			</div>

    			<div class="subtitle">Personal</div>

    			<div class="info_div">
    			<div class="info_row">
    				
    				<span>Phone</span>
    				<label id="phone">Phone number here</label>

    			</div>

    			<div class="info_row">
    				
    				<span>Email</span>
    				<label id="email">Email will be here</label>

    			</div>
    		</div>

    		<div class="subtitle">Socials</div>

    			<div class="info_div" id="socials_div">
    			
    			<!-- don't delete this div -->

    		</div>


    		</div>

    		</div>
    		<!-- end info_container -->
    	</div>
    	<!-- end main_container -->
    	</div>
    	<!-- end wrapper -->

	</body>

	<!-- new/edit contact modal -->

	<div class="cmodal" id="contact_modal">

			<div class="cmodal-scroll">

				<div class="cmodal-top">
					
					<div class="cmodal-cont md">
					<button class="close" onclick="modal('contact_modal','hide');"><i class="fas fa-xmark"></i></button>
					<div class="cmodal-cont-content">
					
						 <form id="contact_form" method="POST" enctype="multipart/form-data" class="form">

			            	<div class="title">
			            		<i class="fa fa-building"></i>
			            		<label>Informations de votre societe</label>
			            	</div>

			            	<div class="row">
       
				              <div class="image_div col-lg-12">
												
												<div class="image_cont">
												<img class="image col-lg-6" id="logoDisplay" alt="Selected Image" src="<?=base_url()?>assets/icons/newimage.png">
												<span id="btn_remove_img" onclick="remove_image()"><i class="fas fa-xmark"></i></span>	
												</div>
				              	
				              		<input type="file" id="profile_picture" name="profile_picture" accept="image/*" style="display: none">
				              		<input type="file" id="file_input" name="file_input" accept="image/*" style="display: none">
				              		<button onclick="show_file_picker(event)">Choose a photo</button>
				              		<span>Please upload an image under 2MB. Thanks!</span>
				           		</div>	
				                    	
				          	</div>

										<div class="row">
				                       
				              <div class="form-group col-lg-6">
												<label>First name<span style="color: red;">*</span></label>
													<input type="text" class="form-control" id="first_name" name="first_name" placeholder="ex: John">
													<span class="error" id="first_name"  style="color:red"></span>
				           		</div>

				           		 <div class="form-group col-lg-6">
												<label>Last name<span style="color: red;">*</span></label>
													<input type="text" class="form-control" id="last_name" name="last_name" placeholder="ex: Doe">
													<span class="error" id="last_name"  style="color:red"></span>
				           		</div>
				                    	
				          	</div>

				          	 <div class="row">
				                       
				              <div class="form-group col-lg-12">
												<label>Description</label>
													<input type="text" class="form-control" name="description" id="description" placeholder="ex: Boss at work">
				           		</div>
				                    	
				          		</div>

				          	  <div class="row">

				          	  	<div class="form-group col-lg-6">
				          	  		<label>Phone<span style="color: red;">*</span></label>
												<input type="tel" class="form-control
													" placeholder="ex: +25777873992" id="phone" name="phone">
													<span class="error" id="phone"  style="color:red"></span>
												</div>

												<div class="form-group col-lg-6">
				          	  		<label>Email</label>
												<input type="email" class="form-control
													" placeholder="ex: john@gmail.com" id="email" name="email">
													<span class="error_secondary" id="email"  style="color:red"></span>
												</div>
				           		</div>

				           		<div class="row">

												<div class="form-group col-lg-6">
				          	  		<label>Facebook</label>
												<input type="text" class="form-control
													" placeholder="type/paste your url here" id="socials_fb" name="socials_fb">
												</div>

												<div class="form-group col-lg-6">
				          	  		<label>Whatsapp</label>
												<input type="tel" class="form-control
													" placeholder="ex: 79000000" id="socials_wp" name="socials_wp">
												</div>

				           		</div>

				           			<div class="row">

												<div class="form-group col-lg-6">
				          	  		<label>Instagram</label>
												<input type="text" class="form-control
													" placeholder="type/paste the url here" id="socials_insta" name="socials_insta">
												</div>

												<div class="form-group col-lg-6">
				          	  		<label>X(Twitter)</label>
												<input type="text" class="form-control
													" placeholder="type/paste the url here" id="socials_x" name="socials_x">
												</div>

				           		</div>

								
			     		</form>

			     		<div class="cmodal_footer">
			            	 <button class="secondary" onclick="modal('contact_modal','hide');"><i class="fa fa-xmark"></i>Cancel</button>
			            	 <button class="primary" id="add_btn" onclick="send_data('contact_modal');"><i class="fa fa-check"></i>Save</button>
			            </div>

					</div>
				</div>

				</div>
			</div>
			
	</div>

	<!-- end new/edit contact modal -->
	
	<!-- js scripts are written in this footer file -->
	<?php include VIEWPATH . 'includes/footer.php'; ?>
	

</html>



