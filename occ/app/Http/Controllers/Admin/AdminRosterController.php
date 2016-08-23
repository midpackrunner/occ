<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateClassesDetailRequest;
use App\Http\Requests;
use Auth;
use App\Classes;
use App\Instructor;
use App\Pet;
use App\Lib\PaginationHelper;
use App\Lib\RosterFileManager;

class AdminRosterController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin');
    }  

    /**
     * Display the Roster.  The roster is "filterable" by instructor
     * and sessions.
     *
     * @return \Illuminate\Http\Response
     */
    public function roster($inst_filter, $session_filter, $curr_page)
    {
        $instructors = Instructor::all();
        if($inst_filter != 'none') {
            $curr_instrctr = Instructor::findOrFail($inst_filter);
        } else {
            $curr_instrctr = 'none';
        }

        // get max session number
        $max_session = Classes::maxSession();
        // instructor and session filters (if any)
        $classes = Classes::upComing();
        if ($inst_filter != 'none') {
            $classes->hasInstructor($inst_filter);
        }
        if ($session_filter != 'none') {
            $classes->ofSession($session_filter);
        }
        $classes = $classes->get();
        $page_helper = new PaginationHelper($classes, 
                            config('app.max_viewable_rosters'), $curr_page);
        $num_of_pages = $page_helper->get_num_of_pages();
        $classes = $page_helper->get_sliced_collection();
        
        return view('classes.roster', compact('classes', 'curr_page', 'num_of_pages', 
                                     'instructors', 'curr_instrctr', 'session_filter', 'max_session', 'inst_filter'));
    }

    public function claimed_hours($pet_id, $class_id)
    {
        $pet = Pet::findOrFail($pet_id);
        $class = Classes::findOrFail($class_id);
        $attendance = $pet->attendance()->where('classes_id', $class_id)->get();
        //dd($attendance);
        return view('pets.attendance', compact('pet', 'attendance', 'class'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pet_id, $class_id, $date)
    {
        Pet::detach_claimed_attendance($pet_id, $class_id, $date);
        session()->flash('flash_message', "Hours have been removed.");
        return redirect()->action('Admin\AdminRosterController@claimed_hours', 
                                   ['pet_id' => $pet_id, 'class_id' => $class_id]);
    }
    /**
     * Log class hours on a user's behalf
     *
     * @param      \Illuminate\Http\Request  $request  The request
     *
     * @return     back to roster_details/claimed_hours
     */
    public function admin_log_hours(Request $request)
    {
        $class = Classes::findOrFail($request->class_id);
        $pet = Pet::findOrFail($request->pet_id);
        if($request->attended_date > $class->end_date || $request->attended_date < $class->begin_date) {
            session()->flash('error_message', 'Error: ' . $request->attended_date . ' does not fall in between the beginning and ending of this class!  Time has not been logged, please try again.');
        } else {
            $pet->attendance()->attach($class, ['attended_date'=> $request->attended_date]);
            foreach ($pet->classes as $class1) {   // loop thru each class the pet is in until match
                if ($class1->id == $class->id ){
                    if($class1->pivot->logged_hours == 5) {
                        $pet->classes()->detach($class);
                        $pet->classes()->attach($class, ['logged_hours' => 6,
                                                         'is_completed' => true]);   // update as complete
                    } else {
                        $pet->classes()->detach($class);
                        $pet->classes()->attach($class, ['logged_hours' => $class1->pivot->logged_hours + 1]);
                    }
                }
            }
            session()->flash('flash_message', $pet->name . '\'s hours for ' . 
                              $class->details->title . ' has been updated!');            
        }
        return redirect()->action('Admin\AdminRosterController@claimed_hours', 
                                   ['pet_id' => $pet->id, 'class_id' => $class->id]);
    }

    public function download_roster($inst_filter, $session_filter)
    {
        $file_mngr = new RosterFileManager($inst_filter, $session_filter);

        $file_mngr->write_to_file();
        return response()->download($file_mngr->get_file_path());
    }
    
}
