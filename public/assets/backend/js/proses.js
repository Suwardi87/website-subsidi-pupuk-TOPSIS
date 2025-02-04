let submit_method;

$(document).ready(function () {
    ProsesTable();
});

// form create
const modalProses= () => {
    submit_method = 'create';
    resetForm('#formProses');
    resetValidation();
    $('#formProses').modal('show');
    $('.modal-title').html('<i class="fa fa-plus"></i> Create Proses');
    $('.btnSubmit').html('<i class="fa fa-save"></i> Save');
}


// store data
$('#formProses').on('submit', function (e) {
    e.preventDefault();

    startLoading();

    let url = '/admin/proses';
    let method = 'POST';

    const inputForm = new FormData(this);

    if (submit_method == 'edit') {
        url = '/admin/proses/' + $('#id').val();
        inputForm.append('_method', 'PUT');
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: method,
        url: url,
        data: inputForm,
        contentType: false,
        processData: false,
        success: function (response) {
            resetValidation();
            stopLoading();

            Swal.fire({
                icon: 'success',
                title: "Success!",
                text: response.message,
            }).then(result => {
                if (result.isConfirmed) {
                    window.location.href = '/admin/proses';
                }
            });
        },
        error: function (jqXHR, response) {
            console.log(response.message);
            toastError(jqXHR.responseText);
        }
    });
});


// update data
$('#formUpdateProses').on('submit', function (e) {
    e.preventDefault();

    startLoading();

    let url, method;
    method = 'POST';

    const inputForm = new FormData(this);

    url = '/admin/proses/' + $('#id').val();
    inputForm.append('_method', 'PUT');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: method,
        url: url,
        data: inputForm,
        contentType: false,
        processData: false,
        success: function (response) {
            resetValidation();
            stopLoading();

            Swal.fire({
                icon: 'success',
                title: "Success!",
                text: response.message,
            }).then(result => {
                if (result.isConfirmed) {
                    window.location.href = '/admin/proses';
                }
            })
        },
        error: function (jqXHR, response) {
            console.log(response.message);
            toastError(jqXHR.responseText);
        }
    });
})

const modalVerifikasi = (e) => {
    let uuid = e.getAttribute('data-uuid');
    console.log("UUID:", uuid); // Debugging, cek UUID di console

    $('#verifikasiForm').attr('action', `proses/verifikasi/${uuid}`);
    $('#uuid').val(uuid); // Pastikan input hidden memiliki nilai UUID
    $('#modalVerifikasi').modal('show');
};

$(document).on('submit', '#verifikasiForm', function (e) {
    e.preventDefault();

    let url = $(this).attr('action');
    let method = $(this).attr('method');  // Form is set to use the PUT method

    startLoading();


    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Ensure CSRF protection
        },
        type: method,
        url: url,
        data: $(this).serialize(),
        success: function (response) {
            stopLoading();
            $('#modalVerifikasi').modal('hide'); // Hide the modal

            Swal.fire({
                icon: 'success',
                title: "Success!",
                text: response.message,
            }).then(result => {
                if (result.isConfirmed) {
                    window.location.href = '/admin/proses';
                }
            })
        },
        error: function (response) {
            stopLoading();
            $('#modalVerifikasi').modal('hide'); // Hide the modal on error
            let errors = response.responseJSON.errors;
            let message = '';

            if (response.status === 404) {
                message = 'Tidak ada hasil query untuk model [App\\Models\\Proses].';
            } else {
                $.each(errors, function (key, value) {
                    message += value + '<br>'; // Collect error messages
                });
            }

            Swal.fire({
                icon: 'error',
                title: 'error',
                html: message // Display error messages in SweetAlert
            });
        }
    });
});

// delete data
const deleteData = (e) => {
    let id = e.getAttribute('data-uuid');

    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to delete this data?",
        icon: "question",
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",
        allowOutsideClick: false,
        showCancelButton: true,
        showCloseButton: true
    }).then((result) => {
        startLoading();
        Swal.fire({
            title: "Please wait...",
            text: "Loading...",
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });


        if (result.value) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "DELETE",
                url: "/admin/proses/" + id,
                dataType: "json",
                success: function (response) {
                    window.location.href = '/admin/proses';
                    toastSuccess(response.message);
                },
                error: function (response) {
                    console.log(response);
                }
            });
        }
    })
}
