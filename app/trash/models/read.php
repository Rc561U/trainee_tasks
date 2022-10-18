<?php
    require_once "header.php";
    $db = require_once "../models/database.connect.php";
    $result = $db->query('SELECT * FROM test.users');
    ?>

<div class="container">
    <div class="box">
        <h4 class="display-4 text-center">Read</h4><br>
        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_GET['success']; ?>
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
                while ($rows = $result->fetch(PDO::FETCH_ASSOC)){
                    $i++;
                    ?>
                    <tr>
                        <th scope="row"><?=$i?></th>
                        <td><?=$rows['email']?></td>
                        <td><?php echo $rows['full_name']; ?></td>
                        <td><?php echo $rows['gender']; ?></td>
                        <td><?php echo $rows['status']; ?></td>

                        <td><a href="update.php?id=<?=$rows['user_id']?>"
                               class="btn btn-success">Update</a>

                            <a href="../../src/models/delete.php?user_id=<?=$rows['user_id']?>"
                               class="btn btn-danger" >Delete</a>

                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } ?>
        <div class="link-right">
            <a href="create.php" class="link-primary">Create</a>
        </div>
    </div>
</div>

<?php require_once "footer.php"; ?>

