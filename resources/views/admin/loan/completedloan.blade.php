@extends('admin.dashboard_layout')
@section('content')
<div class = "container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav class="breadcrumb">
                <span class="breadcrumb-item active">Completed Loan</span>
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
                    <th>Credited Amount</th>
                    <th>Collected Amount</th>
                    <th>Payment On</th>
                    <th>Total Profit</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($records as $record)    
                    <tr>
                        <td><a target="_blank" href="{{route('viewuser',['id'=>$record->User_ID])}}">{{$record->Username}}</a></td>
                        <td>{{$record->Credit_Amount}}</td>
                        <td>{{$record->Collected_Amount}}</td>
                        <td>{{$record->LastPayment_Date}}</td>
                        <td>{{$record->Collected_Amount - $record->Credit_Amount}}</td>
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