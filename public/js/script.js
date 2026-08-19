js;

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

document.querySelectorAll('a[href^="#"]').forEach((link) => {
    link.addEventListener("click", function (e) {
        e.preventDefault();

        const target = document.querySelector(this.getAttribute("href"));

        if (target) {
            target.scrollIntoView({
                behavior: "smooth",
                block: "start",
            });
        }
    });
});

// =======================================
// SCROLL REVEAL ANIMATION
// =======================================

const revealItems = document.querySelectorAll(
    ".card, .portfolio-item, .pricing-card, .hero-image, .info-grid div",
);

const revealObserver = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = "1";
                entry.target.style.transform = "translateY(0)";

                revealObserver.unobserve(entry.target);
            }
        });
    },
    {
        threshold: 0.15,
    },
);

revealItems.forEach((item) => {
    item.style.opacity = "0";
    item.style.transform = "translateY(50px)";
    item.style.transition = "all .7s ease";

    revealObserver.observe(item);
});

// =======================================
// STAGGER CARD ANIMATION
// =======================================

const cards = document.querySelectorAll(".card");

cards.forEach((card, index) => {
    card.style.transitionDelay = `${index * 0.15}s`;
});

const developers = document.querySelectorAll(".portfolio-item");

developers.forEach((item, index) => {
    item.style.transitionDelay = `${index * 0.15}s`;
});

// =======================================
// HERO IMAGE PARALLAX
// =======================================

const heroImage = document.querySelector(".hero-image");

if (heroImage) {
    heroImage.addEventListener("mousemove", (e) => {
        const rect = heroImage.getBoundingClientRect();

        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        const rotateY = (x / rect.width - 0.5) * 12;
        const rotateX = (0.5 - y / rect.height) * 12;

        heroImage.style.transform = `perspective(900px)
             rotateX(${rotateX}deg)
             rotateY(${rotateY}deg)
             scale(1.02)`;
    });

    heroImage.addEventListener("mouseleave", () => {
        heroImage.style.transform =
            "perspective(900px) rotateX(0deg) rotateY(0deg) scale(1)";
    });
}

// =======================================
// BUTTON RIPPLE EFFECT
// =======================================

const buttons = document.querySelectorAll(".btn-primary");

