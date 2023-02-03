<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Mail\CustomerDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public $code;

    public function __construct() {
        $code = rand(11111112, 999999999);
        $this->code = $code;
    }
    public function index($ref = "")
    {
        if ($ref != "") {
            $ref_id = explode("-", $ref);
            $res_code = $ref_id[1];
            $findCust = Customer::find($ref_id[0]);
            $res_name = $findCust->firstname.' '.$findCust->lastname;
            return view('/sign-up', ['res_code' => $res_code, 'res_name' => $res_name]);
        }
        return view('/sign-up');
    }

    public function checkCust($email)
    {
        $cust = Customer::where('email', $email)->first();
        if ($cust) {
            return response()->json(['cust' => $cust->toArray()], 200);
        }
        return response()->json(['error' => "No record found!"]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email'         => 'bail|required|unique:customers,email',
            'fname'         => 'required',
            'lname'         => 'required',
            'gender'        => 'required',
            'dob'           => 'required|date',
            'phone'         => 'required|numeric',
            'state'         => 'required',
            'country'       => 'required',
            'acct_name'     => 'required',
            'bank_name'     => 'required',
            'acct_num'      => 'required|numeric'
        ]);
        $valData = [
            'firstname'     => $request->fname,
            'lastname'      => $request->lname,
            'email'         => $request->email,
            'gender'        => $request->gender,
            'dob'           => $request->dob,
            'phone'         => $request->phone,
            'state'         => $request->state,
            'country'       => $request->country,
            'ref_code'      => $this->code,
            'acct_name'     => $request->acct_name,
            'bank_name'     => $request->bank_name,
            'acct_num'      => $request->acct_num,
            'ref_by'        => $request->ref_by,
            'created_at'    => date('Y-m-d h:i:s'),
        ];
        $customer = Customer::insertGetId($valData);
        if ($customer) {
            $ref_link = url('/sign-up/'.$customer.'-'.$valData['ref_code']);
            Mail::to($valData['email'])->send(new CustomerDetails($valData, $ref_link));
            $suc_msg = "Form submitted successfully. See your referral link below:";
            return view('/sign-up', ['suc_msg' => $suc_msg, 'ref_link' => $ref_link]);
        }
        $err_msg = 'Problem encountered, pls try again';
        return view('/sign-up', ['err_msg' => $err_msg]);
    }
}
