<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanRecord extends Model
{
    const status = array(
        0 => 'Not Approved',
        1 => 'Loan Not Credited',
        2 => 'Rejected',
        3 => 'Loan Credited',
        4 => 'Completed'
    );

    use HasFactory;
    protected $table = 'loan_record';
    public $timestamps = false;
    protected $fillable = ['ID','User_ID','Package_ID','Status','Applied_Date','Owed_Amount','TransferDate'];
    public function getStatus($status){
        return $this->status[$status];
    }

    public static function setReturnedData($status){
        switch($status){
            case 0||2:
                $data = array(
                    'LastPayment_Date','Payment_Credited','Credited_Date','LatePayment_Day','Payment_Collected',
                    'Credited_Amount','Owed_Amount','LatePayment_Amount','Collected_Amount','TransferDate','Collect_Date','Reject_Reason'
                );
                break;
            case 1:
                $data = array(
                    'LastPayment_Date','Credited_Date','LatePayment_Day','Payment_Collected',
                    'Credited_Amount','Owed_Amount','LatePayment_Amount','Collected_Amount','TransferDate','Collect_Date','Reject_Reason'
                );
                break;
            case 3:
                $data = array(
                    'LastPayment_Date','LatePayment_Day','Payment_Collected','Collected_Amount','TransferDate','Reject_Reason'
                );
                break;
            case 4:
                $data = array(
                    'Payment_Credited','Credited_Date','LatePayment_Day','Payment_Collected',
                    'Credited_Amount','Owed_Amount','LatePayment_Amount','Collected_Amount','TransferDate','Collect_Date','Reject_Reason'
                );
                break;
        }
        return $data;
    }  
    
}
