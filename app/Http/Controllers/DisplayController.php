<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\{userLoginEvent,userRegistered};
use App\Http\Requests;
use App\{post, User};
use Auth;
use Event;
use Session;
use Redirect;
use Validator;
use Image;
class DisplayController extends Controller
{
//Research Journal Faculty posts!
	public function displayRjFPosts()
	{
		$posts = post::orderBy('created_at', 'desc')
		->where('tab', '=', 'Research Journal')
		->where('type', '=', 'Faculty')
		->paginate(5);
		return view('Research_Journal.Faculty.index')->withPosts($posts);
	}

	//Research Journal Student posts!
	public function displayRjSPosts($collegeAbvr)
	{
		$posts = post::where('collegeAbbvr', '=', $collegeAbvr)
		->where('tab', '=', 'Research Journal')
		->where('type', '=', 'Student')
		->orderBy('created_at', 'desc')
		->paginate(5);
		return view('Research_Journal.Student.index', ['name' => $collegeAbvr, 'posts' => $posts]);
	}

	//Institutional Journal Faculty posts!
	public function displayIrFPosts()
	{
		$posts = post::orderBy('created_at', 'desc')
		->where('tab', '=', 'Institutional Research')
		->where('type', '=', 'Faculty')
		->paginate(5);
		return view('Institutional_Research.Faculty.index')->withPosts($posts);
	}

	//Institutional Journal Staff posts!
	public function displayIrSPosts()
	{
		$posts = post::orderBy('created_at', 'desc')
		->where('tab', '=', 'Institutional Research')
		->where('type', '=', 'Staff')
		->paginate(5);
		return view('Institutional_Research.Staff.index')->withPosts($posts);
	}

	//Display login
	public function displayLoginForm()
	{
		return view('pages.login');
	}

	//Login user
	public function loginUser(Request $request)
	{
        $input = $request->except('_token');
        if (Auth::attempt($input)) 
        {
            if(Auth::user()->pending_status == 'pending') { //pending account
                Auth::logout();
                return redirect('login')->with('not_activated', 'Sorry but your account has not been activated yet');
            }
            if(Auth::user()->pending_status == 'rejected') //rejected account..
            {
                Auth::logout();
                return redirect('login')->with('rejected', 'Sorry your account has been rejected!');
            }
            //If everything goes well, login please. :D
            // Event::fire(new userLoginEvent(Auth::user()->name));
            Event::fire(new userLoginEvent(Auth::user()->name));
            Session::flash('Success_login', 'Welcome back ' . Auth::user()->name);
            return Redirect::to('Admin/Dashboard');
        }
        Session::flash('wrong', 'Wrong credentials!');
        return Redirect::to('login')->withInput();   
	}

	//Register user
 	public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'max:4000000000|min:5',
            'username' => 'unique:users|max:20|min:5|AlphaDash',
            'password' => 'max:255|min:8|AlphaNum',
            'email' => 'unique:users',
            'image' => 'image|mimes:jpg,png,jpeg',
            'contactNumber' => 'Numeric|min:8',
            'address' => 'max:4000000000|min:10'
            ]);
        if ($validator->fails()) {
            return redirect('/register')
            ->withErrors($validator)
            ->withInput();
        }
        if ($request->studentCourse) 
        {
           $user = new User;
           $user->name = $request->name;
           $user->email = $request->email;
           $user->username = $request->username;
           $user->password = bcrypt($request->password);
           $user->contact = $request->contactNumber;
           $user->address = $request->address;
           $user->pending_status = 'pending';
           $user->course = $request->studentCourse;
           $user->college = $request->college;
           $user->type = 'Student';
           $user->image = Image::make($request->image->getRealPath())->resize(300, 300)->encode('data-url');
           $user->save();
           Session::flash('success', 'Your account has been created.');
           Event::fire(new userRegistered($user->name));
           return Redirect::to('/register');   
        }

       if($request->department)
       {
           $user = new User;
           $user->name = $request->name;
           $user->email = $request->email;
           $user->username = $request->username;
           $user->password = bcrypt($request->password);
           $user->contact = $request->contactNumber;
           $user->address = $request->address;
           $user->pending_status = 'pending';
           $user->college = $request->department;
           $user->type = 'Faculty';
           $user->image = Image::make($request->image->getRealPath())->resize(300, 300)->encode('data-url');
           $user->save();
           Session::flash('success', 'Your account has been created.');
           Event::fire(new userRegistered($user->name));
           return Redirect::to('/register');   
       }
       if($request->office)
       {
         $user = new User;
         $user->name = $request->name;
         $user->email = $request->email;
         $user->username = $request->username;
         $user->password = bcrypt($request->password);
         $user->contact = $request->contactNumber;
         $user->address = $request->address;
         $user->pending_status = 'pending';
         $user->office = $request->office;
         $user->type = 'Staff';
         $user->image = Image::make($request->image->getRealPath())->resize(300, 300)->encode('data-url');
         $user->save();
         Session::flash('success', 'Your account has been created.');
         Event::fire(new userRegistered($user->name));
         return Redirect::to('/register');   
     }
     Session::flash('error', 'Please select whether you are a SMC Student, SMC Faculty, or a SMC Staff.');
     return redirect()->back()->withInput(); 
 }

	//Logout user
    public function logout()
    {
        Auth::logout();
        return Redirect::to('/');
    }
     public function Search($search, $option, $tab, $type)
    {
        return post::with('user')
                    ->where('tab', '=', "$tab")
                    ->where('type', '=', "$type")
                    ->where("$option", 'like', "%$search%")
                    ->where('status', 'accepted')
                    ->get();
    }
    public function SearchStudent($search, $option, $tab, $type, $department)
    {
        return post::with('user')
                    ->where('tab', '=', "$tab")
                    ->where('type', '=', "$type")
                    ->where("$option", 'like', "%$search%")
                    ->where('collegeAbbvr', "$department")
                    ->where('status', 'accepted')
                    ->get();
    }
}
