<div class="navbar-custom">
    <div class="topbar container-fluid">
        <div class="d-flex align-items-center gap-lg-2 gap-1">
            
            <button class="button-toggle-menu">
                <i class="ri-menu-2-fill"></i>
            </button>
            
            <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
        </div>

        <div class="logo-topbar">
                
                <a href="index.php" class="logo-light">
                    <span class="logo-lg">
                        <img src="/assets/images/logo-branca-LARGO-removebg.png" alt="logo" style="border: 1px solid">
                    </span>
                    <span class="logo-sm">
                        <img src="/assets/images/logo-branca-LARGO-removebg.png" alt="small logo" style="border: 1px solid">
                    </span>
                </a>

                
                <a href="index.php" class="logo-dark">
                    <span class="logo-lg">
                        <img src="/assets/images/logo-branca-LARGO-removebg.png" alt="dark logo">
                    </span>
                    <span class="logo-sm">
                        <img src="/assets/images/logo-branca-LARGO-removebg.png" alt="small logo" style="height: 52px">
                    </span>
                </a>
            </div>

        <ul class="topbar-menu d-flex align-items-center gap-3">

            <li class="dropdown d-none d-sm-inline-block">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="ri-apps-2-line fs-22"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg p-0">

                    <div class="p-2">
                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="/assets/images/brands/github.png" alt="Github">
                                    <span>GitHub</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="/assets/images/brands/bitbucket.png" alt="bitbucket">
                                    <span>Bitbucket</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="/assets/images/brands/dropbox.png" alt="dropbox">
                                    <span>Dropbox</span>
                                </a>
                            </div>
                        </div>

                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="/assets/images/brands/slack.png" alt="slack">
                                    <span>Slack</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="/assets/images/brands/dribbble.png" alt="dribbble">
                                    <span>Dribbble</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="/assets/images/brands/behance.png" alt="Behance">
                                    <span>Behance</span>
                                </a>
                            </div>
                        </div> 
                    </div>

                </div>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    {{-- <span class="account-user-avatar">
                        <img src="assets/images/users/avatar-1.jpg" alt="user-image" width="32" class="rounded-circle">
                    </span> --}}
                    <span class="d-lg-flex flex-column gap-1 d-none">
                        <h5 class="my-0">{{ Auth::user()->name }}</h5>
                        {{-- <h6 class="my-0 fw-normal">Founder</h6> --}}
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                    
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Bem Vindo !</h6>
                    </div>
                    
                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#signup-modal">
                        <i class="ri-lock-password-line fs-18 align-middle me-1"></i>
                        <span>Alterar a senha</span>
                    </button>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item">
                            <i class="ri-logout-box-line fs-18 align-middle me-1"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>

<!-- Modal alterar a senha -->
<div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">           

            <div class="modal-body">
                <div class="auth-brand text-center mt-2 mb-4 position-relative top-0">
                    <a href="index.html" class="logo-dark">
                        <span><img src="/assets/images/logo-branca-LARGO-removebg.png" alt="dark logo" height="42"></span>
                    </a>
                    <a href="index.html" class="logo-light">
                        <span><img src="/assets/images/logo-LARGO-removebg.png" alt="logo" height="42"></span>
                    </a>
                </div>

                <form class="ps-3 pe-3" method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="current_password" class="form-label">Senha atual</label>
                        <input class="form-control" type="password" id="current_password" name="current_password" required="" placeholder="Senha atual">
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Nova senha</label>
                        <input class="form-control" type="password" id="password" name="password" required="" placeholder="Nova senha">
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirma nova senha</label>
                        <input class="form-control" type="password" required="" id="password_confirmation" name="password_confirmation" placeholder="Confirmar nova senha">
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="mb-3 text-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="submit">Alterar Senha</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->