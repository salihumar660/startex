@include('admin.component.header')
{{-- @include('admin.component.style') --}}
@include('admin.component.topnav')
@include('admin.component.navbar')




<div class="content-body">
    <div class="container-fluid mt-3">

        <div class="row">

            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-1">
                    <div class="card-body">
                        <h3 class="card-title text-white">Customers</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{$customers}}</h2>
                            {{-- <p class="text-white mb-0">Jan - March 2019</p> --}}
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                    </div>
                </div>
            </div>

        </div>


        <div class="row mt-4">
            <div class="col">
                <div class="card" style="overflow:auto; width:100% !important;">
                    <div class="card-header">
                        <div  class="col-sm-12" style="background:white;  display: flex;  flex-wrap: wrap; flex-direction: row; justify-content: space-between;">

                            <p style="margin-top: 14px;"><i class="fa fa-user"></i>  <button class="btn btn-sm  btn-info ml-2 my-3 add" type="button">add customer</button></p>


                            <form id="filter-form" style="display:flex; align-items:center;  flex-wrap: nowrap; justify-content: space-between; margin-bottom: 0px;">

                                <label for="from_date" class="me-2 h4"  ></label>
                                <input type="date" id="from_date"class="me-2 form-control"   name="from_date"  style="width:40%;">

                                <label for="to_date" class="me-2 h4" >-</label>
                                <input type="date" id="to_date" class="me-2 form-control" name="to_date"  style="width:40%;">

                                <button type="submit" class=" me-2 btn btn-primary" style="padding: 9px;"><i class="fas fa-check"></i></button>

                            </form>

                        </div>

                    </div>


                    <div class="card-body" v-cloak>

                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>success</strong> &nbsp; {{ session()->get('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif



                        <div class="table-responsive">
                            <table class="table table-hover customer-listing table-listing table-hover " style=" width:100%;">
                                <thead>
                                    <tr>

                                        <th>id</th>
                                        <th>name</th>
                                        <th>email</th>

                                        <th>created_at</th>
                                        <th>action</th>

                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>
                        </div>



                    </div>


                </div>
            </div>
        </div>




          {{-- add customer --}}
          <div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">add customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-dark">
                        <form id="addCustomerForm" enctype="multipart/form-data">
                            <div id="sending-message" class="text-danger fw-bold"></div>
                            <br>
                            <div class="row d-flex justify-content-center align-items-center bg-light">
                                <div class="form-group col-md-6">


                                    <label class="control-label">Name</label>
                                    <input type="text" name="user_name" id="user_name" class="form-control" required>

                                </div>
                                <div class="form-group col-md-6">

                                    <label class="control-label">Email *</label>
                                    <input type="email" name="user_email" id="user_email" class="form-control" required>

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Password *</label>
                                    <input type="password" name="user_password" id="user_password" class="form-control" required>
                                </div>
                                {{-- <div class="form-group col-md-6">
                                    <label class="control-label">Customer #</label>
                                    <input type="text" name="user_customer" id="user_customer" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Account active</label>
                                    <input type="text" name="user_account_active" id="user_account_active" class="form-control" required>
                                </div> --}}
                                <div class="form-group col-md-6">
                                    <label class="control-label">Address</label>
                                    <input type="text" name="user_address" id="user_address" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">City</label>
                                    <input type="text" name="user_city" id="user_city" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">State</label>
                                    <input type="text" name="user_state" id="user_state" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Zip</label>
                                    <input type="text" name="user_zip" id="user_zip" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Zone</label>
                                    <input type="text" name="user_zone" id="user_zone" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label">Card id</label>
                                    <input type="text" name="user_card_id" id="user_card_id" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Pin</label>
                                    <input type="text" name="user_pin" id="user_pin" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label">Miles</label>
                                    <input type="text" name="user_miles" id="user_miles" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">User Pin</label>
                                    <input type="text" name="user_userPin" id="user_userPin" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label">Access</label>
                                    <input type="text" name="user_access" id="user_access" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Phone</label>
                                    <input type="text" name="user_phone" id="user_phone" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label">Fax</label>
                                    <input type="text" name="user_fax" id="user_fax" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label">Cell</label>
                                    <input type="text" name="user_cell" id="user_cell" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Cus. Group</label>
                                    <select name="user_cus_group" id="user_cus_group" class="form-select">
                                        <option value="" disabled selected>selelct</option>
                                        <option value="Abbas Ali"  >Abbas Ali
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Opening Bal.</label>
                                    <input type="text" name="user_openingBal" id="user_openingBal" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Current Bal.</label>
                                    <input type="text" name="user_currentBal" id="user_currentBal" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Credit limit</label>
                                    <input type="text" name="user_credit_limit" id="user_credit_limit" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="postCredit">Post credit card in each invoice</label>
                                    <input type="checkbox" name="user_post_credit" id="user_post_credit" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Credit type</label>
                                    <select name="user_credit_type" id="user_credit_type" class="form-select">
                                        <option value="" disabled selected>selelct</option>
                                        <option value="Visa"  >Visa
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="postCredit">Credit Days</label>
                                    <input type="text" name="user_credit_days" id="user_credit_days" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="postCredit">Accept split order</label>
                                    <input type="checkbox" name="user_accept_split_order" id="user_accept_split_order" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="postCredit">Tranport included in price</label>
                                    <input type="text" name="user_transport_include_in_price" id="user_transport_include_in_price" class="form-control" required>
                                </div>
                            </div>

                            <hr>

                            <div class="row d-flex justify-content-center align-items-center bg-light">
                                <div class="form-group col-md-6">
                                    <label class="postCredit">Peach</label>
                                    <input type="text" name="user_peach" id="user_peach" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="postCredit">Income</label>
                                    <input type="text" name="user_income" id="user_income" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="postCredit">Acc. rec</label>
                                    <input type="text" name="user_acc_rec" id="user_acc_rec" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="postCredit">Acc. pay</label>
                                    <input type="text" name="user_acc_pay" id="user_acc_pay" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="postCredit">Brand invoice Acc</label>
                                    <input type="text" name="user_branch_invoice_acc" id="user_branch_invoice_acc" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="postCredit">Card pin</label>
                                    <input type="text" name="user_card_pin" id="user_card_pin" class="form-control" required>
                                </div>
                            </div>
                            <hr>

                            <div class="row d-flex justify-content-center align-items-center bg-light">
                                <div class="form-group col-md-6">
                                    <label class="postCredit">Brand</label>
                                    <input type="text" name="user_brand" id="user_brand" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="postCredit">Terminal</label>
                                    <input type="text" name="user_terminal" id="user_terminal" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="postCredit">Distributor</label>
                                    <input type="text" name="user_distributor" id="user_distributor" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="postCredit">Branch transport</label>
                                    <input type="text" name="user_branch_transport" id="user_branch_transport" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="postCredit">Credit company</label>
                                    <input type="text" name="user_credit_company" id="user_credit_company" class="form-control" required>
                                </div>

                            </div>
                            <hr>
                            <div class="row d-flex justify-content-center align-items-center bg-light">
                                <div class="form-group col-md-6">
                                    <label class="postCredit">Contract date</label>
                                    <input type="date" name="user_contract_date" id="user_contract_date" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="postCredit">Expiry date</label>
                                    <input type="date" name="user_expiry_date" id="user_expiry_date" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="postCredit">Set price</label>
                                    <input type="text" name="user_set_price" id="user_set_price" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="postCredit">But pass</label>
                                    <input type="text" name="user_buy_pass" id="user_buy_pass" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="postCredit">Transport</label>
                                    <input type="text" name="user_transport" id="user_transport" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="postCredit">Sign maintanance</label>
                                    <input type="text" name="user_sign_maintanance" id="user_sign_maintanance" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="postCredit">Invested by</label>
                                    <input type="text" name="user_invested_by" id="user_invested_by" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="postCredit">Owner</label>
                                    <input type="text" name="user_owner" id="user_owner" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="postCredit">Salesman</label>
                                    <input type="text" name="user_salesman" id="user_salesman" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="postCredit">Cont. person</label>
                                    <input type="text" name="user_cont_person" id="user_cont_person" class="form-control" required>
                                </div>


                            </div>
                            <hr>
                            <div class="row d-flex justify-content-center align-items-center bg-light">
                                <div class="form-group col-md-4">
                                    <label class="postCredit">Guiroga fuel Rate</label>
                                    <input type="text" name="user_quiroga_fuelRate" id="user_quiroga_fuelRate" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="postCredit">Guiroga Diesel</label>
                                    <input type="text" name="user_quiroga_diesel" id="user_quiroga_diesel" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="postCredit">Guiroga Flat</label>
                                    <input type="text" name="user_quiroga_flat" id="user_quiroga_flat" class="form-control" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="postCredit">Startex gas And oil fuel Rate</label>
                                    <input type="text" name="user_startex_gas_and_oil_fuelRate" id="user_startex_gas_and_oil_fuelRate" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="postCredit">Startex gas And oil Diesel</label>
                                    <input type="text" name="user_startex_gas_and_oil_diesel" id="user_startex_gas_and_oil_diesel" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="postCredit">Startex gas And oil Flat</label>
                                    <input type="text" name="user_startex_gas_and_oil_flat" id="user_startex_gas_and_oil_flat" class="form-control" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="postCredit">Texas trans Eastern fuel Rate</label>
                                    <input type="text" name="user_texas_trans_eastern_fuelRate" id="user_texas_trans_eastern_fuelRate" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="postCredit">Texas trans Eastern Diesel</label>
                                    <input type="text" name="user_texas_trans_eastern_diesel" id="user_texas_trans_eastern_diesel" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="postCredit">Texas trans Eastern Flat</label>
                                    <input type="text" name="user_texas_trans_eastern_flat" id="user_texas_trans_eastern_flat" class="form-control" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="postCredit">Coastal transport fuel Rate</label>
                                    <input type="text" name="user_coastal_transport_fuelRate" id="user_coastal_transport_fuelRate" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="postCredit">Coastal transport Diesel</label>
                                    <input type="text" name="user_coastal_transport_diesel" id="user_coastal_transport_diesel" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="postCredit">Coastal transport Flat</label>
                                    <input type="text" name="user_coastal_transport_flat" id="user_coastal_transport_flat" class="form-control" required>
                                </div>


                            </div>


                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">submit</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




        {{-- update customer --}}
        <div class="modal fade" id="editCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Customer</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-dark">
                        <input type="hidden" name="customer_id" id="customer_id">
                        <div id="update-message" class="text-danger fw-bold"></div>
                        <div class="row d-flex justify-content-center align-items-center bg-light">

                            <div class="form-group col-md-6">
                                <label class="control-label">Name</label>
                                <input type="text" name="update_name" id="update_name" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Email *</label>
                                <input type="email" name="update_email" id="update_email" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Password *</label>
                                <input type="password" name="update_password" id="update_password" class="form-control">
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <label class="control-label">Customer #</label>
                                <input type="text" name="update_customer" id="update_customer" class="form-control">
                            </div> --}}
                            {{-- <div class="form-group col-md-6">
                                <label class="control-label">Account Active</label>
                                <input type="text" name="update_account_active" id="update_account_active" class="form-control">
                            </div> --}}
                            <div class="form-group col-md-6">
                                <label class="control-label">Address</label>
                                <input type="text" name="update_address" id="update_address" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">City</label>
                                <input type="text" name="update_city" id="update_city" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">State</label>
                                <input type="text" name="update_state" id="update_state" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Zip</label>
                                <input type="text" name="update_zip" id="update_zip" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Zone</label>
                                <input type="text" name="update_zone" id="update_zone" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Card ID</label>
                                <input type="text" name="update_card_id" id="update_card_id" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Pin</label>
                                <input type="text" name="update_pin" id="update_pin" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Miles</label>
                                <input type="text" name="update_miles" id="update_miles" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">User  Pin</label>
                                <input type="text" name="update_userPin" id="update_userPin" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Access</label>
                                <input type="text" name="update_access" id="update_access" class="form-control">
                            </div>
                            <div class=" form-group col-md-6">
                                <label class="control-label">Phone</label>
                                <input type="text" name="update_phone" id="update_phone" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Fax</label>
                                <input type="text" name="update_fax" id="update_fax" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Cell</label>
                                <input type="text" name="update_cell" id="update_cell" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Cus. Group</label >
                                <select name="update_cus_group" id="update_cus_group" class="form-select">
                                    <option value="" disabled selected>select</option>
                                    <option value="Abbas Ali">Abbas Ali</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Opening Bal.</label>
                                <input type="text" name="update_openingBal" id="update_openingBal" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Current Bal.</label>
                                <input type="text" name="update_currentBal" id="update_currentBal" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Credit Limit</label>
                                <input type="text" name="update_credit_limit" id="update_credit_limit" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Post Credit Card in Each Invoice</label>
                                <input type="checkbox" name="update_post_credit" id="update_post_credit" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Credit Type</label>
                                <select name="update_credit_type" id="update_credit_type" class="form-select">
                                    <option value="" disabled selected>select</option>
                                    <option value="Visa">Visa</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Credit Days</label>
                                <input type="text" name="update_credit_days" id="update_credit_days" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Accept Split Order</label>
                                <input type="checkbox" name="update_accept_split_order" id="update_accept_split_order" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Transport Included in Price</label>
                                <input type="text" name="update_transport_include_in_price" id="update_transport_include_in_price" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Peach</label>
                                <input type="text" name="update_peach" id="update_peach" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Income</label>
                                <input type="text" name="update_income" id="update_income" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Acc. Rec</label>
                                <input type="text" name="update_acc_rec" id="update_acc_rec" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Acc. Pay</label>
                                <input type="text" name="update_acc_pay" id="update_acc_pay" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Brand Invoice Acc</label>
                                <input type="text" name="update_branch_invoice_acc" id="update_branch_invoice_acc" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Card Pin</label>
                                <input type="text" name="update_card_pin" id="update_card_pin" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Brand</label>
                                <input type="text" name="update_brand" id="update_brand" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Terminal</label>
                                <input type="text" name="update_terminal" id="update_terminal" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Distributor</label>
                                <input type="text" name="update_distributor" id="update_distributor" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Branch Transport</label>
                                <input type ="text" name="update_branch_transport" id="update_branch_transport" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Credit Company</label>
                                <input type="text" name="update_credit_company" id="update_credit_company" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Contract Date</label>
                                <input type="date" name="update_contract_date" id="update_contract_date" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Expiry Date</label>
                                <input type="date" name="update_expiry_date" id="update_expiry_date" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Set Price</label>
                                <input type="text" name="update_set_price" id="update_set_price" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Buy Pass</label>
                                <input type="text" name="update_buy_pass" id="update_buy_pass" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Transport</label>
                                <input type="text" name="update_transport" id="update_transport" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Sign Maintanance</label>
                                <input type="text" name="update_sign_maintanance" id="update_sign_maintanance" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Invested By</label>
                                <input type="text" name="update_invested_by" id="update_invested_by" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Owner</label>
                                <input type="text" name="update_owner" id="update_owner" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Salesman</label>
                                <input type="text" name="update_salesman" id="update_salesman" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="postCredit">Cont. Person</label>
                                <input type="text" name="update_cont_person" id="update_cont_person" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="postCredit">Guiroga Fuel Rate</label>
                                <input type="text" name="update_quiroga_fuelRate" id="update_quiroga_fuelRate" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="postCredit">Guiroga Diesel</label>
                                <input type="text" name="update_quiroga_diesel" id="update_quiroga_diesel" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="postCredit">Guiroga Flat</label>
                                <input type="text" name="update_quiroga_flat" id="update_quiroga_flat" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="postCredit">Startex Gas And Oil Fuel Rate</label>
                                <input type="text" name="update_startex_gas_and_oil_fuelRate" id="update_startex_gas_and_oil_fuelRate" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="postCredit">Startex Gas And Oil Diesel</label>
                                <input type="text" name="update_startex_gas_and_oil_diesel" id="update_startex_gas_and_oil_diesel" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="postCredit">Startex Gas And Oil Flat</label>
                                <input type="text" name="update_startex_gas_and_oil_flat" id="update_startex_gas_and_oil_flat" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label class ="postCredit">Texas Trans Eastern Fuel Rate</label>
                                <input type="text" name="update_texas_trans_eastern_fuelRate" id="update_texas_trans_eastern_fuelRate" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="postCredit">Texas Trans Eastern Diesel</label>
                                <input type="text" name="update_texas_trans_eastern_diesel" id="update_texas_trans_eastern_diesel" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="postCredit">Texas Trans Eastern Flat</label>
                                <input type="text" name="update_texas_trans_eastern_flat" id="update_texas_trans_eastern_flat" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="postCredit">Coastal Transport Fuel Rate</label>
                                <input type="text" name="update_coastal_transport_fuelRate" id="update_coastal_transport_fuelRate" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="postCredit">Coastal Transport Diesel</label>
                                <input type="text" name="update_coastal_transport_diesel" id="update_coastal_transport_diesel" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="postCredit">Coastal Transport Flat</label>
                                <input type="text" name="update_coastal_transport_flat" id="update_coastal_transport_flat" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-lg-right" id="updateBtn">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



@include('admin.component.footer')


<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" defer></script>

<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js" defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">





<script type="text/javascript">
    $(function() {
        setTimeout(function() {
            var table = $('.customer-listing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/customers-list') }}",
                    data: function(d) {
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                    }
                },

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'created',
                        name: 'created'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [[0, 'desc']],
            });

            $('#filter-form').on('submit', function(e) {
                e.preventDefault();
                $('.customer-listing').DataTable().ajax.reload();
            });

        }, 2000);
    });
