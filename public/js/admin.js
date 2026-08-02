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
    const visits = [1500, 1200, 1100, 1900];
    const income = [3500000, 2000000, 1500000, 4000000]; // contoh pemasukkan per minggu
    // sum income & entries
    const total = income.reduce((a,b)=>a+b,0);
    const entries = visits.length; // contoh: jumlah entri
    document.getElementById('totalIncome').textContent = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('entriesCount').textContent = entries * 10; // contoh konversi -> tampilkan angka yang lebih bermakna

    const trafficChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: sampleLabels,
        datasets: [
          { type: 'line', label: 'Kunjungan', data: visits, borderColor: '#7b2cbf', backgroundColor: 'rgba(123,44,191,0.12)', tension:0.5, yAxisID: 'y' },
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