@extends('admin.dashboard_layout')
@section('content')
<div class = "container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav class="breadcrumb">
                <span class="breadcrumb-item active">Loan Application</span>
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
                    <th>Owed Amount</th>
                    <th>Installment Period</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($records as $record)
                    <?php 
                    $counter = 1;
                    $status = $record->Status;
                    switch($status){
                        case 1:
                            $color = 'text-warning'; 
                            $label = 'Not transferred';
                            break;
                        case 3:
                            $color = 'text-success';
                            $label = 'Waiting for payment';
                            break;
                        case 4:
                            $color = 'text-danger';
                            $label = 'Overdue';
                            break;
                    }
                    ?>
                    <tr>
                        <td>{{$counter}}</td>
                        <td><a target="_blank" href="{{route('viewuser',['id'=>$record->User_ID])}}">{{$record->Username}}</a></td>
                        <td>{{$record->Package_Amount}}</td>
                        <td>{{$record->Period}}</td>
                        <th>
                            <div class="{{$color}}">
                                {{$label}}
                            </div>
                        </th>
                        <td>
                            <a class="nostyle" href="">
                                <button class="btn btn-primary"><i class="fas fa-eye"></i> View</button>
                            </a>&nbsp;
                        </td>
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