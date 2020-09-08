@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="title m-b-md">
            NFQ
        </div>
        <div>
            <a href="{{ route('meeting-create') }}" class="button">Register for the meeting</a>
            <a href="{{ route('meeting-find') }}" class="button">View the meeting details</a>
            <a href="{{ route('meeting-cancel') }}" class="button">Cancel the meeting</a>
        </div>
    </div>
@endsection