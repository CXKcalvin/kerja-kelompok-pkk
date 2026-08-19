@extends('layout.template')

@section('title','Studio Edit | Jasa Edit Foto Profesional')
<!-- CSS -->
<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/komen.css">

@section('isi')

<body>
    <!-- ================= HEADER ================= -->
    <header>
        <div class="container">
            <div href="#" class="logo">
                <img src="/img/logo.png" alt="Logo"></img>
                <span class="judul">
                    Studio Edit
                    <span class="status">
                        Status:
                        {{ Auth::user()->status->nama_status }}
                    </span>
                </span>
            </div>

            <nav class="menu">
                <a href="#home">Home</a>
                <a href="#layanan">Layanan</a>
                <a href="#developer">Developer</a>
                <a href="#harga">Harga</a>
                <a href="#hasil">Hasil Jasa Kami</a>
                <a href="#komentar">Ulasan & Saran Client</a>
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
            @forelse ($services as $service)
            <div class="card">
                <img src="/{{ $service->image_path }}" alt="{{ $service->title }}">
                <h3>{{ $service->title }}</h3>
                <p>{{ $service->description }}</p>
            </div>
            @empty
            <div class="card">
                <h3>Belum ada layanan</h3>
                <p>Data layanan belum tersedia. Tambahkan layanan dari dashboard admin.</p>
            </div>
            @endforelse
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

    <!-- ================= HASIL KAMI ================= -->

    <section id="hasil" class="section">
        <div class="section-title">
            <h2>Hasil Jasa Kami</h2>
            <p>Beberapa proyek editing foto & video yang telah kami kerjakan untuk klien dari berbagai industri.</p>
        </div>

        <div class="card-grid">
            @forelse ($portfolios as $portfolio)
            <div class="card">
                <img src="/{{ $portfolio->image_path }}" alt="{{ $portfolio->title }}" loading="lazy">
                <h3>{{ $portfolio->title }}</h3>
                <p>{{ $portfolio->description }}</p>
            </div>
            @empty
            <div class="card">
                <h3>Belum ada hasil jasa</h3>
                <p>Belum ada portofolio yang ditambahkan. Silakan tambahkan hasil jasa melalui dashboard admin.</p>
            </div>
            @endforelse
        </div>
    </section>

    <!-- ================= KOMENTAR ================= -->
    <section id="komentar" class="section">
        <div class="section-title">
            <h2>Ulasan & Saran Client</h2>
            <p>Fitur ini disediakan bagi klien untuk memberikan ulasan,
                kritik, maupun saran terhadap hasil kerja kami.
                Kami mengimbau agar setiap tanggapan disampaikan menggunakan
                bahasa yang baik, sopan, dan tidak mengandung unsur komparatif atau
                kata-kata kasar.</p>
        </div>

        <div class="showcomment">
            <div class="mengatur_command">
                <div class="marquee-content fast-1">
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                </div>

                <div class="marquee-content fast-1" aria-hidden="true">
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                </div>
            </div>
            <div class="mengatur_command">
                <div class="marquee-content fast-2">
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                </div>

                <div class="marquee-content fast-2" aria-hidden="true">
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                </div>
            </div>
            <div class="mengatur_command">
                <div class="marquee-content fast-3">
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                </div>

                <div class="marquee-content fast-3" aria-hidden="true">
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                    <div class="commentuser">
                        <span>user1</span>
                        <p>hasilnya bagus sekali</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="createcomment">
            <label for="">Menambahkan Komentar</label>
            <input type="text" name="" id="">
            <button type="submit">Kirim</button>
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