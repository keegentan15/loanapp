@extends('admin.dashboard_layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Staff</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('staff.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('staff.update',$users->Staff_ID) }}" method="POST">
        @csrf
        @method('PUT')

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Username:</strong>
                    <input type="text" name="Username" value="{{ $users->Username }}" class="form-control" placeholder="Username">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Password:</strong>
                    <input class="form-control" type="text" name="Password" placeholder="Detail" value="{{ $users->Password }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input class="form-control" type="email" name="Email" placeholder="Enter Your Email" value="{{ $users->Email}}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <input class="form-check-input toggle-class" type="checkbox" value="" name="checkbox1" id="flexCheckDefault" {{$users->status1 ? 'checked' : ''}}>
                <label class="form-check-label" for="flexCheckDefault" id="checkbox1">
                    Access Action 1
                </label>
            </div>
            

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
   
    </form>
</div>

@endsection