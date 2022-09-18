@extends('admin.dashboard_layout')
@section('content')
<div class = "container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav class="breadcrumb">
                <span class="breadcrumb-item active">Late Payment</span>
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
                    <th>Owed Amount</th>
                    <th>Penalty Amount</th>
                    <th>Total Amount</th>
                    <th>Late Period (Days)</th>
                    <th>Remarks</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($records as $record)
                    <tr>
                        <td><a target="_blank" href="{{route('viewuser',['id'=>$record->User_ID])}}">{{$record->Username}}</a></td>
                        <td>{{$record->Owed_Amount}}</td>
                        <td>{{$record->LatePayment_Amount}}</td>
                        <td>{{$record->Owed_Amount + $record->LatePayment_Amount}}</td>
                        <td>{{$record->LatePayment_Day}}</td>
                        <td></td>
                        <td style="display:flex;">
                            <a class="btn btn-primary" href="{{route('viewloan',['id'=>$record->ID])}}" class="btn btn-primary">
                                <i class="fas fa-eye"></i> View
                            </a>&nbsp;
                            <form action="{{route('complete',['id'=>$record->ID])}}" method="post">
                                @csrf
                                <button class="btn btn-success" type="submit"><i class="fas fa-check"></i> Completed</button>
                            </form>
                            <button class="btn btn-info">UPDATE CALL STATUS</button>
                            <!-- <a class="btn btn-primary" href="{{route('complete',['id'=>$record->ID])}}" class="btn btn-primary">
                                <i class="fas fa-check"></i> Completed
                            </a>&nbsp; -->
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog"
		                                    aria-labelledby="myModalLabel" aria-hidden="true">
			                                    <div class="modal-dialog">
			                                        <div class="modal-content">
			                                            <div class="modal-header">
			                                                <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
			                                                <button type="button" class="close" data-dismiss="modal"
			                                                    aria-hidden="true">×</button>
			                                            </div>
			                                            <div class="modal-body">
                                                        <input type="hidden" username = "">
                                                        <p>Are you sure to <span id="action"></span> user <strong id="full_name"></strong></p>
			                                            </div>
			                                            <div class="modal-footer">
			                                                <button type="button" class="btn btn-light"
			                                                    data-dismiss="modal">Close</button>
			                                                <button type="button" data-approve="true" class="btn btn-primary">Confirm</button>
			                                            </div>
			                                        </div><!-- /.modal-content -->
			                                    </div><!-- /.modal-dialog -->
			                                </div><!-- /.modal -->
<script>
    $(document).ready(function() {
        //order data table from oldest user application to newest
        $('#loan_table').DataTable( {
            "order": [[ 3, "desc" ]]
        });
    });
</script>
@endsection