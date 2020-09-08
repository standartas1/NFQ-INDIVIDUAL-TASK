@extends('layouts.app')

@section('content')

@if (session('meetingInfo.meeting_code'))
    <div class="container">
        <div class="content">
            <div>
                <h4>Your meeting date is: {{session('meetingInfo.meeting_time')}}<h4>
                <h4>Time until the meeting: {{ \Carbon\Carbon::parse(session('meetingInfo.meeting_time'))->timezone('Europe/Moscow')->diffForHumans(null, true, true, 2) }}</h4>
                <h4>Your queue number: {{ session('meetingInfo.queueNumber') }}</h4>
            </div>
            <a href="{{ url('/') }}" class="button">Go Back</a>
        </div>
    </div>
@else 
   {{session('meetingInfo')}}         
    <div class="container">
        <div class="content">
        
            <div>
                <h2>View the meeting details</h2>
                <br>
            </div>
            <div class="needs-validation">
                <form method="get" enctype="multipart/form-data" action="{{ action('MeetingsController@findId') }}"  enctype="multipart/form-data">
                @csrf
                    <div class="mb-3">
                        <label for="meeting-code">Meeting code</label>
                        <input type="text" class="form-control" name="meeting-code" id="meeting-code" placeholder="Enter your meeting code">
                    </div>
                    <button type="submit" class="button">Submit</button>
                    <a href="{{ url('/') }}" class="button">Go Back</a>
                </form>
            </div>
        </div>
    </div>
    @endif  
@endsection