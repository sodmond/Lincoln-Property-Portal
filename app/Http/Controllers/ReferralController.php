<?php

namespace App\Http\Controllers;

use App\Customer;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Exports\ReferralListExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReferralController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $allRef = Customer::selectRaw('*')->orderByDesc('created_at')->paginate(15);
        return view('dashboard.referral_list', ['allRef' => $allRef]);
    }

    public function exportRefList()
    {
        if( isset($_GET['wkdate']) ){
            $week = $_GET['wkdate'];
            $export = new ReferralListExport();
            $export->setDate($week);
            $filename = 'Referral-List-For-Week-' . $export->getWeek() . '.xlsx';
            return Excel::download($export, $filename);
        }
        return redirect('/referral_list');
    }

    public function userProfile($id)
    {
        if (isset($id)) {
            $user = Customer::find($id);
            $myRef = Customer::where('ref_by', $user->ref_code)->paginate(10);
            return view('dashboard.user_profile', ['profile' => $user, 'myRef' => $myRef]);
        }
        return redirect('/referral_list');
    }
}
