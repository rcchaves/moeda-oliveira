<?php 

namespace App\Communication;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;


class Email{
/**
 * Credenciais de acesso smtp
 * @var string
 */
const HOST = 'smtp.gmail.com';
const OAUTH_USER_EMAIL = 'ramon.webap@gmail.com';
const OAUTH_CLIENT_ID = '';
const OAUTH_SECRET_KEY = '';
const USER = 'ramon.webap@gmail.com';
const PASS = '';
const SECURE = 'TLS';
const PORT = 587;
const CHARSET = 'UTF-8';

/**
 * Dados Remetente
 * @var string
 */

 const FROM_EMAIL = 'ramon.webap@gmail.com';
 const FROM_NAME = 'Ramon César';
/**
 * MENSSAGEM DE ERRO
 * @var string
 */
private $error;

/**
 * Retorna msg de Erro
 * @return string
 */

 public function getError(){
     return $this->error;
 }
 /**
  * @param string|array @addresses
  * @param string $subject
  * @param string $body
  * @param string|array $attachments
  * @param string|array $ccs
  * @param string|array $bccs
  * @return boolean
  */
  

 public function sendEmail($addresses, $subject, $body, $attachments = [], $ccs = [], $bccs = []){
     $this->error = '';

     $obMail = new PHPMailer(true);
     try{
         $obMail->isSMTP(true);
         $obMail->SMTPDebug = 2;
         $obMail->Host      = self::HOST;
         $obMail->SMTPAuth  = true;
         $obMail->Username  = self::USER;
         $obMail->Password  = self::PASS;
         $obMail->SMTPSecure = self::SECURE;
         $obMail->Port       = self::PORT;
         $obMail->CharSet    = self::CHARSET;

         //REMETENTE
         $obMail->setFrom(self::FROM_EMAIL,self::FROM_NAME);

         //DESTINATARIOS
         $addresses = is_array($addresses) ? $addresses : [$addresses];
         foreach($addresses as $address){
             $obMail->addAddress($address);
         }

         //ANEXOS
         $attachments = is_array($attachments) ? $attachments : [$attachments];
         foreach($attachments as $attachment){
             $obMail->addAttachment($attachment);
         }
         //CONTEUDO EMAIL
         $obMail->isHTML(true);
         $obMail->Subject = $subject;
         $obMail->Body    = $body;

         //envia email
         return $obMail->send();

     }catch(PHPMailerException $e){
         $this->error = $e->getMessage();
         return false;
     }

 }


}
