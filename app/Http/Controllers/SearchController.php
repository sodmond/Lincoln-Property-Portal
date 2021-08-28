<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        if (isset($_GET['searchVal'])) {
            $val = $_GET['searchVal'];
            return redirect("/search/$val");
        }
        return view('dashboard.search');
    }

    public function search($val)
    {
        $sRef = Customer::where('email', '=', $val)->orWhere('lastname', 'LIKE', "%$val%")
            ->orWhere('ref_code', '=', $val)->paginate(10);
        if ($sRef->count() > 0) {
            return view('dashboard.search', ['sRef' => $sRef, 'sVal' => $val]);
        }
        return view('dashboard.search', ['empty_msg' => "No record(s) found!"]);
    }
}
