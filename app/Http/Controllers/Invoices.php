<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Invoices extends Controller
{
    //
    public function invoices()
    {
        return view("pages/invoices/list");
    }

    public function new_invoice()
    {
        $in_number = "INV-" . date('Y') . "-" . rand(100, 999);
        return view("pages/invoices/create", ["invoice_number" => $in_number]);
    }
}
