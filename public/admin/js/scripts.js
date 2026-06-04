document.addEventListener('DOMContentLoaded', function () {

    // =========================
    // TOOLTIP
    // =========================
    let tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );

    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });


    // =========================
    // AUTO CLOSE ALERT
    // =========================
    setTimeout(function () {
        document.querySelectorAll('.alert').forEach(function (alert) {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);


    // =========================
    // SUMMERNOTE
    // =========================
    if ($('.summernote').length) {

        $('.summernote').summernote({
            height: 300,

            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],

            callbacks: {
                onImageUpload: function (files) {
                    console.log(files);
                }
            }
        });
    }


    // =========================
    // LOAD NOTIFICATIONS
    // =========================
    loadNotifications();

    // Refresh setiap 30 detik
    setInterval(loadNotifications, 30000);

});


// =========================
// CONFIRM DELETE
// =========================
function confirmDelete(
    message = 'Apakah Anda yakin ingin menghapus data ini?'
) {
    return confirm(message);
}


// =========================
// PREVIEW IMAGE
// =========================
function previewImage(input, previewId) {

    if (input.files && input.files[0]) {

        let reader = new FileReader();

        reader.onload = function (e) {

            $(previewId)
                .attr('src', e.target.result)
                .show();
        };

        reader.readAsDataURL(input.files[0]);
    }
}


// =========================
// DRAG & DROP
// =========================
function setupDragAndDrop(dropzoneId, inputId, previewId) {

    const dropzone = document.getElementById(dropzoneId);

    if (!dropzone) return;


    dropzone.addEventListener('dragover', (e) => {

        e.preventDefault();
        dropzone.classList.add('dragover');
    });


    dropzone.addEventListener('dragleave', (e) => {

        e.preventDefault();
        dropzone.classList.remove('dragover');
    });


    dropzone.addEventListener('drop', (e) => {

        e.preventDefault();

        dropzone.classList.remove('dragover');

        const input = document.getElementById(inputId);

        input.files = e.dataTransfer.files;

        previewImage(input, previewId);
    });
}


// =========================
// LOAD NOTIFICATION AJAX
// =========================
function loadNotifications() {

    fetch('/admin/laporan/notifikasi')

        .then(response => response.json())

        .then(data => {

            const badge = document.getElementById('notifBadge');

            if (!badge) return;


            // Badge
            if (data.total_belum_dibaca > 0) {

                badge.textContent =
                    data.total_belum_dibaca > 99
                        ? '99+'
                        : data.total_belum_dibaca;

                badge.style.display = 'block';

            } else {

                badge.style.display = 'none';
            }


            // Dropdown
            const dropdown = document.getElementById('notifDropdown');
            const loading = document.getElementById('notifLoading');
            const empty = document.getElementById('notifEmpty');

            if (!dropdown) return;


            if (data.laporan_baru.length > 0) {

                const items =
                    dropdown.querySelectorAll('.notif-item');

                items.forEach(item => item.remove());


                data.laporan_baru.forEach(laporan => {

                    const item = document.createElement('li');

                    item.className = 'notif-item';

                    item.innerHTML = `
                        <a class="dropdown-item"
                           href="/admin/laporan/${laporan.id}">

                            <div class="d-flex align-items-start gap-3">

                                <div
                                    class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                    style="
                                        width:36px;
                                        height:36px;
                                        background:#E3F2FD;
                                    ">

                                    <i class="bi bi-file-earmark-text"
                                       style="color:#1565c0;"></i>

                                </div>

                                <div>

                                    <div class="fw-semibold small">
                                        ${laporan.judul_laporan}
                                    </div>

                                    <div class="small text-muted">
                                        Dari: ${laporan.nama_pelapor}
                                    </div>

                                    <small class="text-muted">
                                        ${new Date(
                                            laporan.created_at
                                        ).toLocaleString('id-ID')}
                                    </small>

                                </div>

                            </div>

                        </a>
                    `;

                    dropdown.insertBefore(
                        item,
                        document.getElementById('notifEmpty')
                    );
                });

                loading.style.display = 'none';
                empty.style.display = 'none';

            } else {

                loading.style.display = 'none';
                empty.style.display = 'block';
            }

        })

        .catch(error => {

            console.error(
                'Error loading notifications:',
                error
            );
        });
}