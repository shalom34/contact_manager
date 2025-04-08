  
    <div class="main_loader">

    <div class="loader">
    <i class="fas fa-file-alt form-icon"></i>
    <div class="arrows">

        <i class="fas fa-chevron-right arrow-icon" style="font-size: 16px;"></i>
        <i class="fas fa-chevron-right arrow-icon" style="font-size: 15px;"></i>
        <i class="fas fa-chevron-right arrow-icon" style="font-size: 14px;"></i>

    </div>
    <i class="fas fa-cloud cloud-icon"></i>
    </div>
 
    </div>
    
    </div>

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

    <div id="scrollToTopButton" class="floating-button">
    <i class="fas fa-arrow-up"></i>
    </div>


    <div class="dialog_cont">
        <div class="dialog">
            <h4>Delete contact</h4>
            <p>Do you really want to delete this contact?
            Mind you, you will never be able to retrieve it.</p>

            <div class="buttons">
                <button id="cancel">Cancel</button>
                <button id="delete">Delete</button>
            </div>
        </div>
    </div>


    <!-- Bootstrap Core JS -->
    <script src="<?=base_url()?>assets/js/bootstrap.bundle.min.js" type="d2ea1eb9a52065b6e33f27f8-text/javascript"></script>

    <!-- Summernote JS -->
    <script src="<?=base_url()?>assets/plugins/summernote/summernote-bs4.min.js" type="d2ea1eb9a52065b6e33f27f8-text/javascript"></script>

    <!-- Select2 JS -->
    <script src="<?=base_url()?>assets/plugins/select2/js/select2.min.js" type="d2ea1eb9a52065b6e33f27f8-text/javascript"></script>

    <!-- Datetimepicker JS -->
    <script src="<?=base_url()?>assets/js/moment.min.js" type="d2ea1eb9a52065b6e33f27f8-text/javascript"></script>
    <script src="<?=base_url()?>assets/js/bootstrap-datetimepicker.min.js" type="d2ea1eb9a52065b6e33f27f8-text/javascript"></script>

    <!-- Bootstrap Tagsinput JS -->
    <script src="<?=base_url()?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js" type="d2ea1eb9a52065b6e33f27f8-text/javascript"></script>


  <script src="<?=base_url()?>assets/js/jquery-3.7.1.min.js"></script>
</body>


<!-- custom js -->
<script type="text/javascript">
    let baseUrl="<?=base_url()?>";
</script>
<script src="<?=base_url()?>assets/js/contact.js"></script>

