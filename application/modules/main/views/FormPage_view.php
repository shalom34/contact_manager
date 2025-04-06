<!DOCTYPE html>
<html lang="en">
  <?php include VIEWPATH .'includes/headerweb.php'; ?>
	<link rel="stylesheet" href="<?=base_url()?>assetsWeb/css/form_style.css">

    <body>


    	<!-- wrapper -->
    	<div class="wrapper">


	    		<div class="main-form-cont">
	    			
	    			<!-- decription container -->
	    			<div class="desc-cont">
	    					<img src="<?=base_url()?>assetsWeb/img/logo.png">
	    					<div class="bottom">
	    					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat.</p>
								<a href="<?=base_url()?>">Plus tards</a>	
	    					</div>

						</div>
								<!-- end description container -->

								<!-- user form -->
						<div class="form-container">
			        <div class="pagination">
			            <span class="page-number">1</span>
			            <span class="page-number">2</span>
			            <span class="page-number">3</span>
			            <span class="page-number">4</span>
			        </div>
			        <form id="paginated-form" method="POST" class="form">
			            <div class="form-page" data-page="1">

			            	<div class="title">
			            		<i class="fa fa-building"></i>
			            		<label>Informations de votre societe</label>
			            	</div>

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
			               
			     			</div>


			            <div class="form-page" data-page="2" style="display: none;">

			                <div class="title">
			            		<i class="fa fa-user"></i>
			            		<label>Informations du responsable</label>
			            		</div>

			                <input type="text" name="last_name" placeholder="Last Name">
			            </div>


			            <div class="form-page" data-page="3" style="display: none;">

			                <div class="title">
			            		<i class="fa fa-laptop"></i>
			            		<label>Informations de le logiciel</label>
			            		</div>

			                <input type="email" name="email" placeholder="Email">
			            </div>
			            <div class="form-page" data-page="4" style="display: none;">
			                
			            	<div class="title">
			            		<i class="fa fa-wallet"></i>
			            		<label>Paiement</label>
			            	</div>

			                <input type="text" name="phone" placeholder="phone">
			            </div>


			            <div class="form-navigation">
			                <button type="button" id="prev-btn"><i class="fa fa-arrow-left"></i>  Precedent</button>
			                <button type="button" id="next-btn">Suivant<i class="fa fa-arrow-right"></i></button>
			            </div>
			        </form>
			    </div>
			    <!-- end user form -->

	</div>
	    		
</div>


    	<!-- end wrapper -->


	</body>

</html>

<script type="text/javascript">
	
document.addEventListener("DOMContentLoaded", function() {
    let currentPage = 1;
    const totalPages = document.querySelectorAll(".form-page").length;

    const showPage = (page) => {
        document.querySelectorAll(".form-page").forEach((formPage) => {
            formPage.style.display = formPage.getAttribute("data-page") == page ? "block" : "none";
        });
        document.querySelectorAll(".page-number").forEach((pageNumber, index) => {
            pageNumber.classList.toggle("active", index + 1 == page);
        });
        document.getElementById("prev-btn").style.display = page == 1 ? 'none' : 'inline-block';
        if (page == totalPages) {
            document.getElementById("next-btn").innerHTML = 'Envoyer <i class="fa fa-paper-plane"></i>';
        } else {
            document.getElementById("next-btn").innerHTML = 'Suivant <i class="fa fa-arrow-right"></i>';
        }
    };

    document.querySelectorAll(".page-number").forEach((pageNumber, index) => {
        pageNumber.addEventListener("click", () => {
            currentPage = index + 1;
            showPage(currentPage);
        });
    });

    document.getElementById("prev-btn").addEventListener("click", () => {
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
        }
    });

    document.getElementById("next-btn").addEventListener("click", () => {
        if (currentPage < totalPages) {
            currentPage++;
            showPage(currentPage);
        } else {
            document.getElementById("paginated-form").submit();
        }
    });

    showPage(currentPage);
});



</script>



