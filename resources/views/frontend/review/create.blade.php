<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Ekka - Admin Dashboard HTML Template.">

    <title>Ekka - Admin Dashboard HTML Template.</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap"
        rel="stylesheet">

    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

    <!-- Ekka CSS -->
    <link id="ekka-css" rel="stylesheet" href="assets-admin/css/ekka.css" />

    <!-- FAVICON -->
    <link href="assets/img/favicon.png" rel="shortcut icon" />
</head>

<body class="sign-inup" id="body">
    <div class="container d-flex align-items-center justify-content-center form-height pt-24px pb-24px">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-10">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="ec-brand">
                            <a href="index.html" title="Ekka">
                                <img class="ec-brand-icon" src="assets/img/logo/logo-login.png" alt="" />
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-5">
                        <h4 class="text-dark mb-5">Sign Up</h4>

                        <form action="{{ route('reviews-create') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_id" id="product_id">
                            <input type="hidden" name="user_id" id="user_id">
                            <div class="row">
                                {{-- <div class="form-group col-md-12 mb-4">
                                    <input type="text" class="form-control" id="name" placeholder="Name">
                                </div> --}}

                                <div class="form-group col-md-12 mb-4">
                                    <label for="firstName">Rating</label>
                                    <select class="form-select" name="rating" id="">
                                        <option value="">pilih</option>
                                        <option value="1">⭐</option>
                                        <option value="2">⭐⭐</option>
                                        <option value="3">⭐⭐⭐</option>
                                        <option value="4">⭐⭐⭐⭐</option>
                                        <option value="5">⭐⭐⭐⭐⭐</option>
                                    </select>
                                </div>

                                {{-- <div class="form-group col-md-12 mb-4">
                                    <input type="email" class="form-control" id="email" placeholder="Username">
                                </div> --}}
                                <div class="form-group col-md-12  mb-4">
                                    <label for="review">Review</label>
                                    <textarea type="text" class="form-control" name="review" rows="5" cols="5" id="review" required>
                                                </textarea>
                                </div>

                                {{-- <div class="form-group col-md-12 ">
                                    <input type="password" class="form-control" id="password" placeholder="Password">
                                </div>

                                <div class="form-group col-md-12 ">
                                    <input type="password" class="form-control" id="cpassword"
                                        placeholder="Confirm Password">
                                </div> --}}

                                <div class="col-md-12">


                                    <button type="submit" class="btn btn-primary btn-block mb-4">Sign Up</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript -->
    <script src="assets/plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugins/jquery-zoom/jquery.zoom.min.js"></script>
    <script src="assets/plugins/slick/slick.min.js"></script>

    <!-- Ekka Custom -->
    <script src="assets/js/ekka.js"></script>
</body>

</html>
