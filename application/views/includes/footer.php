
    <div id="scrollToTopButton" class="floating-button">
    <i class="fas fa-arrow-up"></i>
    </div>  

    <!-- jQuery -->
        <script src="<?=base_url()?>assets/js/jquery-3.7.1.min.js" type="d2ea1eb9a52065b6e33f27f8-text/javascript"></script>

        <!-- Feather Icon JS -->
    <script src="<?=base_url()?>assets/js/feather.min.js" type="d2ea1eb9a52065b6e33f27f8-text/javascript"></script>

    <!-- Slimscroll JS -->
    <script src="<?=base_url()?>assets/js/jquery.slimscroll.min.js" type="d2ea1eb9a52065b6e33f27f8-text/javascript"></script>

    <!-- Datatable JS -->
    <script src="<?=base_url()?>assets/js/jquery.dataTables.min.js" type="d2ea1eb9a52065b6e33f27f8-text/javascript"></script>
    <script src="<?=base_url()?>assets/js/dataTables.bootstrap5.min.js" type="d2ea1eb9a52065b6e33f27f8-text/javascript"></script>

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

    <!-- Sweetalert 2 -->
    <script src="<?=base_url()?>assets/plugins/sweetalert/sweetalert2.all.min.js" type="d2ea1eb9a52065b6e33f27f8-text/javascript"></script>
    <script src="<?=base_url()?>assets/plugins/sweetalert/sweetalerts.min.js" type="d2ea1eb9a52065b6e33f27f8-text/javascript"></script>

    <!-- Custom JS -->
    
  
    <script src="<?=base_url()?>assets/js/script.js" type="d2ea1eb9a52065b6e33f27f8-text/javascript"></script>
  
  <!--<script src="<?=base_url()?>assets/js/theme-settings.js"></script>-->
  
  <script src="<?=base_url()?>assets/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="d2ea1eb9a52065b6e33f27f8-|49" defer=""></script>
  <script src="<?=base_url()?>assets/js/jquery-3.7.1.min.js"></script>
</body>


<!-- custom js -->

<script type="text/javascript">

// declaration of global variables
let currentLetter = 'A'; // Start with the first letter
let loading = false; // Prevent duplicate calls while loading
let selectedFile = null; // Store the valid file globally

document.addEventListener('DOMContentLoaded', function () {


// Trigger loading on scroll
window.addEventListener('scroll', () => {
    if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
        get_data();
    }
});
get_data();
add_events_on_searchtypes();

 });



function modal(modal_id, type) {
    var modal= document.querySelector('#'+modal_id);
    var wrapper= document.querySelector(".wrapper");
     var floatingbtn= document.querySelector(".floating-button");
    var body= document.querySelector("body");

    reinitialize_modal(modal_id);

    if (type==='hide') {
        modal.classList.remove("show");
        body.classList.remove("n-scroll");
        wrapper.classList.remove("blur");
        floatingbtn.classList.remove("blur");
    }else{
      modal.classList.add("show");
        body.classList.add("n-scroll");
        wrapper.classList.add("blur");
        floatingbtn.classList.add("blur");  
    }
}


// shows infos of a contact
function show(){
    const info_cont= document.querySelector('.info_container');
    info_cont.style.display="flex";
}

// shows a box based on the box class
function show_box(button, box_class) {
    const chatbox = document.querySelector("."+box_class);
   
      chatbox.classList.toggle('close');
      button.classList.toggle('rotate');
      button.classList.toggle('fa-xmark');
    button.classList.toggle('fa-search');
    select_searchtype('none');
}


// triggers file picker to pick the image

function show_file_picker(event) {
    const fileInput = document.getElementById('file_input'); 
    const imageDisplay = document.getElementById('logoDisplay'); 
    const btn_remove_img = document.getElementById('btn_remove_img'); 


    // Prevent the default button behavior
    event.preventDefault();

    // Trigger the file input click event
    fileInput.click();

    // Add an event listener for file selection
    fileInput.addEventListener('change', (event) => {
        const file = event.target.files[0]; // Get the selected file

        if (file) {
            // Check if the file size is <= 2MB
            if (file.size <= 2 * 1024 * 1024) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Update the displayed image
                    imageDisplay.classList.add('active');
                    imageDisplay.src = e.target.result;
                    btn_remove_img.style.display="flex";


                    // Store the file globally for future use
                    selectedFile = file;
                    
                };

                reader.readAsDataURL(file);
            } else {
                // Notify the user about the invalid file size
                alert('Please choose an image smaller than 2MB.');

                // Reset the file input for invalid file selection
                fileInput.value = '';

               
            }
        }
    });

}

