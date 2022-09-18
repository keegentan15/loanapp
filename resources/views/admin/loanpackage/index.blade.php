@extends('admin.dashboard_layout')
@section('content')
<div class = "container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav class="breadcrumb">
                <span class="breadcrumb-item active">Loan Package</span>
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
    <br>
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
        <table class="table table-striped table-bordered no-wrap" id="packagetable">
            <thead>
                <tr>
                    <th>Loan Amount (RM)</th>
                    <th>Credited Amount (RM)</th>
                    <th>Collected Amount (RM)</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($package as $package)
                    <tr>
                        <td>{{$package->Amount}}</td>
                        <td>{{$package->CreditAmount}}</td>
                        <td>{{$package->CollectAmount}}</td>
                        <td>
                            <div class="custom-control custom-switch">
                            <input class="custom-control-input" type="checkbox" data-id = "{{$package->ID}}" id="activestatus_{{$package->ID}}" {{$package->Status?"checked":""}}>
                            <label class="custom-control-label" for="activestatus_{{$package->ID}}"><span id="status{{$package->ID}}">{{$package->Status?"Active":"Inactive"}}</span></label>
                            </div>
                        </td>
                        <td>
                            <a href="{{route('loanpackage').'/edit/'.$package->ID}}" class="btn btn-secondary"><i class="fas fa-edit"></i> Edit</a>&nbsp;
                            <button class="btn btn-danger" onclick="deletereminder()" data-id = "{{$package->ID}}"><i class="fas fa-trash"></i> Delete</button>
                        </td>
                    </tr>
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
            <p>Are you sure to delete?</p>
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
        var packagetable = $('#packagetable').DataTable({
            "order": [[ 1, "asc" ]]
        });
        function deletereminder(){
            let id = $(this).data('id');
            $('#myModal').modal('toggle');
        }
        $('.custom-control-input').click(function(){
            let id = $(this).data('id');
            let status;
            if(!$(this).is(":checked"))
                status = 0;
            else    
                status = 1;
            $.ajax({
                url:'{{route("loanpackage")}}'+'/updatestatus',
                method:'post',
                data:{_token:"{{csrf_token()}}",id:id,status:status},
                success:function(){
                    if(status==0)
                        $('#status'+id).text('Inactive');
                    else
                        $('#status'+id).text('Active');
                    }
                });
            

        });
        // $('.btn-danger').click(function(){
            
        //     //reject user
        //     $('button[data-approve=true]').click(function(){
        //         $.ajax({
        //             url:'{{url()->current()."/delete"}}',
        //             method:'post',
        //             data:{_token: "{{csrf_token()}}",id:id},
        //             success:function(response){
        //                location.reload();
        //             }
        //         });
        //     });
        // });
    });
</script>
@endsection