$(document).ready(function () {
    // Memastikan hanya elemen dengan kelas .chainedSelect yang terhubung ke parent dan target
    $('.chainedSelect').each(function () {
        let $parent = $(this).data('parent'); // ID dropdown parent (Tahun Pelajaran / Jurusan)
        let $target = $(this).data('target'); // ID dropdown target (Jurusan / Kelas)
        let $url = $(this).data('url'); // URL untuk AJAX

        if ($parent) {
            // Mendengarkan perubahan pada dropdown parent (Tahun Pelajaran / Jurusan)
            $(`#${$parent}`).on('change', function () {
                let parentId = $(this).val(); // Ambil ID dari parent
                if (parentId) {
                    // Lakukan request AJAX untuk mendapatkan jurusan berdasarkan ID tahun pelajaran
                    $.ajax({
                        url: $url,
                        type: 'POST',
                        data: { id: parentId },
                        success: function (response) {
                            // Update dropdown target dengan respons server
                            $(`#${$target}`).html(response).trigger('change');
                        },
                        error: function () {
                            // Tampilkan pesan error jika request gagal
                            $(`#${$target}`).html('<option value="">Gagal memuat data</option>');
                        }
                    });
                } else {
                    // Jika tidak ada pilihan pada dropdown parent, kosongkan dropdown target
                    $(`#${$target}`).html('<option value="">Pilih ' + $target.charAt(0).toUpperCase() + $target.slice(1) + '</option>');
                }
            });
        }
    });
});
