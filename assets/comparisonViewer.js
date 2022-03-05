if (data[0] != null) {
    var columnNames = Object.keys(data[0]);
    columns = [];
    for (var i in columnNames) {
        columns.push({
            title: columnNames[i],
            data: columnNames[i]
        });
    }

    $('#example').DataTable({
        "dom": 'QBlfrtip',
        scrollY: "600px",
        scrollX: true,
        scrollCollapse: true,
        select: true,
        buttons: [
        ],
        responsive: true,
        data: data,
        columns: columns,
    });
    //});
}