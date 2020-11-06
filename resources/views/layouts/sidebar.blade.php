<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="{{asset('images/users/avatar-2.jpg')}}" alt="" class="avatar-md mx-auto rounded-circle">
            </div>

            <div class="mt-3">

                @if(auth()->guard('admin')->check())
                    <a href="#" class="text-dark font-weight-medium font-size-16">
                        {{auth()->guard('admin')->user()->name}}</a>
                @endif

            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="{{route('admin.dashboard')}}" class="waves-effect">
                        <span>Dashboard</span>
                    </a>
                </li>

                @role('Admin')
                <li class="menu-title">Business Category</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-flip-horizontal"></i>
                        <span>Category</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('businesscategories.create')}}">Add Category</a></li>
                        <li><a href="{{route('businesscategory.home')}}">View Category</a></li>
                    </ul>
                </li>

                @endrole

                @role('store')

                <li class="menu-title">User Manegment</li>

                <li>

                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-flip-horizontal"></i>
                        <span>User</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('user.store.home')}}">View User</a></li>
                    </ul>

                    @endrole
                </li>

                @role('store')

                <li class="menu-title">Order Manegment</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-flip-horizontal"></i>
                        <span>Order</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('order.home')}}">View Order</a></li>
                    </ul>
                </li>
                @endrole


                <li class="menu-title">Store Manegment</li>

                <li>

                    @role('Admin')

                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-flip-horizontal"></i>
                        <span>Store</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('user.home')}}">View Store</a></li>
                    </ul>
                    @endrole

                    @role('store')

                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-flip-horizontal"></i>
                        <span>Category</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('categories.create')}}">Add Category</a></li>
                        <li><a href="{{route('categories.home')}}">View Category</a></li>
                    </ul>

                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-flip-horizontal"></i>
                        <span>Items</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('items.create')}}">Add Item</a></li>
                        <li><a href="{{route('items.home')}}">View Item</a></li>
                    </ul>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-flip-horizontal"></i>
                        <span>Slider</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('sliders.create')}}">Add Slider</a></li>
                        <li><a href="{{route('slider.home')}}">View Slider</a></li>
                    </ul>
                </li>

                @endrole
                </li>

                @role('Admin')

                <li class="menu-title">Role Manegment</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-flip-horizontal"></i>
                        <span>Role</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('roles.create')}}">ADD NEW ROLE</a></li>
                        <li><a href="{{route('role.home')}}">VIEW ROLE</a></li>
                    </ul>
                </li>
                @endrole
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
