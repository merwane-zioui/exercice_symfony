$(".remove-player").click(function () {
    var $this = $(this).closest("li");
    $.ajax({
        url: '/removeFromComparator/'+$this.attr('id'),
        processData: false,
    }).done(function(request){
        $this.remove();
    });
});