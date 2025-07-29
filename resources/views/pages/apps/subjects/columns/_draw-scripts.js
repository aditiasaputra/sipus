// Initialize KTMenu
KTMenu.init();

document.querySelectorAll('[data-kt-action="delete_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        const subjectId = this.getAttribute('data-kt-subject-id');

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
                Livewire.dispatch('delete_subject', [subjectId]);
            }
        });
    });
});

// document.addEventListener('livewire:initialized', () => {
//     Livewire.on('success', (message) => {
//         Swal.close();
//         toastr.success(message || 'Action completed successfully!');
//     });

//     Livewire.on('error', (message) => {
//         Swal.close();
//         toastr.error(message || 'An error occurred!');
//     });
// });

// Add click event listener to update buttons
document.querySelectorAll('[data-kt-action="update_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        Livewire.dispatch('update_subject', [this.getAttribute('data-kt-subject-id')]);
    });
});

// Listen for 'success' event emitted by Livewire
Livewire.on('success', (message) => {
    // Reload the subjects-table datatable
    LaravelDataTables['subjects-table'].ajax.reload();
});
