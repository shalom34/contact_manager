<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notifications
{
  protected $CI;

  public function __construct()
  {
      $this->CI = & get_instance();
      $this->CI->load->library('email');
      $this->CI->load->model('Model');
  }

  function send_mail($subjet, $message, $emailTo = array(), $cc_emails = array(), $attach = array()) {

    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'ssl://mamba.afriregister.com';
    $config['smtp_port'] = 465;
    $config['smtp_user'] = 'unwomen@mediabox.bi';
    $config['smtp_pass'] = 'Mediabox@2025';
    $config['mailtype'] = 'html';
    $config['charset'] = 'UTF-8';
    $config['wordwrap'] = TRUE;
    $config['smtp_timeout'] = 20;
    $config['newline'] = "\r\n";

    $this->CI->email->initialize($config);
    $this->CI->email->set_mailtype("html");
    $this->CI->email->from('noc@mediabox.bi', 'UNwomen');
    $this->CI->email->to($emailTo);
    $this->CI->email->cc($cc_emails);
    $this->CI->email->subject($subjet);
    $this->CI->email->message($message);

    if (!empty($attach)) {
        foreach ($attach as $att) {
            $this->CI->email->attach($att);
        }
    }

    if (!$this->CI->email->send()) {
        return 0; 
    } else {
        return 1;
    }
}



  public function send_sms($string_msg, $string_tel = NULL)
{
    $data = '{"urns": ["' . $string_tel . '"],"text":"' . $string_msg . '"}';

    $header = array();
    $header[0] = 'Authorization:Token 8ae3e567ec75aeac4fab42a43c64edf52f0eb736';  // pas d'espace entre Authori et : et Token
    $header[1] = 'Content-Type:application/json';
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, 'https://sms.ubuviz.com/api/v2/broadcasts.json');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    $result = curl_exec($curl);
    // $result = json_decode($result);

    return $result;
}


   public function generate_UIID($taille)
   {
     $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789'; 
      $QuantidadeCaracteres = strlen($Caracteres); 
      $QuantidadeCaracteres--; 

      $Hash=NULL; 
        for($x=1;$x<=$taille;$x++){ 
            $Posicao = rand(0,$QuantidadeCaracteres); 
            $Hash .= substr($Caracteres,$Posicao,1); 
        }

        return $Hash; 
   }

    public function generate_password($taille)
   {
     $Caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMOPQRSTUVXWYZ0123456789'; 
      $QuantidadeCaracteres = strlen($Caracteres); 
      $QuantidadeCaracteres--; 

      $Hash=NULL; 
        for($x=1;$x<=$taille;$x++){ 
            $Posicao = rand(0,$QuantidadeCaracteres); 
            $Hash .= substr($Caracteres,$Posicao,1); 
        }
        return $Hash; 
   }


   //notification sur whatsapp
   public function whatsapp($phone,$message)
   {
// {
//   "created": true,
//   "message": null,
//   "chatId": "25769176202-1585228756@g.us",
//   "groupInviteLink": "https://chat.whatsapp.com/Jwrl92pPGqCJNCafwiZZWl"
// }
    $data = [
    'phone' =>"'".$phone."'", // Receivers phone
    'body' => "".$message."" // Message
            ];

    $json = json_encode($data); // Encode data to JSON
    // URL for request POST /message
    $url = 'https://api.chat-api.com/instance110613/sendMessage?token=44k8xwmfiveo2h53';

    // Make a POST request
    $options = stream_context_create(['http' => [
        'method'  => 'POST',
        'header'  => 'Content-type: application/json',
        'content' => $json
        ]
        ]);
     // Send a request
     $result = file_get_contents($url, false, $options);


   }

}

?>
