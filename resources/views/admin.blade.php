<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Dashboard Admin</title>
  <!-- Chart.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="/css/admin.css">
</head>

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
      <div>
        <div class="card">
          <h2>Merubah Foto di Menu Awal</h2>
          <p class="muted">Unggah foto yang akan tampil di halaman utama. Preview sebelum menyimpan.</p>
          <form id="photoForm" action="#" method="POST" enctype="multipart/form-data">
            <div style="display:flex;gap:12px;align-items:center;margin-top:12px">
              <div style="width:120px;height:80px;border-radius:8px;background:#0a0a0b;display:flex;align-items:center;justify-content:center;overflow:hidden;border:1px solid rgba(255,255,255,0.03)" id="photoPreview">
                <img src="https://via.placeholder.com/300x200/7b2cbf/ffffff?text=Preview" alt="preview" style="width:100%;height:100%;object-fit:cover">
              </div>
              <div style="flex:1">
                <label class="small">Pilih file</label>
                <input type="file" id="photoInput" name="photo" accept="image/*">
                <div style="margin-top:8px" class="actions">
                  <button type="button" id="savePhoto">Simpan</button>
                </div>
              </div>
            </div>
          </form>
        </div>

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

                <td>
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
              <!-- <tr><td name="clientName"></td><td name="clientEmail"></td><td><span class="status-pill status-active" name="clientStatus"></span></td></tr>
              <tr><td>CV. Cahaya</td><td>info@cahaya.id</td><td><span class="status-pill status-pending">Pending</span></td></tr>
              <tr><td>Freelance A</td><td>freelance@example.com</td><td><span class="status-pill status-active">Active</span></td></tr> -->
            </tbody>
          </table>
          <p class="footer-note">Status client diambil dari sistem. Tambahkan integrasi backend untuk menampilkan data nyata.</p>
        </div>

        <div class="card" style="margin-top:18px">
          <h2>Merubah atau Menambahkan Hasil Jasa</h2>
          <p class="muted">Tambahkan layanan / hasil kerja yang bisa ditagihkan ke client.</p>
          <form id="serviceForm" action="#" method="POST">
            <div style="display:flex;gap:8px;margin-top:8px">
              <input type="text" id="serviceName" placeholder="Nama layanan" required>
              <input type="number" id="servicePrice" placeholder="Harga (Rp)" required>
              <button type="button" id="addService">Tambah</button>
            </div>
          </form>

          <div class="services-list" id="servicesList">
            <!-- contoh item -->
            <div class="service-item">
              <div>Desain Website</div>
              <div>Rp 2.500.000</div>
            </div>
            <div class="service-item">
              <div>Maintenance Bulanan</div>
              <div>Rp 500.000</div>
            </div>
          </div>
          <p class="footer-note">Daftar bersifat sementara — hubungkan ke database dan endpoint CRUD untuk fungsionalitas penuh.</p>
        </div>
      </div>

      <!-- Sidebar column -->
      <aside>
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

        <div class="card" style="margin-top:18px">
          <h2>Quick Actions</h2>
          <div style="display:flex;flex-direction:column;gap:8px;margin-top:8px">
            <button type="button">Sinkron Data Client</button>
            <button type="button" style="background:transparent;border:1px solid rgba(255,255,255,0.04);color:var(--accent)">Export Laporan</button>
          </div>
        </div>
      </aside>
    </div>
  </div>

  <script src="/js/admin.js"></script>
</body>

</html>