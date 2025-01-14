<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="<?= base_url('public/template/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <script src="<?= base_url('public/template/js/sweetalert2.all.min.js'); ?>"></script>
</head>
<body>
    
<div class="row justify-content-center pt-5">
    <div class="card col-md-4">
        <div class="card-header">
            <h5 class="card-title">Sign In</h5>
        </div>
        <div class="card-body">
            <form id="loginForm">
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    <div class="text-danger" id="usernameError"></div>
                </div>
                <div class="form-group mt-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <div class="text-danger" id="passwordError"></div>
                </div>
                <button type="submit" id="loginBtn" class="btn btn-primary mt-3">Log In</button>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('public/template/js/jquery-3.7.1.min.js'); ?>"></script>
<script src="<?= base_url('public/template/js/bootstrap.bundle.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function () {
    $('#loginForm').submit(function (event) {
        event.preventDefault();

        $('#usernameError').text('');
        $('#passwordError').text('');

        const username = $('#username').val();
        const password = $('#password').val();

        if (!username || !password) {
            if (!username) {
                $('#usernameError').text('Username harus diisi');
            }
            if (!password) {
                $('#passwordError').text('Password harus diisi');
            }
            return;
        }

        $.ajax({
            url: '<?= base_url('index.php/login/proses_login') ?>',
            type: 'POST',
            data: { username: username, password: password },
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: response.message,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = response.redirect_url;
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        text: response.message,
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = response.redirect_url;
                    });
                }
            }
        });
    });

    <?php if ($this->session->flashdata('alert') === 'not_logged_in'): ?>
        Swal.fire({
            title: 'Peringatan!',
            text: 'Anda harus login terlebih dahulu untuk mengakses dashboard.',
            icon: 'warning',
            timer: 3000,
            showConfirmButton: false
        });
    <?php endif; ?>
});
</script>
</body>
</html>
