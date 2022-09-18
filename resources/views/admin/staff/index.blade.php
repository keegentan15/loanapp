@extends('admin.dashboard_layout')
@section('content')
<div class = "container-fluid">
    <div class="row">
        <div class="col-md-6">
            <nav class="breadcrumb">
                <span class="breadcrumb-item active">Staff List</span>
            </nav>
        </div>
        <div class="col-md-6">
            <div class="float-right">
                <a class="btn btn-primary text-white" href="{{ route('staff.create')}}">Create</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
        <div class = "table-responsive">
        <table id = "user_table" class="table table-striped table-bordered no-wrap">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Access Action</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($staff as $key => $value)
                        <tr>
                            <td>{{ $value->Staff_ID}}</td>
                            <td>{{ $value->Username }}</td>
                            <td>{{ \Str::limit($value->Password, 100) }}</td>
                            <td>{{ $value->Email }}</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input toggle-class" type="checkbox" value="" name="checkbox1" id="flexCheckDefault" {{$value->status1 ? 'checked' : ''}} disabled>
                                    <label class="form-check-label" for="flexCheckDefault" id="checkbox1">
                                        Access Action 1
                                    </label>
                                 </div>
                            <td>
                                <form action="{{ route('staff.destroy',$value->Staff_ID) }}" method="POST">   
                                    <a class="btn btn-info" href="{{ route('staff.show',$value->Staff_ID) }}">Show</a>    
                                    <a class="btn btn-primary" href="{{ route('staff.edit',$value->Staff_ID) }}">Edit</a>   
                                    @csrf
                                    @method('DELETE')      
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
            </tbody>
        </table>
    </div>
        </div>
    </div>
</div>
@endsection