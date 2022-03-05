$(document).on("click", "a.remove-player", function () {
    var $this = $(this).closest("li");
    $.ajax({
        url: '/removeFromComparator/'+$this.attr('id'),
        processData: false,
    }).done(function(request){
        $this.remove();
    });
});