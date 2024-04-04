

jQuery(function($){
    $(document).ready(function() {
        var zones = document.querySelectorAll('.rectangle');

        zones.forEach(function(zone) {
            zone.addEventListener('click', function() {
                var couleur = $(this).data('couleur');
                this.classList.add = couleur;
                var zoneId = this.getAttribute('id');

                sendZoneAColorer(zoneId, 'red');
            });
        });
    });
})
