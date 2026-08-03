@extends('layout.template')

@section('title','Studio Edit | Jasa Edit Foto Profesional')
<!-- CSS -->
<link rel="stylesheet" href="/css/style.css">

@section('isi')

<body>
    <!-- ================= HEADER ================= -->
    <header>
        <div class="container">
            <div href="#" class="logo">
                <img src="/img/logo.png" alt="Logo"></img>
                Studio Edit
                <span>
                    Status: {{ Auth::user()->status->nama_status }}
                </span>
            </div>

            <nav class="menu">
                <a href="#home">Home</a>
                <a href="#layanan">Layanan</a>
                <a href="#developer">Developer</a>
                <a href="#harga">Harga</a>
                <a href="#hasil">Hasil Jasa Kami</a>
            </nav>

            <a href="https://wa.me/6285669716800" target="_blank" class="btn-primary">
                Contact Us
            </a>
        </div>
    </header>

    <!-- ================= HERO ================= -->

    <section id="home" class="hero">
        <div>
            <span class="badge">
                Premium Photo Editing
            </span>

            <h1 class="hero-title">
                Ubah Foto Biasa Menjadi
                <span>Mahakarya Digital</span>
            </h1>

            <p class="hero-text">
                Jasa edit foto profesional dengan hasil premium,
                pengerjaan cepat, harga terjangkau, dan kualitas terbaik.
            </p>

            <div class="hero-button">
                <a href="#harga" class="btn-primary">
                    Pesan Sekarang
                </a>

                <a href="https://wa.me/6285669716800" target="_blank" class="btn-secondary">
                    Gratis Konsultasi
                </a>
            </div>

            <div class="info-grid">
                <div>
                    <small>Proses</small>
                    <h3>10–45 Menit</h3>
                </div>

                <div>
                    <small>Revisi</small>
                    <h3>Gratis</h3>
                </div>

                <div>
                    <small>Metode</small>
                    <h3>Online</h3>
                </div>
            </div>
        </div>

        <div class="hero-image">
            <img src="/img/sample_01_before.cd33084c.webp" alt="Showcase">

            <span class="image-label">
                Hapus Objek Profesional
            </span>
        </div>
    </section>

    <!-- ================= LAYANAN ================= -->

    <section id="layanan" class="section">
        <div class="section-title">
            <h2>Layanan Kami</h2>

            <p>
                Kami menyediakan berbagai layanan editing foto profesional
                dengan kualitas tinggi dan harga yang terjangkau.
            </p>
        </div>

        <div class="card-grid">
            <div class="card">
                <img src="/img/Perfect skin retouching.jpeg" alt="Retouch">
                <h3>Retouch Wajah</h3>
                <p>
                    Menghaluskan kulit, menghilangkan noda,
                    jerawat, dan membuat wajah tetap natural.
                </p>
            </div>

            <div class="card">
                <img src="/img/sample_01_before.cd33084c.webp" alt="Object">
                <h3>Tambah / Hapus Objek</h3>
                <p>
                    Menghilangkan objek yang mengganggu
                    atau menambahkan objek baru secara realistis.
                </p>
            </div>

            <div class="card">
                <img src="/img/_.jpeg" alt="Pas Foto">
                <h3>Edit Pas Foto</h3>
                <p>
                    Mengganti background, ukuran,
                    hingga edit pakaian formal dengan hasil profesional.
                </p>
            </div>
        </div>
    </section>

    <!-- ================= DEVELOPER ================= -->

    <section id="developer" class="section">
        <div class="section-title">
            <h2>Tim Developer</h2>
            <p>
                Website ini dibuat oleh tim yang berkolaborasi dalam desain,
                pengembangan, dan implementasi website.
            </p>
        </div>

        <div class="portfolio-grid">
            <div class="portfolio-item">
                <img src="/img/leoni.jpeg" alt="Leoni">
                <div class="portfolio-info">
                    <h3>Leoni Puspita Arianti</h3>
                    <p>Front-End Developer</p>
                </div>
            </div>

            <div class="portfolio-item">
                <img src="/img/afdal.jpeg" alt="Afdal">
                <div class="portfolio-info">
                    <h3>Mumammad Afdhal Zikri</h3>
                    <p>UI / UX Designer</p>
                </div>
            </div>

            <div class="portfolio-item">
                <img src="/img/calvin.jpeg" alt="Calvin">
                <div class="portfolio-info">
                    <h3>Muhammad Calvin Pradivta</h3>
                    <p>Back-End Developer</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= HARGA ================= -->

    <section id="harga" class="section harga">
        <div class="pricing-card">
            <span class="pricing-badge">
                Paling Hemat
            </span>
            <h2>Photo Editing</h2>

            <div class="price">
                <small>Mulai dari</small>
                <h1>Rp20K</h1>
                <p>/ Foto</p>
            </div>

            <ul>
                <li><i class="fa-solid fa-check"></i> Retouch Wajah</li>
                <li><i class="fa-solid fa-check"></i> Hapus Background</li>
                <li><i class="fa-solid fa-check"></i> Hapus Objek</li>
                <li><i class="fa-solid fa-check"></i> Color Correction</li>
                <li><i class="fa-solid fa-check"></i> 1x Revisi Gratis</li>
            </ul>

            <a href="https://wa.me/6285669716800" class="btn-primary">
                Pesan Sekarang
            </a>
        </div>

        <div class="pricing-card">
            <span class="pricing-badge">
                Paket Favorit
            </span>
            <h2>Video Editing</h2>

            <div class="price">
                <small>Mulai dari</small>
                <h1>Rp50K</h1>
                <p>/ Video</p>
            </div>

            <ul>
                <li><i class="fa-solid fa-check"></i> Potong & Gabung Video</li>
                <li><i class="fa-solid fa-check"></i> Transisi Smooth</li>
                <li><i class="fa-solid fa-check"></i> Color Grading</li>
                <li><i class="fa-solid fa-check"></i> Subtitle / Caption</li>
                <li><i class="fa-solid fa-check"></i> 2x Revisi Gratis</li>
            </ul>

            <a href="https://wa.me/6285669716800" class="btn-primary">
                Pesan Sekarang
            </a>
        </div>

        <div class="pricing-card">
            <span class="pricing-badge">
                Premium
            </span>
            <h2>Photo & Video Premium</h2>

            <div class="price">
                <small>Mulai dari</small>
                <h1>Rp100K</h1>
                <p>/ Project</p>
            </div>

            <ul>
                <li><i class="fa-solid fa-check"></i> Semua Fitur Editing Foto</li>
                <li><i class="fa-solid fa-check"></i> Semua Fitur Editing Video</li>
                <li><i class="fa-solid fa-check"></i> Thumbnail Premium</li>
                <li><i class="fa-solid fa-check"></i> Export Full HD</li>
                <li><i class="fa-solid fa-check"></i> Revisi Unlimited*</li>
            </ul>

            <a href="https://wa.me/6285669716800" class="btn-primary">
                Pesan Sekarang
            </a>
        </div>
    </section>

    <!-- ================= FOOTER ================== -->

    <footer>
        <p>
            © 2026 Studio Edit. All Rights Reserved.
        </p>
    </footer>

    <script src="/js/script.js"></script>

</body>
@endsection