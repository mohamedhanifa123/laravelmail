<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class SendmailController extends Controller
{
    public function sendmail(Request $request)
    {
        
        $subject=$request->subject;
        $file=$request->file;

        require base_path("vendor/autoload.php");

        $mail = new PHPMailer(true);


    $mail->SMTPDebug = 0;                      
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'hanifa025@gmail.com';                     
    $mail->Password   = 'hanifa025';                               
    $mail->SMTPSecure = 'tls';            
    $mail->Port       = 587;   
    
    $mail->setFrom('hanifa025@gmail.com', 'hanifa');
    $mail->addAddress('hanifa025@gmail.com');

    $mail->addAttachment($file);
    

    if(isset($_FILES['file'])) {
        for ($i=0; $i < count($_FILES['file']['tmp_name']); $i++) {
            $mail->addAttachment($_FILES['file']['tmp_name'][$i], $_FILES['file']['name'][$i]);
        }
    }


    $mail->isHTML(true);                

    $mail->subject = $subject;
    $mail->file= $request->$file;
    $mail->send();


 } 
 
}  



   

