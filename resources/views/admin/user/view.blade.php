@extends('admin.dashboard_layout')
@section('content')
<div class = "container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('user')}}">User List</a></li>
                <span class="breadcrumb-item active">{{$user->FirstName." ".$user->LastName}}</span>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
                <table class="table table-striped table-bordered no-wrap">
                    <tr>
                        <td class="col-md-3">First Name</td>
                        <td class="col-md-9">{{$user->FirstName}}</td>
                    </tr>
                    <tr>
                        <td class="col-md-3">Last Name</td>
                        <td class="col-md-9">{{$user->LastName}}</td>
                    </tr>
                    <tr>
                        <td class="col-md-3">Contact No</td>
                        <td class="col-md-9">{{$user->ContactNo}}</td>
                    </tr>
                    <tr>
                        <td class="col-md-3">Email</td>
                        <td class="col-md-9">{{$user->Email}}</td>
                    </tr>
                    <tr>
                        <td class="col-md-3">Address Line 1</td>
                        <td class="col-md-9">{{$user->Address_Line_1}}</td>
                    </tr>
                    <tr>
                        <td class="col-md-3">Address Line 2</td>
                        <td class="col-md-9">{{$user->Address_Line_2}}</td>
                    </tr>
                    <tr>
                        <td class="col-md-3">City</td>
                        <td class="col-md-9">{{$user->City}}</td>
                    </tr>
                    <tr>
                        <td class="col-md-3">State</td>
                        <td class="col-md-9">{{$user->State}}</td>
                    </tr>
                    <tr>
                        <td class="col-md-3">Postal Code</td>
                        <td class="col-md-9">{{$user->Postal_Code}}</td>
                    </tr>
                    <tr>
                        <td class="col-md-3">Register Date</td>
                        <td class="col-md-9">{{$user->Created_At}}</td>
                    </tr>
                    <tr>
                        <td class="col-md-3">Contact List</td>
                        <td class="col-md-9"><a href="{{route('exportcontact',['id' => $user->ID])}}">Download Excel</a></td>
                    </tr>
                </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a class="nostyle" href="{{route('user')}}">
                <button class="btn btn-secondary">
                    <i class="icon-logout"></i> Back
                </button>
            </a>
            <button class="btn btn-success" data-toggle="modal" data-target="#myModal">
                <i class="fas fa-check"></i> Approve
            </button>
            <button class="btn btn-danger">
                <i class="fas fa-times"></i> Reject
            </button>
        </div>
    </div>
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to approve user <strong>{{$user->FirstName." ".$user->LastName}}</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                        data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Confirm</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
@endsection