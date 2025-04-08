<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * IRUMVA Shalom
 * 66687570/61258468
* 
*/
class ContactPage extends CI_Controller {

  public function __construct() {
    parent::__construct();
    
  }
  

  function index(){
    $this->is_saved();
    $this->load->view('ContactPage_view');

  }

    // verify if the user data is saved locally

  function is_saved()
    {
        if (empty($this->session->userdata('USER_ID'))) {
            redirect(base_url(''));
        }
    }

  // inserts new contact to the database

  function insert_or_update_contact(){

    $this->is_saved();

    $this->validate();

    try {

   $user_id = $this->session->userdata('USER_ID');

    // As of the socials urls/numbers, all of them will be stored in a single column 'SOCIALS' as json objects for a single contact and here are there identifiers:
    // fb: facebook
    // wp: whatsapp
    // insta: instagram
    // x: X(twitter)

    // get posted data from user form
    $first_name = $this->input->post('first_name');
    $last_name = $this->input->post('last_name');
    $description = $this->input->post('description');
    $phone = $this->input->post('phone');
    $email = $this->input->post('email');
    $socials_fb = $this->input->post('socials_fb');
    $socials_wp = $this->input->post('socials_wp');
    $socials_insta = $this->input->post('socials_insta');
    $socials_x = $this->input->post('socials_x');

    // upload a picture to the server folder
    if (!empty($_FILES['profile_picture']['name'])) {
            $photo = $this->upload_document($_FILES['profile_picture']['tmp_name'], $_FILES['profile_picture']['name']);
            if (!$photo) {
                throw new Exception('Erreur lors de l\'upload de l\'image.');
            }
        } else {
            $photo = ''; 
        }


    // create a json object for socials urls/numbers

    $socials='[
        {"fb": "'.$socials_fb.'",
        "wp": "'.$socials_wp.'",
        "insta": "'.$socials_insta.'",
        "x": "'.$socials_x.'"
        }
      ]';

    // store them in an array with table names as keys
    $contact_data = array(
        'USER_ID'=>$user_id,
        'FIRST_NAME' => $first_name,
        'LAST_NAME' => $last_name,
        'DESCRIPTION' => $description,
        'PHONE' => $phone,
        'EMAIL' => $email,
        'SOCIALS' => $socials,
        'PHOTO' => $photo
    );

    if ($_POST['contact_id']=='' || $_POST['contact_id']==null) {
      // insert them in the table
    $this->Model->create('contacts', $contact_data);
    echo json_encode(['status' => true]);  
    }else{
        // update them in the table
    $contact_id= $_POST['contact_id'];
    $this->Model->update('contacts',array('CONTACT_ID'=>$contact_id),$contact_data);
    echo json_encode(['status' => true]);

    }
    
      
    } catch (Exception $e) {
      echo json_encode(['status' => false, 'message'=>'An error has occured while inserting data.']);
      exit();
    }
    
  }

  // validates all unique values from the user form data to the database data

  function validate(){
    
    $this->is_saved();
    // initialization of data array to send to the front
    $data = array(
      'error_string' => array(),
      'inputerror' => array(),
      'status' => true
    );

    $where_cond='';

    // verify if the user is update an existing number

    if ($_POST['contact_id']!='' && $_POST['contact_id']!=null) {

      $where_cond =  ' AND CONTACT_ID != '.$_POST['contact_id'].' ';

    }

    // validation of a phone number
    $phone=$this->input->post('phone');
    $phone_data = $this->Model->getRequeteOne('SELECT CONTACT_ID FROM contacts WHERE  PHONE="'.$phone.'"'.$where_cond);

    if ($this->validate_phone_number($phone)==false) {
    $data['error_string'][] = "The phone number is invalid.";
      $data['inputerror'][] = "phone";
      $data['status'] = FALSE;   
    }

    if (!empty($phone_data)) {
   
      $data['error_string'][] = "The phone number is already registered.";
      $data['inputerror'][] = "phone";
      $data['status'] = FALSE;

      }


    // validation of an email
    $email=$this->input->post('email');

    if (!empty($email)) {
     $email_data = $this->Model->getRequeteOne('SELECT CONTACT_ID FROM contacts WHERE  EMAIL="'.$email.'" AND EMAIL!=NULL'.$where_cond);

      if ($this->validate_email($email)==false) {
          
    $data['error_string'][] = "The email is invalid.";
      $data['inputerror'][] = "email";
      $data['status'] = FALSE;   
     } 
    }
   

 

    if (!empty($email_data)) {
   
      $data['error_string'][] = "The email is already registered.";
      $data['inputerror'][] = "email";
      $data['status'] = FALSE;

      }

      // validation of whatsapp number if typed

      $wp=$this->input->post('socials_wp');

      if (!empty($wp)) {
          
         if ($this->validate_phone_number($phone)==false) {
    $data['error_string'][] = "The Whatsapp number is invalid.";
      $data['inputerror'][] = "socials_wp";
      $data['status'] = FALSE;   
    } 

      }

      if ($data['status']==FALSE) {
      echo json_encode($data);
      exit();
      }
    
  }




