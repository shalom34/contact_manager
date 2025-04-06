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

    $this->load->view('ContactPage_view');
  }

  // inserts new contact to the database

  function insert_contact(){

    $this->validate();

    try {

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
        'FIRST_NAME' => $first_name,
        'LAST_NAME' => $last_name,
        'DESCRIPTION' => $description,
        'PHONE' => $phone,
        'EMAIL' => $email,
        'SOCIALS' => $socials,
        'PHOTO' => $photo
    );

    // insert them in the table
    $this->Model->create('contacts', $contact_data);
    echo json_encode(['status' => true]);
      
    } catch (Exception $e) {
      echo json_encode(['status' => true, 'message'=>'An error has occured while inserting data.']);
      exit();
    }
    
  }

  // validates all unique values from the user form data to the database data

  function validate(){
    
    // initialization of data array to send to the front
    $data = array(
      'error_string' => array(),
      'inputerror' => array(),
      'status' => true
    );

    // validation of a phone number
    $phone=$this->input->post('phone');
    $phone_data = $this->Model->getRequeteOne('SELECT CONTACT_ID FROM contacts WHERE  PHONE="'.$phone.'"');

    if (!empty($phone_data)) {
   
      $data['error_string'][] = "The phone number is already registered.";
      $data['inputerror'][] = "phone";
      $data['status'] = FALSE;

      }


    // validation of an email
    $email=$this->input->post('email');
    $email_data = $this->Model->getRequeteOne('SELECT CONTACT_ID FROM contacts WHERE  EMAIL="'.$email.'"');

    if (!empty($email_data)) {
   
      $data['error_string'][] = "The email is already registered.";
      $data['inputerror'][] = "email";
      $data['status'] = FALSE;

      }

      if ($data['status']==FALSE) {
      echo json_encode($data);
      exit();
      }
    
  }




function get_contacts() {
    $letter = $_POST['letter'] ?? 'A';

    $contact_number= $this->Model->getRequeteOne("SELECT COUNT(CONTACT_ID) AS TOTAL FROM contacts");

    // Fetch all contacts for the given letter
    $contacts = $this->Model->getRequete("SELECT * FROM contacts WHERE FIRST_NAME LIKE '$letter%' ORDER BY FIRST_NAME ASC");

    $table_list = '';

    foreach ($contacts as $contact) {

        $profile_tag='<img class="icon" src="'.base_url().$contact['PHOTO'].'">';

        if ($contact['PHOTO'] == null || $contact['PHOTO'] == "" || !file_exists('uploads/profiles/' . basename($contact['PHOTO']))) {

            $firstLetters = substr($contact['FIRST_NAME'], 0, 1).substr($contact['LAST_NAME'], 0, 1);
             $profile_tag='<div class="icon">'.$firstLetters.'</div>';
            }

        $table_list .= '<tr id="row'.$contact['CONTACT_ID'].'" onclick="show_contact_infos('.$contact['CONTACT_ID'].')">
            <td class="infos">'
                .$profile_tag.
                '<div class="important_infos"> 
                <div class="identity">
                    ' . $contact["FIRST_NAME"] . " " . $contact["LAST_NAME"] . '
                    <span>' . $contact["DESCRIPTION"] . '</span>
                </div>
                 <div class="identity_contacts">
                    <span>' . $contact["PHONE"] . '</span>
                </div>
                </div>
            </td>
            <td class="options">
                <button><i class="fas fa-phone"></i></button>
                <button><i class="fas fa-star"></i></button>
                <button><i class="fas fa-ellipsis-h"></i></button>
            </td>
        </tr>';
    }

    echo json_encode([
        'table_list' => $table_list,
        'total' => $contact_number['TOTAL']
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
    }

    if ($social['wp']!=null || $social['wp']!='') {
       $socials_html.='<div class="info_row">
        <span>Whatsapp <a href="https://wa.me/'.$social['wp'].'" target="_blank"><i class="fa fa-external-link"></i></a></span>
        <label>'.$social['wp'].'</label>

        </div>';
    }

    if ($social['insta']!=null || $social['insta']!='') {
       $socials_html.='<div class="info_row">
        <span>Instagram <a href="'.$social['insta'].'" target="_blank"><i class="fa fa-external-link"></i></a></span>
        <label>'.$social['insta'].'</label>

        </div>';
    }

     if ($social['x']!=null || $social['x']!='') {
       $socials_html.='<div class="info_row">
        <span>X(Twitter) <a href="'.$social['x'].'" target="_blank"><i class="fa fa-external-link"></i></a></span>
        <label>'.$social['x'].'</label>

        </div>';
    }

    }
    }

}

    echo json_encode([
        'fullname' => $fullname,
        'description' => $description,
        'phone' => $phone,
        'email' => $email,
        'first_letters' => $firstLetters,
        'img_path' => $img_path,
        'socials_html' => $socials_html

    ]);
}


// uploads files to the folder

function upload_document($file_name, $field_name){
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

}
?>