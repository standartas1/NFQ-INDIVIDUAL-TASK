@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('meetingas.meeting_code'))
    <div class="alert alert-success">
        <!--  {!! session('success') !!} --> 
        Registration successful<br><br>
        Your meeting code is: <b>{{session('meetingas.meeting_code')}}</b><br>
        Your meeting time is: <b>{{session('meetingas.meeting_time')}}</b><br>
        Your queue number is: <b>{{session('meetingas.queueNumber')}}</b><br>
        <span style="color:red;">Make sure to save your code</span>
    </div>
@endif

@if (session('meetingas2.meeting_code'))
    <div class="alert alert-danger">
        <span>The entered code does not exist</span>
    </div>
@endif

@if (session('meetingas3.meeting_code'))
    <div class="alert alert-success">
        Your meeting has been canceled successfully!
    </div>
@endif

@if (session('meetingas4'))
    <div class="alert alert-success">
        The meeting has been updated successfully!
    </div>
@endif