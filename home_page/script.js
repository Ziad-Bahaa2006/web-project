//this is script for list of the profile droplist in home page
document.addEventListener("DOMContentLoaded", function(){
const profileIcon = document.querySelector(".profile-icon");

    if (profileIcon) {
        profileIcon.addEventListener("click", function(){
            this.classList.toggle("active");
            document.querySelectorAll(".profile-icon").forEach(icon =>{
                if (icon !== this ) icon.classList.remove("active");
            });
        });
    }

    document.addEventListener("click", function(e) {
        const dropdown = document.querySelector(".menu");
        const icon = document.querySelector(".profile-icon");

        if (!e.target.closest(".profile-icon") && !e.target.closest(".menu")) {
            if (icon) icon.classList.remove("active");
        }
    });
});