</script>




<script>
   $(document).ready(function() {
    $('.add').click(function() {
        $('#addCustomer').modal('show');
    });

    $('#addCustomerForm').submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var formData = new FormData(form[0]);

        $('#sending-message').text('Processing request, please wait...');

        $.ajax({
            url: "{{ url('/add-customer') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#sending-message').text(response.success);
                // Reload the DataTable or update the UI as necessary
                $('.customer-listing').DataTable().ajax.reload();
            },
            error: function(xhr) {
                $('#sending-message').text('Error occurred. Please try again.');
                console.log(xhr.responseText);
            },
            complete: function() {
                $('#addCustomer').modal('hide');
                $('#sending-message').text('');
            }
        });
    });
});

</script>



<script>
    $(document).ready(function() {
        // Load customer data into modal
        $(document).on('click', '.edit', function() {
            var customerId = $(this).val(); // Get the customer ID from the button value
            $('#editCustomer').modal('show'); // Show the modal

            $.ajax({
                type: "GET",
                url: "edit-customer/" + customerId, // Fetch customer data from the server
                success: function(response) {
                    console.log(response);

                    // Populate the modal fields with customer data
                    $('#customer_id').val(customerId);
                    $('#update_name').val(response.customer.name);
                    $('#update_email').val(response.customer.email);
                    $('#update_customer').val(response.customer.customer_detail.customer); // Assuming the field name
                    $('#update_account_active').val(response.customer.customer_detail.account_active); // Assuming the field name
                    $('#update_address').val(response.customer.customer_detail.address);
                    $('#update_city').val(response.customer.customer_detail.city);
                    $('#update_state').val(response.customer.customer_detail.state);
                    $('#update_zip').val(response.customer.customer_detail.zip);
                    $('#update_zone').val(response.customer.customer_detail.zone);
                    $('#update_card_id').val(response.customer.customer_detail.card_id);
                    $('#update_pin').val(response.customer.customer_detail.pin);
                    $('#update_miles').val(response.customer.customer_detail.miles);
                    $('#update_userPin').val(response.customer.customer_detail.user_pin);
                    $('#update_access').val(response.customer.customer_detail.access);
                    $('#update_phone').val(response.customer.customer_detail.phone);
                    $('#update_fax').val(response.customer.customer_detail.fax);
                    $('#update_cell').val(response.customer.customer_detail.cell);
                    $('#update_cus_group').val(response.customer.customer_detail.cus_group);
                    $('#update_openingBal').val(response.customer.customer_detail.opening_bal);
                    $('#update_currentBal').val(response.customer.customer_detail.current_bal);
                    $('#update_credit_limit').val(response.customer.customer_detail.credit_limit);
                    $('#update_post_credit').prop('checked', response.customer.customer_detail.post_credit_card_in_each_invoice);
                    $('#update_credit_type').val(response.customer.customer_detail.credit_type);
                    $('#update_credit_days').val(response.customer.customer_detail.credit_days);
                    $('#update_accept_split_order').prop('checked', response.customer.customer_detail.accept_split_order);
                    $('#update_transport_include_in_price').val(response.customer.customer_detail.transport_include_in_price);
                    $('#update_peach').val(response.customer.customer_detail.peach);
                    $('#update_income').val(response.customer.customer_detail.income);
                    $('#update_acc_rec').val(response.customer.customer_detail.acc_rec);
                    $('#update_acc_pay').val(response.customer.customer_detail.acc_pay);
                    $('#update_branch_invoice_acc').val(response.customer.customer_detail.brand_invoice_acc);
                    $('#update_card_pin').val(response.customer.customer_detail.card_pin);
                    $('#update_brand').val(response.customer.customer_detail.brand);
                    $('#update_terminal').val(response.customer.customer_detail.terminal);
                    $('#update_distributor').val(response.customer.customer_detail.distributor);
                    $('#update_branch_transport').val(response.customer.customer_detail.Brand_transport);
                    $('#update_credit_company').val(response.customer.customer_detail.credit_company);
                    $('#update_contract_date').val(response.customer.customer_detail.contract_date);
                    $('#update_expiry_date').val(response.customer.customer_detail.expiry_date);
                    $('#update_set_price').val(response.customer.customer_detail.set_price);
                    $('#update_buy_pass').val(response.customer.customer_detail.buy_pass);
                    $('#update_transport').val(response.customer.customer_detail.transport);
                    $('#update_sign_maintanance').val(response.customer.customer_detail.sign_maintanance);
                    $('#update_invested_by').val(response.customer.customer_detail.invested_by);
                    $('#update_owner').val(response.customer.customer_detail.owner);
                    $('#update_salesman').val(response.customer.customer_detail.salesman);
                    $('#update_cont_person').val(response.customer.customer_detail.cont_person);
                    $('#update_quiroga_fuelRate').val(response.customer.customer_detail.quiraga_fuelRate);
                    $('#update_quiroga_diesel').val(response.customer.customer_detail.quiraga_dieselRate);
                    $('#update_quiroga_flat').val(response.customer.customer_detail.quiraga_flatRate);
                    $('#update_startex_gas_and_oil_fuelRate').val(response.customer.customer_detail.startex_gas_oil_fuelRate);
                    $('#update_startex_gas_and_oil_diesel').val(response.customer.customer_detail.startex_gas_oil_dieselRate);
                    $('#update_startex_gas_and_oil_flat').val(response.customer.customer_detail.startex_gas_oil_flatRate);
                    $('#update_texas_trans_eastern_fuelRate').val(response.customer.customer_detail.texas_trans_fuelRate);
                    $('#update_texas_trans_eastern_diesel').val(response.customer.customer_detail.texas_trans_dieselRate);
                    $('#update_texas_trans_eastern_flat').val(response.customer.customer_detail.texas_trans_flatRate);
                    $('#update_coastal_transport_fuelRate').val(response.customer.customer_detail.coastal_transport_fuelRate);
                    $('#update_coastal_transport_diesel').val(response.customer.customer_detail.coastal_transport_dieselRate);
                    $('#update_coastal_transport_flat').val(response.customer.customer_detail.coastal_transport_flatRate);
                }
            });
        });

        // Handle update button click
        $('#updateBtn').on('click', function() {
            var customerId = $('#customer_id').val();
            var name = $('#update_name').val();
            var email = $('#update_email').val();
            var password = $('#update_password').val(); // Capture password if provided
            var customer_number = $('#update_customer').val();
            var account_active = $('#update_account_active').val();
            var address = $('#update_address').val();
            var city = $('#update_city').val();
            var state = $('#update_state').val();
            var zip = $('#update_zip').val();
            var zone = $('#update_zone').val();
            var card_id = $('#update_card_id').val();
            var pin = $('#update_pin').val();
            var miles = $('#update_miles').val();
            var user_pin = $('#update_userPin').val();
            var access = $('#update_access').val();
            var phone = $('#update_phone').val();
            var fax = $('#update_fax').val();
            var cell = $('#update_cell').val();
            var cus_group = $('#update_cus_group').val();
            var openingBal = $('#update_openingBal').val();
            var currentBal = $('#update_currentBal').val();
            var credit_limit = $('#update_credit_limit').val();
            var post_credit_card_in_each_invoice = $('#update_post_credit').prop('checked');
            var credit_type = $('#update_credit_type').val();
            var credit_days = $('#update_credit_days').val();
            var accept_split_order = $('#update_accept_split_order').prop('checked');
            var transport_include_in_price = $('#update_transport_include_in_price').val();
            var peach = $('#update_peach').val();
            var income = $('#update_income').val();
            var acc_rec = $('#update_acc_rec').val();
            var acc_pay = $('#update_acc_pay').val();
            var brand_invoice_acc = $('#update_branch_invoice_acc').val();
            var card_pin = $('#update_card_pin').val();
            var brand = $('#update_brand').val();
            var terminal = $('#update_terminal').val();
            var distributor = $('#update_distributor').val();
            var brand_transport = $('#update_branch_transport').val();
            var credit_company = $('#update_credit_company').val();
            var contract_date = $('#update_contract_date').val();
            var expiry_date = $('#update_expiry_date').val();
            var set_price = $('#update_set_price').val();
            var buy_pass = $('#update_buy_pass').val();
            var transport = $('#update_transport').val();
            var sign_maintanance = $('#update_sign_maintanance').val();
            var invested_by = $('#update_invested_by').val();
            var owner = $('#update_owner').val();
            var salesman = $('#update_salesman').val();
            var cont_person = $('#update_cont_person').val();
            var quiroga_fuelRate = $('#update_quiroga_fuelRate').val();
            var quiroga_diesel = $('#update_quiroga_diesel').val();
            var quiroga_flat = $('#update_quiroga_flat').val();
            var startex_gas_and_oil_fuelRate = $('#update_startex_gas_and_oil_fuelRate').val();
            var startex_gas_and_oil_diesel = $('#update_startex_gas_and_oil_diesel').val();
            var startex_gas_and_oil_flat = $('#update_startex_gas_and_oil_flat').val();
            var texas_trans_eastern_fuelRate = $('#update_texas_trans_eastern_fuelRate').val();
            var texas_trans_eastern_diesel = $('#update_texas_trans_eastern_diesel').val();
            var texas_trans_eastern_flat = $('#update_texas_trans_eastern_flat').val();
            var coastal_transport_fuelRate = $('#update_coastal_transport_fuelRate').val();
            var coastal_transport_diesel = $('#update_coastal_transport_diesel').val();
            var coastal_transport_flat = $('#update_coastal_transport_flat').val();

            $('#update-message').text('Processing request, please wait...');

            $.ajax({
                url: "{{ url('/update-customer') }}",
                type: 'GET',
                data: {
                    customerId: customerId,
                    name: name,
                    email: email,
                    password: password,
                    customer_number: customer_number,
                    account_active: account_active,
                    address: address,
                    city: city,
                    state: state,
                    zip: zip,
                    zone: zone,
                    card_id: card_id,
                    pin: pin,
                    miles: miles,
                    user_pin: user_pin,
                    access: access,
                    phone: phone,
                    fax: fax,
                    cell: cell,
                    cus_group: cus_group,
                    openingBal: openingBal,
                    currentBal: currentBal ,
                    credit_limit: credit_limit,
                    post_credit_card_in_each_invoice: post_credit_card_in_each_invoice,
                    credit_type: credit_type,
                    credit_days: credit_days,
                    accept_split_order: accept_split_order,
                    transport_include_in_price: transport_include_in_price,
                    peach: peach,
                    income: income,
                    acc_rec: acc_rec,
                    acc_pay: acc_pay,
                    brand_invoice_acc: brand_invoice_acc,
                    card_pin: card_pin,
                    brand: brand,
                    terminal: terminal,
                    distributor: distributor,
                    brand_transport: brand_transport,
                    credit_company: credit_company,
                    contract_date: contract_date,
                    expiry_date: expiry_date,
                    set_price: set_price,
                    buy_pass: buy_pass,
                    transport: transport,
                    sign_maintanance: sign_maintanance,
                    invested_by: invested_by,
                    owner: owner,
                    salesman: salesman,
                    cont_person: cont_person,
                    quiroga_fuelRate: quiroga_fuelRate,
                    quiroga_diesel: quiroga_diesel,
                    quiroga_flat: quiroga_flat,
                    startex_gas_and_oil_fuelRate: startex_gas_and_oil_fuelRate,
                    startex_gas_and_oil_diesel: startex_gas_and_oil_diesel,
                    startex_gas_and_oil_flat: startex_gas_and_oil_flat,
                    texas_trans_eastern_fuelRate: texas_trans_eastern_fuelRate,
                    texas_trans_eastern_diesel: texas_trans_eastern_diesel,
                    texas_trans_eastern_flat: texas_trans_eastern_flat,
                    coastal_transport_fuelRate: coastal_transport_fuelRate,
                    coastal_transport_diesel: coastal_transport_diesel,
                    coastal_transport_flat: coastal_transport_flat
                },
                success: function(response) {
                    // Handle success response
                    $('#editCustomer').modal('hide');
                    $('.customer-listing').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    $('#update-message').text('Error: ' + xhr.responseText);
                },
                complete: function() {
                    $('#update-message').text('');
                }
            });
        });
    });
</script>

