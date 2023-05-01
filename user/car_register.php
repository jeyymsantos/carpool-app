<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Register </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <div class="container my-3 col-lg-5">

        <!-- Car Registration -->
        <form action="config/car_register.php" method="post">

            <h1 class="mb-3"> Rei </h1>
            <hr>

            <input type="hidden" name="id" value="<?= $id ?>">

            <div class="row">
                <div class="mb-3 col-4">
                    <label for="fname" class="form-label">Car Plate No. <span class="text-danger">*</span></label>
                    <input type="text" name="fname" id="fname" class="form-control" required placeholder="XXX-9999">
                </div>
                <div class="mb-3 col-4">
                    <label for="mname" class="form-label">Car Model <span class="text-danger">*</span></label>
                    <input type="text" name="mname" id="mname" class="form-control">
                </div>
                <div class="mb-3 col-4">
                    <label for="lname" class="form-label">Car Color <span class="text-danger">*</span></label>
                    <input type="text" name="lname" id="lname" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-4">
                    <label for="fname" class="form-label">Car Brand <span class="text-danger">*</span></label>
                    <input type="text" name="fname" id="fname" class="form-control" required>
                </div>
            </div>

            <div class="col">
                <input type="submit" name="register" value="Register" class="btn btn-primary">
                <input type="reset" class="btn btn-warning">
            </div>

        </form>


    </div>

</body>

</html>