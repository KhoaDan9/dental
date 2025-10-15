<?php

namespace App\Observers;

use App\Models\AccessControl;
use App\Models\Feature;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $feature_systems = Feature::where('category', 'Hệ thống')->get();
        $feature_datas = Feature::where('category', 'Dữ liệu')->get();
        $feature_medicals = Feature::where('category', 'Bệnh án')->get();
        $feature_transaction_vouchers = Feature::where('category', 'Thu chi')->get();
        $feature_catalogs = Feature::where('category', 'Danh mục')->get();
        $feature_reports = Feature::where('category', 'Báo cáo')->get();
        $feature_security_group = Feature::where('category', 'Bảo mật')->get();

        $permissionIds = Permission::pluck('id')->all();
        $accessControls = [];

        //hệ thống
        foreach ($feature_systems as $feature_system) {
            foreach ($permissionIds as $permissionId) {
                if ($permissionId == 1 || $permissionId == 3) {
                    $accessControls[] = [
                        'user_id' => $user->id,
                        'feature_id' => $feature_system->id,
                        'permission_id' => $permissionId,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'user_permission' => 0
                    ];
                } else {
                    $accessControls[] = [
                        'user_id' => $user->id,
                        'feature_id' => $feature_system->id,
                        'permission_id' => $permissionId,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'user_permission' => 2
                    ];
                }
            }
        }

        //Dữ liệu
        foreach ($feature_datas as $feature_data) {
            foreach ($permissionIds as $permissionId) {
                if ($permissionId == 5 || $permissionId == 6) {
                    $accessControls[] = [
                        'user_id' => $user->id,
                        'feature_id' => $feature_data->id,
                        'permission_id' => $permissionId,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'user_permission' => 2
                    ];
                } else
                    $accessControls[] = [
                        'user_id' => $user->id,
                        'feature_id' => $feature_data->id,
                        'permission_id' => $permissionId,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'user_permission' => 0
                    ];
            }
        }

        //Thu chi
        foreach ($feature_transaction_vouchers as $feature_transaction_voucher) {
            foreach ($permissionIds as $permissionId) {
                if ($permissionId == 5 || $permissionId == 6) {
                    $accessControls[] = [
                        'user_id' => $user->id,
                        'feature_id' => $feature_transaction_voucher->id,
                        'permission_id' => $permissionId,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'user_permission' => 2
                    ];
                } else
                    $accessControls[] = [
                        'user_id' => $user->id,
                        'feature_id' => $feature_transaction_voucher->id,
                        'permission_id' => $permissionId,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'user_permission' => 0
                    ];
            }
        }

        //Bệnh án
        foreach ($feature_medicals as $feature_medical) {
            foreach ($permissionIds as $permissionId) {
                if ($permissionId == 5) {
                    $accessControls[] = [
                        'user_id' => $user->id,
                        'feature_id' => $feature_medical->id,
                        'permission_id' => $permissionId,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'user_permission' => 2
                    ];
                } else
                    $accessControls[] = [
                        'user_id' => $user->id,
                        'feature_id' => $feature_medical->id,
                        'permission_id' => $permissionId,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'user_permission' => 0
                    ];
            }
        }

        //Danh mục
        foreach ($feature_catalogs as $feature_catalog) {
            foreach ($permissionIds as $permissionId) {
                if ($permissionId == 5 || $permissionId == 6) {
                    $accessControls[] = [
                        'user_id' => $user->id,
                        'feature_id' => $feature_catalog->id,
                        'permission_id' => $permissionId,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'user_permission' => 2
                    ];
                } else
                    $accessControls[] = [
                        'user_id' => $user->id,
                        'feature_id' => $feature_catalog->id,
                        'permission_id' => $permissionId,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'user_permission' => 0
                    ];
            }
        }



        //Báo cáo
        foreach ($feature_reports as $feature_report) {
            foreach ($permissionIds as $permissionId) {
                if ($permissionId == 2 || $permissionId == 3 || $permissionId == 4) {
                    $accessControls[] = [
                        'user_id' => $user->id,
                        'feature_id' => $feature_report->id,
                        'permission_id' => $permissionId,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'user_permission' => 2
                    ];
                } else
                    $accessControls[] = [
                        'user_id' => $user->id,
                        'feature_id' => $feature_report->id,
                        'permission_id' => $permissionId,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'user_permission' => 0
                    ];
            }
        }

        //Bảo mật
        foreach ($feature_security_group as $feature_security) {
            foreach ($permissionIds as $permissionId) {
                if ($permissionId == 5 || $permissionId == 6) {
                    $accessControls[] = [
                        'user_id' => $user->id,
                        'feature_id' => $feature_security->id,
                        'permission_id' => $permissionId,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'user_permission' => 2
                    ];
                } else
                    $accessControls[] = [
                        'user_id' => $user->id,
                        'feature_id' => $feature_security->id,
                        'permission_id' => $permissionId,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'user_permission' => 0
                    ];
            }
        }

        //Thêm toàn bộ vào db
        AccessControl::insert($accessControls);

        //Danh muc
        $feature_employee_salary = Feature::where('name','Bảng lương nhân viên')->first();
        $accessControl = AccessControl::where('user_id',$user->id)->where('feature_id', $feature_employee_salary->id)
            ->where('permission_id', 5)
            ->first();
        $accessControl->user_permission = 0;
        $accessControl->save();

        $accessControl = AccessControl::where('user_id',$user->id)->where('feature_id', $feature_employee_salary->id)
            ->where('permission_id', 6)
            ->first();
        $accessControl->user_permission = 0;
        $accessControl->save();

        //Thu chi
        $feature_transaction_voucher = Feature::where('name','Quản lý thu chi')->first();
        $accessControl = AccessControl::where('user_id',$user->id)->where('feature_id', $feature_transaction_voucher->id)
            ->where('permission_id', 6)
            ->first();
        $accessControl->user_permission = 0;
        $accessControl->save();


        //Benh an
        $feature_print_invoice = Feature::where('name','In bệnh án')->first();
        $accessControl = AccessControl::where('user_id',$user->id)->where('feature_id', $feature_print_invoice->id)
            ->where('permission_id', 1)
            ->first();
        $accessControl->user_permission = 2;
        $accessControl->save();

        $accessControl = AccessControl::where('user_id',$user->id)->where('feature_id', $feature_print_invoice->id)
            ->where('permission_id', 2)
            ->first();
        $accessControl->user_permission = 2;
        $accessControl->save();

        $accessControl = AccessControl::where('user_id',$user->id)->where('feature_id', $feature_print_invoice->id)
            ->where('permission_id', 3)
            ->first();
        $accessControl->user_permission = 2;
        $accessControl->save();

        $accessControl = AccessControl::where('user_id',$user->id)->where('feature_id', $feature_print_invoice->id)
            ->where('permission_id', 4)
            ->first();
        $accessControl->user_permission = 2;
        $accessControl->save();


        $feature_patient_service = Feature::where('name','Thủ thuật bệnh nhân')->first();
        $accessControl = AccessControl::where('user_id',$user->id)->where('feature_id', $feature_patient_service->id)
            ->where('permission_id', 6)
            ->first();
        $accessControl->user_permission = 2;
        $accessControl->save();

        $feature_patient_service2 = Feature::where('name','Lịch hẹn')->first();
        $accessControl = AccessControl::where('user_id',$user->id)->where('feature_id', $feature_patient_service2->id)
            ->where('permission_id', 6)
            ->first();
        $accessControl->user_permission = 2;
        $accessControl->save();

        $feature_patient_service2 = Feature::where('name','Thẻ bảo hành')->first();
        $accessControl = AccessControl::where('user_id',$user->id)->where('feature_id', $feature_patient_service2->id)
            ->where('permission_id', 6)
            ->first();
        $accessControl->user_permission = 2;
        $accessControl->save();

        $accessControl = AccessControl::where('user_id',$user->id)->where('feature_id', $feature_patient_service2->id)
            ->where('permission_id', 4)
            ->first();
        $accessControl->user_permission = 2;
        $accessControl->save();

        //Bảo mật
        $feature_action_log = Feature::where('name','Log hành động')->first();
        $accessControl = AccessControl::where('user_id',$user->id)->where('feature_id', $feature_action_log->id)
            ->where('permission_id', 2)
            ->first();
        $accessControl->user_permission = 2;
        $accessControl->save();
        $accessControl = AccessControl::where('user_id',$user->id)->where('feature_id', $feature_action_log->id)
            ->where('permission_id', 3)
            ->first();
        $accessControl->user_permission = 2;
        $accessControl->save();
        $accessControl = AccessControl::where('user_id',$user->id)->where('feature_id', $feature_action_log->id)
            ->where('permission_id', 4)
            ->first();
        $accessControl->user_permission = 2;
        $accessControl->save();

    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
