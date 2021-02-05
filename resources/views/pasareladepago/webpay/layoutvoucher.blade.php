@include('partials.head')

    <link href="assets/css/text.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <div class='header w-100'>
        <div class='d-flex justify-content-center'>
                <div class='container p-lg-0 pl-4 pr-4  inner'>
                    <div class='row mt-5 w-100 d-flex justify-content-center'>
                        <div class='col-lg-6 p-0'>
                            <div class='banner w-100'>
                                <div class='text-center mb-5'>
                                        @yield('msje')
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@include('partials.footer')
