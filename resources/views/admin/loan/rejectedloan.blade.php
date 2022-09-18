@extends('admin.dashboard_layout')
@section('content')
<div class = "container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav class="breadcrumb">
                <span class="breadcrumb-item active">Rejected Loan</span>
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
        <table id = "user_table" class="table table-striped table-bordered no-wrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Loaned By</th>
                    <th>Loan Amount</th>
                    <th>Loan Period</th>
                    <th>Rejected On</th>
                    <th>Rejected By</th>
                    <th>Reason</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $counter = 1;
                ?>
                    @foreach($records as $record)    
                    <tr>
                        <td>{{$counter}}</td>
                        <td><a target="_blank" href="{{route('viewuser',['id'=>$record->User_ID])}}">{{$record->Username}}</a></td>
                        <td>{{$record->Package_Amount}}</td>
                        <td>{{$record->Period}}</td>
                        <td>{{$record->Reject_Date}}</td>
                        <td> - </td>
                        <td>{{$record->Reject_Reason}}</td>
                    </tr>
                    <?php $counter++;?>
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
        $('#user_table').DataTable( {
            "order": [[ 3, "desc" ]]
        });
    });
</script>
@endsection