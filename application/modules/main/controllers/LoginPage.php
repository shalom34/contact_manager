<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * IRUMVA Shalom
 * 66687570/61258468
* 
*/
class LoginPage extends CI_Controller {

  public function __construct() {
    parent::__construct();
    
  }
  

  function index(){
    $this->is_saved();
    $this->load->view('LoginPage_view');
  }



  // verify if the user data is saved locally

  function is_saved()
    {
        if (!empty($this->session->userdata('USER_ID'))) {
            redirect(base_url('contacts'));
        }
    }


// login with user infos

  function login(){

    $username=$this->input->post('username');
    $password=sha1($this->input->post('password'));

    $log_data=$this->Model->getRequeteOne('SELECT USER_ID FROM users WHERE USERNAME="'.$username.'" AND PASSWORD="'.$password.'"');

    if (!empty($log_data)) {
        echo json_encode(['status'=>true]);
        $this->savedata($log_data['USER_ID']);
    }else{
        echo json_encode(['status'=>false, 'message'=>"The acount with such informations does not exist."]);

    }


  }


    function register(){

    $this->validate();

    $username=$this->input->post('username_register');
    $password=sha1($this->input->post('password_register'));

    $user_data=[
        'USERNAME'=>$username,
        'PASSWORD'=>$password
    ];

    $results=$this->Model->create('users', $user_data);
    $status=false;

    if ($results) {
       $status=true;
    }

    echo json_encode(['status'=>$status]);


  }

    function validate(){
    
    $this->is_saved();
    // initialization of data array to send to the front
    $data = array(
      'error_string' => array(),
      'inputerror' => array(),
      'status' => true
    );

    // validation of an email
    $username=$this->input->post('username_register');

     $username_data = $this->Model->getRequeteOne('SELECT USER_ID FROM users WHERE  USERNAME="'.$username.'"');

      if (!empty($username_data)) {
          
    $data['error_string'][] = "The username is already taken.";
      $data['inputerror'][] = "username_register";
      $data['status'] = FALSE;   
     } 

   


      if ($data['status']==FALSE) {
      echo json_encode($data);
      exit();
      }
    
  }

  // save user data in session
   public function savedata($id){
      
      
            $session = array(
              'USER_ID' => $id
            );
  
            $this->session->set_userdata($session);

  
         }
 
}


?>