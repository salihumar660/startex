@include('admin.component.header')
@include('admin.component.topnav')
@include('admin.component.navbar')

<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Profile</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-uppercase">Update Profile</h3>
                        <div class="form-validation">
                            <form class="form-valide" action="{{url('/update-user')}}" method="get">

                                <input type="hidden" value="{{$user->id}}" name="userId">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">User Name<span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-username" name="name"
                                        value="{{$user->name}}"
                                        placeholder="Enter a username..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-email">Email <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-email" name="email"
                                        placeholder="Your valid email.."
                                        value="{{$user->email}}"
                                        >

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-password">Password <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Choose a safe one..">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if($user->customerDetail != Null)
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-uppercase">Customer Detail</h3>

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Field</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Customer</td>
                                        <td>{{ $user->customerDetail->customer }}</td>
                                    </tr>
                                    <tr>
                                        <td>User ID</td>
                                        <td>{{ $user->customerDetail->user_id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Account Active</td>
                                        <td>{{ $user->customerDetail->account_active }}</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>{{ $user->customerDetail->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td>{{ $user->customerDetail->city }}</td>
                                    </tr>
                                    <tr>
                                        <td>State</td>
                                        <td>{{ $user->customerDetail->state }}</td>
                                    </tr>
                                    <tr>
                                        <td>Zip</td>
                                        <td>{{ $user->customerDetail->zip }}</td>
                                    </tr>
                                    <tr>
                                        <td>Zone</td>
                                        <td>{{ $user->customerDetail->zone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Card ID</td>
                                        <td>{{ $user->customerDetail->card_id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pin</td>
                                        <td>{{ $user->customerDetail->pin }}</td>
                                    </tr>
                                    <tr>
                                        <td>Miles</td>
                                        <td>{{ $user->customerDetail->miles }}</td>
                                    </tr>
                                    <tr>
                                        <td>User Pin</td>
                                        <td>{{ $user->customerDetail->user_pin }}</td>
                                    </tr>
                                    <tr>
                                        <td>Password</td>
                                        <td>{{ $user->customerDetail->password }}</td>
                                    </tr>
                                    <tr>
                                        <td>Access</td>
                                        <td>{{ $user->customerDetail->access }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{ $user->customerDetail->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Fax</td>
                                        <td>{{ $user->customerDetail->fax }}</td>
                                    </tr>
                                    <tr>
                                        <td>Cell</td>
                                        <td>{{ $user->customerDetail->cell }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $user->customerDetail->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Customer Group</td>
                                        <td>{{ $user->customerDetail->cus_group }}</td>
                                    </tr>
                                    <tr>
                                        <td>Opening Balance</td>
                                        <td>{{ $user->customerDetail->opening_bal }}</td>
                                    </tr>
                                    <tr>
                                        <td>Current Balance</td>
                                        <td>{{ $user->customerDetail->current_bal }}</td>
                                    </tr>
                                    <tr>
                                        <td>Credit Limit</td>
                                        <td>{{ $user->customerDetail->credit_limit }}</td>
                                    </tr>
                                    <tr>
                                        <td>Post Credit Card in Each Invoice</td>
                                        <td>{{ $user->customerDetail->post_credit_card_in_each_invoice }}</td>
                                    </tr>
                                    <tr>
                                        <td>Credit Type</td>
                                        <td>{{ $user->customerDetail->credit_type }}</td>
                                    </tr>
                                    <tr>
                                        <td>Credit Days</td>
                                        <td>{{ $user->customerDetail->credit_days }}</td>
                                    </tr>
                                    <tr>
                                        <td>Accept Split Order</td>
                                        <td>{{ $user->customerDetail->accept_split_order }}</td>
                                    </tr>
                                    <tr>
                                        <td>Transport Included in Price</td>
                                        <td>{{ $user->customerDetail->transport_include_in_price }}</td>
                                    </tr>
                                    <tr>
                                        <td>Peach</td>
                                        <td>{{ $user->customerDetail->peach }}</td>
                                    </tr>
                                    <tr>
                                        <td>Income</td>
                                        <td>{{ $user->customerDetail->income }}</td>
                                    </tr>
                                    <tr>
                                        <td>Accounts Receivable</td>
                                        <td>{{ $user->customerDetail->acc_rec }}</td>
                                    </tr>
                                    <tr>
                                        <td>Accounts Payable</td>
                                        <td>{{ $user->customerDetail->acc_pay }}</td>
                                    </tr>
                                    <tr>
                                        <td>Brand Invoice Account</td>
                                        <td>{{ $user->customerDetail->brand_invoice_acc }}</td>
                                    </tr>
                                    <tr>
                                        <td>Card Pin</td>
                                        <td>{{ $user->customerDetail->card_pin }}</td>
                                    </tr>
                                    <tr>
                                        <td>Brand</td>
                                        <td>{{ $user->customerDetail->brand }}</td>
                                    </tr>
                                    <tr>
                                        <td>Terminal</td>
                                        <td>{{ $user->customerDetail->terminal }}</td>
                                    </tr>
                                    <tr>
                                        <td>Distributor</td>
                                        <td>{{ $user->customerDetail->distributor }}</td>
                                    </tr>
                                    <tr>
                                        <td>Brand Transport</td>
                                        <td>{{ $user->customerDetail->Brand_transport }}</td>
                                    </tr>
                                    <tr>
                                        <td>Credit Company</td>
                                        <td>{{ $user->customerDetail->credit_company }}</td>
                                    </tr>
                                    <tr>
                                        <td>Contract Date</td>
                                        <td>{{ $user->customerDetail->contract_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>Expiry Date</td>
                                        <td>{{ $user->customerDetail->expiry_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>Set Price</td>
                                        <td>{{ $user->customerDetail->set_price }}</td>
                                    </tr>
                                    <tr>
                                        <td>Buy Pass</td>
                                        <td>{{ $user->customerDetail->buy_pass }}</td>
                                    </tr>
                                    <tr>
                                        <td>Transport</td>
                                        <td>{{ $user->customerDetail->transport }}</td>
                                    </tr>
                                    <tr>
                                        <td>Sign Maintenance</td>
                                        <td>{{ $user->customerDetail->sign_maintanance }}</td>
                                    </tr>
                                    <tr>
                                        <td>Invested By</td>
                                        <td>{{ $user->customerDetail->invested_by }}</td>
                                    </tr>
                                    <tr>
                                        <td>Owner</td>
                                        <td>{{ $user->customerDetail->owner }}</td>
                                    </tr>
                                    <tr>
                                        <td>Salesman</td>
                                        <td>{{ $user->customerDetail->salesman }}</td>
                                    </tr>
                                    <tr>
                                        <td>Contact Person</td>
                                        <td>{{ $user->customerDetail->cont_person }}</td>
                                    </tr>
                                    <tr>
                                        <td>Quiraga Fuel Rate</td>
                                        <td>{{ $user->customerDetail->quiraga_fuelRate }}</td>
                                    </tr>
                                    <tr>
                                        <td>Quiraga Diesel Rate</td>
                                        <td>{{ $user->customerDetail->quiraga_dieselRate }}</td>
                                    </tr>
                                    <tr>
                                        <td>Quiraga Flat Rate</td>
                                        <td>{{ $user->customerDetail->quiraga_flatRate }}</td>
                                    </tr>
                                    <tr>
                                        <td>Startex Gas Oil Fuel Rate</td>
                                        <td>{{ $user->customerDetail->startex_gas_oil_fuelRate }}</td>
                                    </tr>
                                    <tr>
                                        <td>Startex Gas Oil Diesel Rate</td>
                                        <td>{{ $user->customerDetail->startex_gas_oil_dieselRate }}</td>
                                    </tr>
                                    <tr>
                                        <td>Startex Gas Oil Flat Rate</td>
                                        <td>{{ $user->customerDetail->startex_gas_oil_flatRate }}</td>
                                    </tr>
                                    <tr>
                                        <td>Texas Transport Fuel Rate</td>
                                        <td>{{ $user->customerDetail->texas_trans_fuelRate }}</td>
                                    </tr>
                                    <tr>
                                        <td>Texas Transport Diesel Rate</td>
                                        <td>{{ $user->customerDetail->texas_trans_dieselRate }}</td>
                                    </tr>
                                    <tr>
                                        <td>Texas Transport Flat Rate</td>
                                        <td>{{ $user->customerDetail->texas_trans_flatRate }}</td>
                                    </tr>
                                    <tr>
                                        <td>Coastal Transport Fuel Rate</td>
                                        <td>{{ $user->customerDetail->coastal_transport_fuelRate }}</td>
                                    </tr>
                                    <tr>
                                        <td>Coastal Transport Diesel Rate</td>
                                        <td>{{ $user->customerDetail->coastal_transport_dieselRate }}</td>
                                    </tr>
                                    <tr>
                                        <td>Coastal Transport Flat Rate</td>
                                        <td>{{ $user->customerDetail->coastal_transport_flatRate }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>



@include('admin.component.footer')