// removes picked image

function remove_image() {
   const fileInput = document.getElementById('file_input'); 
    const imageDisplay = document.getElementById('logoDisplay'); 
    const btn_remove_img = document.getElementById('btn_remove_img');

    fileInput.value='';
    imageDisplay.src='<?=base_url()?>assets/icons/newimage.png';
    imageDisplay.classList.remove('active');
    selectedFile=null;
    btn_remove_img.style.display='none'; 
}

// empties an input when clicked on the x icon of the input

function empty_input(input_id) {
    const input = document.querySelector("#"+input_id);
    input.value="";


}

// adds events on a selected searchtype
function add_events_on_searchtypes() {

    const search_types = document.querySelector('.search_types');
      const buttons = search_types.querySelectorAll('button');

      buttons.forEach(button => {
        button.addEventListener('click', function () {

        select_searchtype(button.value);

      });
  });
}

// selects a clicked searchtype
function select_searchtype(button_value) {

    const search_types = document.querySelector('.search_types');
      const buttons = search_types.querySelectorAll('button');

      buttons.forEach(button => {

        if (button_value==='none') {
            search_types.querySelector('.all').classList.remove('selected');
            search_types.querySelector('.all').classList.add('selected');
            button.classList.remove('selected');
        }else{

        if (button.value===button_value) {
        button.classList.remove('selected');
        button.classList.add('selected');

        if (button_value!=='0') {
            search_types.querySelector('.all').classList.remove('selected');
        }

        }else{

            if (button_value==='0') {
                button.classList.remove('selected');
            }       

        }
      }
       

  });
}

// sends data from the modal to the controller

function send_data(modal_id) {
    const modalElement= document.querySelector('#'+modal_id);
    const form= modalElement.querySelector('form');
    if (!hasEmpty(form.id)) {
      validate_and_send(modalElement);
    }
    
}

// Verifies if the modal form has any empty required field using the id of its form
function hasEmpty(idform) {
        const form = document.querySelector("#" + idform);
        var formElements = form.querySelectorAll('input,select');

        let returnValue = false;

        for (let i = 0; i < formElements.length; i++) {
            const element = formElements[i];
            if (element.tagName === 'INPUT' || element.tagName === 'SELECT') {
                if (element.tagName === 'INPUT') {
                    let value = element.value;
                    if (value === '') {
                        
                        const errors = form.querySelectorAll('.error');
                        errors.forEach(error => {
                            let elementId = element.id;
                            if (elementId === error.id) {
                                error.innerHTML = "This field is required.";
                                returnValue = true;
                            }

                        });
                    } else {

                        const errors = form.querySelectorAll('.error');
                        errors.forEach(error => {

                            let elementId = element.id;
                            if (elementId === error.id) {

                                error.innerHTML = "";
                            }
                        });


                    }
                }

                if (element.tagName === 'SELECT') {
                    let index = element.selectedIndex;
                    if (index === 0) {
                        
                        const errors = form.querySelectorAll('.error');
                        errors.forEach(error => {
                            let elementId = element.id;
                            if (elementId === error.id) {

                                error.innerHTML = "This field is required.";
                                returnValue = true;
                            }

                        });
                    } else {
                        const errors = form.querySelectorAll('.error');
                        errors.forEach(error => {
                            let elementId = element.id;
                            if (elementId === error.id) {

                                error.innerHTML = "";
                            }
                        });

                    }
                }

            }
        }
        return returnValue;
    }

// validates unique data from the controller before sending them
function validate_and_send(modalElement) {

    $('#add_btn').attr("disabled", true);

    var url = "<?php echo base_url('contacts/add'); ?>";
    const form= modalElement.querySelector('form');
    var formData = new FormData($('#'+form.id)[0]);
    formData.append('profile_picture', selectedFile);

    return new Promise((resolve, reject) => {
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    resolve(true);
                     get_data();
                    modal(modalElement.id,'hide');
                    
                } else {


                     for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                    }   
                    resolve(false);
                  
                }
                $('#add_btn').attr('disabled', false);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Erreur s\'est produite ');
                $('#add_btn').attr('disabled', false);
                reject(false);
            }
        });
    });
}

