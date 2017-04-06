<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
//Default page routes
Route::get('/', function () {
    return view('pages.index');
});
Route::get('/about', function(){
	return view('pages.about');
});
Route::get('/contact', function(){
	return view('pages.contact');
});
Route::get('/register', function(){
	return view('pages.register');
});

//Login and register routes
Route::get('/logout', 'DisplayController@logout');
Route::get('/login', 'DisplayController@displayLoginForm');
Route::post('/login', 'DisplayController@loginUser');
Route::post('/register', 'DisplayController@store');


//Routes for display only!
Route::get('ResearchJournal/Faculty', 'DisplayController@displayRjFPosts');
Route::get('ResearchJournal/Student/{collegeAbvr}','DisplayController@displayRjSPosts');
Route::get('InstitutionalResearch/Faculty', 'DisplayController@displayIrFPosts');
Route::get('InstitutionalResearch/Staff', 'DisplayController@displayIrSPosts');

/*-------------Dashboard routes here---------------------*/
Route::get('Admin/Dashboard', 'DashboardController@index'); //index page..

//Profile routes..
Route::get('Admin/Profile/{id}', 'DashboardController@displayProfile'); //display profile
Route::get('Admin/Profile/{id}/edit', 'DashboardController@editProfile'); //edit profile
Route::put('Admin/Profile/{id}', 'DashboardController@updateProfile'); //update profile


//Calendar routes..
Route::get('/events/events-json', 'DashboardController@appendEvents'); //Fetch events
Route::get('Admin/Dashboard/create-event', 'DashboardController@createEvent'); //Display create event page..
Route::post('Admin/Dashboard/create-event', 'DashboardController@storeEvent'); //Store event..
Route::get('Admin/Dashboard/{id}/edit', 'DashboardController@editEvent'); //Edit event..
Route::put('Admin/Dashboard/{id}', 'DashboardController@updateEvent'); //Update event..
Route::delete('Admin/Dashboard/{id}', 'DashboardController@deleteEvent'); //Delete event..
Route::get('/event/resize/id/{id}/start/{start}/end/{end}', 'DashboardController@resizeEvent'); //Resize event..
Route::get('/event/drag/id/{id}/start/{start}/end/{end}', 'DashboardController@dragEvent'); //Drag event..

//Research Journals for Faculty..
Route::get('Admin/Research-Journal/Faculty', 'DashboardController@displayRJFaculty');

//Research Journals for Students..
Route::get('Admin/Research-Journal/Student/{department}','DashboardController@displayRjStudents');

//Institutional Researches for Staff..
Route::get('Admin/Institutional-Research/Faculty', 'DashboardController@displayIrFaculty');

//Institutionl Researches for Staff..
Route::get('Admin/Institutional-Research/Staff', 'DashboardController@displayIrStaff');

//Store post..
Route::post('Admin/storePost', 'DashboardController@storePost');

//Edit and Update and Delete routes..
Route::get('Admin/EditPost/{id}', 'DashboardController@editPost');
Route::put('Admin/UpdatePost/{id}', 'DashboardController@updatePost');
Route::delete('Admin/DeletePost/{id}', 'DashboardController@deletePost');

//Admin Notifications
Route::get('Admin/Notifications','DashboardController@displayNotifications');
Route::get('Admin/markAllAsRead', 'DashboardController@markAllAsRead');
Route::get('Admin/AcceptUsersOnclick', 'DashboardController@markAllAsRead');

//Admin Pending posts..
Route::get('Admin/PostReview/{id}', 'DashboardController@displayPostsForReview');
Route::post('Admin/PostAction/{id}', 'DashboardController@PostAction');

//Display ALL POSTS..
Route::get('Admin/Posts', 'DashboardController@displayAllPosts');

//Admin pending users
Route::get('Admin/PendingUsers', 'DashboardController@displayPendingUsers');
Route::get('Admin/AcceptUsers/{id}', 'DashboardController@acceptPendingUser');
Route::get('Admin/RejectUsers/{id}', 'DashboardController@rejectPendingUser');

//Display All Users
Route::get('Admin/Users', 'DashboardController@displayAllUsers');

//Searches
Route::get('search/{search}/option/{optionSelect}/tab/{tab}/type/{type}', 'DisplayController@Search');
Route::get('search/{search}/option/{optionSelect}/tab/{tab}/type/{type}/department/{department}', 'DisplayController@SearchStudent');