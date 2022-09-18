@extends('admin.dashboard_layout')
@section('content')
<?php 
    if(!empty($package)){
        $amount = $package->Amount;
        $credit_amount = $package->CreditAmount;
        $collect_amount = $package->CollectAmount;
        $year = $package->Year;
        $month = $package->Month;
        $day = $package->Day;
        $increment_amount = $package->IncrementAmount;
        $increment_period = $package->IncrementPeriod;
        $status = $package->Status;
    }else{
        $amount = old('Amount');
        $credit_amount = old('CreditAmount');
        $collect_amount = old('>CollectAmount');
        $year = old('Year');
        $month = old('Month');
        $day = old('Day');
        $increment_amount = old('IncrementAmount');
        $increment_period = old('IncrementPeriod');
    }
?>
<div class = "container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('loanpackage')}}">Loan Package</a></li>
                <span class="breadcrumb-item active">New Loan Package</span>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if(!empty($package))
            <form action="{{route('loanpackage').'/edit'}}" method="post">
            @else
            <form action="{{route('loanpackage').'/create'}}" method="post"> 
            @endif         
            <?php $success = Session::get('success'); ?>
            @if(isset($success))
            <div class="alert alert-success" role="alert">
                <strong>Success - </strong> Changes has been saved!
            </div>
            @endif
                <table class="table table-striped table-bordered no-wrap">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    @if(!empty($package))
                    <input type="hidden" name="id" value="{{$package->ID}}">
                    @endif
                    <tr>
                        <td class="col-md-3">Amount (RM)</td>
                        <td class="col-md-3">                   
                                <input type="text" class="form-control" name="Amount" value="{{$amount}}">
                                <div class="row">
                                @error('Amount')
                                    <div class="text-danger"  style="margin-left:15px">{{ $message }}</div>
                                @enderror
                                </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-3">Credited Amount (RM)</td>
                        <td class="col-md-9">
                            <input type="text" class="form-control" name="CreditAmount" value="{{$credit_amount}}">
                            <div class="row">
                                @error('CreditAmount')
                                    <div class="text-danger"  style="margin-left:15px">{{ $message }}</div>
                                @enderror
                                </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-3">Payback Amount (RM)</td>
                        <td class="col-md-9">
                            <input type="text" class="form-control" name="CollectAmount" value="{{$collect_amount}}">
                            <div class="row">
                                @error('CollectAmount')
                                    <div class="text-danger"  style="margin-left:15px">{{ $message }}</div>
                                @enderror
                                </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-3"> Loan Period</td>
                        <td class="col-md-9 flex">
                            <div class="row">
                                <!-- <div class="col-md-3" style="display:flex; align-items:center;"> 
                                    <input type="text" class="form-control" name="Year" value="{{$year}}"><span> &nbsp;Years</span>
                                </div>
                                <div class="col-md-3" style="display:flex; align-items:center;">
                                    <input type="text" class="form-control" name="Month" value="{{$month}}"><span> &nbsp;Months</span>
                                </div> -->
                                <div class="col-md-3" style="display:flex; align-items:center;">
                                    <input type="text" class="form-control" name="Day" value="{{$day}}"><span> &nbsp;Days</span>
                                </div>
                            </div>
                            <div class="row">
                                @error('Period')
                                    <div class="text-danger" style="margin-left:15px">{{$message}}</div>
                                @enderror
                            </div>
                        </td>
                    </tr>
                  
                    <tr>
                        <td class="col-md-3">Increment Amount</td>
                        <td class="col-md-9">
                            <input type="text" class="form-control" name="IncrementAmount" value="{{$increment_amount}}">
                            <div class="row">
                                @error('IncrementAmount')
                                    <div class="text-danger"  style="margin-left:15px">{{ $message }}</div>
                                @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-3">Increment Period</td>
                        <td class="col-md-9">
                            <input type="text" class="form-control" name="LatePeriod" value="{{$increment_period}}">
                            <div class="row">
                                @error('LatePeriod')
                                    <div class="text-danger"  style="margin-left:15px">{{ $message }}</div>
                                @enderror
                            </div>
                        </td>
                    </tr>
                    @if(!empty($period))
                    <tr>
                        <td class="col-md-3">Status</td>
                        <td class="col-md-9">
                            <div class="custom-control custom-switch">
                                <input class="custom-control-input" name="Status" type="checkbox" id="activestatus" {{$status?"checked":""}}>
                                <label class="custom-control-label" for="activestatus"><span id="status">{{$status?"Active":"Inactive"}}</span></label>
                            </div>
                        </td>
                    </tr>
                    @endif
                </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-success" type="submit">
                <i class="fas fa-save"></i> Save
            </button>
            </form>
            <a class="nostyle" href="{{route('loanpackage')}}">
                <button class="btn btn-secondary">
                    <i class="icon-logout"></i> Back
                </button>
            </a>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#activestatus').click(function(){
            if(!$(this).is(":checked"))
                $('#status').text('Inactive');
            else
                $('#status').text('Active');
        });
    });
</script>
@endsection