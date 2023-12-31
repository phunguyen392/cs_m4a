<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <span class="ms-1 font-weight-bold text-white">NƠI CHÚNG TA THUỘC VỀ</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
       
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="{{route('categories.index')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">{{ __('language.category') }}</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{route('products.index')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">{{ __('language.product') }}</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('users.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">view_in_ar</i>
            </div>
            <span class="nav-link-text ms-1">{{ __('language.user') }}</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('orders.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
            </div>
            <span class="nav-link-text ms-1">{{ __('language.order') }}</span>
          </a>
        </li>


        <li class="nav-item">
          
          <a class="nav-link text-white " href="{{ route('products.trash') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">delete</i>
              
            </div>
            <span class="nav-link-text ms-1">{{ __('language.trash') }}</span>

            
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('groups.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
            </div>
            <span class="nav-link-text ms-1">{{ __('language.group') }}</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">{{ __('language.acc') }}</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="../pages/profile.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('login') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">login</i>
            </div>
            <span class="nav-link-text ms-1">{{ __('language.sign') }}</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="../pages/sign-up.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">assignment</i>
            </div>
            <span class="nav-link-text ms-1">{{ __('language.sign up') }}</span>
          </a>
        </li>
      </ul>
    </div>
   
  </aside>