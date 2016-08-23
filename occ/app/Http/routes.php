<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::auth();
Route::get('/create_membership_paypal_payout', 'PaymentController@create_membership_paypal_payout');
Route::get('/member_cancel_pay_by_paypal', 'PaymentController@cancelled_pay');
Route::get('/member_confirmation_pay_by_paypal', 'PaymentController@from_pay_pal');



Route::get('/member_confirmation_pay_by_check', 'NewMemberController@pay_by_check');

Route::get('membership_application', 'MembershipController@membership_application');
Route::resource('profiles', 'User\UserProfileController');
Route::resource('phone_numbers', 'PhoneNumberController');
Route::get('/volunteer/create', array('as' =>'volunteer.create', 'uses' =>'VolunteerHourController@create'));
Route::post('/volunteer', array('as' =>'volunteer', 'uses' =>'VolunteerHourController@store'));


Route::get('/contact', 'ContactController@index');

Route::resource('announcements', 'AnnouncementController');

// Pet Related Routes
Route::resource('pets', 'PetController');
Route::get('/pet_added_conformation', 'PetController@confirmation');
Route::post('/log_hours', 'PetController@log_hours');
Route::get('/download_med_rec/{med_rec_id}', 'PetController@download_med_rec');


// Class Related Routes
Route::get('/pre_class_prep', 'ClassController@pre_class_prep');
Route::get('/class_info', 'ClassController@class_info');
Route::get('/classes_schedule', 'ClassController@schedule');
Route::get('/classes_schedule/{page_schedule}', 'ClassController@schedule');
Route::get('/class_sign_up/{class_id}', 'ClassController@class_sign_up');
Route::post('/post_class_sign_up', 'ClassController@post_class_sign_up');




Route::resource('instructors', 'InstructorController');
Route::get('/instructor_bios', 'InstructorController@instructor_bios');



//***********                Admin Routes        *********************//
Route::get('/admin', 'Admin\AdminMainController@index');
Route::get('/update_membership/{usr_prf_id}/edit/', 
							   array('as' => 'admin.update_membership', 'uses' => 'Admin\AdminMembersController@update_membership_status'));
Route::get('members/{page}/{filters}', 'Admin\AdminMembersController@members');
Route::get('download_members/{filters}', 'Admin\AdminMembersController@download_members');
Route::resource('class_details', 'Admin\AdminClassDetailController');
Route::get('roster/{inst_filter}/{session_filter}/{curr_page}', 'Admin\AdminRosterController@roster');
Route::get('roster_details/claimed_hours/{pet_id}/{class_id}', 'Admin\AdminRosterController@claimed_hours');

Route::post('roster_details/claimed_hours/delete/{pet_id}/{class_id}/{date}', array('uses' => 'Admin\AdminRosterController@destroy', 'as' => 'roster.delete'));

Route::post('/admin_log_hours/', 'Admin\AdminRosterController@admin_log_hours');
Route::get('/download_roster/{inst_fltr}/{session_fltr}', 'Admin\AdminRosterController@download_roster');


Route::resource('classes', 'Admin\AdminClassesController');
Route::get('/classes_full_list/{curr_page}', 'Admin\AdminClassesController@classes_full_list');
Route::get('/upload_schedule', 'Admin\AdminClassesController@upload_schedule');
Route::post('/upload_schedule', 'Admin\AdminClassesController@post_schedule');
