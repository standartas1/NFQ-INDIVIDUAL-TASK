@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="content">
            <div>
                <h2>Edit meeting details</h2>
            </div>
            <div class="needs-validation">
                <form method="post" action="{{ action('MeetingsController@update', $meeting) }}" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                    <div class="mb-3">    
                        <select class="form-control" name="meeting-state">
                            <option value="registered">Registered</option>
                            <option value="up_next">Up next</option>
                            <option value="started">Started</option>
                            <option value="finished">Finished</option>
                            <option value="canceled">Canceled</option>
                        </select>
                    </div>
                    <button type="submit" class="button">Assign meeting to me</button>
                    <a href="{{ url('/home/personalMeetings') }}" class="button">Go Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection