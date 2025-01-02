<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\DtnController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\SubAdmin\SaleController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\SubAdmin\DriverController;
use App\Http\Controllers\driver\SplitLoadController;
use App\Http\Controllers\SubAdmin\DtnFuelController;
use App\Http\Controllers\driver\DriverOrderController;
use App\Http\Controllers\SubAdmin\TransportController;
use App\Http\Controllers\SubAdmin\AttendanceController;
use App\Http\Controllers\SubAdmin\OrderAssignController;
use App\Http\Controllers\SubAdmin\PurchaseSaleController;
use App\Http\Controllers\SubAdmin\DriverPaymentController;
use App\Http\Controllers\Supplier\OrderApprovalController;
use App\Http\Controllers\Admin\InventoryCategoryController;
use App\Http\Controllers\SubAdmin\AdminSplitLoadController;
use App\Http\Controllers\Supplier\DriverSupplierController;
use App\Http\Controllers\SuperAdmin\SaleController as SuperAdminSaleController;
use App\Http\Controllers\SubAdmin\InventoryController as SubAdminInventoryController;
use App\Http\Controllers\Supplier\InventoryController as SupplierInventoryController;
use App\Http\Controllers\Inventory\InventoryController as InventoryInventoryController;

Route::get('/optimize', function() {
    Artisan::call('optimize');
    return "optimized!";
});

    // routes/web.php
Route::get('lang/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
})->name('setLanguage');

Route::redirect('/', '/dashboard');


