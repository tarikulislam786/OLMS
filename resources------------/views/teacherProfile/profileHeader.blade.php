<div class="media">
    {{--<div class="media-left">--}}

            {{--@if(Auth::user()->image)--}}
                {{--<img src="{{asset('images/teacher-img/'.Auth::user()->image)}}" alt="" width="100">--}}
            {{--@else--}}
                {{--<img src="{{asset('img/p0.jpg')}}" alt="" class="img-responsive" width="100">--}}
            {{--@endif--}}

    {{--</div>--}}
    <div class="media-body">
        <h4 class="media-heading">{{Auth::user()->first_name}} {{Auth::user()->last_name}}
            @if (Session::get('message') == true)
                <span class="message label bg-info m-l-xs pull-right">{{Session::get('message')}}</span>
            @endif
        </h4>
        {{--<p>Area of Interest: {{Auth::user()->area_of_interest}}</p>--}}
        {{--<p>Member since: {{date('M d,  Y', strtotime(Auth::user()->created_at))}}</p>--}}
    </div>
</div>





{{--<a href="" class="btn btn-success" data-toggle="modal" data-target="#myModal">Edit Profile</a>--}}
<!-- Modal -->
