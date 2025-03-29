document.addEventListener("DOMContentLoaded" , function(){

    function dropdownNav() {
        const btnRecherche = document.querySelector("#nav__recherche");
        const dropdownNav = document.querySelector(".dropdownRecherche");

        if (btnRecherche && dropdownNav) {
            btnRecherche.addEventListener("click", function(e) {
                e.preventDefault();
                dropdownNav.classList.toggle("dropdownRecherche--active");
                this.classList.toggle("active", dropdownNav.classList.contains("dropdownRecherche--active"));
            });
        }
    }
    dropdownNav();
})