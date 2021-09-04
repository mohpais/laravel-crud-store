<div class="container-fluid bg-white">
    <div class="row py-21">
        <div class="col-auto my-auto">
            <div class="mb-0 h5 pl-2">
                Website Store
            </div>
        </div>
        <div class="col-auto my-auto">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link {{ Request::path() == '/' ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                </li>
                @php
                    $root = explode("/", Request::path())
                @endphp
                @auth
                    @if (auth()->user()->is_admin == 1)
                        <li class="nav-item">
                            <a class="nav-link {{ in_array('product', $root) ? 'active' : '' }}" href="{{ url('/product') }}">Product</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ in_array('order', $root) ? 'active' : '' }}" href="{{ url('/order') }}">Order</a>
                    </li>
                @endauth
            
            </ul>
        </div>
        <div class="col-auto ml-auto my-auto">
            <div class="row">
                <div class="col-auto my-auto">
                    @if (Route::has('login'))
                        @auth
                            <div class="btn-group my-1" role="group">
                                <button type="button" class="btn bg-cyan text-left" >
                                    <div class="row">
                                        <div class="col-auto my-auto pr-0">
                                            <img src="{{ asset('img/user.svg')}}" alt="" width="30">
                                        </div>
                                        <div class="col-auto my-auto d-none d-lg-block">
                                            <p class="mb-0 text-dark" style="font-size: 12px; font-weight: bold">{{auth()->user()->fullname}}</p>
                                            <p class="mb-0 text-secondary" style="font-size: 10px">{{auth()->user()->is_admin === 1 ? 'Administrator' : 'Guest'}}</p>
                                        </div>
                                    </div>
                                </button>
                                <button class="btn bg-cyan dropdown-toggle" type="button" id="btn_group" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="btn_group" style="font-size: 14px">
                                    <div class="dropdown-item-text text-muted" style="font-size: 12px;">SETTINGS</div>
                                    <a class="dropdown-item text-danger text-left" href="{{ route('logout') }}">
                                        <i class='bx bx-log-out mr-2'></i>Logout
                                    </a>
                                </div>
                            </div>
                
                        @else
                            <a class="btn btn-primary mr-2" href="{{ route('login') }}">Login</a>
                            @if (Route::has('register'))
                                <a class="btn btn-success" href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>