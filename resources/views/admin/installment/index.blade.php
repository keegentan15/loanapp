@extends('admin.dashboard_layout')
@section('content')
<div class = "container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav class="breadcrumb">
                <span class="breadcrumb-item active">Installment Option</span>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-primary" href="{{url()->current().'/create'}}">
                <i class="fas fa-plus"></i> Create New</button>
            </a>&nbsp;
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
                    <th>No.</th>
                    <th>Installment Period</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1;?>
                @foreach($installment as $ins)
                    <tr>
                        <td>{{$counter}}</td>
                        <td>{{$ins->Years==0?'':$ins->Years.' Years '}}{{$ins->Months==0?'':$ins->Months.' Months'}}</td>
                        <td>
                            <a href="{{route('installment').'/edit/'.$ins->ID}}" class="btn btn-secondary"><i class="fas fa-edit"></i> Edit</a>&nbsp;
                            <button class="btn btn-danger" data-action="reject" data-id = "{{$ins->ID}}"><i class="fas fa-trash"></i> Delete</button>
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
            <input type="hidden" username = "">
            <p>Are you sure to delete this record?</p>
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
        //let bootstrap modal know which user to approve
        //let bootstrap modal know which user to reject
        $('.btn-danger').click(function(){
            var id = $(this).data('id');
            $('#myModal').modal('toggle');
            //reject user
            $('button[data-approve=true]').click(function(){
                $.ajax({
                    url:'{{url()->current()."/delete"}}',
                    method:'post',
                    data:{_token: "{{csrf_token()}}",id:id},
                    success:function(response){
                       location.reload();
                    }
                });
            });
        });
    });
</script>
@endsection