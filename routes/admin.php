<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\MenuBuilderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\PassportController;
use App\Http\Controllers\Admin\RefundController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\StaffPaymentController;
use App\Http\Controllers\Admin\StaffAttendanceController;
use App\Http\Controllers\Admin\SupplierPaymentController;
use App\Http\Controllers\Admin\StaffPermissionController;
use App\Http\Controllers\Admin\TrainingController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\VisaController;
use App\Http\Controllers\Admin\StudentVisaController;
use App\Http\Controllers\Admin\MedicalVisaController;
use App\Http\Controllers\Admin\SoftwareSaleController;



Route::get('/login', [AdminLoginController::class, 'viewLogin'])->name('login.view');
Route::post('admin-login', [AdminLoginController::class, 'login'])->name('login');
Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

Route::prefix('passwords')->group(function () {
    Route::get('forget-password', [ForgotPasswordController::class, 'getEmail'])->name('forget.password');
    Route::post('forget-password', [ForgotPasswordController::class, 'postEmail'])->name('forget.password.store');

    Route::get('reset-password/{token}', [ResetPasswordController::class, 'getPassword'])->name('reset.password');
    Route::post('reset-password', [ResetPasswordController::class, 'updatePassword'])->name('reset.password.store');
});
Route::middleware('admin')->group(function () {

    /* ============> Dashboard <=========== */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.home');

    /* ============> Categories <=========== */
    Route::prefix('categories')->group(function () {
        Route::get('/index', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
        Route::get('/show/{id}', [CategoryController::class,'show'])->name('category.show');

    });

    /* ============> Configuration <=========== */
    Route::group(['prefix'=>'settings'], function(){   
        Route::get('/index', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/update', [SettingController::class, 'update'])->name('settings.update');     
        Route::get('/profile/view', [SettingController::class, 'profileView'])->name('profile.view');     
        Route::post('/profile/update', [SettingController::class, 'profileUpdate'])->name('profile.update');     
        Route::get('/password/change', [SettingController::class, 'passwordChange'])->name('password.change');   
        Route::post('/password/update', [SettingController::class, 'passwordUpdate'])->name('password.update');   
    });

    /* ============> Sections <=========== */
    Route::group(['prefix'=>'sections'], function(){   
        Route::get('/index', [SectionController::class, 'index'])->name('section.index');
        Route::get('/create', [SectionController::class, 'create'])->name('section.create');
        Route::post('/store', [SectionController::class, 'store'])->name('section.store');
        Route::get('/edit/{id}', [SectionController::class, 'edit'])->name('section.edit');
        Route::post('/update/{id}', [SectionController::class, 'update'])->name('section.update');
        Route::get('/delete/{id}', [SectionController::class, 'destroy'])->name('section.delete');
        Route::get('/show/{id}', [SectionController::class,'show'])->name('section.show');

    });


    
    /* ============> About <=========== */
    Route::group(['prefix'=>'abouts'], function(){   
        Route::get('/index', [AboutController::class, 'index'])->name('about.index');
        // Route::get('/create', [AboutController::class, 'create'])->name('about.create');
        // Route::post('/store', [AboutController::class, 'store'])->name('about.store');
        Route::get('/edit/{id}', [AboutController::class, 'edit'])->name('about.edit');
        Route::post('/update/{id}', [AboutController::class, 'update'])->name('about.update');
        Route::get('/delete/{id}', [AboutController::class, 'destroy'])->name('about.delete');
        Route::get('/show/{id}', [AboutController::class,'show'])->name('about.show');

    });

    /* ===========> Manage Menu Builder <========== */
    Route::group(['prefix'=>'menus'], function(){        
        // Route::get('/menu/builder', MenuBuilder::class)->name('menu.builder.create')
        Route::get('/manage/menus/{id?}', [MenuBuilderController::class, 'index'])->name('menuBuilder');
        Route::post('store/menu', [MenuBuilderController::class, 'store'])->name('menu.store');
        Route::get('delete/menuitem/{id}', [MenuBuilderController::class, 'deleteMenuItem'])->name('deleteMenuItem');
        Route::get('create/menu', [MenuBuilderController::class, 'createMenu'])->name('createMenu');
        Route::get('update/menu', [MenuBuilderController::class, 'updateMenu'])->name('updateMenu');
        Route::get('add/item/menu', [MenuBuilderController::class, 'addItemToMenu'])->name('addItemToMenu');
        Route::post('update/menuitem/{id}', [MenuBuilderController::class, 'updateMenuItem'])->name('updateMenuItem');
        Route::get('delete/menu/{id}', [MenuBuilderController::class, 'destroy'])->name('deleteMenu');
    });

    /* ============> Pages <=========== */
    Route::prefix('pages')->group(function () {
        Route::get('/index', [PageController::class, 'index'])->name('page.index');
        Route::get('/create', [PageController::class, 'create'])->name('page.create');
        Route::post('/store', [PageController::class, 'store'])->name('page.store');
        Route::get('/edit/{id}', [PageController::class, 'edit'])->name('page.edit');
        Route::post('/update/{id}', [PageController::class, 'update'])->name('page.update');
        Route::get('/delete/{id}', [PageController::class, 'destroy'])->name('page.delete');
        Route::get('/show/{id}', [PageController::class,'show'])->name('page.show');

    });

    /* ============> Manage Team  <=========== */
    Route::prefix('teams')->group(function () {
        Route::get('/index', [TeamController::class, 'index'])->name('team.index');
        Route::get('/create', [TeamController::class, 'create'])->name('team.create');
        Route::post('/store', [TeamController::class, 'store'])->name('team.store');
        Route::get('/edit/{id}', [TeamController::class, 'edit'])->name('team.edit');
        Route::post('/update/{id}', [TeamController::class, 'update'])->name('team.update');
        Route::get('/delete/{id}', [TeamController::class, 'destroy'])->name('team.delete');
        Route::get('/show/{id}', [TeamController::class,'show'])->name('team.show');

    });

    /* ============> Manage Team  <=========== */
    Route::prefix('testimonials')->group(function () {
        Route::get('/index', [TestimonialController::class, 'index'])->name('testimonial.index');
        Route::get('/create', [TestimonialController::class, 'create'])->name('testimonial.create');
        Route::post('/store', [TestimonialController::class, 'store'])->name('testimonial.store');
        Route::get('/edit/{id}', [TestimonialController::class, 'edit'])->name('testimonial.edit');
        Route::post('/update/{id}', [TestimonialController::class, 'update'])->name('testimonial.update');
        Route::get('/delete/{id}', [TestimonialController::class, 'destroy'])->name('testimonial.delete');
        Route::get('/show/{id}', [TestimonialController::class,'show'])->name('testimonial.show');

    });

    /* ============> Manage Slider   <=========== */
    Route::prefix('slider')->group(function () {
        Route::get('/index', [SliderController::class, 'index'])->name('slider.index');
        Route::get('/create', [SliderController::class, 'create'])->name('slider.create');
        Route::post('/store', [SliderController::class, 'store'])->name('slider.store');
        Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
        Route::post('/update/{id}', [SliderController::class, 'update'])->name('slider.update');
        Route::get('/delete/{id}', [SliderController::class, 'destroy'])->name('slider.delete');
        Route::get('/show/{id}', [SliderController::class,'show'])->name('slider.show');

    });

    /* ============> Manage Counter   <=========== */
    Route::prefix('counters')->group(function () {
        Route::get('/index', [CounterController::class, 'index'])->name('counter.index');
        Route::get('/create', [CounterController::class, 'create'])->name('counter.create');
        Route::post('/store', [CounterController::class, 'store'])->name('counter.store');
        Route::get('/edit/{id}', [CounterController::class, 'edit'])->name('counter.edit');
        Route::post('/update/{id}', [CounterController::class, 'update'])->name('counter.update');
        Route::get('/delete/{id}', [CounterController::class, 'destroy'])->name('counter.delete');
        Route::get('/show/{id}', [CounterController::class,'show'])->name('counter.show');

    });

    /* ============> Manage Service   <=========== */
    Route::prefix('service')->group(function () {
        Route::get('/index', [ServiceController::class, 'index'])->name('service.index');
        Route::get('/create', [ServiceController::class, 'create'])->name('service.create');
        Route::post('/store', [ServiceController::class, 'store'])->name('service.store');
        Route::get('/edit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
        Route::post('/update/{id}', [ServiceController::class, 'update'])->name('service.update');
        Route::get('/delete/{id}', [ServiceController::class, 'destroy'])->name('service.delete');
        Route::get('/show/{id}', [ServiceController::class,'show'])->name('service.show');

    });

    /* ============> Manage Gallery   <=========== */
    Route::prefix('gallery')->group(function () {
        Route::get('/index', [GalleryController::class, 'index'])->name('gallery.index');
        Route::get('/create', [GalleryController::class, 'create'])->name('gallery.create');
        Route::post('/store', [GalleryController::class, 'store'])->name('gallery.store');
        Route::get('/edit/{id}', [GalleryController::class, 'edit'])->name('gallery.edit');
        Route::post('/update/{id}', [GalleryController::class, 'update'])->name('gallery.update');
        Route::get('/delete/{id}', [GalleryController::class, 'destroy'])->name('gallery.delete');
        Route::get('/show/{id}', [GalleryController::class,'show'])->name('gallery.show');

    });
    
    /* ============> Manage Partner   <=========== */
    Route::prefix('partner')->group(function () {
        Route::get('/index', [PartnerController::class, 'index'])->name('partner.index');
        Route::get('/create', [PartnerController::class, 'create'])->name('partner.create');
        Route::post('/store', [PartnerController::class, 'store'])->name('partner.store');
        Route::get('/edit/{id}', [PartnerController::class, 'edit'])->name('partner.edit');
        Route::post('/update/{id}', [PartnerController::class, 'update'])->name('partner.update');
        Route::get('/delete/{id}', [PartnerController::class, 'destroy'])->name('partner.delete');
        Route::get('/show/{id}', [PartnerController::class,'show'])->name('partner.show');
        // online applicaiton show
        Route::get('/apply/list', [PartnerController::class,'apply'])->name('apply.list');
        Route::get('/apply/list/show/{id}', [PartnerController::class,'applyShow'])->name('apply.list.show');
        Route::get('/apply/list/show/delete/{id}', [PartnerController::class,'applyDelete'])->name('apply.list.delete');

    });

    /* ============> Manage Visitor   <=========== */
    Route::prefix('visitor')->group(function () {
        Route::get('/index', [VisitorController::class, 'index'])->name('visitor.index');
        Route::get('/create', [VisitorController::class, 'create'])->name('visitor.create');
        Route::post('/store', [VisitorController::class, 'store'])->name('visitor.store');
        Route::get('/edit/{id}', [VisitorController::class, 'edit'])->name('visitor.edit');
        Route::put('/update/{id}', [VisitorController::class, 'update'])->name('visitor.update');
        Route::get('/delete/{id}', [VisitorController::class, 'destroy'])->name('visitor.delete');
        Route::get('/show/{id}', [VisitorController::class,'show'])->name('visitor.show');

    });

    // Clients
    Route::prefix('client')->name('client.')->group(function () {
        Route::get('/index', [ClientController::class, 'index'])->name('index');
        Route::post('/store', [ClientController::class, 'store'])->name('store');
        Route::post('/update/{id}', [ClientController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [ClientController::class, 'destroy'])->name('delete');
    });

    // Agents
    Route::prefix('agent')->name('agent.')->group(function () {
        Route::get('/index', [AgentController::class, 'index'])->name('index');
        Route::post('/store', [AgentController::class, 'store'])->name('store');
        Route::post('/update/{id}', [AgentController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [AgentController::class, 'destroy'])->name('delete');
    });

    // Suppliers
    Route::prefix('supplier')->name('supplier.')->group(function () {
        Route::get('/index', [SupplierController::class, 'index'])->name('index');
        Route::post('/store', [SupplierController::class, 'store'])->name('store');
        Route::post('/update/{id}', [SupplierController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [SupplierController::class, 'destroy'])->name('delete');
    });

    // Supplier Payment
    Route::prefix('supplier-payment')->name('supplier-payment.')->group(function () {
        Route::get('/index', [SupplierPaymentController::class, 'index'])->name('index');
        Route::post('/store', [SupplierPaymentController::class, 'store'])->name('store');
        Route::post('/update/{id}', [SupplierPaymentController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [SupplierPaymentController::class, 'destroy'])->name('delete');
    });

    /* ============> Manage Notice   <=========== */
    Route::resource('notice', NoticeController::class);

    // Invoices
    Route::prefix('invoice')->name('invoice.')->group(function () {
        Route::get('/index', [InvoiceController::class, 'index'])->name('index');
        Route::post('/store', [InvoiceController::class, 'store'])->name('store');
        Route::post('/update/{id}', [InvoiceController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [InvoiceController::class, 'destroy'])->name('delete');
        Route::get('/get-client/{id}', [InvoiceController::class, 'getClientInfo'])->name('getClient');
        Route::get('/get-client-due/{id}', [InvoiceController::class, 'getClientDue'])->name('getClientDue');
    });

    // Passport
    Route::prefix('passport')->name('passport.')->group(function () {
        Route::get('/index', [PassportController::class, 'index'])->name('index');
        Route::post('/store', [PassportController::class, 'store'])->name('store');
        Route::post('/update/{id}', [PassportController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [PassportController::class, 'destroy'])->name('delete');
    });

    // Refund
    Route::prefix('refund')->name('refund.')->group(function () {
        Route::get('/index', [RefundController::class, 'index'])->name('index');
        Route::post('/store', [RefundController::class, 'store'])->name('store');
        Route::post('/update/{id}', [RefundController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [RefundController::class, 'destroy'])->name('delete');
        Route::get('/get-client/{id}', [RefundController::class, 'getClientInfo'])->name('getClient');
    });

    // Staff
    Route::prefix('staff')->name('staff.')->group(function () {
        Route::get('/index', [StaffController::class, 'index'])->name('index');
        Route::post('/store', [StaffController::class, 'store'])->name('store');
        Route::post('/update/{id}', [StaffController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [StaffController::class, 'destroy'])->name('delete');
    });

    // Staff Payment
    Route::prefix('staff/payment')->name('staff.payment.')->group(function () {
        Route::get('/index', [StaffPaymentController::class, 'index'])->name('index');
        Route::post('/store', [StaffPaymentController::class, 'store'])->name('store');
        Route::post('/update/{id}', [StaffPaymentController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [StaffPaymentController::class, 'destroy'])->name('delete');
    });

    // Staff Attendance
    Route::prefix('staff/attendance')->name('staff.attendance.')->group(function () {
        Route::get('/index', [StaffAttendanceController::class, 'index'])->name('index');
        Route::post('/store', [StaffAttendanceController::class, 'store'])->name('store');
        Route::post('/update/{id}', [StaffAttendanceController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [StaffAttendanceController::class, 'destroy'])->name('delete');
    });

    // Staff Permissions
    Route::get('staff/permissions', [StaffPermissionController::class, 'index'])->name('staff.permissions.index');
    Route::get('staff/permissions/{id}/edit', [StaffPermissionController::class, 'edit'])->name('staff.permissions.edit');
    Route::post('staff/permissions/{id}', [StaffPermissionController::class, 'update'])->name('staff.permissions.update');
    Route::get('staff/permissions/{id}', [StaffPermissionController::class, 'show'])->name('staff.permissions.show');

    /* ============> Manage Training   <=========== */
    Route::prefix('training')->group(function () {
        Route::get('/index', [TrainingController::class, 'index'])->name('training.index');
        Route::get('/create', [TrainingController::class, 'create'])->name('training.create');
        Route::post('/store', [TrainingController::class, 'store'])->name('training.store');
        Route::get('/edit/{id}', [TrainingController::class, 'edit'])->name('training.edit');
        Route::post('/update/{id}', [TrainingController::class, 'update'])->name('training.update');
        Route::get('/delete/{id}', [TrainingController::class, 'destroy'])->name('training.delete');
        Route::get('/show/{id}', [TrainingController::class,'show'])->name('training.show');

    });

    /* ============> Manage Country   <=========== */
    Route::prefix('country')->group(function () {
        Route::get('/index', [CountryController::class, 'index'])->name('country.index');
        Route::post('/store', [CountryController::class, 'store'])->name('country.store');
        Route::post('/update/{id}', [CountryController::class, 'update'])->name('country.update');
        Route::get('/delete/{id}', [CountryController::class, 'destroy'])->name('country.delete');
    });

     /* ============> Manage Branch   <=========== */
    Route::prefix('branch')->group(function () {
        Route::get('/index', [BranchController::class, 'index'])->name('branch.index');
        Route::get('/create', [BranchController::class, 'create'])->name('branch.create');
        Route::post('/store', [BranchController::class, 'store'])->name('branch.store');
        Route::get('/edit/{id}', [BranchController::class, 'edit'])->name('branch.edit');
        Route::post('/update/{id}', [BranchController::class, 'update'])->name('branch.update');
        Route::get('/delete/{id}', [BranchController::class, 'destroy'])->name('branch.delete');
        Route::get('/show/{id}', [BranchController::class,'show'])->name('branch.show');

    });

    /* ============> Manage Course   <=========== */
    Route::prefix('course')->group(function () {
        Route::get('/index', [CourseController::class, 'index'])->name('course.index');
        Route::get('/create', [CourseController::class, 'create'])->name('course.create');
        Route::post('/store', [CourseController::class, 'store'])->name('course.store');
        Route::get('/edit/{id}', [CourseController::class, 'edit'])->name('course.edit');
        Route::post('/update/{id}', [CourseController::class, 'update'])->name('course.update');
        Route::get('/delete/{id}', [CourseController::class, 'destroy'])->name('course.delete');
        Route::get('/show/{id}', [CourseController::class,'show'])->name('course.show');

    });

    /* ============> Manage Education   <=========== */
    Route::prefix('education')->group(function () {
        Route::get('/index', [EducationController::class, 'index'])->name('education.index');
        Route::get('/create', [EducationController::class, 'create'])->name('education.create');
        Route::post('/store', [EducationController::class, 'store'])->name('education.store');
        Route::get('/edit/{id}', [EducationController::class, 'edit'])->name('education.edit');
        Route::post('/update/{id}', [EducationController::class, 'update'])->name('education.update');
        Route::get('/delete/{id}', [EducationController::class, 'destroy'])->name('education.delete');
        Route::get('/show/{id}', [EducationController::class,'show'])->name('education.show');

    });


    Route::prefix('visa')->group(function () {
        Route::get('/index', [VisaController::class, 'index'])->name('visa.index');
        Route::get('/create', [VisaController::class, 'create'])->name('visa.create');
        Route::post('/store', [VisaController::class, 'store'])->name('visa.store');
        Route::get('/edit/{id}', [VisaController::class, 'edit'])->name('visa.edit');
        Route::put('/update/{id}', [VisaController::class, 'update'])->name('visa.update');
        Route::get('/delete/{id}', [VisaController::class, 'destroy'])->name('visa.delete');
        Route::get('/show/{id}', [VisaController::class,'show'])->name('visa.show');
        Route::get('/request/list', [VisaController::class, 'visarequestList'])->name('visa.request.list');
        Route::get('/request/show/{id}', [VisaController::class,'visarequestListShow'])->name('visa.request.list.show');
        Route::get('/request/{id}', [VisaController::class, 'visarequestListedit'])->name('visa.request.list.edit');
        Route::post('/request/update/{id}', [VisaController::class, 'visarequestupdate'])->name('visa.request.list.update');
        Route::get('/request/delete/{id}', [VisaController::class, 'visarequestdestroy'])->name('visa.request.list.delete');

    });

    Route::prefix('student/visa')->group(function () {
        Route::get('/index', [StudentVisaController::class, 'index'])->name('student.visa.index');
        Route::get('/create', [StudentVisaController::class, 'create'])->name('student.visa.create');
        Route::post('/store', [StudentVisaController::class, 'store'])->name('student.visa.store');
        Route::get('/edit/{id}', [StudentVisaController::class, 'edit'])->name('student.visa.edit');
        Route::put('/update/{id}', [StudentVisaController::class, 'update'])->name('student.visa.update');
        Route::get('/delete/{id}', [StudentVisaController::class, 'destroy'])->name('student.visa.delete');
        Route::get('/show/{id}', [StudentVisaController::class,'show'])->name('student.visa.show');
    });
    

    Route::prefix('medical/visa')->group(function () {
        Route::get('/index', [MedicalVisaController::class, 'index'])->name('medical.visa.index');
        Route::get('/create', [MedicalVisaController::class, 'create'])->name('medical.visa.create');
        Route::post('/store', [MedicalVisaController::class, 'store'])->name('medical.visa.store');
        Route::get('/edit/{id}', [MedicalVisaController::class, 'edit'])->name('medical.visa.edit');
        Route::put('/update/{id}', [MedicalVisaController::class, 'update'])->name('medical.visa.update');
        Route::get('/delete/{id}', [MedicalVisaController::class, 'destroy'])->name('medical.visa.delete');
        Route::get('/show/{id}', [MedicalVisaController::class,'show'])->name('medical.visa.show');
    });

    Route::prefix('software/sale')->group(function () {
        Route::get('/index', [SoftwareSaleController::class, 'index'])->name('software.sale.list');
        Route::get('/create', [SoftwareSaleController::class, 'create'])->name('software.sale.create');
        Route::post('/store', [SoftwareSaleController::class, 'store'])->name('software.sale.store');
        Route::get('/edit/{id}', [SoftwareSaleController::class, 'edit'])->name('software.sale.edit');
        Route::put('/update/{id}', [SoftwareSaleController::class, 'update'])->name('software.sale.update');
        Route::get('/delete/{id}', [SoftwareSaleController::class, 'destroy'])->name('software.sale.delete');
        Route::get('/show/{id}', [SoftwareSaleController::class,'show'])->name('software.sale.show');
    });
    

});
