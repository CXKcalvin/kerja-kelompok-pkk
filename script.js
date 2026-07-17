js 

// =======================================
// PLAY BUTTON
// =======================================

const playBtn = document.getElementById("playBtn");

if (playBtn) {
    playBtn.addEventListener("click", () => {
        alert("🎬 Video showcase akan segera tersedia!");
    });
}


// =======================================
// NAVBAR SCROLL EFFECT
// =======================================

const header = document.querySelector("header");

window.addEventListener("scroll", () => {

    if (window.scrollY > 40) {

        header.style.background = "rgba(9,9,11,.95)";
        header.style.backdropFilter = "blur(18px)";
        header.style.boxShadow = "0 10px 30px rgba(0,0,0,.35)";

    } else {

        header.style.background = "rgba(9,9,11,.75)";
        header.style.boxShadow = "none";

    }

});


// =======================================
// SMOOTH SCROLL
// =======================================

document.querySelectorAll('a[href^="#"]').forEach(link => {

    link.addEventListener("click", function(e){

        e.preventDefault();

        const target = document.querySelector(this.getAttribute("href"));

        if(target){

            target.scrollIntoView({

                behavior:"smooth",
                block:"start"

            });

        }

    });

});


// =======================================
// SCROLL REVEAL ANIMATION
// =======================================

const revealItems = document.querySelectorAll(
    ".card, .portfolio-item, .pricing-card, .hero-image, .info-grid div"
);

const revealObserver = new IntersectionObserver((entries)=>{

    entries.forEach(entry=>{

        if(entry.isIntersecting){

            entry.target.style.opacity="1";
            entry.target.style.transform="translateY(0)";

            revealObserver.unobserve(entry.target);

        }

    });

},{
    threshold:.15
});

revealItems.forEach(item=>{

    item.style.opacity="0";
    item.style.transform="translateY(50px)";
    item.style.transition="all .7s ease";

    revealObserver.observe(item);

});


// =======================================
// STAGGER CARD ANIMATION
// =======================================

const cards = document.querySelectorAll(".card");

cards.forEach((card,index)=>{

    card.style.transitionDelay = `${index * 0.15}s`;

});

const developers = document.querySelectorAll(".portfolio-item");

developers.forEach((item,index)=>{

    item.style.transitionDelay = `${index * 0.15}s`;

});


// =======================================
// HERO IMAGE PARALLAX
// =======================================

const heroImage = document.querySelector(".hero-image");

if(heroImage){

    heroImage.addEventListener("mousemove",(e)=>{

        const rect = heroImage.getBoundingClientRect();

        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        const rotateY = (x / rect.width - 0.5) * 12;
        const rotateX = (0.5 - y / rect.height) * 12;

        heroImage.style.transform =
            `perspective(900px)
             rotateX(${rotateX}deg)
             rotateY(${rotateY}deg)
             scale(1.02)`;

    });

    heroImage.addEventListener("mouseleave",()=>{

        heroImage.style.transform =
            "perspective(900px) rotateX(0deg) rotateY(0deg) scale(1)";

    });

}


// =======================================
// BUTTON RIPPLE EFFECT
// =======================================

const buttons = document.querySelectorAll(".btn-primary");

buttons.forEach(button=>{

    button.addEventListener("click",function(e){

        const ripple = document.createElement("span");

        ripple.classList.add("ripple");

        const rect = this.getBoundingClientRect();

        ripple.style.left = `${e.clientX - rect.left}px`;
        ripple.style.top = `${e.clientY - rect.top}px`;

        this.appendChild(ripple);

        setTimeout(()=>{

            ripple.remove();

        },600);

    });

});


// =======================================
// BACK TO TOP
// =======================================

const backTop = document.createElement("button");

backTop.innerHTML = "↑";

backTop.style.position = "fixed";
backTop.style.right = "25px";
backTop.style.bottom = "25px";
backTop.style.width = "48px";
backTop.style.height = "48px";
backTop.style.border = "none";
backTop.style.borderRadius = "50%";
backTop.style.cursor = "pointer";
backTop.style.fontSize = "20px";
backTop.style.background = "#A855F7";
backTop.style.color = "#fff";
backTop.style.display = "none";
backTop.style.zIndex = "999";
backTop.style.boxShadow = "0 10px 25px rgba(168,85,247,.35)";
backTop.style.transition = ".3s";

document.body.appendChild(backTop);

window.addEventListener("scroll",()=>{

    if(window.scrollY > 400){

        backTop.style.display = "block";

    }else{

        backTop.style.display = "none";

    }

});

backTop.addEventListener("click",()=>{

    window.scrollTo({

        top:0,
        behavior:"smooth"

    });

});