function get_contacts() {


    $this->is_saved();

   $user_id = $this->session->userdata('USER_ID');


    $letter = $_POST['letter'] ?? 'A';
    $contact_number = $this->Model->getRequeteOne("SELECT COUNT(CONTACT_ID) AS TOTAL FROM contacts WHERE USER_ID=".$user_id);

    $user_cond=' AND USER_ID='.$user_id.' ';
    $add_favorite_table='';
    $add_favorite_cond='';

    if ($_POST['is_favorite']=='true') {
        $add_favorite_table=', favorites ';  
        $add_favorite_cond=' AND contacts.CONTACT_ID=favorites.CONTACT_ID ';

    }

    $returned_contacts = $this->Model->getRequeteOne("SELECT COUNT(contacts.CONTACT_ID) AS TOTAL FROM contacts".$add_favorite_table." WHERE 1 ".$user_cond.$add_favorite_cond);

    // Handle special characters as a group
    if ($letter === "SPECIAL") {
        // Query for names starting with any special character
        $contacts = $this->Model->getRequete("
            SELECT *,contacts.CONTACT_ID AS CONTACT_ID FROM contacts"
            .$add_favorite_table. 
            " WHERE FIRST_NAME REGEXP '^[^A-Za-z]'"
            .$user_cond.$add_favorite_cond.
            " ORDER BY FIRST_NAME ASC");
    } else {
        // Query for specific alphabetic letters
        $contacts = $this->Model->getRequete("
            SELECT *,contacts.CONTACT_ID AS CONTACT_ID FROM contacts"
            .$add_favorite_table. 
            " WHERE FIRST_NAME LIKE '$letter%'"
            .$user_cond.$add_favorite_cond.
            " ORDER BY FIRST_NAME ASC");
    }

    $table_list = '';
    foreach ($contacts as $contact) {

        $favorite = $this->Model->getRequeteOne("SELECT FAVORITE_ID FROM favorites WHERE CONTACT_ID=" . $contact['CONTACT_ID']);
        $favorite_star_class = empty($favorite) ? 'far' : 'fas';

        $profile_tag = '<img class="icon" id="photo_img" src="' . base_url() . $contact['PHOTO'] . '">';
        if ($contact['PHOTO'] == null || $contact['PHOTO'] == "" || !file_exists('uploads/profiles/' . basename($contact['PHOTO']))) {

            $firstLetters = substr($contact['FIRST_NAME'], 0, 1) . substr($contact['LAST_NAME'], 0, 1);

             if ($letter === "SPECIAL") {
                $firstLetters='...';
             }

            $profile_tag = '<div id="photo_letters" class="icon">' . $firstLetters . '</div>';
        }

        $table_list .= '<tr id="row' . $contact['CONTACT_ID'] . '" onclick="show_contact_infos(' . $contact['CONTACT_ID'] . ')">
            <td class="infos">'
                . $profile_tag .
                '<div class="important_infos"> 
                <div class="identity" id="fullname">'
                    . $contact["FIRST_NAME"] . " " . $contact["LAST_NAME"] .
                    '<span id="description">' . $contact["DESCRIPTION"] . '</span>
                </div>
                 <div class="identity_contacts">
                    <span id="phone">' . $contact["PHONE"] . '</span>
                </div>
                </div>
            </td>
            <td class="options">
                <a href="tel:'.$contact['PHONE'].'"><i class="fas fa-phone"></i></a>
                <a id="fav' . $contact['CONTACT_ID'] . '" onclick="toggle_favorite(' . $contact['CONTACT_ID'] . ')"><i class="' . $favorite_star_class . ' fa-star"></i></a>
                <button onclick="show_contact_infos(' . $contact['CONTACT_ID'] . ')"><i class="fas fa-ellipsis-h"></i></button>
            </td>
        </tr>';
    }

    echo json_encode([
        'table_list' => $table_list,
        'total' => $contact_number['TOTAL'],
        'returned_contacts' => $returned_contacts['TOTAL']
    ]);
}

// gets contact info by posted id from selected row

