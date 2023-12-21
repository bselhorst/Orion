@include('layouts.main')

<head>
    <title>Starter Page | Attex - Bootstrap 5 Admin & Dashboard Template</title>
    @include('layouts.title-meta')
    @include('layouts.head-css')
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">
        @include('layouts.menu')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Attex</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                        <li class="breadcrumb-item active">Starter</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">@yield('title')</h4>
                            </div>
                        </div>
                    </div>

                </div> <!-- container -->

                @yield('content')
                          

            </div> <!-- content -->

            @include('layouts.footer')

        </div>

        <x-dialog-success :message="session('success')" />
        <x-dialog-error :message="session('error')" />
        <x-dialog-error-password :errors="$errors->messages" />                                        

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    @include('layouts.footer-scripts')

    <!-- App js -->
    <script src="/assets/js/app.js"></script>

    <script>
        $(document).ready(function(){
            @if($errors->messages->count())
                $('#danger-alert-modal-password').modal('show');
            @endif
            @if(Session::has('success'))
                $('#success-alert-modal').modal('show');
            @endif
            @if(Session::has('error'))
                $('#danger-alert-modal').modal('show');
            @endif
        });
    </script>

</body>

</html>