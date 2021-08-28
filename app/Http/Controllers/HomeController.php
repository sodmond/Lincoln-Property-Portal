<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    private function getRefName($users)
    {
        $data = [];
        foreach($users as $user){
            if ($user->ref_by == 11111111) {
                continue;
            }
            $name = Customer::select('id', 'firstname', 'lastname')->where('ref_code', $user->ref_by)->first();
            $fullname = $name->firstname.' '.$name->lastname;
            $data[] = [
                'id'            =>  $name->id,
                'fullname'      =>  $fullname,
                'ref_code'      =>  $user->ref_by,
                'freq'          =>  $user->freq
            ];
        }
        return $data;
    }

    public function index()
    {
        $totalRef = Customer::all()->count();
        $todayRef = Customer::whereRaw("DATE(created_at) = date('Y-m-d')")->count();
        $directRef = ((Customer::where('ref_by', 11111111)->count()) * 100) / $totalRef;
        $totalAdmin = User::all()->count();
        $topUserByRef = Customer::selectRaw('DISTINCT ref_by, COUNT(ref_by) as freq')->groupBy('ref_by')->limit(8)->get();
        $gender = [];
        $gender['male'] = Customer::where('gender', 'male')->count();
        $gender['female'] = Customer::where('gender', 'female')->count();
        $recentRef = Customer::selectRaw('*')->orderByDesc('created_at')->limit(10)->get();
        return view('dashboard.home', [
            'totalRef'              => $totalRef,
            'todayRef'              => $todayRef,
            'directRef'             => $directRef,
            'totalAdmin'            => $totalAdmin,
            'totalUserByRef'        => $this->getRefName($topUserByRef),
            'gender'                => $gender,
            'recentRef'             => $recentRef,
        ]);
    }
}
