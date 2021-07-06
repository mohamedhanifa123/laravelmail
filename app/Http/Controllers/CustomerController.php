<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Member;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class CustomerController extends Controller
{
    public function store(Request $request)
    {
        
         $request->validate([
             'email'=> 'required'
         ]);

         Customer::create($request->all());
         
         return back()->with('success', 'Email uploaded successfully');
    }

    public function create(Request $request)
    {
         $customer=customer::all();

        
        $request->validate([
           'subject' => 'required',
          'file' => 'required',
          
        ]);
       

        if ($request->hasfile('file')) {
            $images = $request->file('file');

            foreach($images as $image) {
                $name = $image->getClientOriginalName();
                $file = $image->storeAs('image_file', $name);

                Member::create([
                    'name' => $name,
                    'file' => $file,
                    'subject' => $request->subject,
                  ]);
            }
         }

        
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

     foreach($customer as $record){
        $email= $record->email;
        $mail->addAddress($email);
    }
    
    
 
     $mail->addAttachment($file);
     
 
     if(isset($_FILES['file'])) {
         for ($i=0; $i < count($_FILES['file']['tmp_name']); $i++) {
             $mail->addAttachment($_FILES['file']['tmp_name'][$i], $_FILES['file']['name'][$i]);
         }
     }
 
 
     $mail->isHTML(true);                
 
     $mail->subject = $subject;
     $mail->file= $file;
     $mail->send();
    

        return back()->with('success', 'Images & Email send successfully');
    }
}