function get_contact_infos($id) {

    $contact_data= $this->Model->getRequeteOne("SELECT * FROM contacts WHERE CONTACT_ID=".$id);

    $fullname= $contact_data['FIRST_NAME']." ".$contact_data['LAST_NAME'];
    $description= $contact_data['DESCRIPTION'];
    $phone= $contact_data['PHONE'];
    $email= $contact_data['EMAIL'];
    $photo= $contact_data['PHOTO'];
    $firstLetters = substr($contact_data['FIRST_NAME'], 0, 1).substr($contact_data['LAST_NAME'], 0, 1);

    $img_path=base_url().$photo;

    if ($photo == null || $photo == "" || !file_exists('uploads/profiles/' . basename($photo))) {

                $img_path='';
            }

    // get all socials from json

// JSON string from MySQL database
$socials_json = $contact_data['SOCIALS'];


 $socials_html='';

$fb='';
$wp='';
$insta='';
$x='';

if ($socials_json!=null || $socials_json!='') {
   
   // Decode JSON into an associative array
$socials_data = json_decode($socials_json, true); 

if ($socials_data!=null || $socials_data!='') {

foreach ($socials_data as $social) {


    if ($social['fb']!=null || $social['fb']!='') {
       $socials_html.='<div class="info_row">
        <span>Facebook <a href="'.$social['fb'].'" target="_blank"><i class="fa fa-external-link"></i></a></span>
        <label>'.$social['fb'].'</label>

        </div>';
    $fb=$social['fb'];
    }

    if ($social['wp']!=null || $social['wp']!='') {
       $socials_html.='<div class="info_row">
        <span>Whatsapp <a href="https://wa.me/'.$social['wp'].'" target="_blank"><i class="fa fa-external-link"></i></a></span>
        <label>'.$social['wp'].'</label>

        </div>';
    $wp=$social['wp'];

    }

    if ($social['insta']!=null || $social['insta']!='') {
       $socials_html.='<div class="info_row">
        <span>Instagram <a href="'.$social['insta'].'" target="_blank"><i class="fa fa-external-link"></i></a></span>
        <label>'.$social['insta'].'</label>

        </div>';
    $insta=$social['insta'];

    }

     if ($social['x']!=null || $social['x']!='') {
       $socials_html.='<div class="info_row">
        <span>X(Twitter) <a href="'.$social['x'].'" target="_blank"><i class="fa fa-external-link"></i></a></span>
        <label>'.$social['x'].'</label>

        </div>';
    $x=$social['x'];

    }

    }
    }

}

    echo json_encode([
        'id' => $id,
        'first_name' => $contact_data['FIRST_NAME'],
        'last_name' => $contact_data['LAST_NAME'],
        'fullname' => $fullname,
        'description' => $description,
        'phone' => $phone,
        'email' => $email,
        'first_letters' => $firstLetters,
        'img_path' => $img_path,
        'fb' => $fb,
        'wp' => $wp,
        'insta' => $insta,
        'x' => $x,
        'socials_html' => $socials_html

    ]);
}

// add a contact to the favorites

function toggle_favorite($contact_id){
    
    $this->is_saved();
    $favorite= $this->Model->getRequeteOne("SELECT FAVORITE_ID FROM favorites WHERE CONTACT_ID=".$contact_id);

    $status=false;
    if (!empty($favorite)) {

        $favorite_id=$favorite['FAVORITE_ID'];
        $status=$this->Model->delete('favorites', ['FAVORITE_ID' => $favorite_id]);

    }else{

        $status=$this->Model->create('favorites', ['CONTACT_ID'=>$contact_id]);
        
    }

    echo json_encode(['status'=>$status]);
}



// uploads files to the folder

function upload_document($file_name, $field_name){
        $this->is_saved();
        $rep_doc = FCPATH . 'uploads/profiles/';
        $file_extension = pathinfo($field_name, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension);
    
        if (!is_dir($rep_doc)) { 
            mkdir($rep_doc, 0777, TRUE);
        }
    
        $pathfile = 'uploads/profiles/' . $field_name;    
        move_uploaded_file($file_name, $rep_doc . $field_name);
        
        return $pathfile;
    }

function delete_contact($id){
        $this->is_saved();
     $results=$this->Model->delete('contacts', ['CONTACT_ID' => $id]);
     if ($results) {
         echo json_encode(['status'=>true]);
     }else{
         echo json_encode(['status'=>false]);

     }
}

function validate_phone_number($phoneNumber) {
    $pattern = "/^\+?[0-9]{8,15}$/";

    if (preg_match($pattern, $phoneNumber)) {
        return true; 
    } else {
        return false;
    }
}

function validate_email($email) {
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    if (preg_match($pattern, $email)) {
        return true; 
    }
    return false;
}



}


?>