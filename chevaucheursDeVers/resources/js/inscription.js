$(document).ready(function() {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    $('.inscription').on('click', function() {
        $('.inscription-form').toggle(); 
    });

    $('.submit-inscription').on('click', function() {
        
        var pseudo = document.getElementById('inscription-pseudo').value;
        var email = document.getElementById('inscription-email').value;
        var password = document.getElementById('inscription-password').value;

        let formData = new FormData();
        formData.append("pseudo", pseudo);
        formData.append("email", email);
        formData.append("password", password);

        $.ajax({
            url: 'connexion/creerUser',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            method: 'post',
            headers: {'X-CSRF-TOKEN': csrfToken},
            success: function(data){
                console.log(data);
                window.location.reload();
            },
            error: function(err) {
                console.log("Erreur");
                console.log(err);

            }
        });
    });
});
