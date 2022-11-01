<div class="container text-center">
    <div class="box">
        <h3 class="display-4 text-center">Update</h3><br>
        <div class="row">

            <div class="col">
                <form method="post" id="update_form" action="update">
                    <!-- Email unique -->
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="<?= $result['email'] ?>">

                    </div>

                    <!-- First and last name -->
                    <div class="mb-3">
                        <label class="form-label">Your first and last name</label>
                        <input type="text" class="form-control" id="name" name="name"
                               value="<?= $result['full_name'] ?>">
                    </div>

                    <!-- Gender dropdown -->
                    <label>Gender</label>
                    <select name="gender" class="form-control">
                        <option value="Male" <?php if ($result['gender'] == "Male") echo "selected=\"selected\""; ?>>
                            Male
                        </option>
                        <option value="Female" <?php if ($result['gender'] == "Female") echo "selected=\"selected\""; ?>>
                            Female
                        </option>
                    </select>

                    <!-- Status dropdown -->
                    <label>Status</label>
                    <select name="status" class="form-control">

                        <option value="Active" <?php if ($result['status'] == "Active") echo "selected=\"selected\""; ?>>
                            Active
                        </option>
                        <option value="Inactive" <?php if ($result['status'] == "Inactive") echo "selected=\"selected\""; ?>>
                            Inactive
                        </option>

                    </select>

                    <!-- Send user_id to models/update.php -->
                    <input type="text"
                           name="id"
                           id="user_id"
                           value="<?= $_GET['id'] ?>"
                           hidden>

                    <div class="row">
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        <p>or view <a href="read">existing</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/resources/js/update_validation.js" defer></script>


