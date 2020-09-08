@extends('layouts.app')

@section('content')
<div class="container">
    @if (count($meetings) > 0)
    <div class="row justify-content-center">
        <div class="col-md-8">
        @foreach ($meetings as $meeting)
            @if ($meeting->worker_id == 0)
                <div class="card">
                    <div class="card-header">Meeting ID: {{$meeting->id}}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table style="width:100%">
                            <tr>
                                <th>Code</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Meeting state</th>
                                <th>Meeting time</th>
                                <th>Worker ID</th>
                                <th>ACTION</th>
                            </tr>
                            <tr>
                                <td>{{ $meeting->meeting_code }}</td>
                                <td>{{ $meeting->first_name }}</td>
                                <td>{{ $meeting->last_name }}</td>
                                <td>{{ $meeting->meeting_state }}</td>
                                <td>{{ \Carbon\Carbon::parse($meeting->meeting_time)->format('Y, m, d \ H:i:s')}}</td>
                                <td>{{ $meeting->worker_id }}</td>
                                <td><a href="{{ action('MeetingsController@edit', $meeting) }}" class="button">EDIT</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            @else
            @endif
    @endforeach
    @else
        <h3>No current meetings at the moment.</h3>
    @endif
</div>
@endsection