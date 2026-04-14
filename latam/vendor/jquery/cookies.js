const cookieCointainer = document.querySelector(".cookie-container");
const cookieButton = document.querySelector(".cookie-btn");

cookieButton.addEventListener("click", () => {
    cookieCointainer.classList.remove("active");
    localStorage.setItem("cookieBannerDisplayed", "true");
    
});


setTimeout (()  =>  {
    if(!localStorage.getItem("cookieBannerDisplayed"))
    cookieCointainer.classList.add("active");
    }, 2000);

