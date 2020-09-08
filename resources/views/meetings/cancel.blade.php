@extends('layouts.app')

@section('content')
   {{session('meetingInfo')}}         
    <div class="container">
        <div class="content">
        
            <div>
                <h2>Cancel the meeting</h2>
                <br>
            </div>
            <div class="needs-validation">
                <form method="get" enctype="multipart/form-data" action="{{ action('MeetingsController@cancelMeetingId') }}"  enctype="multipart/form-data">
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
@endsection