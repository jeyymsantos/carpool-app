<?php

include 'includes/connection.php';
include 'includes/exist.php';

if (!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $bg = $_SESSION['bg'];
}

include 'user_components/head.php';
?>

<title>Sabay App | Register Page </title>
</head>

<body>

    <div class="container my-3 p-4 col-lg-5" style="background-color: #fff;">

        <form action="config/register.php" method="post">

            <h1 class="mb-3"> User Registration Page </h1>
            <hr>

            <div class="row">
                <h3> Personal Details </h3>
                <div class="mb-3 col-4">
                    <label for="fname" class="form-label">First Name <span class="text-danger">*</span></label>
                    <input type="text" name="fname" id="fname" class="form-control" required>
                </div>
                <div class="mb-3 col-4">
                    <label for="mname" class="form-label">Middle Name</label>
                    <input type="text" name="mname" id="mname" class="form-control">
                </div>
                <div class="mb-3 col-4">
                    <label for="lname" class="form-label">Last Name <span class="text-danger">*</span></label>
                    <input type="text" name="lname" id="lname" class="form-control" required>
                </div>
            </div>



            <div class="row">
                <div class="mb-3 col-4">
                    <label for="contact_no" class="form-label">Contact Number</label>
                    <input type="text" maxlength="11" minlength="11" name="contact_no" id="contact_no" class="form-control">
                </div>
                <div class="mb-3 col-8">
                    <label for="barangay" class="form-label">Barangay <span class="text-danger">*</span></label>
                    <input type="text" name="barangay" id="barangay" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-6">
                    <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                    <input type="text" name="city" id="city" class="form-control" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="province" class="form-label">Province <span class="text-danger">*</span></label>
                    <input type="text" name="province" id="province" class="form-control" required>
                </div>
            </div>

            <hr>

            <div class="row">
                <h3> Identification </h3>
                <div class="mb-3 col-6">
                    <label for="id_type" class="form-label">ID Type</label>
                    <select class="form-select" name="id_type" id="id_type" aria-label="Default select example">
                        <option value="">-- Select -- </option>
                        <option value="Driver's License">Driver's License</option>
                        <option value="UMID">UMID</option>
                        <option value="Student">Student ID</option>
                    </select>
                </div>
                <div class="mb-3 col-6">
                    <label for="id_number" class="form-label">ID Number</label>
                    <input type="text" maxlength="20" name="id_number" id="id_number" class="form-control" disabled>
                </div>
            </div>

            <hr>

            <div class="row">
                <h3> Account Credentials </h3>
                <div class="mb-3 col-6">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" id="password" class="form-control" minlength="8" required>
                </div>

                <div class="col">
                    <input type="submit" name="register" value="Register" class="btn btn-primary">
                    <input type="reset" class="btn btn-warning">
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous">


    </script>

    <script>
        $('select').on('change', function() {
            if (this.value != '') {
                $("#id_number").prop('disabled', false);
                $("#id_number").prop('required', true);
            } else {
                $("#id_number").prop('disabled', true);
                $("#id_number").prop('required', false);
                $("#id_number").val('');
            }
        });
    </script>

    <?php
    include_once 'user_components/foot.php';
    ?>