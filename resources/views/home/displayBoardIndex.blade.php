@extends('layouts.app')

@section('content')
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){       
        setInterval(function(){
            $.ajax({
                url:'/home/displayBoard',
                type:'GET',
                dataType:'json',
                success:function(response){
                    if(response.meetings.length>0){
                        var meetings ='';
                        var meetings_active ='<tr><th>Meeting ID</th><th>Code</th><th>Meeting state</th><th>Worker ID</th></tr>';
                        var meetings_next ='<tr><th>Meeting ID</th><th>Code</th><th>Meeting state</th><th>Worker ID</th></tr>';
                        for(var i=0;i<response.meetings.length;i++){
                            if (response.meetings[i]['meeting_state'] == 'started')
                                meetings_active=meetings_active+'<tr><td>'+response.meetings[i]['id']+'</td><td>'+response.meetings[i]['meeting_code']+'</td><td>'+response.meetings[i]['meeting_state']+'</td><td>'+response.meetings[i]['worker_id']+'</td></tr>';
                            else if (response.meetings[i]['meeting_state'] == 'up_next')
                                meetings_next=meetings_next+'<tr><td>'+response.meetings[i]['id']+'</td><td>'+response.meetings[i]['meeting_code']+'</td><td>'+response.meetings[i]['meeting_state']+'</td><td>'+response.meetings[i]['worker_id']+'</td></tr>';
                        }
                        $('#meeting-active').empty();
                        $('#meeting-next').empty();
                        $('#meeting-active').append(meetings_active);
                        $('#meeting-next').append(meetings_next);
                    }
                },error:function(err){
                }
            })
        }, 5000);
    });
</script>

<div class="container">
    @if (count($meetings) > 0)
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Active meeting</div>
                    <div class="card-body">
                        <table style="width:100%"  id="meeting-active">
                            <tr>
                                <th>Meeting ID</th>
                                <th>Code</th>
                                <th>Meeting state</th>
                                <th>Worker ID</th>
                            </tr>
                            @foreach ($meetings as $meeting)
                                @if ($meeting->meeting_state == 'started')
                                    <tr>
                                        <td>{{ $meeting->id }}</td>
                                        <td>{{ $meeting->meeting_code }}</td>
                                        <td>{{ $meeting->meeting_state }}</td>
                                        <td>{{ $meeting->worker_id }}</td>
                                    </tr>
                                @else
                                @endif
                            @endforeach
                        </table>
                    </div>
            </div>
                
            <div class="card">
                <div class="card-header">Next meeting</div>
                    <div class="card-body">
                        <table style="width:100%" id="meeting-next">
                            <tr>
                                <th>Meeting ID</th>
                                <th>Code</th>
                                <th>Meeting state</th>
                                <th>Worker ID</th>
                            </tr>
                            @foreach ($meetings as $meeting)
                                @if ($meeting->meeting_state == 'up_next')         
                                    <tr>
                                        <td>{{ $meeting->id }}</td>
                                        <td>{{ $meeting->meeting_code }}</td>
                                        <td>{{ $meeting->meeting_state }}</td>
                                        <td>{{ $meeting->worker_id }}</td>
                                    </tr>
                                @else
                                @endif            
                            @endforeach    
                        </table>
                    </div> 
            </div>
        </div>
    @else
        <h3>No active meetings at the moment.</h3>
    @endif
</div>
@endsection