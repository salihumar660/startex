@php
    $roleId = Auth::user()->role_id;
@endphp

<div class="nk-sidebar">
    <div class="nk-nav-scroll bg-dark">
        <ul class="metismenu bg-dark" id="menu">
            @if ($roleId == 1)
                <li>
                    <a href="{{ url('/dashboard') }}" aria-expanded="false" style="color:white !important;">
                        <i class="icon-speedometer menu-icon" style="color:white !important;"></i>
                        <span class="nav-text">{{ __('SE.dashboard') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/user') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-user" style="color:white !important;"></i>
                        <span class="nav-text">{{ __('SE.user_management') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/customer') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-users" style="color:white !important;"></i>
                        <span class="nav-text">CUSTOMER</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/branch') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-code-branch" style="color:white !important;"></i>
                        <span class="nav-text">REGION</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/credit-cards') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-credit-card" style="color:white !important;"></i>
                        <span class="nav-text">Credit Cards</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/driver') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-clipboard-user" style="color:white !important;"></i>
                        <span class="nav-text"> Driver</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/transport') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-van-shuttle" style="color:white !important;"></i>
                        <span class="nav-text"> Transport</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/dtn-fuel') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-gas-pump" style="color:white !important;"></i>
                        <span class="nav-text">GAS PRICE</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/order-to-driver') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-arrow-up-wide-short" style="color:white !important;"></i>
                        <span class="nav-text">GAS ORDER</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/dtn-bol') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-regular fa-rectangle-list" style="color:white !important;"></i>
                        <span class="nav-text">DTN BOL</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin-split-load') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-truck-ramp-box" style="color:white !important;"></i>
                        <span class="nav-text">Load</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/dtn-eft') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-truck-ramp-box" style="color:white !important;"></i>
                        <span class="nav-text">EFT</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/purchase-sale') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-cash-register" style="color:white !important;"></i>
                        <span class="nav-text">Purchase Sale</span>
                    </a>
                </li>
            @elseif ($roleId == 2)
                <li>
                    <a href="{{ url('/dashboard') }}" aria-expanded="false" style="color:white !important;">
                        <i class="icon-speedometer menu-icon" style="color:white !important;"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/dtn-fuel') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-gas-pump" style="color:white !important;"></i>
                        <span class="nav-text">GAS PRICE</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/order-to-driver') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-arrow-up-wide-short" style="color:white !important;"></i>
                        <span class="nav-text">GAS ORDER</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/dtn-bol') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-regular fa-rectangle-list" style="color:white !important;"></i>
                        <span class="nav-text">DTN BOL</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin-split-load') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-truck-ramp-box" style="color:white !important;"></i>
                        <span class="nav-text">Load</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/credit-cards') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-truck-ramp-box" style="color:white !important;"></i>
                        <span class="nav-text">Credit Cards</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/dtn-eft') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-truck-ramp-box" style="color:white !important;"></i>
                        <span class="nav-text">EFT</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/purchase-sale') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-cash-register" style="color:white !important;"></i>
                        <span class="nav-text">Purchase Sale</span>
                    </a>
                </li>


            @elseif ($roleId == 3)

                {{-- supplier --}}
                {{-- <li>
                    <a href="{{ url('/supplier-inventory-refill') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-warehouse" style="color:white !important;"></i>
                        <span class="nav-text">INVENTORY REFILL</span>
                    </a>
                </li> --}}

                  <li>
                    <a href="{{ url('/dtn-bol') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-regular fa-rectangle-list" style="color:white !important;"></i>
                        <span class="nav-text">DTN BOL</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/dtn-eft') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-truck-ramp-box" style="color:white !important;"></i>
                        <span class="nav-text">EFT</span>
                    </a>
                </li>
                 <li>
                    <a href="{{ url('/order-deliver-approval') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-arrow-up-wide-short" style="color:white !important;"></i>
                        <span class="nav-text">DELIVERY APPROVAL</span>
                    </a>
                </li>
                 <li>
                    <a href="{{ url('/driver-supplier') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-arrow-up-wide-short" style="color:white !important;"></i>
                        <span class="nav-text">Driver</span>
                    </a>
                </li>

            @elseif ($roleId == 4)

                <li>
                    <a href="{{ url('/driver-order') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-arrow-up-wide-short" style="color:white !important;"></i>
                        <span class="nav-text">DRIVER ORDER</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/split-load') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-truck-ramp-box" style="color:white !important;"></i>
                        <span class="nav-text">Load</span>
                    </a>
                </li>

            @elseif ($roleId == 5)

                <li>
                    <a href="{{ url('/order') }}" aria-expanded="false" style="color:white !important;">
                        <i class="fa-solid fa-arrow-up-wide-short" style="color:white !important;"></i>
                        <span class="nav-text">PLACE ORDER</span>
                    </a>
                </li>

            @endif
        </ul>
    </div>
</div>
