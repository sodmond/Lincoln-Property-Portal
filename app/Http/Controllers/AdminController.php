<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $allAdmin = User::all();
        return view('dashboard.registered_admin', ['allAdmin' => $allAdmin]);
    }

    public function delete($id)
    {
        $admin = User::find($id);
        if ($admin) {
            $admin->delete();
            return redirect('/registered_admin');
        }
        //dd("Error");
    }
}
