<div class="container ">
    <div class="box">
        <h3 class="display-4 text-center">Create</h3><br>
        <div id="status">

        </div>
        <div class="row">

            <div class="col">
                <form method="post" id="create_form" action="create">

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
                    <p>or view <a href="read">existing</a></p>


                </form>
            </div>

        </div>
    </div>
</div>


