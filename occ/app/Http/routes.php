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

// ------  Payment Routes
Route::get('/create_membership_paypal_payout', 'PaymentController@create_membership_paypal_payout');
Route::get('/member_cancel_pay_by_paypal', 'PaymentController@cancelled_pay');
Route::get('/member_confirmation_pay_by_paypal', 'PaymentController@membership_from_pay_pal');
Route::get('/member_confirmation_pay_by_check', 'PaymentController@membership_pay_by_check');
Route::get('/member_cancel_pay_by_paypal', 'PaymentController@member_cancel_pay_by_paypal');
Route::get('/member_renewal_confirmation_pay_by_paypal/{mem_id}', 'PaymentController@member_renewal_confirmation_pay_by_paypal');
Route::get('/member_renewal_cancel_pay_by_paypal', 'PaymentController@member_renewal_cancel_pay_by_paypal');
Route::get('/renew_membership_paypal_payout/{mem_id}', 'PaymentController@renew_membership_paypal_payout');
//Route::get('mem_app_temp', 'MembershipController@mem_app_temp');

Route::get('/class_pay_with_pay_pal/{token}', 'PaymentController@class_pay_with_pay_pal');
Route::get('/class_confirmation_paypal/{token}', 'PaymentController@class_confirmation_paypal');

Route::get('/class_cancel_paypal/{token}', 'PaymentController@class_cancel_paypal');

// ------- Member and Profile related Routes
Route::get('membership_application/{id}', 'MembershipController@membership_application');

Route::match(array('PUT', 'PATCH'),'memberships/{membership}', array('as'=> 'memberships.update', 
									 'uses' => 'MembershipController@update'));
Route::resource('profiles', 'User\UserProfileController');
Route::resource('phone_numbers', 'PhoneNumberController');
Route::resource('volunteer', 'VolunteerHourController');
Route::get('memberships/{membership}/edit', array('as'=> 'memberships.edit', 
									 'uses' => 'MembershipController@edit'));
// ------- Public facing routes
Route::get('/contact', ['uses' => 'ContactController@index']);
Route::resource('announcements', 'AnnouncementController');
Route::resource('faqs', 'FAQController');
Route::resource('events', 'EventController');

// ------- Pet Related Routes
Route::resource('pets', 'PetController');
Route::get('/pet_added_conformation', 'PetController@confirmation');
Route::post('/log_hours', 'PetController@log_hours');
Route::get('/download_med_rec/{med_rec_id}', 'PetController@download_med_rec');


// ------- Class Related Routes
Route::get('/pre_class_prep', 'ClassController@pre_class_prep');
Route::get('/class_info', 'ClassController@class_info');
Route::get('/classes_schedule', 'ClassController@schedule');
Route::get('/classes_schedule/{page_schedule}', 'ClassController@schedule');
Route::get('/class_sign_up/{class_id}', 'ClassController@class_sign_up');
Route::post('/post_class_sign_up', 'ClassController@post_class_sign_up');
Route::resource('class_details', 'ClassDetailController');



// -------- Instructor Related Routes
Route::resource('instructors', 'InstructorController');
Route::get('/instructor_bios', 'InstructorController@instructor_bios');
Route::get('/instructor/roster/{user_id}', 'InstructorController@instructor_roster');


//********************************************************************//
//***********                Admin Routes        *********************//
//********************************************************************//

Route::get('/admin', 'Admin\AdminMainController@index');
Route::get('/update_membership/{usr_prf_id}/edit/', 
							   array('as' => 'admin.update_membership', 'uses' => 'Admin\AdminMembersController@update_membership_status'));
Route::get('members/{page}/{filters}', 'Admin\AdminMembersController@members');
Route::get('download_members/{filters}', 'Admin\AdminMembersController@download_members');
Route::get('roster/list/{inst_filter}/{session_filter}/{num_of_clm_hrs}/{curr_page}', 'Admin\AdminRosterController@roster');
Route::get('roster_details/claimed_hours/{pet_id}/{class_id}', 'Admin\AdminRosterController@claimed_hours');

Route::post('roster_details/claimed_hours/delete/{pet_id}/{class_id}/{date}', array('uses' => 'Admin\AdminRosterController@destroy', 'as' => 'roster.delete'));

Route::post('/admin_log_hours/', 'Admin\AdminRosterController@admin_log_hours');
Route::get('/download_roster/{inst_fltr}/{session_fltr}/{num_of_clm_hrs}', 'Admin\AdminRosterController@download_roster');

// ------- Admin Class/Course
Route::resource('classes', 'Admin\AdminClassesController');
Route::get('/classes_full_list/{curr_page}', 'Admin\AdminClassesController@classes_full_list');
Route::get('/upload_schedule', 'Admin\AdminClassesController@upload_schedule');
Route::post('/upload_schedule', 'Admin\AdminClassesController@post_schedule');

// -------- Admin Medical Records
Route::get('med_records/{curr_page}/{filter}', 'Admin\AdminMedicalRecordsController@index');
Route::get('medical_records/{med_id}/edit', array('uses' => 'Admin\AdminMedicalRecordsController@edit', 'as' => 'medical_record.edit'));
Route::get('medical_records/create/{usr_id}/new', array('uses' => 'Admin\AdminMedicalRecordsController@create', 'as' => 'medical_record.create'));
Route::post('medical_records/store', array('uses' => 'Admin\AdminMedicalRecordsController@store', 'as' => 'medical_record.store'));
Route::match(array('PUT', 'PATCH'), 'medical_records/{med_id}', array('uses' => 'Admin\AdminMedicalRecordsController@update', 'as' => 'medical_record.update'));
Route::get('roster/verified_payment/{class_id}/{pet_id}', 'Admin\AdminRosterController@verified_payment');
