const allowedExtensions = ["jpg", "jpeg", "png", "webp"];

function getWordCount(value) {
    return value.trim().split(/\s+/).filter(Boolean).length;
}

function validateImage(file) {
    if (!file) return true;
    const extension = file.name.split(".").pop().toLowerCase();
    return allowedExtensions.includes(extension);
}

function validateModuleForm(form) {
    const title = form.querySelector('[name="title"]');
    const description = form.querySelector('[name="description"]');
    const image = form.querySelector('[name="image"]');
    const errorBox = form.querySelector(".error-message");

    if (!title || !description || !errorBox) return true;

    const titleWords = getWordCount(title.value);
    if (titleWords > 20) {
        errorBox.textContent = `Judul hanya boleh maksimal 20 kata. Saat ini ${titleWords} kata.`;
        return false;
    }

    const descriptionWords = getWordCount(description.value);
    if (descriptionWords > 150) {
        errorBox.textContent = `Deskripsi hanya boleh maksimal 150 kata. Saat ini ${descriptionWords} kata.`;
        return false;
    }

    if (
        image &&
        image.files &&
        image.files.length > 0 &&
        !validateImage(image.files[0])
    ) {
        errorBox.textContent =
            "Foto harus berformat JPG, JPEG, PNG, atau WEBP.";
        return false;
    }

    errorBox.textContent = "";
    return true;
}

function bindFormValidation(form) {
    if (!form) return;

    form.addEventListener("submit", function (event) {
        if (!validateModuleForm(this)) {
            event.preventDefault();
        }
    });

    const imageInput = form.querySelector('[name="image"]');
    if (imageInput) {
        imageInput.addEventListener("change", function () {
            if (this.files.length && !validateImage(this.files[0])) {
                const errorBox = form.querySelector(".error-message");
                if (errorBox) {
                    errorBox.textContent =
                        "Foto harus berformat JPG, JPEG, PNG, atau WEBP.";
                }
                this.value = "";
            }
        });
    }
}

const serviceForm = document.getElementById("serviceForm");
const portfolioForm = document.getElementById("portfolioForm");
const updateForms = document.querySelectorAll('form[data-validate="true"]');

bindFormValidation(serviceForm);
bindFormValidation(portfolioForm);
updateForms.forEach(bindFormValidation);

const serviceImageInput = document.getElementById("serviceImage");
const serviceImagePreview = document.getElementById("serviceImagePreview");

if (serviceImageInput && serviceImagePreview) {
    serviceImageInput.addEventListener("change", (event) => {
        const file = event.target.files[0];
        if (!file || !validateImage(file)) return;

        const url = URL.createObjectURL(file);
        serviceImagePreview.innerHTML = "";
        const img = document.createElement("img");
        img.src = url;
        img.alt = "Preview Layanan";
        serviceImagePreview.appendChild(img);
    });
}

const portfolioImageInput = document.getElementById("portfolioImage");
const portfolioImagePreview = document.getElementById("portfolioImagePreview");

if (portfolioImageInput && portfolioImagePreview) {
    portfolioImageInput.addEventListener("change", (event) => {
        const file = event.target.files[0];
        if (!file || !validateImage(file)) return;

        const url = URL.createObjectURL(file);
        portfolioImagePreview.innerHTML = "";
        const img = document.createElement("img");
        img.src = url;
        img.alt = "Preview Hasil Jasa";
        portfolioImagePreview.appendChild(img);
    });
}

const ctx = document.getElementById("trafficChart");
if (ctx) {
    const chartContext = ctx.getContext("2d");
    const sampleLabels = ["Minggu 1", "Minggu 2", "Minggu 3", "Minggu 4"];
    const visits = [1500, 1200, 1100, 1900];
    const income = [3500000, 2000000, 1500000, 4000000];
    const total = income.reduce((acc, value) => acc + value, 0);
    const entries = visits.length;

    document.getElementById("totalIncome").textContent =
        "Rp " + total.toLocaleString("id-ID");
    document.getElementById("entriesCount").textContent = entries * 10;

    new Chart(chartContext, {
        type: "bar",
        data: {
            labels: sampleLabels,
            datasets: [
                {
                    type: "line",
                    label: "Kunjungan",
                    data: visits,
                    borderColor: "#7b2cbf",
                    backgroundColor: "rgba(123,44,191,0.12)",
                    tension: 0.5,
                    yAxisID: "y",
                },
                {
                    type: "bar",
                    label: "Pemasukkan (Rp)",
                    data: income.map((v) => v / 1000),
                    backgroundColor: "#5a189a",
                    yAxisID: "y1",
                },
            ],
        },
        options: {
            responsive: true,
            interaction: { mode: "index", intersect: false },
            scales: {
                y: {
                    type: "linear",
                    position: "left",
                    ticks: { color: "#cfc" },
                    beginAtZero: true,
                },
                y1: {
                    type: "linear",
                    position: "right",
                    ticks: { color: "#ffd" },
                    beginAtZero: true,
                    grid: { display: false },
                },
            },
            plugins: { legend: { labels: { color: "#ddd" } } },
        },
    });
}
