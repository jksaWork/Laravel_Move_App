<div class="dlabnav" style="top: 60px">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="{{ request()->routeIs('dashboard') ? 'mm-active' : '' }} ">
                <a class="ai-icon d-flex justify-content-between align-items-center"  href="/" aria-expanded="false">
                    <span>
                    <span>
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M13,3V9H21V3M13,21H21V11H13M3,21H11V15H3M3,13H11V3H3V13Z" />
                        </svg>
                    </span>
                    <span class="nav-text mx-2">{{__('translation.dashboard')}}</span>
                    </span>

                </a>
            </li>
            <li class="{{ request()->routeIs('analytics') ? 'mm-active' : '' }}" >
                <a class="ai-icon d-flex justify-content-between align-items-center"  href="{{ route('analytics')}}" aria-expanded="false">
                    <span>
                        <span>
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M16.5,21C13.5,21 12.31,16.76 11.05,12.28C10.14,9.04 9,5 7.5,5C4.11,5 4,11.93 4,12H2C2,11.63 2.06,3 7.5,3C10.5,3 11.71,7.25 12.97,11.74C13.83,14.8 15,19 16.5,19C19.94,19 20.03,12.07 20.03,12H22.03C22.03,12.37 21.97,21 16.5,21Z" />
                            </svg>
                        </span>
                        <span class=" nav-text mx-2">{{ __('translation.analytics')}}</span>
                    </span>
                </a>
            </li>
            <li class="{{ request()->routeIs('addOrder') ? 'mm-active' : '' }}" >
                <a class="has-arrow" href="javascript:void()"   aria-expanded="false">
                    <span>
                        <span>
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M3 16H10V14H3M18 14V10H16V14H12V16H16V20H18V16H22V14M14 6H3V8H14M14 10H3V12H14V10Z" />
                            </svg>
                        </span>
                        <span class="nav-text mx-2">{{__('translation.add.order')}}</span>
                    </span>
                </a>
                <ul aria-expanded="false" class="mm-collapse">
                    <li class=""><a href="{{route('addOrder' , encrypt(1) )}}" class="">{{__('translation.shiping_to_shops')}}</a></li>
                    <li class=""><a href="{{route('addOrder' , encrypt(2) )}}" class="">{{__('translation.deliverd_to_shops')}}</a></li>
                    <li class=""><a href="{{route('addOrder' , encrypt(3) )}}" class="">{{__('translation.iternation_shipping')}}</a></li>
                </ul>
            </li>
            <li class="{{ request()->routeIs('MyOrders') ? 'mm-active' : '' }}" >
                <a class="ai-icon d-flex justify-content-between align-items-center"  href="{{ route('MyOrders') }}" aria-expanded="false">
                    <span>
                        <span>
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19 3H14.82C14.4 1.84 13.3 1 12 1S9.6 1.84 9.18 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3M7 8H9V12H8V9H7V8M10 17V18H7V17.08L9 15H7V14H9.25C9.66 14 10 14.34 10 14.75C10 14.95 9.92 15.14 9.79 15.27L8.12 17H10M11 4C11 3.45 11.45 3 12 3S13 3.45 13 4 12.55 5 12 5 11 4.55 11 4M17 17H12V15H17V17M17 11H12V9H17V11Z" />
                            </svg>
                        </span>
                        <span class="nav-text mx-2">{{ __('translation.my_orders') }}</span>
                    </span>

                </a>
            </li>
            <li class="{{ request()->routeIs('OrderHistory') ? 'mm-active' : '' }}" >
                <a class="ai-icon d-flex justify-content-between align-items-center"  href="{{ route('OrderHistory') }}" aria-expanded="false">
                    <span>
                        <span>
                            <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M14 10H3V12H14V10M14 6H3V8H14V6M3 16H10V14H3V16M21.5 11.5L23 13L16 20L11.5 15.5L13 14L16 17L21.5 11.5Z" />
                            </svg>
                        </span>
                        <span class="nav-text mx-2">{{ __('translation.order-history') }}</span>
                    </span>

                </a>
            </li>
            <li class="{{ request()->routeIs('orderTraking') ? 'mm-active' : '' }}" >
                <a class="ai-icon d-flex justify-content-between align-items-center"  href="{{ route('orderTraking') }}" aria-expanded="false">
                    <span>
                        <span>
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19.07,4.93L17.66,6.34C19.1,7.79 20,9.79 20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12C4,7.92 7.05,4.56 11,4.07V6.09C8.16,6.57 6,9.03 6,12A6,6 0 0,0 12,18A6,6 0 0,0 18,12C18,10.34 17.33,8.84 16.24,7.76L14.83,9.17C15.55,9.9 16,10.9 16,12A4,4 0 0,1 12,16A4,4 0 0,1 8,12C8,10.14 9.28,8.59 11,8.14V10.28C10.4,10.63 10,11.26 10,12A2,2 0 0,0 12,14A2,2 0 0,0 14,12C14,11.26 13.6,10.62 13,10.28V2H12A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12C22,9.24 20.88,6.74 19.07,4.93Z" />
                            </svg>
                        </span>
                <span class=" nav-text mx-2">{{ __('translation.order-traking')}}</span>
            </span>

                </a>
            </li>
            <li class="{{ request()->routeIs('ReturedOrder') ? 'mm-active' : '' }}" >
                <a class="ai-icon d-flex justify-content-between align-items-center"  href="{{ route('ReturedOrder')}}" aria-expanded="false">
                    <span>
                        <span>
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19,7V11H5.83L9.41,7.41L8,6L2,12L8,18L9.41,16.58L5.83,13H21V7H19Z" />
                            </svg>
                        </span>
                        <span class="nav-text mx-2">{{ __('translation.returend_order')}}</span>
                    </span>

                </a>
            </li>
            </ul>
    </div>
</div>
