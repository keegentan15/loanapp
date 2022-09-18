<?php
namespace App\Helpers;
use App\Models\UserActivityLog;

class ActivityLog {
    public static function writeLog($data) {
    
        $userlog = new UserActivityLog;
        $userlog->Staff_ID = $data["Staff_ID"];
        $userlog->Action = $data["Action"];
        $userlog->Content = $data["Content"];
        $userlog->ContentType = $data['ContentType'];
        $userlog->save();

    }
}


?>