<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Dao\CourseDao;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(CourseDao $dao)
    {
        $courses = $dao->all();
        return view('user/home', ['courses' => $courses]);
    }

    public function correo()
    {
        return view('mail/index');
    }
}
