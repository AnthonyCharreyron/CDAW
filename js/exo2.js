document.addEventListener("DOMContentLoaded", function() {
    var elements = document.querySelectorAll('.descr'); 
    
    elements.forEach(function(element) {
        element.style.backgroundColor = "red"; 
    }); 

    let monCaroussel = document.getElementById("caroussel");
    let premierParagraphe = monCaroussel.querySelector('p');
    premierParagraphe.style.backgroundColor = "lightblue";

    let deuxiemeParagraphe = monCaroussel.querySelector('p:nth-of-type(2)');
    deuxiemeParagraphe.style.display = 'none';
    //deuxiemeParagraphe.style.display = 'block'; 

});