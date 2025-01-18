let Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
})

const toastSuccess = (message) => {
    Toast.fire({
        icon: 'success',
        title: message
    })
}

const toastError = (message) => {
    Toast.fire({
        icon: 'error',
        title: message
    })
}

const startLoading = (str = 'Please wait...') => {
    Swal.fire({
        title: 'Loading',
        text: str,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading()
        }
    })
}

const stopLoading = () => {
    Swal.close()
}

const resetForm = (form) => {
    $(form)[0].reset();
}

const resetValidation = () => {
    $('.is-invalid').removeClass('is-invalid');
    $('.is-valid').removeClass('is-valid');
    $('.invalid-feedback').remove();
    
}
