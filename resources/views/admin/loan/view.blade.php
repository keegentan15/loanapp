@extends('admin.dashboard_layout')
@section('content')
<div class = "container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('loanapplication')}}">Loan Application</a></li>
                <span class="breadcrumb-item active">View</span>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
                <table class="table table-striped table-bordered no-wrap">
                    <tr>
                        <td class="col-md-3">User</td>
                        <td class="col-md-9"><a target="_blank" href="{{route('viewuser',['id'=>$record->User_ID])}}">{{$record->Username}}</a></td>
                    </tr>
                    <tr>
                        <td class="col-md-3">Loan Amount (RM)</td>
                        <td class="col-md-9">{{$record->Package_Amount}}</td>
                    </tr>
                    <tr>
                        <td class="col-md-3">Loan Period (Days)</td>
                        <td class="col-md-9">{{$record->Period}}</td>
                    </tr>
                    <tr>
                        <td class="col-md-3">User Gallery</td>
                        <td class="col-md-9">
                            <?php $counter = 0;?>
                            @foreach($path as $p)
                            <img src="{{asset($p)}}" id="img_{{$counter}}" style="width:100px;" alt="">
                            <?php $counter++;?>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-3">Loan History</td>
                        <td class="col-md-9" style="display:flex; flex-direction:column;">
                            <?php?>
                            <!-- if(count($record->History)||count($record->Current))
                                if(count($record->Current))
                                <strong>Current Loan</strong>
                                endif
                                if(count($record->History))
                                <strong>Completed Loan</strong>
                                    foreach($record->History as $r)
                                    
                                    endforeach
                                endif
                            else
                                No record found
                            endif -->
                        </td>
                    </tr>
                </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a class="nostyle" href="{{url()->previous()}}">
                <button class="btn btn-secondary">
                    <i class="icon-logout"></i> Back
                </button>
            </a>
            @if($record->Status==0)
            <button class="btn btn-success" data-toggle="modal" data-target="#myModal">
                <i class="fas fa-check"></i> Approve
            </button>
            <button class="btn btn-danger">
                <i class="fas fa-times"></i> Reject
            </button>
            @endif
        </div>
    </div>
</div>
<div id="imgModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body" style="padding:0">
                    <img id="modalimg" style="width:100%" src="" alt="">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<script>
    $(document).ready(function(){
        $('img').click(function(){
            // let id = $(this).attr('id').split('_')[1];
            let src = $(this).attr('src');
            $('#modalimg').attr('src',src);
            $('#imgModal').modal('show');
        });
    });
</script>
@endsection