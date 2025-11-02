<?php

use App\Livewire\Appointment\EditStatusAppointment;
use App\Livewire\Appointment\IndexAppointment;
use App\Livewire\Category\Diagnosis\ActionDiagnosis;
use App\Livewire\Category\Diagnosis\ActionDiagnosisGroup;
use App\Livewire\Category\Diagnosis\IndexDiagnosis;
use App\Livewire\Category\Diagnosis\IndexDiagnosisGroup;
use App\Livewire\Category\Prescription\ActionPrescription;
use App\Livewire\Category\Prescription\IndexPrescription;
use App\Livewire\Category\Reminder\ActionReminder;
use App\Livewire\Category\Reminder\IndexReminder;
use App\Livewire\ClinicPayment\ActionFinance;
use App\Livewire\ClinicPayment\ActionFundingSource;
use App\Livewire\ClinicPayment\ActionTransactionVoucher;
use App\Livewire\ClinicPayment\IndexFinance;
use App\Livewire\ClinicPayment\IndexFundingSource;
use App\Livewire\ClinicPayment\IndexTransactionVoucher;
use App\Livewire\Employee\ActionEmployee;
use App\Livewire\Employee\IndexEmployee;
use App\Livewire\IndexWarrantyCard;
use App\Livewire\Login;
use App\Livewire\Material\ActionMaterial;
use App\Livewire\Material\ActionMaterialGroup;
use App\Livewire\Material\IndexMaterial;
use App\Livewire\Material\IndexMaterialGroup;

use App\Livewire\Patient\ActionPatient;
use App\Livewire\Patient\ActionPatientAppointment;
use App\Livewire\Patient\ActionPatientPayment;
use App\Livewire\Patient\ActionPatientPrescription;
use App\Livewire\Patient\ActionPatientReminder;
use App\Livewire\Patient\ActionPatientService;
use App\Livewire\Patient\EditStatusPatient;
use App\Livewire\Patient\IndexPatient;
use App\Livewire\Patient\DetailWarrantyCard;

use App\Livewire\Patient\PrintInvoice;
use App\Livewire\Reports\PatientDetails;
use App\Livewire\Security\IndexDataLogs;
use App\Livewire\Security\UserManagement\ActionUser;
use App\Livewire\Security\UserManagement\IndexUserManagement;
use App\Livewire\Security\UserManagement\UserPermission;

use App\Livewire\Service\ActionService;
use App\Livewire\Service\ActionServiceGroup;
use App\Livewire\Service\IndexService;
use App\Livewire\Service\IndexServiceGroup;

//use App\Livewire\Supplier\ActionSupplier;
//use App\Livewire\Supplier\IndexSupplier;
use App\Livewire\System\ActionClinic;
use App\Livewire\System\IndexClinic;
use App\Livewire\System\UpdatePassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return redirect('/patients');
});

Route::middleware(['auth'])->group(function () {
    //He thong
    Route::get('/clinics', IndexClinic::class);

    Route::get('/clinics/{clinic}', ActionClinic::class);

    Route::get('/change-password', UpdatePassword::class);


    //du lieu
    Route::get('/patients', IndexPatient::class);

    Route::get('/edit-status/{patient}', EditStatusPatient::class);

    Route::get('/patients/{value}', ActionPatient::class);


    // Lich hen
    Route::get('/patients/{patient}/appointments/{value}', ActionPatientAppointment::class);
    Route::get('/patients/{patient}/appointment-status/{appointment}', EditStatusAppointment::class);

        //In benh an
    Route::get('/patients/{patient}/invoice', PrintInvoice::class);

    // thu thuat
    Route::get('/patients/{patient}/{value}', ActionPatientService::class);

    Route::get('/patients/{patient}/{patient_service}/warranty-card', DetailWarrantyCard::class);


    Route::get('/patients/{patient}/prescriptions/{value}', ActionPatientPrescription::class);

    //Thanh toan
    Route::get('/patients/{patient}/payments/{value}', ActionPatientPayment::class);

    //Loi nhac
    Route::get('/patients/{patient}/reminders/{value}', ActionPatientReminder::class);




    // All Lich hen
    Route::get('/appointments', IndexAppointment::class);

    // Danh sach the bao hanh
    Route::get('/warranty-cards', IndexWarrantyCard::class);

    // Danh sach nha cung cap
//    Route::get('/suppliers', IndexSupplier::class);
//    Route::get('/suppliers/{value}', ActionSupplier::class);

    // Nhom dich vu va dich vu
    Route::get('/service-groups', IndexServiceGroup::class);

    Route::get('/service-groups/{value}', ActionServiceGroup::class);

    Route::get('/services', IndexService::class);

    Route::get('/services/{value}', ActionService::class);

    // Nhan vien
    Route::get('/employees', IndexEmployee::class);

    Route::get('/employees/{value}', ActionEmployee::class);

    //nguon quy, thu chi
    Route::get('/funding-sources', IndexFundingSource::class);
    Route::get('/funding-sources/{value}', ActionFundingSource::class);

    Route::get('/finances', IndexFinance::class);
    Route::get('/finances/{value}', ActionFinance::class);

    Route::get('/transaction-vouchers', IndexTransactionVoucher::class);
    Route::get('/transaction-vouchers/{value}', ActionTransactionVoucher::class);


    //danh muc
    // Chan doan
    Route::get('/diagnosis-groups', IndexDiagnosisGroup::class);

    Route::get('/diagnosis-groups/{value}', ActionDiagnosisGroup::class);

    Route::get('/diagnoses', IndexDiagnosis::class);

    Route::get('/diagnoses/{value}', ActionDiagnosis::class);

    // Loi nhac

    Route::get('/reminders', IndexReminder::class);

    Route::get('/reminders/{value}', ActionReminder::class);

    // Don thuoc
    Route::get('/prescriptions', IndexPrescription::class);

    Route::get('/prescriptions/{value}', ActionPrescription::class);

    // Nhom vat tu
    Route::get('/material-groups', IndexMaterialGroup::class);
    Route::get('/material-groups/{value}', ActionMaterialGroup::class);

    Route::get('/materials', IndexMaterial::class);
    Route::get('/materials/{value}', ActionMaterial::class);


    //bao mat
    Route::get('/users', IndexUserManagement::class);
    Route::get('/users/{value}', ActionUser::class);
    Route::get('/user-permission/{user}', UserPermission::class);

    Route::get('/data-logs', IndexDataLogs::class);


    //bao cao
    Route::get('/reports/patient-details', PatientDetails::class);



});


Route::get('/login', Login::class)->name('login');
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
});
