// Simple Datatable
const table1 = document.querySelector('#table1');
if (table1) {
    const dataTable = new simpleDatatables.DataTable(table1);
}

$(function () {
    $(document).on('click', '#delete_item', function (e) {
        e.preventDefault()
        const link = $(this).attr("href")
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this file!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, keep it'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                // For more information about handling dismissals please visit
                // https://sweetalert2.github.io/#handling-dismissals
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    'Cancelled',
                    'Your file is safe.',
                    'error'
                )
            }
        })
    })
})