<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal - ATC Personel Planner</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --sidebar-bg: #0B192C;
            --sidebar-hover: #1E3A5F;
            --sidebar-active: #0D6EFD;
            --text-main: #FFFFFF;
            --text-muted: #A0B2C6;
            --bg-main: #F8F9FA;
            --border-color: #E2E8F0;
            
            /* Table specific */
            --th-dark: #2A3F54;
            --th-light: #3E5367;
            --th-weekend: #D1D5DB;
            --td-border: #D1D5DB;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
            background-color: var(--bg-main);
            color: #333;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background-color: var(--sidebar-bg);
            color: var(--text-main);
            display: flex;
            flex-direction: column;
            padding: 20px 0;
            flex-shrink: 0;
        }

        .logo-container {
            padding: 0 20px;
            margin-bottom: 30px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
        }

        .menu {
            list-style: none;
            flex-grow: 1;
            padding: 0 15px;
        }

        .menu li {
            margin-bottom: 5px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 20px;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
        }

        .menu a:hover {
            background-color: var(--sidebar-hover);
            color: var(--text-main);
        }

        .menu a.active {
            background-color: var(--sidebar-active);
            color: var(--text-main);
        }

        .menu i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        /* Main Content */
        .main-content {
            flex-grow: 1;
            padding: 30px 40px;
            overflow-y: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .title-section h1 {
            font-size: 28px;
            font-weight: 800;
            color: #000;
        }

        .btn-export {
            background-color: #0D6EFD;
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s;
        }

        .btn-export:hover {
            background-color: #0b5ed7;
        }

        /* Card */
        .card {
            background: #FFF;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            overflow-x: auto;
        }

        /* Table */
        .jadwal-table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            font-size: 12px;
            min-width: 1000px;
        }

        .jadwal-table th, .jadwal-table td {
            border: 1px solid var(--td-border);
            padding: 6px 4px;
            white-space: nowrap;
        }

        .th-title-row {
            background-color: var(--th-dark);
            color: white;
            font-size: 14px;
            font-weight: 600;
            padding: 8px !important;
        }

        .th-subtitle-row {
            background-color: var(--th-light);
            color: white;
            font-size: 11px;
            font-weight: 400;
            padding: 4px !important;
        }

        .th-header {
            background-color: var(--th-dark);
            color: white;
            font-weight: 600;
        }

        .th-weekend {
            background-color: var(--th-weekend);
            color: #000;
            font-weight: 600;
        }

        .col-no { width: 30px; font-weight: 600; background-color: #F8F9FA;}
        .col-nama { width: 60px; font-weight: 700; text-align: left; padding-left: 10px !important;}
        .col-hk { width: 40px; font-weight: 700; background-color: #F8F9FA;}

        /* Cell Types */
        .cell-pa { color: #1565C0; background-color: #E3F2FD; font-weight: 500; }
        .cell-sa { color: #2E7D32; background-color: #E8F5E9; font-weight: 500; }
        .cell-ma { color: #6A1B9A; background-color: #F3E5F5; font-weight: 500; }
        .cell-l { color: #C62828; background-color: #FFEBEE; font-weight: 600; }
        .cell-dk { color: #E65100; background-color: #FFF3E0; font-weight: 500; }
        .cell-ct { color: #1565C0; background-color: #BBDEFB; font-weight: 500; }
        .cell-sk { color: #C62828; background-color: #FFCDD2; font-weight: 600; }
        .cell-mc { color: #C62828; background-color: #FFCDD2; font-weight: 600; }
        .cell-il { color: #00838F; background-color: #E0F7FA; font-weight: 500; }

        /* Header buttons */
        .header-actions { display: flex; gap: 12px; }

        .btn-generate {
            background-color: #198754;
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s;
        }
        .btn-generate:hover { background-color: #157347; }
        .btn-generate:disabled { background-color: #9CC5AE; cursor: not-allowed; }

        /* Legend */
        .legend-card {
            background: #FFF;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            padding: 18px 20px;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        }
        .legend-card h3 {
            font-size: 14px;
            font-weight: 700;
            color: #000;
            margin-bottom: 12px;
        }
        .legend-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 8px 14px;
            margin-bottom: 14px;
        }
        .legend-chip {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12.5px;
            color: #333;
        }
        .legend-code {
            display: inline-block;
            min-width: 26px;
            text-align: center;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 700;
            font-size: 11px;
            border: 1px solid rgba(0,0,0,0.08);
        }
        .legend-note {
            font-size: 12px;
            color: #555;
            line-height: 1.6;
            border-top: 1px dashed var(--border-color);
            padding-top: 12px;
        }
        .legend-note code {
            background: #F1F5F9;
            padding: 1px 6px;
            border-radius: 4px;
            font-size: 11.5px;
            color: #0B192C;
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-container">
            <div class="logo">
                <i class="fa-solid fa-plane-departure"></i>
                <span>ATC Personel Planner</span>
            </div>
        </div>

        <ul class="menu">
            <li><a href="/"><i class="fa-solid fa-table-cells-large"></i> Dashboard</a></li>
            <li><a href="/jadwal" class="active"><i class="fa-regular fa-calendar"></i> Jadwal</a></li>
            <li><a href="/input-jadwal"><i class="fa-regular fa-calendar-plus"></i> Input Jadwal</a></li>
            <li><a href="/pengurangan-hk"><i class="fa-solid fa-user-minus"></i> Pengurangan HK</a></li>

        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <div class="title-section">
                <h1>Jadwal</h1>
            </div>
            <div class="header-actions">
                <button class="btn-generate" id="btnGenerate">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> Generate Jadwal Baru
                </button>
                <button class="btn-export">
                    <i class="fa-solid fa-download"></i> Export
                </button>
            </div>
        </div>

        <div class="card">
            <div id="jadwalStatus" style="padding: 30px; text-align: center; color: #666;">Memuat jadwal…</div>
            <table class="jadwal-table" id="jadwalTable" style="display: none;">
                <thead id="jadwalHead"></thead>
                <tbody id="jadwalBody"></tbody>
            </table>
        </div>

        <div class="legend-card" id="legendCard" style="display: none;">
            <h3>Keterangan</h3>
            <div class="legend-grid">
                <div class="legend-chip"><span class="legend-code cell-pa">P</span> Shift Pagi (06:00&ndash;15:00)</div>
                <div class="legend-chip"><span class="legend-code cell-sa">S</span> Shift Siang (15:00&ndash;24:00)</div>
                <div class="legend-chip"><span class="legend-code cell-l">L</span> Libur / OFF</div>
                <div class="legend-chip"><span class="legend-code cell-ct">CT</span> Cuti</div>
                <div class="legend-chip"><span class="legend-code cell-sk">SK</span> Sakit</div>
                <div class="legend-chip"><span class="legend-code cell-dk">DK</span> Diklat</div>
                <div class="legend-chip"><span class="legend-code cell-mc">MC</span> MEDEC</div>
                <div class="legend-chip"><span class="legend-code cell-il">IL</span> IELP</div>
            </div>
            <div class="legend-note">
                <strong>Notasi sel kerja:</strong> <code>[Shift]t[Sektor]/[Tim]</code> &mdash;
                contoh <code>Pt1/A</code> = Pagi, Tower Sektor 1, Tim A.
                <strong>Shift:</strong> P = Pagi, S = Siang &nbsp;&middot;&nbsp;
                <strong>Sektor:</strong> 1&ndash;2 (posisi di tower) &nbsp;&middot;&nbsp;
                <strong>Tim:</strong> A&ndash;C (kelompok rotasi).
                Arahkan kursor ke sel untuk melihat nama lengkap personel.
            </div>
        </div>
    </div>

    <script>
        const API = '/api';

        document.querySelector('.btn-export').addEventListener('click', () => {
            window.location.href = `${API}/export?format=xlsx`;
        });

        const btnGenerate = document.getElementById('btnGenerate');
        btnGenerate.addEventListener('click', async () => {
            const original = btnGenerate.innerHTML;
            btnGenerate.disabled = true;
            btnGenerate.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menghasilkan…';
            try {
                const res  = await fetch(`${API}/generate`, { method: 'POST' });
                const data = await res.json();
                if (!res.ok) throw new Error(data.error || 'Gagal generate jadwal');
                await loadJadwal();
            } catch (err) {
                alert(err.message === 'Failed to fetch'
                    ? 'Tidak bisa terhubung ke backend.'
                    : err.message);
            } finally {
                btnGenerate.disabled = false;
                btnGenerate.innerHTML = original;
            }
        });

        // Pemetaan shift (huruf depan notasi AirNav) → kelas warna sel.
        const SHIFT_CELL_CLASS = { P: 'pa', S: 'sa' };

        async function loadJadwal() {
            const statusEl = document.getElementById('jadwalStatus');
            const table    = document.getElementById('jadwalTable');
            try {
                const res  = await fetch(`${API}/schedule/month`);
                const data = await res.json();
                if (!res.ok) throw new Error(data.error || 'Gagal memuat jadwal');

                const ncols = data.days + 3; // NO + NAMA + tanggal + HK
                let head = `
                    <tr><th colspan="${ncols}" class="th-title-row">${data.title}</th></tr>
                    <tr><th colspan="${ncols}" class="th-subtitle-row">${data.shift_info}</th></tr>
                    <tr>
                        <th class="th-header" rowspan="2">NO</th>
                        <th class="th-header" rowspan="2">NAMA</th>`;
                data.day_headers.forEach(h => head += `<th class="th-header">${h.day}</th>`);
                head += `<th class="th-header" rowspan="2">HK</th></tr><tr>`;
                data.day_headers.forEach(h =>
                    head += `<th class="${h.weekend ? 'th-weekend' : 'th-header'}">${h.name}</th>`);
                head += '</tr>';
                document.getElementById('jadwalHead').innerHTML = head;

                let body = '';
                data.rows.forEach(row => {
                    body += `<tr><td class="col-no">${row.no}</td>
                             <td class="col-nama" title="${row.nama}">${row.initial}</td>`;
                    row.cells.forEach(c => {
                        // Sel kerja → tampilkan notasi AirNav (shift + sektor + tim),
                        // sel non-kerja (L/CT/SK/dst) → tampilkan kode singkat.
                        const isWork = c.airnav.includes('/');
                        if (isWork) {
                            const cls = SHIFT_CELL_CLASS[c.airnav[0]] || 'pa';
                            body += `<td class="cell-${cls}" title="${row.nama} — ${c.airnav}">${c.airnav}</td>`;
                        } else {
                            body += `<td class="cell-${c.code.toLowerCase()}" title="${row.nama}">${c.code}</td>`;
                        }
                    });
                    body += `<td class="col-hk">${row.hk}</td></tr>`;
                });
                document.getElementById('jadwalBody').innerHTML = body;

                statusEl.style.display = 'none';
                table.style.display = '';
                document.getElementById('legendCard').style.display = '';
            } catch (err) {
                const msg = err.message === 'Failed to fetch'
                    ? 'Tidak bisa terhubung ke backend. Jalankan: <code>.venv/bin/python main.py</code>'
                    : `${err.message} — upload data di halaman <a href="/input-jadwal">Input Jadwal</a>.`;
                statusEl.innerHTML = msg;
            }
        }

        loadJadwal();
    </script>
</body>
</html>
