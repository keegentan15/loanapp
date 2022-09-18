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
                <i id="notification-icon"></i><span id="message"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        <div class = "table-responsive">
        <table id = "user_table" class="table table-striped table-bordered no-wrap">
            <thead>
                <tr>
                    <!-- <th>#</th> -->
                    <th>Requested By</th>
                    <th>Loan Amount (RM)</th>
                    <th>Installment Period (Days)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                    <?php $counter = 1;?>
                    @foreach($records as $key => $record)
                    <tr id="loan{{$record->ID}}">
                        <!-- <td>{{$counter}}</td> -->
                        <td><a target="_blank" href="{{route('viewuser',['id'=>$record->User_ID])}}">{{$record->Username}}</a></td>
                        <td>{{$record->Package_Amount}}</td>
                        <td>{{$record->Period}}</td>
                        <td>
                            <a class="nostyle" href="{{route('viewloan',['id'=>$record->ID])}}">
                                <button class="btn btn-primary"><i class="fas fa-eye"></i> View</button>
                            </a>
                            <button name="modal" data-id="{{$record->ID}}" data-action="approve" class="btn btn-success"><i class="fas fa-check"></i> Approve</button>
                            <button name="modal" data-id="{{$record->ID}}" data-action="reject" class="btn btn-danger"><i class="fas fa-times"></i> Reject</button>
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
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
            <p><span id="modalmessage"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light"
                    data-dismiss="modal">Close</button>
                <button type="button" name="confirm" class="btn btn-primary">Confirm</button>
            </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $(document).ready(function() {
        function success(action,id){
            //$('#loan'+id).remove();
            table.rows('#loan'+id).remove().draw();
            $('#message').text('Loan has been '+action+'ed');
            $('#notification').attr('class','alert alert-success');
            $('#notification-icon').attr('class','fas fa-check');
            $('#notification').css('display','block');
        }
        var url = '';
        //order data table from oldest user application to newest
        var table = $('#user_table').DataTable( {
            "order": [[ 3, "desc" ]]
        });
        $('button[name="modal"]').click(function(){
            var message = '';
            var action = '';
            var reason = null;
            var id = $(this).data('id');
            if($(this).data('action') == 'approve'){
                message = 'Are you sure to approve this loan?';
                action = 'approve';
            }
            else{
                message = 'Reason of rejecting loan';  
                message += '<br><input id="reject_reason" class="form-control" type="text">';
                action = 'reject';
            }
            if(action=='approve')
                url = '{{url("/")}}/admin/loan/approveloan/'+id;
            else if(action=='reject')
                url = '{{url("/")}}/admin/loan/rejectloan/'+id;
            $('#modalmessage').html(message);
            $('#myModal').modal('show');
            $('button[name="confirm"]').click(function(){ 
                reason = $('#reject_reason').val();
                $.ajax({
                    url:url,
                    method:'post',
                    data:{_token: "{{csrf_token()}}",id:id,reason:reason},
                    success:function(res){
                        if(res==true){
                            $('#myModal').modal('hide');
                            success(action,id);  
                        }                        
                    }
                })
                    
            });
        });
    });
</script>
@endsection