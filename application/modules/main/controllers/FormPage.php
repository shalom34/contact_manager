<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * IRUMVA Shalom
 * 66687570/61258468
* 
*/
class FormPage extends CI_Controller {

  public function __construct() {
    parent::__construct();
    
  }

  function is_auth()
  {
    if (empty($this->session->userdata('USER_ID'))) {
      redirect(base_url(''));
    }
  }
  

  function index(){

    $this->load->view('FormPage_view');
  }

 
}
?>