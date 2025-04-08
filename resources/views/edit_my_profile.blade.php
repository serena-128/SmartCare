@extends('layouts.app')

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<style>
    body {
        margin-top: 20px;
        background: #f8f9fa; /* light purple tint */
    }
    .panel {
        box-shadow: none;
    }
    .panel-heading {
        border-bottom: 0;
    }
    .panel-title {
        font-size: 17px;
    }
    .panel-title > small {
        font-size: .75em;
        color: #999999;
    }
    .panel-body *:first-child {
        margin-top: 0;
    }
    .panel-default > .panel-heading {
        background-color: transparent;
        border-color: rgba(0, 0, 0, 0.07);
    }
    form label {
        color: #999999;
        font-weight: 400;
    }
    .form-horizontal .form-group {
        margin-left: -15px;
        margin-right: -15px;
    }
    .profile-avatar {
        width: 200px;
        margin: 0 auto;
        border: 4px solid #f3f3f3;
    }
</style>

<div class="container bootstrap snippets bootdeys">
    <div class="row">
        <div class="col-xs-12 col-sm-9">
            <form class="form-horizontal" method="POST" action="{{ route('my.profile.update') }}" enctype="multipart/form-data">
                @csrf

                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        @if($staff->profile_picture)
                            <img src="{{ asset('storage/' . $staff->profile_picture) }}" class="img-circle profile-avatar" alt="User avatar">
                        @else
                            <img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="img-circle profile-avatar" alt="User avatar">
                        @endif
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">User Info</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Phone Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="contactnumber" value="{{ $staff->contactnumber }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="address" value="{{ $staff->address }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Profile Image</label>
                            <div class="col-sm-10">
                                <input type="file" name="profile_picture" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <a href="{{ route('my.profile') }}" class="btn btn-default">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection