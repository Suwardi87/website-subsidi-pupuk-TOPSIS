let submit_method;

$(document).ready(function () {
    DosisPemupukanTable();
});

// form create
const modalKomoditas= () => {
    submit_method = 'create';
    resetForm('#formDosisPemupukan');
    resetValidation();
    $('#formDosisPemupukan').modal('show');
    $('.modal-title').html('<i class="fa fa-plus"></i> Create Dosis Pemupukan');
    $('.btnSubmit').html('<i class="fa fa-save"></i> Save');
}

// store data
$('#formDosisPemupukan').on('submit', function (e) {
    e.preventDefault();

    startLoading();

    let url = '/admin/dosis-pupuk';
    let method = 'POST';

    const inputForm = new FormData(this);

    if (submit_method == 'edit') {
        url = '/admin/dosis-pupuk/' + $('#id').val();
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
                    window.location.href = '/admin/dosis-pupuk';
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
$('#formUpdateDosisPempupukan').on('submit', function (e) {
    e.preventDefault();

    startLoading();

    let url, method;
    method = 'POST';

    const inputForm = new FormData(this);

    url = '/admin/dosis-pupuk/' + $('#id').val();
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
                    window.location.href = '/admin/dosis-pupuk';
                }
            })
        },
        error: function (jqXHR, response) {
            console.log(response.message);
            toastError(jqXHR.responseText);
        }
    });
})


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

        if (result.value) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "DELETE",
                url: "/admin/dosis-pupuk/" + id,
                dataType: "json",
                success: function (response) {
                    window.location.href = '/admin/dosis-pupuk';
                    toastSuccess(response.message);
                },
                error: function (response) {
                    console.log(response);
                }
            });
        }
    })
}

