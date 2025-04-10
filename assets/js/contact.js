// declaration of global variables
let currentLetter = 'A'; // Start with the first letter
let loading = false; // Prevent duplicate calls while loading
let selectedFile = null; // Store the valid file globally
let currentIndex = 0;
// Group special characters under the label "SPECIAL"
const characters = ["SPECIAL", ...'ABCDEFGHIJKLMNOPQRSTUVWXYZ'];



let is_favorite=false;

document.addEventListener('DOMContentLoaded', function () {


// Trigger loading on scroll
window.addEventListener('scroll', () => {
    if (window.innerHeight + window.scrollY >= document.documentElement.scrollHeight - 10) {
        get_data();
    }
});

get_data();

 });

function modal(modal_id, type) {
    var modal= document.querySelector('#'+modal_id);
    var wrapper= document.querySelector(".wrapper");
     var floatingbtn= document.querySelector(".floating-button");
    var body= document.querySelector("body");

    if (type==='hide') {

        modal.classList.remove("show");
        body.classList.remove("n-scroll");
        wrapper.classList.remove("blur");
        floatingbtn.classList.remove("blur");
        reinitialize_modal(modal_id);
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
    const search_box = document.querySelector("."+box_class);

      search_box.classList.toggle('close');
      button.classList.toggle('rotate');
      button.classList.toggle('fa-xmark');
    button.classList.toggle('fa-search');


        const topbar= document.querySelector('.top_bar');

        if (search_box.classList.contains('close')) {

        topbar.style.justifyContent='flex-end';
        topbar.querySelector('.search_box').style.display="flex";   
        topbar.querySelector('.title').style.display="none";   
        topbar.querySelector('#btn_new').style.display="none";   
        }else{
        topbar.style.justifyContent='space-between';
        topbar.querySelector('.search_box').style.display="none";   
        topbar.querySelector('.title').style.display="flex";   
            topbar.querySelector('#btn_new').style.display="block";
        }
 
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
                show_toast('Image size','Please choose an image smaller than 2MB.','error');

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
    imageDisplay.src=baseUrl+'assets/icons/newimage.png';
    imageDisplay.classList.remove('active');
    selectedFile=null;
    btn_remove_img.style.display='none';
}

// empties an input when clicked on the x icon of the input

function empty_input(input_id) {
    const input = document.querySelector("#"+input_id);
    input.value="";


}


// sends data from the modal to the controller

function send_data(modal_id) {
    const modalElement= document.querySelector('#'+modal_id);
    const form= modalElement.querySelector('form');
    modalElement.querySelectorAll('.error, .error_secondary').forEach(span => {
    span.textContent = "";
    });
    if (!hasEmpty(form.id)) {
      validate_and_send(modalElement);
    }else{
     show_toast('Required fields','Please, fill out all required fields','error');
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

    let contact_id= modalElement.querySelector('#add_btn').value;


    var url = baseUrl+"contacts/add";

     const form= modalElement.querySelector('form');
    var formData = new FormData($('#'+form.id)[0]);
    formData.append('profile_picture', selectedFile);

    if (contact_id!==null || contact_id!=="") {
    var url = baseUrl+"contacts/edit";
    formData.append('contact_id', contact_id);
    }

     load(true);

    return new Promise((resolve, reject) => {
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {

                load(false);

                if (data.status) {
                    resolve(true);
                    modal(modalElement.id,'hide');
                    show_toast('Success','A new contact has been added successsfully','success');
                    refresh();



                } else {


                     for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                    }

                    show_toast('Validation error','Some of your informations are taken or invalid.','error');

                    resolve(false);

                }
                $('#add_btn').attr('disabled', false);
            },
            error: function (jqXHR, textStatus, errorThrown) {

                load(false);

                show_toast('Validation error','An error has occured while validating your data','error');
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
    modal.querySelector('img').src=baseUrl+"assets/icons/newimage.png";
    modal.querySelector('img').classList.remove("active");
    modal.querySelector('#btn_remove_img').style.display='none';

    const title=modal.querySelector('.title');

    title.querySelector('label').textContent="Add new contact";


     modal.querySelectorAll('.error, .error_secondary').forEach(span => {
    span.textContent = "";
    });
     modal.querySelectorAll('input').forEach(input => {
    input.value = "";
    });

      modal.querySelectorAll('select').forEach(select => {
    select.value = "0";
    });

    modal.querySelectorAll('button').forEach(select => {
    select.value = "";
    });

}


function get_data() {
    if (loading || currentIndex >= characters.length) return;

    loading = true;
    const currentChar = characters[currentIndex];
    const url = baseUrl+"contacts/get";
    const table_body = document.querySelector('table');
    const total_number = document.querySelector('#total_number');

    // Show shimmer placeholders
    load_table(true);

    // Create FormData for AJAX request
    const formData = new FormData();
    formData.append('letter', currentChar);
    formData.append('is_favorite', is_favorite);

    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {
            // Remove shimmer placeholders
             load_table(false);
            total_number.textContent = data.total + " TOTAL";

            if (data.table_list !== '') {
                const headerRow = `<tr class="header"><td>${currentChar === "SPECIAL" ? "..." : currentChar}</td></tr>`;
                table_body.insertAdjacentHTML('beforeend', headerRow);
                table_body.insertAdjacentHTML('beforeend', data.table_list);
            }

            // Move to the next character
            currentIndex++;
            loading = false;

            // Automatically load the next batch if the screen isn't filled
            check_screen_space();
        },
        error: function (jqXHR, textStatus, errorThrown) {

            show_toast('Server error','An error has occured while fetching your data. Please, try refreshing the page','error');
            loading = false;
             load_table(false);

           
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
 const shimmer= document.querySelector('.info_shimers');
 const contact_infos= document.querySelector('.contact_infos');
    const url = baseUrl+"contacts/get_infos/"+id;

    contact_infos.style.display='none';
    shimmer.style.display='flex';

    $.ajax({
        url: url,
        type: "POST",
        data: {},
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {

            info_container.querySelector('#edit_btn').setAttribute('contact-data',JSON.stringify(data));
            info_container.querySelector('#fullname').textContent=data.fullname;
            info_container.querySelector('#description').textContent=data.description;
            info_container.querySelector('#info_call').href="tel:"+data.phone;
            info_container.querySelector('#info_email').href="mailto:"+data.email;
            info_container.querySelector('#info_sms').href="sms:"+data.phone;
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

            if (starts_with_non_etter(data.first_letters)) {
             info_container.querySelector('#photo_letters').textContent='...';   
            }else{
                info_container.querySelector('#photo_letters').textContent=data.first_letters;
            }
            
            }

            info_container.querySelector('#delete_btn').value=data.id;
            info_container.querySelector('#socials_div').innerHTML=data.socials_html;

                contact_infos.style.display='flex';
                shimmer.style.display='none';


        },
        error: function (jqXHR, textStatus, errorThrown) {
            show_toast('Server error','An error has occured while fetching contact data, retry.','error');

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
 contact_infos.style.display='none';
}

// gets infos and open edit modal

function open_edit_modal(btn) {

    const contact_data= JSON.parse(btn.getAttribute('contact-data'));

    const modalElement= document.querySelector('#contact_modal');
    const title=modalElement.querySelector('.title');

    title.querySelector('label').textContent="Edit contact";
    modalElement.querySelector('#first_name').value=contact_data.first_name;
    modalElement.querySelector('#last_name').value=contact_data.last_name;
    modalElement.querySelector('#description').value=contact_data.description;
    modalElement.querySelector('#phone').value=contact_data.phone;
    modalElement.querySelector('#email').value=contact_data.email;
    modalElement.querySelector('#socials_fb').value=contact_data.fb;
    modalElement.querySelector('#socials_wp').value=contact_data.wp;
    modalElement.querySelector('#socials_insta').value=contact_data.insta;
    modalElement.querySelector('#socials_x').value=contact_data.x;
    modalElement.querySelector('#add_btn').value=contact_data.id;

    const img_path=contact_data.img_path;

    if (img_path!=='') {

    modalElement.querySelector('#logoDisplay').src=img_path;
    modalElement.querySelector('#logoDisplay').classList.add('active');
    modalElement.querySelector('#btn_remove_img').style.display='flex';


    }else{
    modalElement.querySelector('#logoDisplay').src=baseUrl+"assets/icons/newimage.png";
    modalElement.querySelector('#logoDisplay').classList.remove('active');
    modalElement.querySelector('#btn_remove_img').style.display='none';
    }


    modal('contact_modal','show');


}

// updates a row of a contact
function refresh() {


currentLetter='A'
loading= false;
currentIndex = 0;

var table=document.querySelector('table');
table.innerHTML='';
get_data();
close_infos();


}

function open_dialog(btn) {
    show_delete_dialog(btn.value);
}

function show_delete_dialog(contact_id) {

   const dialog= document.querySelector('.dialog_cont');
   const body= document.querySelector('body');
   const delete_btn= dialog.querySelector('#delete');
   const cancel= dialog.querySelector('#cancel');

   dialog.style.display='flex';
   body.classList.add('n-scroll');

   cancel.addEventListener('click', function(){
    dialog.style.display='none';
   body.classList.remove('n-scroll');
   });



   delete_btn.addEventListener('click', function(){
    
            load(true);
    const url = baseUrl+"contacts/delete/"+contact_id;
    $.ajax({
        url: url,
        type: "POST",
        data: {},
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {
                load(false);
            dialog.style.display='none';
            body.classList.remove('n-scroll');
            show_toast('Success',"A contact has been successsfully removed", 'success');

            refresh();

          
        },
        error: function (jqXHR, textStatus, errorThrown) {
                load(false);
     dialog.style.display='none';
     body.classList.remove('n-scroll');
            show_toast('Deletion error',"An error has occured while deleting the contact.", 'error');

        }
    });

   });

}

function toggle_favorite(contact_id) {
    
    const table= document.querySelector('table');
    const favorite_btn= table.querySelector("#fav"+contact_id);
    const favorite_btn_icon= favorite_btn.querySelector("i");

    const url = baseUrl+"contacts/toggle_favorite/"+contact_id;
    favorite_btn.disabled = true;

    $.ajax({
        url: url,
        type: "POST",
        data: {},
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {

        
        if (favorite_btn_icon.classList.contains('far')) {

            favorite_btn_icon.classList.remove('far');
            favorite_btn_icon.classList.add('fas');

        }else{

            favorite_btn_icon.classList.add('far');
            favorite_btn_icon.classList.remove('fas');
         
        }

        favorite_btn.disabled = false; 

          
        },
        error: function (jqXHR, textStatus, errorThrown) {
            favorite_btn.disabled = false;
        show_toast('Error',"An error has occured. Try again please.", 'error');

        }
    });


}

// toggle fetching favorites

function toggle_fetch_favorites(btn) {

    btn.classList.toggle('deselected')
    if (btn.classList.contains('deselected')) {
        is_favorite=false;
    }else{
        is_favorite=true;
    }

    refresh();
}

// log out user

function log_out(btn){
    

    const url = baseUrl+"logout";
    btn.disabled = true;

    $.ajax({
        url: url,
        type: "POST",
        data: {},
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {
        setTimeout(function () {
            window.location.replace(baseUrl);
        },500) 

          
        },
        error: function (jqXHR, textStatus, errorThrown) {
            btn.disabled = false;
        show_toast('Error',"An error has occured. Try again please.", 'error');

        }
    });


}

// verifies if a string doesn't start with a letter

function starts_with_non_etter(str) {
    // Check if the first character is NOT a letter (a-z or A-Z)
    return /^[^a-zA-Z]/.test(str);
}

// for toast, type is either "success" or "error"
function show_toast(title, message, type) {

 const toast= document.querySelector('.ctoast'); 

 if (type==='error') {
    toast.querySelector('h6').classList.add('error');
    toast.querySelector('.icon').classList.add('error');
    toast.querySelector('.icon').classList.remove('fa-check');
    toast.querySelector('.icon').classList.add('fa-xmark');
 }else{
    toast.querySelector('h6').classList.remove('error');
    toast.querySelector('.icon').classList.remove('error');
    toast.querySelector('.icon').classList.add('fa-check');
    toast.querySelector('.icon').classList.remove('fa-xmark');
 }

 toast.querySelector('h6').textContent=title;
 toast.querySelector('p').textContent=message;

 toast.classList.remove('hide');
toast.classList.add('show');  

setTimeout(close_toast, 3000);

}


function close_toast() {

    document.querySelector('.ctoast').classList.remove('show');
    document.querySelector('.ctoast').classList.add('hide');

}

function load(isloading) {
    if (isloading) {
        document.querySelector('.main_loader').style.display='flex';
    }else{
        document.querySelector('.main_loader').style.display='none';

    }
}

function load_table(isLoad) {
    const table_shimmer=document.querySelector('.table_shimmer');

    if (isLoad) {
        table_shimmer.style.display='flex';
    }else{
        table_shimmer.style.display='none';
    }
}


