$(document).ready(function () {
    $('.datatable').DataTable({

    });


    $('#table_export').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

});

jQuery(function ($) {
    var path = decodeURIComponent(window.location.href);
    $('#main-menu ul a').each(function () {
        if (path === decodeURIComponent(this.href)) {
            $(this).parent('li').addClass('active');
            $(this).parent('li').parent('ul').addClass('visible');
            $(this).parent('li').parent('ul').parent('li').addClass('opened active');
            $(this).parent('li').parent('ul').parent('li').parent('ul').addClass('visible');
            $(this).parent('li').parent('ul').parent('li').parent('ul').parent('li').addClass('opened active');
        }
    });
});