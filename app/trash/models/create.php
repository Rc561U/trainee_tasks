
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../../resources/css/style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="../../resources/js/validation.js" defer></script>
    <title></title>
</head>
<body>


<div class="container ">
    <div class="box">
        <h3 class="display-4 text-center">Create</h3><br>
        <div id="status">

        </div>
        <div class="row">

            <div class="col">
                <form method="post" id="create_form" >

                    <!-- Email unigue -->
                    <div class="mb-3 ">
                        <label for="email" class="form-label mb-0" >Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" >

                    </div>

                    <!-- First and last name -->
                    <div class="mb-3">
                        <label  class="form-label mb-0">Your first and last name</label>
                        <input type="text" class="form-control" placeholder="Jim Royal" id="name" name="name">
                    </div>

                    <!-- Gender dropdown -->
                    <div class="mb-3">
                        <label for="gender">Gender</label>
                        <select name="gender" class="form-control text-center" id="gender">
                            <option value="" selected disabled hidden>-- Choose your gender --</option>
                            <option value="Male" <?php $gender = ""?>;
                                    echo $gender == "Male" ? "selected" : "" ?>Male</option>
                            <option value="Female" <?php echo $gender == "Female" ? "selected" : "" ?>>Female</option>
                        </select>
                    </div>


                    <!-- Status dropdown -->
                    <div class="mb-3">
                        <label for="status" >Status</label>
                        <select name="status" class="form-control text-center" id="status">
                            <option value="" selected disabled hidden>-- Choose your status --</option>
                            <option value="Active" <?php $status = ""?>;
                                    echo $gender == "Active" ? "selected" : "" ?>Active</option>
                            <option value="Inactive" <?php echo $status == "inactive" ? "selected" : "" ?>>Inactive</option>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    <p>or view <a href="read.php">existing</a></p>


                </form>
            </div>

        </div>

    </div>

</div>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>

