// Konfigurasi default untuk Sweet Alert
const sweetAlertConfig = {
    // Konfigurasi untuk konfirmasi penghapusan
    delete: {
        title: "Apakah Anda yakin?",
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
            buttons: {
                cancel: {
                text: "Batal",
                value: false,
                    visible: true,
                className: "btn btn-secondary",
                closeModal: true,
                },
                confirm: {
                text: "Ya, hapus!",
                value: true,
                visible: true,
                className: "btn btn-danger",
                closeModal: true
                }
        },
        dangerMode: true,
        closeOnClickOutside: false,
        closeOnEsc: false
    },

    // Konfigurasi untuk notifikasi sukses
    success: {
        title: "Berhasil!",
        icon: "success",
        buttons: {
            confirm: {
                text: "OK",
                className: "btn btn-success"
            }
        },
        timer: 2000,
        timerProgressBar: true
    },

    // Konfigurasi untuk notifikasi error
    error: {
        title: "Gagal!",
        icon: "error",
        buttons: {
            confirm: {
                text: "OK",
                className: "btn btn-danger"
            }
        }
    },

    // Konfigurasi untuk konfirmasi publikasi
    publish: {
        title: "Publikasikan Kampanye?",
        text: "Kampanye akan dipublikasikan dan terlihat oleh publik.",
        icon: "info",
            buttons: {
                cancel: {
                text: "Batal",
                value: false,
                    visible: true,
                className: "btn btn-secondary",
                closeModal: true,
                },
                confirm: {
                text: "Ya, publikasikan!",
                value: true,
                visible: true,
                className: "btn btn-primary",
                closeModal: true
                }
        },
        closeOnClickOutside: false,
        closeOnEsc: false
    },

    // Konfigurasi untuk konfirmasi selesai
    complete: {
        title: "Tandai sebagai Selesai?",
        text: "Kampanye akan ditandai sebagai selesai dan tidak akan menerima donasi baru.",
        icon: "info",
        buttons: {
            cancel: {
                text: "Batal",
                value: false,
                visible: true,
                className: "btn btn-secondary",
                closeModal: true,
            },
            confirm: {
                text: "Ya, tandai selesai!",
                value: true,
                visible: true,
                className: "btn btn-primary",
                closeModal: true
            }
        },
        closeOnClickOutside: false,
        closeOnEsc: false
    }
};

// Fungsi helper untuk konfirmasi penghapusan
function confirmDelete(message = null) {
    const config = { ...sweetAlertConfig.delete };
    if (message) {
        config.text = message;
    }
    return swal(config);
}

// Fungsi helper untuk notifikasi sukses
function showSuccess(message) {
    const config = { ...sweetAlertConfig.success };
    config.text = message;
    return swal(config);
}

// Fungsi helper untuk notifikasi error
function showError(message) {
    const config = { ...sweetAlertConfig.error };
    config.text = message;
    return swal(config);
}

// Fungsi helper untuk konfirmasi publikasi
function confirmPublish(message = null) {
    const config = { ...sweetAlertConfig.publish };
    if (message) {
        config.text = message;
    }
    return swal(config);
}

// Fungsi helper untuk konfirmasi selesai
function confirmComplete(message = null) {
    const config = { ...sweetAlertConfig.complete };
    if (message) {
        config.text = message;
    }
    return swal(config);
    }

// Inisialisasi Sweet Alert untuk notifikasi sistem
$(document).ready(function() {
    // Handle success message
    const successMessage = $('#success-message').text();
    if (successMessage && successMessage.trim() !== '') {
        showSuccess(successMessage);
    }

    // Handle error message
    const errorMessage = $('#error-message').text();
    if (errorMessage && errorMessage.trim() !== '') {
        showError(errorMessage);
    }
});
