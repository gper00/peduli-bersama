<script>
    // Inisialisasi fungsi download dengan SweetAlert
    $(document).ready(function() {
        // Tambahkan event listener untuk tombol download template
        $('.btn-download-template').on('click', function(e) {
            e.preventDefault();
            
            const url = $(this).attr('href');
            const templateName = $(this).data('template-name');
            
            swal({
                title: 'Download Template',
                text: "Anda akan mengunduh template " + templateName + ". Lanjutkan?",
                icon: 'info',
                buttons: {
                    cancel: {
                        visible: true,
                        text: 'Batal',
                        className: 'btn btn-danger'
                    },
                    confirm: {
                        text: 'Ya, Unduh',
                        className: 'btn btn-success'
                    }
                }
            }).then((confirm) => {
                if (confirm) {
                    // Tampilkan notifikasi sukses
                    swal({
                        title: 'Berhasil!',
                        text: 'Template sedang diunduh',
                        icon: 'success',
                        timer: 2000,
                        buttons: false
                    });
                    
                    // Redirect ke URL download
                    setTimeout(function() {
                        window.location.href = url;
                    }, 1000);
                }
            });
        });
        
        // Inisialisasi Chart.js (pastikan div chart sudah ada)
        if ($('#monthlyDonationChart').length > 0) {
            // Chart sudah diinisialisasi di section scripts pada view index
        }
    });
</script>
