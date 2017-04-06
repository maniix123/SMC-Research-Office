<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Events\userPostEvent;
use App\{User, post, StudentPost, Events, notify, Remarks};
use Auth;
use Validator;
use Response;
use URL;
use Image;
use Session;
use Redirect;
use Event;
use DB;

class DashboardController extends Controller
{
	//Constructor!
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('checkIfSuperAdmin')->only(['createEvent', 'editEvent', 'resizeEvent', 'dragEvent', 'displayAllUsers']);
        $this->middleware('checkIfProfileOwner')->only(['editProfile']);
	}

	//Index page.. [middleware: auth]
	public function index()
	{
        $userPosts = post::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();
		$users = User::where('pending_status', '=', 'accepted')
                        ->whereNull('role')
                        ->orderBy('created_at', 'desc')
                        ->limit(8)
                        ->get();
		$RjFposts = post::orderBy('created_at', 'desc')
                    ->where('tab', '=', 'Research Journal')
                    ->where('type', '=', 'Faculty')
                    ->limit(3)
                    ->get();
        $RjSposts = post::orderBy('created_at', 'desc')
                    ->where('tab', '=', 'Research Journal')
                    ->where('type', '=', 'Student')
                    ->where('status', '=', 'accepted')
                    // ->limit(3)
                    ->get();
        $IrFposts = post::orderBy('created_at', 'desc')
                    ->where('tab', '=', 'Institutional Research')
                    ->where('type', '=', 'Faculty')
                    ->limit(3)
                    ->get();
         $IrSposts = post::orderBy('created_at', 'desc')
                    ->where('tab', '=', 'Institutional Research')
                    ->where('type', '=', 'Staff')
                    ->limit(3)
                    ->get();
		return view('Admin_Dashboard.index', compact('users', 'RjFposts', 'RjSposts', 'IrFposts', 'IrSposts', 'userPosts'));
	}

	//Display profile [middleware: auth]
	public function displayProfile($id)
	{
		$user = User::findOrFail($id);
		return view('Admin_Dashboard.displayUserProfile', compact('user'));
	}

	//Edit profile [middleware: auth, checkIfProfileOwner]
	public function editProfile($id)
	{
		$user = User::findOrFail($id);
		return view('Admin_Dashboard.editProfile', compact('user'));
	}

	//Update profile
	public function updateProfile(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'max:4000000000|min:5',
            'username' => "max:20|min:5|AlphaDash",
            'password' => "max:4000000000|min:8",
            'contact' => 'Numeric|regex:/(09)[0-9]{9}/',
            'address' => 'max:4000000000|min:10',
            'image' => 'image',
            'email' => 'email'
            ]);
		 if ($validator->fails()) {
            return redirect('/Admin/Profile/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->contact = $request->contact;
       	if($request->address)
       	{
       		$user->address = $request->address;
       	}
       	if($request->image)
       	{
       		 $user->image = Image::make($request->image->getRealPath())->resize(300, 300)->encode('data-url');
       	}
       	$user->save();
       	return redirect('Admin/Profile/' .$id)->with('message', 'Successfully edited your profile');
	}

	//Fetch events..
	public function appendEvents()
	{
		$events = Events::all();
        $eventsJson = array();
        foreach ($events as $event) {
            $eventsJson[] = array(
                'id' => $event->id,
                'title' => $event->title,
                'description' => $event->description,
                'start' => $event->start,
                'end' => $event->end
            );
        }
        return Response::json($eventsJson);
	}

	//Display create event page.. [middleware: checkIfSuperAdmin]
	public function createEvent()
	{
		return view('Admin_Dashboard.createEvent');
	}

	//Store events..
	public function storeEvent(Request $request)
	{
	     $validator = Validator::make($request->all(), [
        'eventName' => 'max:4000000000|min:5|regex:/^[\pL\s\-]+$/u',
        'eventDescription' => 'max:4000000000|min:5|regex:^[a-zA-Z0-9,.!? ]*$^',
        ]);
        if ($validator->fails()) {
            return redirect('/Admin/Dashboard/create-event')
                        ->withErrors($validator)
                        ->withInput();
        }
        $events = new Events;
        $events->title = $request->eventName;
        $events->description = $request->eventDescription;
        $events->start = $request->eventStart;
        $events->end = $request->eventEnd;
        $events->save();
        return redirect('Admin/Dashboard#calendar')->with('Event', 'Successfully created event!');
	}

	//Edit events.. [middleware: checkIfSuperAdmin]
	public function editEvent($id)
	{
		$event = Events::find($id);
		return view('Admin_Dashboard.editEvent', compact('event'));
	}

	//Update event
	public function updateEvent(Request $request, $id)
	{
		 $validator = Validator::make($request->all(), [
            'title' => 'max:4000000000|min:5',
            'description' => "max:4000000000|min:5",
        ]);
        if ($validator->fails()) {
            return redirect('/Admin/Dashboard/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }
		$event = Events::find($id);
		$event->title = $request->title;
		$event->description = $request->description;
		$event->start = $request->start;
		$event->end = $request->end;
		$event->save();
		return redirect('Admin/Dashboard#calendar')->with('Event', 'Successfully updated ' . $request->title);
	}

	//Delete event
	public function deleteEvent($id)
	{
		$event = Events::find($id);
		$title = $event->title;
		$event->delete();
		return redirect('Admin/Dashboard#calendar')->with('message', 'Successfully deleted ' . $title);
	}

	//Resize event [middleware: checkIfSuperAdmin]
	public function resizeEvent($id, $start, $end)
	{
		$event = Events::find($id);
		$event->start = $start;
		$event->end = $end;
		$event->save();
		return response()->json(['status' => 'success']);
	}

	//Drag event [middleware: checkIfSuperAdmin]
    public function dragEvent($id, $start, $end)
    {
        $event = Events::find($id);
        $event->start = $start;
        $event->end = $end;
        $event->save();
        return response()->json(['status'=>'success']);
    }

    //Display Research Journal for Faculty
	public function displayRJFaculty()
	{
	    $posts = post::orderBy('created_at', 'desc')
                      ->where('tab', '=', 'Research Journal')
                      ->where('type', '=', 'Faculty')
                      ->where('status', '=', 'accepted')
                      ->paginate(5);
		return view('Admin_Dashboard.researchJournalFaculty')->withPosts($posts);;
	}

	//Display Research Journal for Students
	public function displayRjStudents($department)
	{
        $posts = post::where('collegeAbbvr', '=', $department)
                                     ->orderBy('created_at', 'desc')
                                     ->where('tab', '=', 'Research Journal')
                                     ->where('type', '=', 'Student')
                                     ->where('status', '=', 'accepted')
                                     ->paginate(5);
        return view('Admin_Dashboard.researchJournalStudent', ['name' => $department, 'posts' => $posts]);
	}

	//Display Institutional Researches for Faculty
	public function displayIrFaculty()
	{
		$posts = post::orderBy('created_at', 'desc')
                      ->where('tab', '=', 'Institutional Research')
                      ->where('type', '=', 'Faculty')
                      ->where('status', '=', 'accepted')
                      ->paginate(5);
		return view('Admin_Dashboard.institutionalResearchFaculty')->withPosts($posts);
	}

	//Display Institutional Researches for Staff
	public function displayIrStaff()
	{
		$posts = post::orderBy('created_at', 'desc')
                      ->where('tab', '=', 'Institutional Research')
                      ->where('type', '=', 'Staff')
                      ->where('status', '=', 'accepted')
                      ->paginate(5);
		return view('Admin_Dashboard.institutionalResearchStaff')->withPosts($posts);
	}

	//Store Journal/Research
	public function storePost(Request $request)
	{
		$post = new Post;
		$user = User::find(Auth::id());
		$validator = Validator::make($request->all(), [
					'author' => 'max:100000000|min:5',
					'proposal' => "max:100000000|min:5",
					'abstract' => 'max:100000000|min:8'
					]);
		if($validator->fails()) {
					return redirect()
					->back()
					->withErrors($validator)
					->withInput();
				}
		if($request->tab == 'Research Journal')
		{
			if($request->type == 'Faculty')
			{
				$post->author = $request->author;
				$post->proposal = ucwords($request->proposal);
				$post->abstract = ucfirst($request->abstract);
				$post->schoolyear = $request->schoolyear;
				$post->tab = $request->tab;
				$post->type = $request->type;
				$post->status = 'pending';
				$user->posts()->save($post);
				$post->save();
				Event::fire(new userPostEvent(Auth::user()->name, $post->id));
				return redirect()->back()->with('message', "Post created successfully. It will be reviewed by the admin first.");
			}
				$post->author = $request->author;
				$post->proposal = ucwords($request->proposal);
				$post->abstract = ucfirst($request->abstract);
				$post->schoolyear = $request->schoolyear;
				$post->tab = $request->tab;
				$post->type = $request->type;
				$post->course = ((Auth::user()->course !== NULL) ? Auth::user()->course : 'NULL');
				$post->college = $request->college;
				$post->collegeAbbvr = $request->collegeAbbvr;
				$post->status = 'pending';
				$user->posts()->save($post);
				$post->save();
				Event::fire(new userPostEvent(Auth::user()->name, $post->id));
				return redirect()->back()->with('message', "Post created successfully. It will be reviewed by the admin first.");
		}
		if($request->tab == 'Institutional Research')
		{
			if($request->type == 'Faculty')
			{
				$post->author = $request->author;
				$post->proposal = ucwords($request->proposal);
				$post->abstract = ucfirst($request->abstract);
				$post->schoolyear = $request->schoolyear;
				$post->tab = $request->tab;
				$post->type = $request->type;
				$post->status = 'pending';
				$user->posts()->save($post);
				$post->save();
				Event::fire(new userPostEvent(Auth::user()->name, $post->id));
				return redirect()->back()->with('message', "Post created successfully. It will be reviewed by the admin first.");
			}
				$post->author = $request->author;
				$post->proposal = ucwords($request->proposal);
				$post->abstract = ucfirst($request->abstract);
				$post->schoolyear = $request->schoolyear;
				$post->tab = $request->tab;
				$post->type = $request->type;
				$post->status = 'pending';
				$user->posts()->save($post);
				$post->save();
				Event::fire(new userPostEvent(Auth::user()->name, $post->id));
				return redirect()->back()->with('message', "Post created successfully. It will be reviewed by the admin first.");
		}
	}

	//Display edit post page [middleware: checkIfSuperAdmin]
    public function editPost($id)
    {
        $post = post::findOrFail($id);
        return view('Admin_Dashboard.editPost', compact('post'));
    }

    //Update Journal or Research
    public function updatePost(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'author' => 'max:4000000000|min:5',
            'proposal' => 'max:4000000000|min:5',
            'abstract' => 'max:4000000000|min:8'
            ]);
        if ($validator->fails()) {
            return redirect('Admin/EditPost/' .$id)
            ->withErrors($validator)
            ->withInput();
        }
        $post = post::findOrFail($id);
        $post->author = ucwords($request->author);
        $post->proposal = ucwords($request->proposal);
        $post->abstract = $request->abstract;
        $post->schoolyear = $request->schoolyear;
        $post->save();
        Event::fire(new userPostEvent(Auth::user()->name, $post->id));
        return redirect('Admin/Dashboard')->with('message', 'Post updated successfully. It will be reviewed again by the Admin.');
    }

    //Delete post
    public function deletePost($id)
    {
    	$post = post::findOrFail($id);
    	$post->delete();
    	return redirect('Admin/Dashboard')->with('message', 'Post deleted successfully.');
    }

	//Display notifications.. [middleware: checkIfSuperAdmin]
	public function displayNotifications()
	{
    	return view('Admin_Dashboard.displayNotifications');
	}

	//Mark as all read..
    public function markAllAsRead()
    {
        DB::table('notifications')->update(['is_read' => 'true']);
    }
    //Display posts for review [middleware: checkIfSuperAdmin]
    public function displayPostsForReview($id)
    {
        $post = post::findOrFail($id);
        return view('Admin_Dashboard.displayPostsForReview', compact('post'));
    }

    //Accept post or add remark
    public function PostAction(Request $request, $id)
    {
        $post = post::findOrFail($id);
        if($post->status == 'pending')
        {
            if($request->remark)
            {
                $remark = new Remarks;
                $remark->remark_name = $request->remark;
                $remark->post()->associate($post);
                $remark->save();
                return redirect('Admin/Dashboard')->with('remarks', "Successfully addedd a remark on the post.");
            }
            $post->status = 'accepted';
            $post->postRemarks()->delete();
            $post->save();
            return redirect('Admin/Dashboard')->with('remarks', "Successfully accepted post."); 
        }
        return redirect('Admin/PostReview/'. $id)->with('remarks', "This post has been accepted already!");    
    }

    //Display All Posts
    public function displayAllPosts()
    {
        $posts = DB::table('posts')
        ->select(['*', DB::raw('count(*) as Total')])
        ->where('status', 'accepted')
        ->groupBy('schoolyear', 'proposal')
        ->get();
        foreach ($posts as $post) {
            $groupedPost[$post->schoolyear][] = $post;
        }
        ksort($groupedPost);
    	return view('Admin_Dashboard.displayAllPosts', compact('groupedPost'));
    }

    //Display Pending users [middleware: checkIfSuperAdmin]
    public function displayPendingUsers()
    {
        $pendings = User::orderBy('created_at', 'ASC')->whereNull('role')->get();
        return view('Admin_Dashboard.displayPendingUsers', compact('pendings'));
    }

    //Accept pending user..
    public function acceptPendingUser($id)
    {
        $pendingUser = User::findOrFail($id);
        $pendingUser->pending_status = 'accepted';
        $pendingUser->save();
        return response()->json(['status' => 'success']); 
    }

    //Reject pending user..
    public function rejectPendingUser($id)
    {
        $pendingUser = User::findOrFail($id);
        $pendingUser->pending_status = 'rejected';
        $pendingUser->save();
        return response()->json(['status' => 'success']); 
    }

    //Display All Users [middleware: checkIfSuperAdmin]
    public function displayAllUsers()
    {
        $users = User::where('pending_status', 'accepted')->get();
        return view('Admin_Dashboard.displayAllUsers', compact('users'));
    }
}
