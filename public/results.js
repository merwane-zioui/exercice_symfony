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
            {
                extend: 'selected',
                text: 'Add to selection',
                action: function (e, dt, type, indexes) {
                    var data = dt.rows({selected: true}).data().toArray();
                    data.forEach(function(curr) {
                        $.ajax({
                            url: '/addToComparator/'+curr['id'],
                            processData: false,
                        }).done(function(request){
                            var $li = $('<li id="'+curr['id']+'"><p>'+curr['id']+' <a class="btn btn-danger remove-player">X</a></p></li>');
                            $li.appendTo($("#comparatorList"));
                        });
                    });
                }
            },
        ],
        responsive: true,
        data: data,
        columns: columns,
    });
    //});
}

