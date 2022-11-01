<div class="container">
    <div class="box">
        <h4 class="display-4 text-center">Read</h4><br>
        <?php if (isset($_GET['create'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_GET['create']; ?>
            </div>
        <?php } ?>
        <?php if (isset($_GET['update'])) { ?>
            <div class="alert alert-info" role="alert">
                <?php echo $_GET['update']; ?>
            </div>
        <?php } ?>
        <?php if (isset($_GET['delete'])) { ?>
            <div class="alert alert-warning" role="alert">
                <?php echo $_GET['delete']; ?>
            </div>
        <?php } ?>
        <div id="reed_status">

        </div>

        <?php if ($result) { ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col">Full name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;

                while ($rows = $result->fetch(\PDO::FETCH_ASSOC)) {
                    $i++;
                    ?>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td><?= $rows['email'] ?></td>
                        <td><?php echo $rows['full_name']; ?></td>
                        <td><?php echo $rows['gender']; ?></td>
                        <td><?php echo $rows['status']; ?></td>

                        <td>
                            <a href="update?id=<?= $rows['user_id'] ?>" class="btn btn-success">Update</a>
                            <button id="myBtn" class="btn btn-dark" value="<?= $rows['user_id'] ?>">Delete</button>

                            <!-- The Modal -->
                            <div id="myModal" class="modal">
                                <!-- Modal content -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5>Are you sure?</h5>
                                    </div>

                                    <div class="modal-footer ">
                                        <a id="delete_link" href="" class="btn btn-danger">Delete</a>
                                        <button type="button" id="close" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </td>

                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } ?>


        <div class="link-right">

            <a href="create" class="link-primary">Create</a>
        </div>
    </div>
</div>
<script src="/resources/js/main.js" defer></script>