buttons.forEach((button) => {
    button.addEventListener("click", function (e) {
        const ripple = document.createElement("span");

        ripple.classList.add("ripple");

        const rect = this.getBoundingClientRect();

        ripple.style.left = `${e.clientX - rect.left}px`;
        ripple.style.top = `${e.clientY - rect.top}px`;

        this.appendChild(ripple);

        setTimeout(() => {
            ripple.remove();
        }, 600);
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

window.addEventListener("scroll", () => {
    if (window.scrollY > 400) {
        backTop.style.display = "block";
    } else {
        backTop.style.display = "none";
    }
});

backTop.addEventListener("click", () => {
    window.scrollTo({
        top: 0,
        behavior: "smooth",
    });
});

// =======================================
// ULASAN CLIENT-SIDE
// =======================================

const commentForm = document.getElementById("commentForm");

if (commentForm) {
    const storageKey = "studioEditComments";
    const blockedCountKey = "studioEditBlockedComments";
    const expiryMs = 30 * 24 * 60 * 60 * 1000;
    const blacklist = [
        "anjing",
        "babi",
        "bangsat",
        "brengsek",
        "bodoh",
        "bego",
        "goblok",
        "kampret",
        "kontol",
        "memek",
        "tolol",
        "idiot",
        "bajingan",
        "monyet",
        "sara",
        "rasis",
        "radikal",
        "judi",
        "judol",
        "slot",
        "narkoba",
        "scam",
        "penipuan",
        "phishing",
        "spam",
        "sex",
        "porno",
        "pornografi",
    ];
    const nameInput = document.getElementById("commentName");
    const messageInput = document.getElementById("commentMessage");
    const adminSearch = document.getElementById("adminSearch");
    const adminList = document.getElementById("adminList");
    const activeCount = document.getElementById("activeCount");
    const filteredCount = document.getElementById("filteredCount");
    const blockedCount = document.getElementById("blockedCount");

    const readComments = () => {
        try {
            const comments = JSON.parse(
                localStorage.getItem(storageKey) || "[]",
            );
            return Array.isArray(comments) ? comments : [];
        } catch (error) {
            return [];
        }
    };

    const writeComments = (comments) =>
        localStorage.setItem(storageKey, JSON.stringify(comments));

    const removeExpiredComments = () => {
        const now = Date.now();
        const activeComments = readComments().filter((comment) => {
            const createdAt = new Date(comment.createdAt).getTime();
            return Number.isFinite(createdAt) && now - createdAt <= expiryMs;
        });
        writeComments(activeComments);
        return activeComments;
    };

    const escapeHtml = (value) =>
        String(value).replace(
            /[&<>'"]/g,
            (character) =>
                ({
                    "&": "&amp;",
                    "<": "&lt;",
                    ">": "&gt;",
                    "'": "&#39;",
                    '"': "&quot;",
                })[character],
        );

    const findBlockedWord = (text) => {
        const words =
            text
                .toLowerCase()
                .normalize("NFKC")
                .match(/[\p{L}\p{N}]+/gu) || [];
        return blacklist.find((blockedWord) => words.includes(blockedWord));
    };

    const formatDate = (createdAt) =>
        new Intl.DateTimeFormat("id-ID", {
            dateStyle: "medium",
            timeStyle: "short",
        }).format(new Date(createdAt));

    const commentCard = (comment) =>
        `<div class="commentuser"><span>${escapeHtml(comment.name)}</span><p>${escapeHtml(comment.message)}</p></div>`;

    const renderMarquee = (comments) => {
        document.querySelectorAll("[data-marquee-row]").forEach((row) => {
            const rowNumber = Number(row.dataset.marqueeRow);
            const rowComments = comments.filter(
                (comment, index) => index % 3 === rowNumber,
            );
            row.innerHTML =
                (rowComments.length ? rowComments : comments)
                    .map(commentCard)
                    .join("") ||
                '<p class="empty-state">Jadilah ulasan pertama.</p>';
        });
    };

    const renderAdmin = (comments) => {
        const searchTerm = (adminSearch.value || "").trim().toLowerCase();
        const visibleComments = comments.filter((comment) =>
            `${comment.name} ${comment.message}`
                .toLowerCase()
                .includes(searchTerm),
        );
        activeCount.textContent = comments.length;
        filteredCount.textContent = visibleComments.length;
        blockedCount.textContent = Number(
            localStorage.getItem(blockedCountKey) || 0,
        );
        adminList.innerHTML = visibleComments.length
            ? visibleComments
                  .map(
                      (comment) =>
                          `<article class="admin-item"><div class="admin-item-top"><strong>${escapeHtml(comment.name)}</strong><time datetime="${escapeHtml(comment.createdAt)}">${formatDate(comment.createdAt)}</time></div><p>${escapeHtml(comment.message)}</p><div class="admin-actions"><button type="button" data-detail-id="${escapeHtml(comment.id)}">Detail</button><button type="button" data-delete-id="${escapeHtml(comment.id)}">Hapus</button></div></article>`,
                  )
                  .join("")
            : '<p class="empty-state">Tidak ada komentar yang cocok.</p>';
    };

    const render = (comments) => {
        renderMarquee(comments);
        renderAdmin(comments);
    };

    commentForm.addEventListener("submit", (event) => {
        event.preventDefault();
        const name = nameInput.value.trim();
        const message = messageInput.value.trim();
        const blockedWord = findBlockedWord(`${name} ${message}`);

        if (!name || !message) {
            alert("Nama dan isi pesan wajib diisi.");
            return;
        }

        if (blockedWord) {
            localStorage.setItem(
                blockedCountKey,
                Number(localStorage.getItem(blockedCountKey) || 0) + 1,
            );
            alert(
                "Peringatan: Komentar Anda mengandung kata-kata yang tidak pantas/kasar. Mohon gunakan bahasa yang sopan dan bijak!",
            );
            return;
        }

        const comments = removeExpiredComments();
        comments.unshift({
            id: `${Date.now()}-${Math.random().toString(36).slice(2, 8)}`,
            name,
            message,
            createdAt: new Date().toISOString(),
        });
        writeComments(comments);
        commentForm.reset();
        render(comments);
        alert("Ulasan berhasil disimpan.");
    });

    adminSearch.addEventListener("input", () => renderAdmin(readComments()));

    adminList.addEventListener("click", (event) => {
        const detailButton = event.target.closest("[data-detail-id]");
        const deleteButton = event.target.closest("[data-delete-id]");
        const comments = readComments();

        if (detailButton) {
            const comment = comments.find(
                (item) => item.id === detailButton.dataset.detailId,
            );
            if (comment)
                alert(
                    `Nama: ${comment.name}\nDibuat: ${formatDate(comment.createdAt)}\n\n${comment.message}`,
                );
        }

        if (deleteButton) {
            const comment = comments.find(
                (item) => item.id === deleteButton.dataset.deleteId,
            );
            if (comment && confirm(`Hapus komentar dari ${comment.name}?`)) {
                const remainingComments = comments.filter(
                    (item) => item.id !== comment.id,
                );
                writeComments(remainingComments);
                render(remainingComments);
            }
        }
    });

    render(removeExpiredComments());
}
