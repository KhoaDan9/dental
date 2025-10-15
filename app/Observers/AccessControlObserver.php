<?php

namespace App\Observers;

use App\Models\AccessControl;
use App\Models\DataLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AccessControlObserver
{
    public function createLog(AccessControl $access_control, $action){
        $user_id = Auth::user()->id;
        $is_active = $access_control->user_permission == 0 ? "Tắt" : "Bật";
        $permission = $access_control->permission->name;
        $features = $access_control->feature->name;
        $clinic_id = $access_control->user->clinic_id;
        $username = $access_control->user->username;

        $detail = "Tài khoản: $username; Tên chức năng: $features; Hành động: $permission; Trạng thái: $is_active;";

        DataLog::create([
            'clinic_id' => $clinic_id,
            'user_id' => $user_id,
            'action' => $action,
            'action_id' => $access_control->id,
            'group_action' => "Quyền",
            'detail' => $detail
        ]);
    }
    /**
     * Handle the AccessControl "created" event.
     */
    public function created(AccessControl $accessControl): void
    {
        //
    }

    /**
     * Handle the AccessControl "updated" event.
     */
    public function updated(AccessControl $accessControl): void
    {
        $this->createLog($accessControl, "Sửa");
    }

    /**
     * Handle the AccessControl "deleted" event.
     */
    public function deleted(AccessControl $accessControl): void
    {
        //
    }

    /**
     * Handle the AccessControl "restored" event.
     */
    public function restored(AccessControl $accessControl): void
    {
        //
    }

    /**
     * Handle the AccessControl "force deleted" event.
     */
    public function forceDeleted(AccessControl $accessControl): void
    {
        //
    }
}
