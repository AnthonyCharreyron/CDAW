document.addEventListener("DOMContentLoaded", function() {
    var descrElements = document.getElementsByClassName("descr");
    for (var i = 0; i < descrElements.length; i++) {
        descrElements[i].style.color = "red";
    }

    let monCaroussel = document.getElementById("caroussel");
    monCaroussel.style.background = "grey";

    var idElement = document.getElementById("p3");
    idElement.style.display="none";
});

