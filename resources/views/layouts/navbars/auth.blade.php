<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="{{ route('page.index', 'dashboard') }}" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="/images/favicon.png">
            </div>
        </a>
        <?php $role = Auth::user()->role; ?>
        @if($role == 1)
        <a href="{{ route('sales.dashboard') }}" class="simple-text logo-normal">
            {{ __('TSK SYNERGY') }}
        </a>
        @else
        <a href="{{ route('page.index', 'dashboard') }}" class="simple-text logo-normal">
            {{ __('TSK SYNERGY') }}
        </a>
        @endif
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            
            @if($role == 1)
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('sales.dashboard') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            @else
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'dashboard') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            @endif
           
            
           
            <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                <a href="{{ route('profile.edit_admin') }}">
                    <i class="nc-icon nc-paper"></i>
                    <p>{{ __('User Profile') }}</p>
                </a>
            </li>
           
            
            <?php $role = Auth::user()->role; ?>
            @if($role == 3)
            <li class="{{ $elementActive == 'purchaserequest' ? 'active' : '' }}">
                <a href="{{ route('purchaserequest.index') }}">
                    <i class="nc-icon nc-paper"></i>
                    <p>{{ __('Purchase Request') }}</p>
                </a>
            </li>
            @endif
            <?php $role = Auth::user()->role; ?>
            @if($role == 2)
            <li class="{{ $elementActive == 'productcategory' ? 'active' : '' }}">
                <a href="{{ route('productcategory.index') }}">
                    <i class="nc-icon nc-bullet-list-67"></i>
                    <p>{{ __('Product Category') }}</p>
                </a>
            </li>
            @endif
            
            <?php $role = Auth::user()->role; ?>
            @if($role == 2)
            <li class="{{ $elementActive == 'supplier' ? 'active' : '' }}">
                <a href="{{ route('supplier.index') }}">
                    <i class="nc-icon nc-world-2"></i>
                    <p>{{ __('Our Suppliers') }}</p>
                </a>
            </li>
            @endif

            <?php $role = Auth::user()->role; ?>
            @if($role == 2)
            <li class="{{ $elementActive == 'product' ? 'active' : '' }}">
                <a href="{{ route('product.index') }}">
                    <i class="nc-icon nc-basket"></i>
                    <p>{{ __('Products') }}</p>
                </a>
            </li>
            @endif

            <?php $role = Auth::user()->role; ?>
            @if($role == 3)
            <li class="{{ $elementActive == 'quantity' ? 'active' : '' }}">
                <a href="{{ route('quantity.index') }}">
                    <i class="nc-icon nc-bag-16"></i>
                    <p>{{ __('Inventory') }}</p>
                </a>
            </li>
            @endif

            <?php $role = Auth::user()->role; ?>
            @if($role == 3)
            <li class="{{ $elementActive == 'order' ? 'active' : '' }}">
                <a href="{{ route('order.index') }}">
                    <i class="nc-icon nc-box-2"></i>
                    <p>{{ __('Order Status') }}</p>
                </a>
            </li>
            @endif

            <?php $role = Auth::user()->role; ?>
            @if($role == 2)
            <li class="{{ $elementActive == 'purchaserequest' ? 'active' : '' }}">
                <a href="{{ route('purchaserequest.index') }}">
                    <i class="nc-icon nc-bag-16"></i>
                    <p>{{ __('Purchase Request') }}</p>
                </a>
            </li>
            @endif

            <?php $role = Auth::user()->role; ?>
            @if($role == 3)
            <li class="{{ $elementActive == 'purchase-order' ? 'active' : '' }}">
                <a href="{{ route('po.index') }}">
                    <i class="nc-icon nc-box-2"></i>
                    <p>{{ __('Purchase Order') }}</p>
                </a>
            </li>
            @endif

            <?php $role = Auth::user()->role; ?>
            @if($role == 3)
            <li class="{{ $elementActive == 'grn' ? 'active' : '' }}">
                <a href="{{ route('grn.index') }}">
                    <i class="nc-icon nc-world-2"></i>
                    <p>{{ __('GRN') }}</p>
                </a>
            </li>
            @endif

            

            <?php $role = Auth::user()->role; ?>
            @if($role == 2)
            <li class="{{ $elementActive == 'purchase-order' ? 'active' : '' }}">
                <a href="{{ route('po.index') }}">
                    <i class="nc-icon nc-box-2"></i>
                    <p>{{ __('Purchase Order') }}</p>
                </a>
            </li>
            @endif

            <?php $role = Auth::user()->role; ?>
            @if($role == 1)
            <li class="{{ $elementActive == 'order-detail' ? 'active' : '' }}">
                <a href="{{ route('sales.order.detail') }}">
                    <i class="nc-icon nc-zoom-split"></i>
                    <p>{{ __('Order') }}</p>
                </a>
            </li>
            @endif

            <?php $role = Auth::user()->role; ?>
            @if($role == 1)
            <li class="{{ $elementActive == 'total-sales' ? 'active' : '' }}">
                <a href="{{ route('sales.weekly.sales') }}">
                    <i class="nc-icon nc-chart-bar-32"></i>
                    <p>{{ __('Total Sales') }}</p>
                </a>
            </li>
            @endif

            <?php $role = Auth::user()->role; ?>
            @if($role == 1)
            <li class="{{ $elementActive == 'sales-order-report' ? 'active' : '' }}">
            <a href="{{ route('sales.monthly.report') }}">
                    <i class="nc-icon nc-single-copy-04"></i>
                    <p>{{ __('Report') }}</p>
                </a>
            </li>
            @endif

            <?php $role = Auth::user()->role; ?>
            @if($role == 4)
            <li class="{{ $elementActive == 'logistic-detail' ? 'active' : '' }}">
            <a href="{{ route('logistic.detail') }}">
                <i class="nc-icon nc-delivery-fast"></i>
                    <p>{{ __('Logistic') }}</p>
                </a>
            </li>
            @endif

            <?php $role = Auth::user()->role; ?>
            @if($role == 2)
            <li class="{{ $elementActive == 'grn' ? 'active' : '' }}">
                <a href="{{ route('grn.index') }}">
                    <i class="nc-icon nc-world-2"></i>
                    <p>{{ __('GRN') }}</p>
                </a>
            </li>
            @endif
        </ul>
    </div>
</div>