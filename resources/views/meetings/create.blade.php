@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="content">
            <div>
                <h2>Register for the meeting</h2>
                <br>
            </div>
            <div class="needs-validation">
                <form method="post" action="{{ action('MeetingsController@store') }}" enctype="multipart/form-data">
                @csrf
                    <div class="mb-3">
                        <label for="first-name">First name</label>
                        <input type="text" class="form-control" name="first-name" id="first-name" placeholder="Enter your first name">
                    </div>
                    <div class="mb-3">
                        <label for="last-name">Last name</label>
                        <input type="text" class="form-control" name="last-name" id="last-name" placeholder="Enter your last name">
                    </div>
                    <div class="mb-3">
                        <label for="meeting-time">Meeting time</label>
                        <input type="datetime-local" class="form-control" name="meeting-time" id="meeting-time" min="<?php echo date('Y-m-d\TH:i');?>">
                    </div>
                    <button type="submit" class="button">Submit</button>
                    <a href="{{ url('/') }}" class="button">Go Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection