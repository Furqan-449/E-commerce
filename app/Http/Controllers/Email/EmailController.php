<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Mail\welcomeemail;
use App\Models\EndUser\EndUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    //

    public function send_email()
    {
        $to = "john+@inbox.mailtrap.io";
        $message = "welcome to TechShop";
        $subject = "welcome";

        // $response =  Mail::to($to)->send(new welcomeemail($message, $subject));
        return "email send";    
    }
}
