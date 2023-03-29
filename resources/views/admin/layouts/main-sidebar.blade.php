  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
          <img src="{{ asset('assets/img/logo.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
          <span class="brand-text font-weight-light">Halal</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">

                  <img src="{{ asset('assets/img/logo.jpg') }}" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block">{{auth()->user()->name}}</a>
              </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                      aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item menu-open">
                  <li class="nav-item">
                      <a href="{{ route('category.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-columns"></i>
                          <p>
                              Categories
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('product.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-columns"></i>
                          <p>
                              Products
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('city.index')}}" class="nav-link">
                          <i class="nav-icon fas fa-columns"></i>
                          <p>
                              Cities
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('policy.index')}}" class="nav-link">
                          <i class="nav-icon fas fa-columns"></i>
                          <p>
                              Polices
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{route('contact.index')}}" class="nav-link">
                          <i class="nav-icon fas fa-columns"></i>
                          <p>
                              Contact Us
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{route('ask.index')}}" class="nav-link">
                          <i class="nav-icon fas fa-columns"></i>
                          <p>
                              Askes
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('account.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Account
                        </p>
                    </a>
                </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.destroy') }}" class="nav-link">
                        <i class="far fa-arrow-alt-circle-left"></i>
                          <p>
                              Logout
                          </p>
                      </a>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
