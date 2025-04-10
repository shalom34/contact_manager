
// shows or hide the password
function toggle_password(btn) {

    // Toggle the icon classes
    if (btn.classList.contains('fa-eye')) {
        btn.classList.remove('fa-eye');
        btn.classList.add('fa-eye-slash');
    } else {
        btn.classList.add('fa-eye');
        btn.classList.remove('fa-eye-slash');
    }

    // Find the input element in the same parent div
    const parentDiv = btn.closest('div');
    const input = parentDiv.querySelector('input');

   
    if (input.type === 'password') {
        input.type = 'text'; 
    } else {
        input.type = 'password'; 
    }
}

function send_data(btn, event) {
	event.preventDefault();
	const form= document.querySelector('form');
	const login_form= form.querySelector('.login');
    form.querySelectorAll('.error, .error_secondary').forEach(span => {
    span.textContent = "";
    });
    if (!hasEmpty()) {
    	let isLog=true;
    	if (login_form.style.display==='none') {
    		isLog=false;
    	}	
      validate_and_send(btn,isLog);
    }else{
     show_toast('Required fields','Please, fill out all required fields','error');
    }



}

// go from login to register form end vice versa
function navigate_forms() {
    
	const reg_link_btn = document.querySelector('.reg_link_btn');
    const form = document.querySelector('form');
	const header = document.querySelector('.header');
	const login = form.querySelector('.login');
	const register = form.querySelector('.register');
	const top_label = reg_link_btn.querySelector('label');
	const btn = reg_link_btn.querySelector('button');

	form.querySelectorAll('.error, .error_secondary').forEach(span => {
    span.textContent = "";
    });

    form.querySelectorAll('input').forEach(input => {
    input.value = "";
    });

    console.log("header"+header)

    let header_text='Create your account';
	let message='Do you have an account?';
	let btn_text='Log in';

	if (login.style.display === 'none') {
		login.style.display = 'flex';
		register.style.display = 'none'; 
         header_text='Login to your account';
		 message='New here?';
		 btn_text='Create account';


	} else {
		login.style.display = 'none';
		register.style.display = 'flex';
		 message='Do you have an account?';
		 btn_text='Log in';
	}
    header.textContent=header_text;
	top_label.textContent=message;
	btn.textContent=btn_text;

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

function load(button, isloading) {
	const line_loader= document.querySelector('.line_loader');
	const span= button.querySelector('span');

	if (isloading) {
		button.disable=true;
		line_loader.style.display='inline-block';
		span.style.display='inline-block';
	}else{
		button.disable=false;
		line_loader.style.display='none';
		span.style.display='none';
	}
}


// Verifies if the form has any empty required field using the id of its form
function hasEmpty() {
		let class_form='login';
		const mainForm = document.querySelector('form');
		const login_form=mainForm.querySelector('.login');

		if (login_form.style.display==='none') {
			class_form='register';
		}
        const form = document.querySelector("."+class_form);
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
function validate_and_send(btn,islog) {

    var url = baseUrl+"login";

    var formData = new FormData($('form')[0]);

    if (islog==false) {
     url = baseUrl+"register";;
    }

    console.log(url);

     load(btn, true);

    return new Promise((resolve, reject) => {
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {

                load(btn, false);

                if (data.status) {
                    resolve(true);
                   if (islog==false) {
          			 show_toast('Success','You have successsfully created an account','success');	
          			 setTimeout(navigate_forms(),1000);
          			}else{
          			 show_toast('Success','Successsfully logged in','success');
          			 window.location.replace(baseUrl+'contacts');
          			
          			}

                } else {

                	if (data.message) {

                		show_toast('Authentification error',data.message,'error');

                     
                	}else{

                		for (var i = 0; i < data.inputerror.length; i++) {
                        
                        	var elements= document.querySelectorAll('#'+data.inputerror[i]);
                        	

                        	elements.forEach(element=>{
                        		if (element.classList.contains('error')) {
                        			element.textContent=data.error_string[i];
                        		}
                        	});
                        
		                    }

		                    if (islog) {
		                    	show_toast('Validation error','Some of your informations are taken or invalid.','error');
		                    }else{
		                    	show_toast('Server error','An error has occured while creating your account.','error');

		                    }
		               

		                }

                    resolve(false);

                }
            },
            error: function (jqXHR, textStatus, errorThrown) {

                load(btn, false);
                let error_message="An error has occured while validating your data";
                if (islog) {
                error_message= "An error has occured while creating your account."	
                }
                show_toast('Server error',error_message,'error');
                reject(false);
            }
        });
    });
}