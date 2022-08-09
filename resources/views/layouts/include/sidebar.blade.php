<div class="sidebar" data-color="orange">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          Admin Panel
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li class="{{Request::is('dashboard')?'active':''}}">
            <a href="{{url('dashboard')}}">
              <p>Dashboard</p>
            </a>
          </li>
          <li class="{{Request::is('categories')?'active':''}}">
            <a href="{{url('categories')}}">
              <p>Categories</p>
            </a>
          </li>
          <li class =" {{Request::is('add-category')?'active':''}}"">
            <a href="{{url('add-category')}}">
              <p>Add Category</p>
            </a>
          </li>

          <li class =" {{Request::is('products')?'active':''}}">
            <a href="{{url('products')}}">
              <p>Products</p>
            </a>
          </li>
          <li class =" {{Request::is('add-products')?'active':''}}">
            <a href="{{url('add-products')}}">
              <p>Add Products</p>
            </a>
          </li>
          <li class =" {{Request::is('view-order')?'active':''}}">
            <a href="{{url('view-order')}}">
              <p>View Orders</p>
            </a>
          </li>

          <li class =" {{Request::is('view-coupons')?'active':''}}">
            <a href="{{url('view-coupons')}}">
              <p>View Coupons</p>
            </a>
          </li>

          <li class =" {{Request::is('add-coupons')?'active':''}}">
            <a href="{{url('add-coupons')}}">
              <p>Add Coupons</p>
            </a>
          </li>

          <li class =" {{Request::is('delivery-panel')?'active':''}}">
            <a href="{{url('delivery-panel')}}">
              <p>Delivery Panel</p>
            </a>
          </li>
        </ul>
      </div>
    </div>