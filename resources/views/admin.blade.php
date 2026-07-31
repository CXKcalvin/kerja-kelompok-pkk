<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Dashboard Admin</title>
  <!-- Chart.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    :root{
      --bg:#0b0b0d; /* near black */
      --card:#121217;
      --accent:#7b2cbf; /* purple */
      --accent-2:#5a189a;
      --muted:#9aa0a6;
      --glass: rgba(255,255,255,0.03);
    }
    *{box-sizing:border-box;font-family:Segoe UI,Roboto,Arial,sans-serif}
    body{margin:0;background:linear-gradient(180deg,var(--bg),#07070a);color:#fff;min-height:100vh}
    .container{max-width:1100px;margin:32px auto;padding:20px}
    header{display:flex;align-items:center;gap:16px}
    .brand{display:flex;flex-direction:column}
    h1{margin:0;color:var(--accent)}
    p.lead{margin:0;color:var(--muted)}
    .grid{display:grid;grid-template-columns:1fr 380px;gap:20px;margin-top:20px}
    .card{background:var(--card);border-radius:10px;padding:18px;box-shadow:0 6px 20px rgba(0,0,0,0.6)}
    .card h2{margin-top:0;color:var(--accent-2)}
    .muted{color:var(--muted);font-size:13px}
    .form-row{display:flex;gap:10px;align-items:center}
    input[type=file]{color:#fff}
    input,select,textarea{background:var(--glass);border:1px solid rgba(255,255,255,0.04);padding:10px;border-radius:6px;color:#fff;width:100%}
    button{background:var(--accent);border:none;padding:10px 14px;color:#fff;border-radius:8px;cursor:pointer}
    .small{font-size:13px}
    table{width:100%;border-collapse:collapse;margin-top:12px}
    th,td{padding:8px 6px;text-align:left;border-bottom:1px dashed rgba(255,255,255,0.03)}
    .status-pill{padding:6px 10px;border-radius:999px;font-weight:600}
    .status-active{background:linear-gradient(90deg,#2dd4bf10,#7b2cbf22);color:var(--accent)}
    .status-pending{background:#3a3a3a;color:#ffd166}
    .stats{display:flex;gap:12px;margin-top:12px}
    .stat{flex:1;background:linear-gradient(90deg,rgba(123,44,191,0.12),rgba(90,24,154,0.06));padding:14px;border-radius:8px}
    .stat h3{margin:0;color:var(--accent)}
    .actions{display:flex;gap:8px}
    .services-list{margin-top:12px}
    .service-item{display:flex;justify-content:space-between;align-items:center;padding:8px;border-radius:6px;background:rgba(255,255,255,0.01);margin-bottom:8px}
    .footer-note{margin-top:18px;color:var(--muted);font-size:13px}
    @media(max-width:900px){.grid{grid-template-columns:1fr;}}
  </style>
</head>
<body>
  <div class="container">
    <header>
      <div style="width:64px;height:64px;border-radius:10px;background:linear-gradient(135deg,var(--accent),var(--accent-2));display:flex;align-items:center;justify-content:center;font-weight:700">AD</div>
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
              <tr><th>Nama Client</th><th>Email</th><th>Status</th></tr>
            </thead>
            <tbody id="clientsTable">
              <tr><td>PT. Sinar Makmur</td><td>admin@sinar.co.id</td><td><span class="status-pill status-active">Active</span></td></tr>
              <tr><td>CV. Cahaya</td><td>info@cahaya.id</td><td><span class="status-pill status-pending">Pending</span></td></tr>
              <tr><td>Freelance A</td><td>freelance@example.com</td><td><span class="status-pill status-active">Active</span></td></tr>
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
            <div class="service-item"><div>Desain Website</div><div>Rp 2.500.000</div></div>
            <div class="service-item"><div>Maintenance Bulanan</div><div>Rp 500.000</div></div>
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
              <h3 id="totalIncome">Rp 3.500.000</h3>
              <div class="small">Total pemasukkan bulan ini</div>
            </div>
            <div class="stat">
              <h3 id="entriesCount">42</h3>
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

  <script>
    // Photo preview
    const photoInput = document.getElementById('photoInput');
    const photoPreview = document.getElementById('photoPreview');
    photoInput && photoInput.addEventListener('change', e => {
      const f = e.target.files && e.target.files[0];
      if(!f) return;
      const url = URL.createObjectURL(f);
      photoPreview.innerHTML = '';
      const img = document.createElement('img');
      img.src = url;
      img.style.width='100%';img.style.height='100%';img.style.objectFit='cover';
      photoPreview.appendChild(img);
    });

    // Services add (frontend only)
    const servicesList = document.getElementById('servicesList');
    document.getElementById('addService').addEventListener('click', ()=>{
      const name = document.getElementById('serviceName').value.trim();
      const price = document.getElementById('servicePrice').value.trim();
      if(!name || !price) return alert('Isi nama layanan dan harga.');
      const item = document.createElement('div');
      item.className='service-item';
      item.innerHTML = `<div>${name}</div><div>Rp ${Number(price).toLocaleString('id-ID')}</div>`;
      servicesList.prepend(item);
      document.getElementById('serviceName').value='';
      document.getElementById('servicePrice').value='';
    });

    // Chart: trafik + pemasukkan contoh
    const ctx = document.getElementById('trafficChart').getContext('2d');
    const sampleLabels = ['Minggu 1','Minggu 2','Minggu 3','Minggu 4'];
    const visits = [1200, 1500, 1100, 1900];
    const income = [600000, 900000, 400000, 1500000];
    // sum income & entries
    const total = income.reduce((a,b)=>a+b,0);
    const entries = income.length; // contoh: jumlah entri
    document.getElementById('totalIncome').textContent = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('entriesCount').textContent = entries * 10; // contoh konversi -> tampilkan angka yang lebih bermakna

    const trafficChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: sampleLabels,
        datasets: [
          { type: 'line', label: 'Kunjungan', data: visits, borderColor: '#7b2cbf', backgroundColor: 'rgba(123,44,191,0.12)', tension:0.3, yAxisID: 'y' },
          { type: 'bar', label: 'Pemasukkan (Rp)', data: income.map(v=>v/1000), backgroundColor: '#5a189a', yAxisID: 'y1' }
        ]
      },
      options: {
        responsive:true,
        interaction:{mode:'index',intersect:false},
        scales:{
          y: { type:'linear', position:'left', ticks:{color:'#cfc'}, beginAtZero:true },
          y1: { type:'linear', position:'right', ticks:{color:'#ffd'}, beginAtZero:true, grid:{display:false} }
        },
        plugins: {legend:{labels:{color:'#ddd'}}}
      }
    });
  </script>
</body>
</html>