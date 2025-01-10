<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Dashboard</title>
    <link href="<?= base_url('public/template/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <script src="<?= base_url('public/template/js/jquery-3.7.1.min.js'); ?>"></script>
    <script src="<?= base_url('public/template/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container mt-4">
    <!-- Ini Header Dashboard -->
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h1 class="display-4">Dashboard</h1>
        </div>
        <div class="col-md-6 text-md-right text-center">
            <h4>Kamu sedang login di akun: <span class="font-weight-bold"><?= $this->session->userdata('username'); ?></span></h4>
        </div>
    </div>

    <!-- Ini Card Kontrol -->
    <div class="row justify-content-center">
        <div class="card col-md-10">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Kelola Data User</h5>
                <div>
                    <button id="addUserBtn" class="btn btn-primary mr-2">Tambah User</button>
                    <a href="<?= base_url('login/logout') ?>" class="btn btn-danger">Logout</a>
                </div>
            </div>
            <div class="card-body">
                <!-- Ini Tabel User -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            <?php $no = 1; ?>
                            <?php foreach ($users as $user): ?>
                            <tr id="userRow<?= $user->id; ?>">
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $user->username ?></td>
                                <td><?= $user->password ?></td>
                                <td class="text-center">
                                    <?php if ($user->id != $this->session->userdata('user_id')): ?>
                                        <button class="btn btn-warning btn-sm editUserBtn" data-id="<?= $user->id; ?>">Edit</button>
                                        <button class="btn btn-danger btn-sm deleteUserBtn" data-id="<?= $user->id; ?>">Delete</button>
                                    <?php else: ?>
                                        <span class="text-muted">Tidak dapat diedit</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function () {
    // Tambah User
    $('#addUserBtn').click(function () {
        Swal.fire({
            title: 'Tambah User Baru',
            html: ` 
                <br><label for="id">ID Otomatis</label>
                <input id="id" class="swal2-input" value="Auto-generated" readonly><br>
                <label for="username">Username : </label>
                <input id="username" class="swal2-input" placeholder="Masukkan Username"><br>
                <label for="password">Password : </label>
                <input id="password" class="swal2-input" type="password" placeholder="Masukkan Password">
            `,
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            preConfirm: () => {
                const username = $('#username').val();
                const password = $('#password').val();

                if (!username || !password) {
                    Swal.showValidationMessage('Semua kolom harus diisi!');
                }

                return $.ajax({
                    url: '<?= base_url("dashboard/check_username") ?>',
                    type: 'POST',
                    data: { username },
                }).then((response) => {
                    const res = JSON.parse(response);
                    if (res.status === 'error') {
                        Swal.showValidationMessage(res.message);
                    }
                    return { username, password };
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url("dashboard/save") ?>',
                    type: 'POST',
                    data: result.value,
                    success: function (response) {
                        Swal.fire('Berhasil!', 'User berhasil ditambahkan.', 'success').then(() => location.reload());
                    }
                });
            }
        });
    });

    // Edit User
    $(document).on('click', '.editUserBtn', function () {
        const userId = $(this).data('id');
        $.getJSON(`<?= base_url('dashboard/edit/') ?>${userId}`, function (response) {
            if (response.status === 'success') {
                const user = response.data;
                Swal.fire({
                    title: 'Edit User',
                    html: `
                        <br><label for="id">ID User : </label>
                        <input id="id" class="swal2-input" value="${user.id}" readonly><br>
                        <label for="username">Username : </label>
                        <input id="username" class="swal2-input" value="${user.username}" placeholder="Username"><br>
                        <br><label for="password">Password : </label>
                        <input id="password" class="swal2-input" value="${user.password}" placeholder="Password">
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Update',
                    preConfirm: () => {
                        const username = $('#username').val();
                        const password = $('#password').val();

                        if (!username || !password) {
                            Swal.showValidationMessage('Semua kolom harus diisi!');
                        }

                        return $.ajax({
                            url: '<?= base_url("dashboard/check_username") ?>',
                            type: 'POST',
                            data: { username, id: user.id },
                        }).then((response) => {
                            const res = JSON.parse(response);
                            if (res.status === 'error') {
                                Swal.showValidationMessage(res.message);
                            }
                            return { id: userId, username, password };
                        });
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?= base_url("dashboard/update_user") ?>',
                            type: 'POST',
                            data: result.value,
                            success: function (response) {
                                Swal.fire('Berhasil!', 'User berhasil diperbarui.', 'success').then(() => location.reload());
                            }
                        });
                    }
                });
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        });
    });

    // Hapus User
    $(document).on('click', '.deleteUserBtn', function () {
        const userId = $(this).data('id');
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `<?= base_url('dashboard/delete/') ?>${userId}`,
                    type: 'POST',
                    success: function () {
                        Swal.fire('Berhasil!', 'User berhasil dihapus.', 'success').then(() => $(`#userRow${userId}`).remove());
                    }
                });
            }
        });
    });
});
</script>
</body>
</html>
