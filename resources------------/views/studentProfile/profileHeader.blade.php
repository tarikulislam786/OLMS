<div class="media">
    {{--<div class="media-left">--}}
        {{--<a href="#">--}}
            {{--@if(Auth::user()->image)--}}
                {{--<img src="{{asset('images/student-img/'.Auth::user()->image)}}" alt="" width="100">--}}
            {{--@else--}}
                {{--<img src="{{asset('img/p0.jpg')}}" alt="" class="img-responsive" width="100">--}}
            {{--@endif--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="media-body">--}}
        {{--<h4 class="media-heading">{{Auth::user()->first_name}} {{Auth::user()->last_name}}--}}
            {{--@if (Session::get('message') == true)--}}
                {{--<span class="message label bg-info m-l-xs pull-right">{{Session::get('message')}}</span>--}}
            {{--@endif--}}
        {{--</h4>--}}
        {{--<p>{{Auth::user()->area_of_interest}}</p>--}}
        {{--<p>Member since: {{date('M d,  Y', strtotime(Auth::user()->created_at))}}</p>--}}
    {{--</div>--}}
</div>

{{--<a href="" class="btn btn-success" data-toggle="modal" data-target="#myModal">Edit Profile</a>--}}
<!-- Modal -->
{{--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--}}
    {{--<div class="modal-dialog" role="document">--}}
        {{--<div class="modal-content">--}}
            {{--<div class="modal-header">--}}
                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                {{--<h4 class="modal-title" id="myModalLabel">Modal title</h4>--}}
            {{--</div>--}}
            {{--{!! Form::open(['url'=>'/admin/profile-update']) !!}--}}
            {{--<div class="modal-body">--}}
                {{--<div class="form-group">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-sm-6">--}}
                            {{--<label for="">First Name</label>--}}
                            {{--<input type="text" name="first_name" class="form-control" value="{{$profile->first_name}}">--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-6">--}}
                            {{--<label for="">Last Name</label>--}}
                            {{--<input type="text" name="last_name" class="form-control" value="{{$profile->last_name}}">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<label for="">Discipline</label>--}}
                    {{--<select name="discipline_id" class="form-control">--}}
                        {{--<option value="">Select Discipline</option>--}}
                        {{--@foreach($disciplines as $discipline)--}}
                            {{--<option @if($profile->discipline_id == $discipline->id) selected @endif value="{{$discipline->id}}">{{$discipline->name}}</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<label for="">Designation</label>--}}
                    {{--<select name="designation" id="" class="form-control">--}}
                        {{--<option>Select Designation</option>--}}
                        {{--<option @if($profile->designation == 'Lecturer') selected @endif value="Lecturer">Lecturer</option>--}}
                        {{--<option @if($profile->designation == 'Assistant Professor') selected @endif value="Assistant Professor">Assistant Professor</option>--}}
                        {{--<option @if($profile->designation == 'Associate Professor') selected @endif value="Associate Professor">Associate Professor</option>--}}
                        {{--<option @if($profile->designation == 'Professor') selected @endif value="Professor">Professor</option>--}}
                    {{--</select>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<label for="">Email</label>--}}
                    {{--<input type="text" name="email" class="form-control" value="{{$profile->email}}">--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<label for="">Area of Interest</label>--}}
                    {{--<input type="text" name="area_of_interest" class="form-control" value="{{$profile->area_of_interest}}">--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<label for="">Image</label>--}}
                    {{--<input type="file" name="image" value="{{$profile->image}}">--}}
                    {{--<input type="text" name="email" class="form-control" value="{{$profile->email}}">--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="modal-footer">--}}
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                {{--<button type="submit" class="btn btn-primary">Save changes</button>--}}
            {{--</div>--}}
            {{--{!! Form::close() !!}--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
