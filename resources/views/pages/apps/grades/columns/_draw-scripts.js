// Initialize KTMenu
KTMenu.init();

document.querySelectorAll('[data-kt-action="delete_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        const gradeId = this.getAttribute('data-kt-grade-id');

        Swal.fire({
            text: 'Are you sure you want to remove?',
            icon: 'warning',
            buttonsStyling: false,
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-secondary',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                        Livewire.on('success', (message) => {
                            Swal.close();
                        });

                        Livewire.on('error', (message) => {
                            Swal.close();
                        });
                    }
                });
                Livewire.dispatch('delete_grade', [gradeId]);
            }
        });
    });
});

// Add click event listener to update buttons
document.querySelectorAll('[data-kt-action="update_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        Livewire.dispatch('update_grade', [this.getAttribute('data-kt-grade-id')]);
    });
});

// Listen for 'success' event emitted by Livewire
Livewire.on('success', (message) => {
    // Reload the grades-table datatable
    LaravelDataTables['grades-table'].ajax.reload();
});
