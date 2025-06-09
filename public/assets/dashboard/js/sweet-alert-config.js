// Sweet Alert Configuration for Peduli Bersama Dashboard
$(document).ready(function () {
    // Inisialisasi SweetAlert untuk tombol delete dengan class .btn-delete
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        const form = $(this).closest('form');
        const name = $(this).data('name') || 'item';
        
        swal({
            title: 'Apakah Anda yakin?',
            text: `Anda akan menghapus ${name} ini. Tindakan ini tidak dapat dibatalkan!`,
            icon: 'warning',
            buttons: {
                cancel: {
                    visible: true,
                    text: 'Batal',
                    className: 'btn btn-danger'
                },
                confirm: {
                    text: 'Ya, Hapus',
                    className: 'btn btn-success'
                }
            }
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
    
    // Inisialisasi SweetAlert untuk tombol confirm dengan class .btn-confirm
    $(document).on('click', '.btn-confirm', function(e) {
        e.preventDefault();
        const form = $(this).closest('form');
        const action = $(this).data('action') || 'melakukan tindakan ini';
        
        swal({
            title: 'Konfirmasi',
            text: `Apakah Anda yakin ingin ${action}?`,
            icon: 'info',
            buttons: {
                cancel: {
                    visible: true,
                    text: 'Batal',
                    className: 'btn btn-danger'
                },
                confirm: {
                    text: 'Ya, Lanjutkan',
                    className: 'btn btn-success'
                }
            }
        }).then((willConfirm) => {
            if (willConfirm) {
                form.submit();
            }
        });
    });
    
    // Inisialisasi SweetAlert untuk notifikasi sukses
    if ($('#success-message').length > 0 && $('#success-message').text().trim() !== '') {
        swal({
            title: 'Berhasil!',
            text: $('#success-message').text(),
            icon: 'success',
            buttons: {
                confirm: {
                    className: 'btn btn-success'
                }
            }
        });
    }
    
    // Inisialisasi SweetAlert untuk notifikasi error
    if ($('#error-message').length > 0 && $('#error-message').text().trim() !== '') {
        swal({
            title: 'Error!',
            text: $('#error-message').text(),
            icon: 'error',
            buttons: {
                confirm: {
                    className: 'btn btn-danger'
                }
            }
        });
    }
});
