@extends('admin.dashboard_layout')
@section('content')
<div class = "container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav class="breadcrumb">
                <span class="breadcrumb-item active">Active Loan</span>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="notification" style="display:none;" strole="alert">
                <strong id="notification_status"></strong> - <span id="message"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        <div class = "table-responsive">
        <table id = "loan_table" class="table table-striped table-bordered no-wrap">
            <thead>
                <tr>
                    <th>Loaned By</th>
                    <th>Loan Amount</th>
                    <th>Loan Period</th>
                    <th>Approved On</th>
                    <th>Payment In (Days)</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($records as $record)    
                    <tr>
                        <td><a target="_blank" href="{{route('viewuser',['id'=>$record->User_ID])}}">{{$record->Username}}</a></td>
                        <td>{{$record->Package_Amount}}</td>
                        <td>{{$record->Period}}</td>
                        <td>{{$record->Reject_Date}}</td>
                        <td> - </td>
                        <td>{{$record->Reject_Reason}}</td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        //order data table from oldest user application to newest
        $('#loan_table').DataTable( {
            "order": [[ 3, "desc" ]]
        });
    });
</script>
@endsection