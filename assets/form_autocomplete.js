function formatData(res) {
    data = [];
    res.forEach(player => data.push(player['first_name'] + " " + player['last_name']));
    return data;
}

$('.form-control').autoComplete({
    resolver: 'custom',
    events: {
        search: function (qry, callback) {
            // let's do a custom ajax call
            $.ajax(
                '/autocomplete/'+$('.form-control').val(),
            ).done(function (res) {
                console.log(formatData(res['data']));
                callback(formatData(res['data']))
            });
        }
    }
});