// removes all error from the modal
function reinitialize_modal(modal_id) {
    selectedFile=null;

    const modal= document.querySelector('#'+modal_id);
    modal.querySelector('img').src="<?=base_url()?>assets/icons/newimage.png";
    modal.querySelector('img').classList.remove("active");
    modal.querySelector('#btn_remove_img').style.display='none';


     modal.querySelectorAll('.error, .error_secondary').forEach(span => {
    span.textContent = "";
    });
     modal.querySelectorAll('input').forEach(input => {
    input.value = "";
    });

      modal.querySelectorAll('select').forEach(select => {
    select.value = "0";
    });

}

function get_data() {
    if (loading || currentLetter > 'Z') return;

    loading = true;
    const url = "<?php echo base_url('contacts/get'); ?>";
    const table_body = document.querySelector('table');
    const total_number = document.querySelector('#total_number');


    // Show shimmer placeholders
    for (let i = 0; i < 3; i++) {
        const shimmerRow = document.createElement('tr');
        shimmerRow.innerHTML = '<td class="shimmer"></td>';
        table_body.appendChild(shimmerRow);
    }

    // Create FormData for AJAX request
    const formData = new FormData();
    formData.append('letter', currentLetter);

    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {
            
            // Remove shimmer placeholders
            document.querySelectorAll('.shimmer').forEach(el => el.remove());
            total_number.textContent=data.total+" TOTAL";

            // Check if contacts exist for this letter
            if (data.table_list !== '') {
                // Add the header for the current letter
                const headerRow = `<tr class="header"><td>${currentLetter}</td></tr>`;
                table_body.insertAdjacentHTML('beforeend', headerRow);

                // Append rows to the table body
                table_body.insertAdjacentHTML('beforeend', data.table_list);
            }

            // Move to the next letter
            currentLetter = String.fromCharCode(currentLetter.charCodeAt(0) + 1);

            loading = false;

            // Automatically load the next batch if the screen isn't filled
            check_screen_space();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Erreur s\'est produite');
            loading = false;

            // Remove shimmer placeholders on error
            document.querySelectorAll('.shimmer').forEach(el => el.remove());
        }
    });
}

function check_screen_space() {
    const contentHeight = document.body.offsetHeight;
    const windowHeight = window.innerHeight;

    // If content height is less than the window height, load the next batch
    if (contentHeight <= windowHeight && currentLetter <= 'Z') {
        get_data();
    }
}

//shows selected contact infos

function show_contact_infos(contact_id) {

 const table= document.querySelector('table');
 const info_container= document.querySelector('.info_container');
 const empty_infos= document.querySelector('.empty_infos');
 const contact_infos= document.querySelector('.contact_infos');
 const selected_row= table.querySelector('#row'+contact_id);

 table.querySelectorAll('tr').forEach(row => {
    row.classList.remove('selected');
    });

 selected_row.classList.add('selected');
 get_contact_info(contact_id);
 empty_infos.style.display="none";
 info_container.classList.add('active');
 contact_infos.classList.add('active');


}

// gets contact data from selected row

function get_contact_info(id) {
    
 const info_container= document.querySelector('.info_container');
    const url = "<?php echo base_url('contacts/get_infos'); ?>"+"/"+id;
    

    $.ajax({
        url: url,
        type: "POST",
        data: {},
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {
            
            info_container.querySelector('#fullname').textContent=data.fullname;
            info_container.querySelector('#description').textContent=data.description;
            info_container.querySelector('#phone').textContent=data.phone;
            info_container.querySelector('#email').textContent=data.email;
            const img_path=data.img_path;

            if (img_path!=='') {
            info_container.querySelector('#photo_img').src=img_path;
            info_container.querySelector('#photo_img').style.display='flex';
            info_container.querySelector('#photo_letters').style.display='none';

            }else{
              info_container.querySelector('#photo_img').style.display="none";
              info_container.querySelector('#photo_letters').style.display='flex';
            info_container.querySelector('#photo_letters').textContent=data.first_letters;  
            }
            console.log(data.socials_html);

            info_container.querySelector('#socials_div').innerHTML=data.socials_html;  

            
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Erreur s\'est produite');
           
        }
    });
}

// closes infos

function close_infos() {
 const table= document.querySelector('table');
 const info_container= document.querySelector('.info_container');
 const empty_infos= document.querySelector('.empty_infos');
 const contact_infos= document.querySelector('.contact_infos');

 table.querySelectorAll('tr').forEach(row => {
    row.classList.remove('selected');
    });

 empty_infos.style.display="flex";
 info_container.classList.remove('active');
 contact_infos.classList.remove('active');  
}


</script>

