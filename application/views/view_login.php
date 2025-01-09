<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="<?= base_url('public/template/css/bootstrap.min.css'); ?>" rel="stylesheet">
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
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    <div class="text-danger" id="emailError"></div>
                </div>
                <div class="form-group mt-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <div class="text-danger" id="passwordError"></div>
                </div>
                <button type="button" id="loginBtn" class="btn btn-primary mt-3">Log In</button>
                <div id="responseMessage" class="mt-3"></div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('public/template/js/jquery-3.7.1.min.js'); ?>"></script>
<script src="<?= base_url('public/template/js/bootstrap.bundle.min.js') ?>"></script>
<script>
$(document).ready(function () {
    $('#loginBtn').click(function () {

        $('#emailError').text('');
        $('#passwordError').text('');
        $('#responseMessage').html('');

        const email = $('#email').val();
        const password = $('#password').val();
        

        if (!password && !email) {
            $('#emailError').text('Email harus diisi');
            $('#passwordError').text('Password harus diisi');
            return;
        }

        if (!email) {
            $('#emailError').text('Email harus diisi');
            return;
        }
        if (!password) {
            $('#passwordError').text('Password harus diisi');
            return;
        }

        if ($(this).hasClass('btn-danger')) { 
            $('#responseMessage').html('<div class="text-info">Anda telah logout</div>');
            $(this).text('Log In').removeClass('btn-danger').addClass('btn-primary');
            $('#email, #password').val(''); 
            return;
        }

        $.ajax({
            url: '<?= base_url('index.php/login/proses_login') ?>',
            type: 'POST',
            data: { email: email, password: password },
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    $('#responseMessage').html(`
                        <div class="text-success alert alert-success">
                            Login berhasil!<br>
                            Email Anda: ${response.email}<br>
                            Password Anda: ${response.password}
                        </div>
                    `);
                    $('#loginBtn').text('Logout').removeClass('btn-primary').addClass('btn-danger');
                } else {
                    $('#responseMessage').html('<div class="text-danger">Login gagal</div>');
                }
            }
        });
    });
});
</script>
</body>
</html>
