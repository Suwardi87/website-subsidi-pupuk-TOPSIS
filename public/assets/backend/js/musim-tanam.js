let submit_method;

$(document).ready(function () {
    MusimTanamTable();
});

// form create
const modalMusimTanam= () => {
    submit_method = 'create';
    resetForm('#formMusimTanam');
    resetValidation();
    $('#formMusimTanam').modal('show');
    $('.modal-title').html('<i class="fa fa-plus"></i> Create Musim Tanam');
    $('.btnSubmit').html('<i class="fa fa-save"></i> Save');
}


// store data
$('#formMusimTanam').on('submit', function (e) {
    e.preventDefault();

    startLoading();

    let url = '/admin/musim-tanam';
    let method = 'POST';

    const inputForm = new FormData(this);

    if (submit_method == 'edit') {
        url = '/admin/musim-tanam/' + $('#id').val();
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
                    window.location.href = '/admin/musim-tanam';
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
$('#formUpdateMusimTanam').on('submit', function (e) {
    e.preventDefault();

    startLoading();

    let url, method;
    method = 'POST';

    const inputForm = new FormData(this);

    url = '/admin/musim-tanam/' + $('#id').val();
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
                    window.location.href = '/admin/musim-tanam';
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
                url: "/admin/musim-tanam/" + id,
                dataType: "json",
                success: function (response) {
                    window.location.href = '/admin/musim-tanam';
                    toastSuccess(response.message);
                },
                error: function (response) {
                    console.log(response);
                }
            });
        }
    })
}

