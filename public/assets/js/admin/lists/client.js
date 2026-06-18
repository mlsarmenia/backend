$(document).ready(function () {
    console.log(99)
    var dataTable = $('#crudTable').DataTable(); // Use your DataTable ID

    dataTable.on('init.dt', function () {
        dataTable.rows().every(function () {
            var data = this.data();
            var archiveDateSpan = $(data[4]); //TODO: change logic
            var archiveDate = archiveDateSpan.text().trim();
            console.log(archiveDate);
            var currentDate = new Date();
            var archiveTillDate = new Date(archiveDate);

            if (archiveTillDate < currentDate) {
                $(this.node()).addClass('bg-red text-white');
            }
        });
    });
});


