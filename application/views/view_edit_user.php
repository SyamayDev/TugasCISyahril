<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Dashboard</title>
    <link href="<?= base_url('public/template/css/bootstrap.min.css'); ?>" rel="stylesheet">
</head>
<body>
<div class="row justify-content-center">
<div class="card col-md-8 mt-5">
    <div class="card-header">
        <h1>Edit User</h1>
    </div>
    <div class="card-body">
        <div class="table-user">
            <form action="<?= base_url('dashboard/update_user') ?>" method="post" enctype="multipart/form-data">
                <div class="mb-1">
                <label for="id" class="form-label">ID :</label>
                <input type="id" class="form-control" id="id" name="id" value="<?= isset($user->id) ? $user->id : ''; ?>">
                <div class="error-block"></div><br>
                </div>
                <div class="mb-1">
                <label for="username" class="form-label">Email :</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= isset($user->username) ? $user->username : ''; ?>">
                <div class="error-block"></div><br>
                </div>
                <div class="mb-1">
                <label for="password" class="form-label">Password :</label>
                <input type="password" class="form-control" id="password" name="password" value="<?= isset($user->password) ? $user->password : ''; ?>">
                <div class="error-block"></div>
                </div>

                <button type="submit" id="saveBtn" class="btn btn-primary mt-3">Update</button>
                <div class="update-error"></div>
            </form>

            <div>
                <?php 
                echo '<p class="text-danger">', null !== $this->session->set_flashdata('update_error') ? $this->session->flashdata('update_error') : '', '</p>';
                ?>
            </div>

        </div>
    </div>
</div>
</div>

    <script src="<?= base_url('public/template/js/jquery-3.7.1.min.js'); ?>"></script>
    <script src="<?= base_url('public/template/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>