Route::get('register', [AuthController::class, 'registerPage'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.post');
Route::get('login', [AuthController::class, 'loginPage'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');



Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::get('/all-branch-sales', [SaleController::class, 'allBranchSales'])->name('branch.allSales');





    //================ user

    Route::get('/user', [UserController::class, 'index'])->name('user');

    Route::get('/users-list', [UserController::class, 'getUsers'])->name('user.list');

    // add user
    Route::post('/add-user',                     [UserController::class, 'addUser'])->name('user.add');

    // edit user
    Route::get('/edit-user/{id}',                [UserController::class, 'editUser'])->name('user.edit');

    // update user
    Route::get('/update-user',                   [UserController::class, 'updateUser'])->name('user.update');

    // user delete
    Route::get('/user-delete/{id}',              [UserController::class, 'deleteUser'])->name('user.delete');


    // profile user
    Route::get('/profile-user',                   [UserController::class, 'profileUser'])->name('user.profile');




    //================ driver

    Route::get('/driver', [DriverController::class, 'index'])->name('Driver');

    Route::get('/driverDetail-list', [DriverController::class, 'getDrivers'])->name('driver.list');

    // add driver
    Route::post('/add-driverDetail',                     [DriverController::class, 'addDriver'])->name('Driver.add');

    // edit Driver
    Route::get('/edit-driverDetail/{id}',                [DriverController::class, 'editDriver'])->name('Driver.edit');

    // update Driver
    Route::get('/update-driverDetail',                   [DriverController::class, 'updateDriver'])->name('Driverasd.update');

    // Driver delete
    Route::get('/driverDetail-delete/{id}',              [DriverController::class, 'deleteDriver'])->name('Driver.delete');




    //================ transport

    Route::get('/transport', [TransportController::class, 'index'])->name('Transport');

    Route::get('/transport-list', [TransportController::class, 'getTransports'])->name('Transport.list');

    // add
    Route::post('/add-transport',                     [TransportController::class, 'addTransport'])->name('Transport.add');

    // edit
    Route::get('/edit-transport/{id}',                [TransportController::class, 'editTransport'])->name('Transport.edit');

    // update
    Route::get('/update-transport',                   [TransportController::class, 'updateTransport'])->name('Transportasd.update');

    //  delete
    Route::get('/transport-delete/{id}',              [TransportController::class, 'deleteTransport'])->name('Transport.delete');





    //================ Customer

    Route::get('/customer', [CustomerController::class, 'index'])->name('Customer');

    Route::get('/customers-list', [CustomerController::class, 'getCustomers'])->name('customer.list');

    // add customer
    Route::post('/add-customer',                     [CustomerController::class, 'addCustomer'])->name('customer.add');

    // edit customer
    Route::get('/edit-customer/{id}',                [CustomerController::class, 'editCustomer'])->name('customer.edit');

    // update customer
    Route::get('/update-customer',                   [CustomerController::class, 'updateCustomer'])->name('customer.update');

    // customer delete
    Route::get('/customer-delete/{id}',              [CustomerController::class, 'deleteCustomer'])->name('customer.delete');




    //================ CustomerLISt

    Route::get('/customer-list', [CustomerController::class, 'customerListPage'])->name('CustomerList');

    Route::get('/customerList-list', [CustomerController::class, 'getcustomerList'])->name('customerlist.list');





    //================ dtn

    Route::get('/dtn', [DtnController::class, 'index'])->name('dtn');

    Route::get('/dtn-list', [DtnController::class, 'getDtn'])->name('dtn.list');

    // add customer
    Route::post('/add-dtn',                     [DtnController::class, 'addDtn'])->name('dtn.add');

    // edit customer
    Route::get('/edit-dtn/{id}',                [DtnController::class, 'editDtn'])->name('dtn.edit');

    // update Dtn
    Route::get('/update-dtn',                   [DtnController::class, 'updateDtn'])->name('dtn.update');

    // Dtn delete
    Route::get('/dtn-delete/{id}',              [DtnController::class, 'deleteDtn'])->name('dtn.delete');







    //================ branch



    Route::get('/branch', [BranchController::class, 'index'])->name('branch');

    // change the user to branch


    Route::get('/branch-inventory-list', [BranchController::class, 'getBranchInventory'])->name('Branchinventory.list');

    Route::get('/branch-sale-list', [BranchController::class, 'getBranchSale'])->name('Branchsale.list');


    Route::get('/branches-list', [BranchController::class, 'getBranch'])->name('branch.list');

    // add branch
    Route::post('/add-branch',       [BranchController::class, 'addBranch'])->name('branch.add');

    // detail branch
    Route::get('/branch-detail/{id}',  [BranchController::class, 'detailBranch'])->name('branch.detail');

    // edit branch
    Route::get('/edit-branch/{id}',  [BranchController::class, 'editBranch'])->name('branch.edit');

    // update branch
    Route::get('/update-branch',     [BranchController::class, 'updateBranch'])->name('branch.update');

    // branch delete
    Route::get('/branch-delete/{id}',[BranchController::class, 'deleteBranch'])->name('branch.delete');




    //================ Inventory

     Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');

     // change the Inventory


     Route::get('/inventory-list', [InventoryController::class, 'getInventory'])->name('inventory.list');

     // add
     Route::post('/add-inventory', [InventoryController::class, 'addinventory'])->name('inventory.add');

    //  // edit
     Route::get('/edit-inventory/{id}',[InventoryController::class, 'editinventory'])->name('inventory.edit');

    //  // update
     Route::post('/update-inventory', [InventoryController::class, 'updateinventory'])->name('inventory.update');

     Route::get('/inventory-delete/{id}', [InventoryController::class, 'deleteinventory'])->name('inventory.delete');








    //================ Inventory Category

    Route::get('/inventoryCategory', [InventoryCategoryController::class, 'index'])->name('CAtegory');

    // change the InventoryCategory


    Route::get('/inventoryCategory-list', [InventoryCategoryController::class, 'getInventoryCategory'])->name('inventoryCategory.list');

    // add
    Route::post('/add-inventoryCategory', [InventoryCategoryController::class, 'addinventoryCategory'])->name('inventoryCategory.add');

   //  // edit
    Route::get('/edit-inventoryCategory/{id}',[InventoryCategoryController::class, 'editinventoryCategory'])->name('inventoryCategory.edit');

   //  // update
    Route::post('/update-inventoryCategory', [InventoryCategoryController::class, 'updateinventoryCategory'])->name('inventoryCategory.update');

    Route::get('/inventoryCategory-delete/{id}', [InventoryCategoryController::class, 'deleteinventoryCategory'])->name('inventoryCategory.delete');








    // --------------=========Sub Admin


    //================ dtn  fuel

    Route::get('/dtn-fuel', [DtnFuelController::class, 'index'])->name('dtnFuel');

    Route::get('/dtn-fuel-list', [DtnFuelController::class, 'getFuelDtn'])->name('GetFuel.list');




    //================ dtn  bol

    Route::get('/dtn-bol', [DtnFuelController::class, 'dtnbol'])->name('dtnbol');

    Route::get('/dtn-bol-list', [DtnFuelController::class, 'getbolDtn'])->name('getbolDtn.list');



    //================ dtn eft

    Route::get('/dtn-eft', [DtnFuelController::class, 'dtneft'])->name('dtneft');

    Route::get('/dtn-eft-list', [DtnFuelController::class, 'geteftDtn'])->name('dtneft.list');




    //================ purchase sale overview

    Route::get('/purchase-sale', [PurchaseSaleController::class, 'purchaseSale'])->name('purchaseSale');

    Route::get('/purchase-sale-list', [PurchaseSaleController::class, 'getpurchaseSale'])->name('purchaseSale.list');





    // =============== sales

    Route::get('/sales', [SaleController::class, 'index'])->name('sale.index');

    Route::get('/invoice/{sale}', [SaleController::class, 'show'])->name('invoice.show');

    Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');



    // === orders assign to driver


    Route::get('/order-to-driver', [OrderAssignController::class, 'index'])->name('orderDriver.index');

    Route::get('/order-to-driver-list', [OrderAssignController::class, 'list'])->name('orderDriver.list');


    // assign order
   Route::get('/edit-assign-order/{id}',[OrderAssignController::class, 'editAssignOrder'])->name('Assign order.edit');

    // update order
    Route::post('/update-order-assign', [OrderAssignController::class, 'updateAssignOrder'])->name('Assign.update');

    //  order status
   Route::get('/edit-order-status/{id}',[OrderAssignController::class, 'editOrderStatus'])->name('Statusorder.edit');

    // update order
    Route::post('/update-order-status', [OrderAssignController::class, 'updateOrderStatus'])->name('Statusorder.update');

    //  order status
   Route::get('/edit-order-company/{id}',[OrderAssignController::class, 'editOrderCompany'])->name('editOrderCompany.edit');

    // update order
    Route::post('/update-order-company', [OrderAssignController::class, 'updateOrderCompany'])->name('editOrderCompany.update');





    /// ==admin-delivery-ticket-show/
    Route::get('/admin-delivery-ticket-show/{id}',[OrderAssignController::class, 'adminDeliveryTicketShow'])->name('adminDeliveryTicketShow.edit');



    //================ admin split-load

    Route::get('/admin-split-load', [AdminSplitLoadController::class, 'index'])->name('adminsplit-load');

    Route::get('/admin-split-load-list', [AdminSplitLoadController::class, 'getSplitLoad'])->name('admin.list');





    // =================== user attendance

      // index
      Route::get('/user-attendance', [AttendanceController::class,'index'])->name('user-attandace');

      // load user data
      Route::get('/user-dashboard-data', [AttendanceController::class,'loadData'])->name('load-data');








    // ========  sub admin inventory review

    Route::get('/inventory-branch', [SubAdminInventoryController::class, 'inventoryBranch'])->name('inventory.Branch');

    Route::get('/inventory-list-branch', [SubAdminInventoryController::class, 'inventoryListBranch'])->name('inventory.listBranch');









    // ========  supplier


    // inventory review

    Route::get('/supplier-inventory-refill', [SupplierInventoryController::class, 'view'])->name('inventory.index');

    Route::get('/supplier-inventory-list', [SupplierInventoryController::class, 'getSupplierInventory']);


   // edit branch
    Route::get('edit-inventory-refill/{id}',[SupplierInventoryController::class, 'editinventoryRefill']);

   // update branch
    Route::post('/supplier-refill-inventory', [SupplierInventoryController::class, 'updateinventoryRefill']);




     // === delivery approval

     Route::get('/order-deliver-approval', [OrderApprovalController::class, 'index']);

     Route::get('/order-deliver-approval-list', [OrderApprovalController::class, 'list']);



    // edit delivery approval
    Route::get('/edit-order-deliver/{id}',[OrderApprovalController::class, 'editOrderDelivery']);

    // update  delivery approval
    Route::post('/update-order-deliver', [OrderApprovalController::class, 'updateOrderDelivery']);




    //================ Credit cards

    Route::get('/credit-cards', [CustomerController::class, 'creditCard'])->name('credit');

    // change the credit


    Route::get('/credit-cards-list', [CustomerController::class, 'getcreditCard'])->name('credit.list');

    // add
    Route::post('/add-credit-cards', [CustomerController::class, 'addcreditCard'])->name('credit.add');

   //  // edit
    Route::get('/edit-credit-cards/{id}',[CustomerController::class, 'editcreditCard'])->name('credit.edit');

   //  // update
    Route::post('/update-credit-cards', [CustomerController::class, 'updatecreditCard'])->name('credit.update');

    Route::get('/credit-cards-delete/{id}', [CustomerController::class, 'deletecreditCard'])->name('credit.delete');



    // supplier driver detail




    //================ driver supplier

    Route::get('/driver-supplier', [DriverSupplierController::class, 'index'])->name('Driversupplier');

    Route::get('/driver-supplier-list', [DriverSupplierController::class, 'getSupplierDrivers'])->name('drivesupplierr.list');

    // addSupplier driver
    Route::post('/add-driver-supplier',                     [DriverSupplierController::class, 'addSupplierDriver'])->name('Driversupplier.add');

    // editSupplier Driver
    Route::get('/edit-driver-supplier/{id}',                [DriverSupplierController::class, 'editSupplierDriver'])->name('Driversupplier.edit');

    // update Supplier Driver
    Route::get('/update-driver-supplier',                   [DriverSupplierController::class, 'updateSupplierDriver'])->name('Driverasd-supplier.update');

    // Driver Supplier delete
    Route::get('/driver-supplier-delete/{id}',              [DriverSupplierController::class, 'deleteSupplierDriver'])->name('Driversupplier.delete');









    // ========================= Customer


    // ===   Order


    Route::get('/order', [OrderController::class, 'index'])->name('order');

    // list
    Route::get('/order-list', [OrderController::class, 'getOrder'])->name('order.list');

    //add-order

    Route::post('/add-order', [OrderController::class, 'addOrder'])->name('order.add');



    // ==============driver


    Route::get('/driver-order', [DriverOrderController::class, 'index'])->name('driverOrder.index');

    Route::get('/driver-order-list', [DriverOrderController::class, 'list'])->name('.list');


    // assign order
   Route::get('/edit-driver-order/{id}',[DriverOrderController::class, 'editDriverOrder'])->name('driverOrder.edit');

    // update order
    Route::post('/update-driver-order', [DriverOrderController::class, 'updateDriverOrder'])->name('driverOrder.update');






    // = ============ driver tciker    //
    Route::get('/driver-ticket/{id}', [DriverOrderController::class, 'ticket'])->name('ticket.index');

    Route::post('/submit', [DriverOrderController::class, 'store']);




    //================ split-load

    Route::get('/split-load', [SplitLoadController::class, 'index'])->name('split-load');

    Route::get('/split-load-list', [SplitLoadController::class, 'getSplitLoad'])->name('split load.list');

    // add split-load
    Route::post('/add-split-load',                     [SplitLoadController::class, 'addSplitLoad'])->name('split load.add');






    // ================== invoice

    Route::get('/invoices/{id}', [InvoiceController::class, 'generate'])->name('invoice.update');

    // list
    Route::get('/invoice-list', [InvoiceController::class, 'getInvoice'])->name('invoice.list');

    //add-invoice

    Route::post('/add-invoice', [InvoiceController::class, 'addInvoice'])->name('invoice.add');

    Route::get('/invoice-pdf/{id}', [InvoiceController::class, 'generatePdf'])->name('invoice.pdf');


    Route::get('/export-invoice/{id}', [InvoiceController::class, 'exportInvoice'])->name('export.invoice');

    Route::get('/all-export-invoice', [InvoiceController::class, 'exportAllInvoices'])->name('allexport.invoice');



    // ================== driver payment

    Route::get('/driver-payment', [DriverPaymentController::class, 'generate'])->name('Driver.update');

    // list
    Route::get('/driver-list', [DriverPaymentController::class, 'getDriver'])->name('Driver.list');

    //add-invoice

    Route::post('/add-driver', [DriverPaymentController::class, 'addDriver'])->name('sad.add');


});
