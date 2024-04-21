<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Multipurpose Admin & Dashboard Template" name="description" />
    @include('include.style')
</head>

<body data-sidebar="dark" data-layout-mode="light">
<div id="layout-wrapper">
    @include('include.header')
    @include('include.v-menu')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script> © Skote.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

</div>
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>
@include('include.script')
@yield('script')
</body>
</html>
