

jQuery(function($){
    $(document).ready(function() {
        window.placerVer = function(){
            $('#consigne-poser-ver').toggle();
            var zones = document.querySelectorAll('.rectangle');

            zones.forEach(function(zone) {
                zone.addEventListener('click', function() {
                    var couleur = $(this).data('couleur');
                    couleur = convertColor(couleur)
                    var zoneId = this.getAttribute('id');
                    poserVer(this, zoneId, couleur);
                });
            });
        }

        function convertColor(color) {
            switch(color) {
                case 'bleu':
                    return 'blue';
                case 'jaune':
                    return 'yellow';
                case 'rouge':
                    return 'red';
                case 'violet':
                    return 'purple';
                case 'vert':
                    return 'green';
                default:
                    return 'black';
            }
        }
    });
})
