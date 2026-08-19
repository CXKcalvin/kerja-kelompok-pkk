@extends('layout.template')

@section('title','Studio Edit | Admin Dashboard')
<!-- Link css -->
<link rel="stylesheet" href="/css/admin.css">
<link rel="stylesheet" href="/css/komen.css">
<!-- Link Javascript -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('isi')

<body>
  <div class="container">
    <header>
      <!-- <div style="width:64px;height:64px;border-radius:10px;background:linear-gradient(135deg,var(--accent),var(--accent-2));display:flex;align-items:center;justify-content:center;font-weight:700">AD</div> -->
      <img src="/img/logo.png" alt="Logo" style="width:64px;height:64px;border-radius:10px;object-fit:cover">
      <div class="brand">
        <h1>Dashboard Admin</h1>
        <p class="lead">Ringkasan cepat — ungu & hitam theme</p>
      </div>
    </header>

    <div class="grid">
      <!-- Main column -->

      <div class="card" style="margin-top:18px">
        <h2>Melihat Status Client</h2>
        <p class="muted">Daftar client dan status terkini.</p>
        <table>
          <thead>
            <tr>
              <th>Nama Client</th>
              <th>Email</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="clientsTable">
            @foreach ($users as $client)
            <tr>
              <td>{{ $client->name }}</td>
              <td>{{ $client->email }}</td>

              <td class="status-cell">
                <form action="{{ route('admin.status.update', $client->id) }}" method="POST">
                  @csrf
                  @method('PUT')

                  <select name="status_id" onchange="this.form.submit()">

                    @foreach ($statuses as $status)
                    <option value="{{ $status->id }}"
                      {{ $client->status_id == $status->id ? 'selected' : '' }}>
                      {{ $status->nama_status }}
                    </option>
                    @endforeach

                  </select>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <p class="footer-note">Status client diambil dari sistem. Tambahkan integrasi backend untuk menampilkan data nyata.</p>
      </div>

      <div class="card">
        <h2>Pemasukkan & Trafik</h2>
        <p class="muted">Ringkasan pemasukkan + trafik untuk analisis keuangan.</p>
        <div class="stats">
          <div class="stat">
            <h3 id="totalIncome">0</h3>
            <div class="small">Total pemasukkan bulan ini</div>
          </div>
          <div class="stat">
            <h3 id="entriesCount">0</h3>
            <div class="small">Jumlah pemasukkan (transaksi)</div>
          </div>
        </div>

        <div style="margin-top:12px">
          <canvas id="trafficChart" width="400" height="220"></canvas>
        </div>

        <div style="margin-top:12px" class="footer-note">Trafik menunjukkan kunjungan dan konversi — gunakan data riil dari analytics/backend untuk insight akurat.</div>
      </div>
    </div>

    <!-- Sidebar column -->
    <aside>
      <div class="card" style="margin-top:18px">
        <h2>Kelola Layanan</h2>
        <p class="muted">Tambah layanan yang akan tampil di halaman publik.</p>

        @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
        @endif

        <form id="serviceForm" action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" data-validate="true">
          @csrf
          <div class="form-row">
            <label class="ketik">
              Foto Layanan
              <input type="file" name="image" accept="image/*" required>
            </label>

            <label class="ketik">
              Judul Layanan
              <input type="text" name="title" maxlength="255" placeholder="Judul layanan" required>
            </label>

            <label class="ketik">
              Deskripsi Layanan
              <textarea name="description" rows="4" placeholder="Deskripsi layanan" required></textarea>
            </label>

            <div class="error-message"></div>
            <button type="submit">Simpan Layanan</button>
          </div>
        </form>
      </div>

      <div class="card" style="margin-top:18px">
        <h2>Daftar Layanan</h2>
        <p class="muted">Preview data layanan yang sudah tersimpan.</p>
        <div class="table-wrapper">
          <table>
            <thead>
              <tr>
                <th>Foto</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Tanggal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($services as $service)
              <tr>
                <td><img src="/{{ $service->image_path }}" alt="{{ $service->title }}" class="thumb"></td>
                <td>{{ $service->title }}</td>
                <td>{{ \Illuminate\Support\Str::limit($service->description, 80) }}</td>
                <td>{{ $service->created_at->format('d M Y') }}</td>
                <td class="actions">
                  <!-- <button class="action-button update" type="button" onclick="document.getElementById('service-edit-{{ $service->id }}').classList.toggle('hidden')">Edit</button> -->
                  <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="action-button delete" type="submit">Hapus</button>
                  </form>
                </td>
              </tr>
              <tr id="service-edit-{{ $service->id }}" class="edit-row hidden">
                <td colspan="5">
                  <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" data-validate="true">
                    @csrf
                    @method('PUT')
                    <div class="edit-grid">
                      <label>Ganti Foto
                        <input type="file" name="image" accept="image/*">
                      </label>
                      <label>Judul
                        <input type="text" name="title" value="{{ $service->title }}" required>
                      </label>
                      <label>Deskripsi
                        <textarea name="description" rows="3" required>{{ $service->description }}</textarea>
                      </label>
                      <div class="error-message"></div>
                      <button class="action-button update" type="submit">Perbarui</button>
                    </div>
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5">Belum ada layanan. Tambahkan layanan baru di atas.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <div class="card" style="margin-top:18px">
        <h2>Kelola Hasil Jasa</h2>
        <p class="muted">Tambah hasil pekerjaan yang akan muncul di portofolio publik.</p>

        <form id="portfolioForm" action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data" data-validate="true">
          @csrf
          <div class="form-row">
            <label class="ketik">
              Foto Hasil Jasa
              <input type="file" name="image" accept="image/*" required>
            </label>

            <label class="ketik">
              Judul Hasil Jasa
              <input type="text" name="title" maxlength="255" placeholder="Judul hasil jasa" required>
            </label>

            <label class="ketik">
              Deskripsi Hasil Jasa
              <textarea name="description" rows="4" placeholder="Deskripsi hasil jasa" required></textarea>
            </label>

            <div class="error-message"></div>
            <button type="submit">Simpan Hasil Jasa</button>
          </div>
        </form>
      </div>

      <div class="card" style="margin-top:18px">
        <h2>Daftar Hasil Jasa</h2>
        <p class="muted">Preview hasil jasa yang sudah tersimpan.</p>
        <div class="table-wrapper">
          <table>
            <thead>
              <tr>
                <th>Foto</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Tanggal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($portfolios as $portfolio)
              <tr>
                <td><img src="/{{ $portfolio->image_path }}" alt="{{ $portfolio->title }}" class="thumb"></td>
                <td>{{ $portfolio->title }}</td>
                <td>{{ \Illuminate\Support\Str::limit($portfolio->description, 80) }}</td>
                <td>{{ $portfolio->created_at->format('d M Y') }}</td>
                <td class="actions">
                  <button class="action-button update" type="button" onclick="document.getElementById('portfolio-edit-{{ $portfolio->id }}').classList.toggle('hidden')">Edit</button>
                  <form action="{{ route('admin.portfolios.destroy', $portfolio->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="action-button delete" type="submit">Hapus</button>
                  </form>
                </td>
              </tr>
              <tr id="portfolio-edit-{{ $portfolio->id }}" class="edit-row hidden">
                <td colspan="5">
                  <form action="{{ route('admin.portfolios.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data" data-validate="true">
                    @csrf
                    @method('PUT')
                    <div class="edit-grid">
                      <label>Ganti Foto
                        <input type="file" name="image" accept="image/*">
                      </label>
                      <label>Judul
                        <input type="text" name="title" value="{{ $portfolio->title }}" required>
                      </label>
                      <label>Deskripsi
                        <textarea name="description" rows="3" required>{{ $portfolio->description }}</textarea>
                      </label>
                      <div class="error-message"></div>
                      <button class="action-button update" type="submit">Perbarui</button>
                    </div>
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5">Belum ada hasil jasa. Tambahkan project baru di atas.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

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
      </section>
    </aside>

  </div>

  <script src="/js/admin.js"></script>

</body>

@endsection