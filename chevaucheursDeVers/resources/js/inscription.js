$(document).ready(function() {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
   
    $('.inscription').on('click', function() {
        $('.inscription-form').toggle();
        $('.inscription').toggle();
        $('#connexionContainer').toggle();
    });

});
