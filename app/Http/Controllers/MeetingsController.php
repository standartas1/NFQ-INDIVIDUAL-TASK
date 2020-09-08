<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meeting;
use Auth;
use Carbon\Carbon;

class MeetingsController extends Controller
{
    //  Generates a random code for the registered meeting
    function createRandomPassword() { 

        $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
        srand((double)microtime()*1000000); 
        $i = 0; 
        $pass = '' ; 
    
        while ($i <= 7) { 
            $num = rand() % 33; 
            $tmp = substr($chars, $num, 1); 
            $pass = $pass . $tmp; 
            $i++; 
        } 
    
        return $pass; 
    } 

    //  The index page of the website
    public function index() {
        return view('meetings.index');
    }

    /*  Displays all successfully registered meetings, that are not taken by worker,
        #not taken -> meeting worker_id == 0,
        Requires authentication*/
    public function viewAllMeetings() {
        $meetings = Meeting::orderBy('meeting_time', 'ASC')->get();
        
        return view('home.meetingsIndex')->with('meetings', $meetings);
    }

    /*  Displays all meetings, that are taken by the logged in worker,
        #taken -> meeting worker_id == logged in user_id,
        Requires authentication*/
    public function viewPersonalMeetings() {
        $meetings = Meeting::orderBy('meeting_time', 'ASC')->get();
        
        return view('home.personalMeetingsIndex')->with('meetings', $meetings);
    }

    /*  Displays all meetings, that have already started or are about to begin,
        #started -> meeting_state == started, 
        #about to begin -> meeting_state == up_next,
        Requires authentication*/
    public function viewDisplayBoardMeetings(Request $request) {
        $meetings = Meeting::orderBy('meeting_time', 'ASC')->take(6)->get();

        if($request->ajax()){
            return response()->json(array('meetings'=>$meetings));
        }
        
        return view('home.displayBoardIndex')->with('meetings', $meetings);
    }

    /*  Displays the meeting registration window, 
        where person can enter the required meeting details and register,
        Does not require authentication*/
    public function create() {
        return view('meetings.create');
    }

    /*  Stores the persons entered meeting data,
        Does not require authentication*/
    public function store(Request $request) {
        $this->validate($request, [
            'first-name' => 'required',
            'last-name' => 'required',
            'meeting_time' => 'date_format:Y-m-d H:i:s'
        ]);
        
        $meeting = new Meeting();
        $meeting->first_name = $request->input('first-name');
        $meeting->last_name = $request->input('last-name');
        $meeting->meeting_time = $request->input('meeting-time');
        $meeting->meeting_code = self::createRandomPassword();
        $meeting->worker_id = "0";  
        $dabar = Carbon::now();
        $queueNumber = Meeting::where('meeting_time', '<', $meeting->meeting_time)->where('meeting_time','>', $dabar)->count(); //Tikrinam ar mūsų laikas didesnis už eilėj stovinčius, bet tik tuos, kurių eilė dar nepraėjo.
        $queueNumber = $queueNumber+1; //Kadangi aš esu sekantis po paskutinio žmogaus
        $meeting->save();
        $meeting->queueNumber = $queueNumber;
            
         return redirect('/')->with('meetingas', $meeting);
    }

    /*  Displays the meeting details edit window, 
        where worker can change the state of the meeting or assign it to himself,
        #assign it to himself -> change the meeting worker_id to his logged in user_id,
        Requires authentication*/
    public function edit($id) {
        $meeting = Meeting::find($id);

        return view('meetings.edit', compact('meeting'));
    }

    /*  Updates the workers entered meeting data,
        Requires authentication*/
    public function update($id, Request $request) {
        $this->validate($request, [
            'meeting-state' => 'required'
           // 'worker-id' => 'required'
        ]);   
        $meeting = Meeting::find($id);

        $meeting->meeting_state = $request->input('meeting-state');
        $meeting->worker_id = Auth::id(); 
        $meeting->save();

        return redirect('/home/meetings')->with('meetingas4', $meeting);
    }

    /*  Displays the meeting find window, 
        where person can enter his meeting code and find out more information about his meeting,
        Does not require authentication*/
    public function find() {
            return view('meetings.find');
    }

    /*  Displays the information about the persons meeting,
        Does not require authentication*/
    public function findId(Request $request) {
        $this->validate($request, [
            'meeting-code' => 'required'
        ]);    

        $meeting_code = $request->input('meeting-code');
        $meetingInfo = Meeting::where('meeting_code', $meeting_code)->first();

        $dabar = Carbon::now();
        $queueNumber = Meeting::where('meeting_time', '<', $meetingInfo->meeting_time)->where('meeting_time','>', $dabar)->count(); //Tikrinam ar mūsų laikas didesnis už eilėj stovinčius, bet tik tuos, kurių eilė dar nepraėjo.
        $queueNumber = $queueNumber+1; // kadangi aš esu sekantis po paskutinio žmogaus        
        $meetingInfo->queueNumber = $queueNumber;  

    
        if ( $meetingInfo == null)     
            return redirect('/meetings/find')->with('meetingas2.meeting_code', $meeting_code); 
      
        return redirect('/meetings/find')->with('meetingInfo', $meetingInfo);
    }

    /*  Displays the meeting cancel window, 
        where person can enter his meeting code and cancel his meeting,
        Does not require authentication*/
    public function cancelMeeting() {
        return view('meetings.cancel');
    }
    
    /*  Cancels the meeting,
        Does not require authentication*/
    public function cancelMeetingId(Request $request)
    {
        $this->validate($request, [
            'meeting-code' => 'required'
        ]);            
        $meeting_code = $request->input('meeting-code');  
        $meetingInfo = Meeting::where('meeting_code', $meeting_code)->first();

        if ( $meetingInfo == null)     
            return redirect('/meetings/cancel')->with('meetingas2.meeting_code', $meeting_code);
       
        $meetingInfo->meeting_state = "canceled";
        $meetingInfo->save();

        return redirect('/')->with('meetingas3.meeting_code', $meeting_code);    
    }
}