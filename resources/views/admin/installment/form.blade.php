@extends('admin.dashboard_layout')
@section('content')
    @if(isset($data))
<script>
    $(document).on('click','#save_period',function(e){
        var year = $('#year').val();
        var month = $('#month').val();
        $.ajax({
            url:"{{route('installment')}}/edit/{{$data->ID}}",
            method:'post',
            data:{_token: "{{csrf_token()}}",year:year,month:month},
            success:function(){
                window.location.href = "{{route('installment')}}";
            }
        });
    });
</script>
    @else
<script>
    $(document).on('click','#save_period',function(e){
            var year = $('#year').val();
            var month = $('#month').val();
            $.ajax({
                url:"{{route('installment')}}/create",
                method:'post',
                data:{_token: "{{csrf_token()}}",year:year,month:month},
                success:function(){
                    window.location.href = "{{route('installment')}}";
                }
            });
        });
</script>
    @endif
<?php 
if(!empty($data)){
    $year = $data->Years;
    $month = $data->Months;
}
?>
<div class = "container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('installment')}}">Installment Option</a></li>
                <span class="breadcrumb-item active">New Installment Option</span>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">           
                <table class="table table-striped table-bordered no-wrap">
                    <tr>
                        <td class="col-md-3">Years</td>
                        <td class="col-md-9">                   
                                <input type="text" class="form-control" id="year" value="{{!isset($year)?'0':$year}}">
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-3">Months</td>
                        <td class="col-md-9">
                            <input type="text" class="form-control" id="month" value="{{!isset($month)?'0':$month}}">
                        </td>
                    </tr>
                </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a class="nostyle" href="{{route('installment')}}">
                <button class="btn btn-secondary">
                    <i class="icon-logout"></i> Back
                </button>
            </a>
            <button class="btn btn-success" id="save_period">
                <i class="fas fa-save"></i> Save
            </button>
        </div>
    </div>
    </form>
</div>
@endsection