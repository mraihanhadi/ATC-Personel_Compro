<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Jadwal - ATC Personel Planner</title>
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
            
            /* Upload Area */
            --upload-bg: #D4E2F6;
            --upload-border: #6B9AE8;
            --text-blue: #4A85F6;
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
            margin-bottom: 30px;
        }

        .title-section h1 {
            font-size: 28px;
            font-weight: 800;
            color: #000;
        }

        /* Card & Upload Area */
        .card {
            background: #FFF;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            display: flex;
            flex-direction: column;
        }

        .upload-area {
            background-color: var(--upload-bg);
            border: 2px dashed var(--upload-border);
            border-radius: 12px;
            padding: 60px 20px;
            text-align: center;
            margin-bottom: 30px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .upload-area:hover {
            background-color: #C8DBF4;
        }

        .upload-icon {
            font-size: 56px;
            color: var(--upload-border);
            margin-bottom: 20px;
        }

        .upload-text {
            font-size: 16px;
            color: #333;
            margin-bottom: 8px;
        }

        .upload-text strong {
            color: var(--text-blue);
            font-weight: 700;
        }

        .upload-subtext {
            font-size: 14px;
            color: #666;
        }

        .btn-submit {
            align-self: flex-end;
            background-color: #0047AB;
            color: white;
            border: none;
            padding: 12px 32px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: background 0.2s;
        }

        .btn-submit:hover {
            background-color: #003380;
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
            <li><a href="/jadwal"><i class="fa-regular fa-calendar"></i> Jadwal</a></li>
            <li><a href="/input-jadwal" class="active"><i class="fa-regular fa-calendar-plus"></i> Input Jadwal</a></li>
            <li><a href="/pengurangan-hk"><i class="fa-solid fa-user-minus"></i> Pengurangan HK</a></li>

        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <div class="title-section">
                <h1>Input Jadwal</h1>
            </div>
        </div>

        <div class="card">
            <div class="upload-area" id="areaGrid">
                <div class="upload-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="upload-text">
                    <strong>File Personel (Roster Grid)</strong> — klik untuk upload atau drag & drop
                </div>
                <div class="upload-subtext" id="subGrid">
                    CSV dengan kolom EMP_ID, NAMA, INITIAL, SEKTOR (maks. 10MB)
                </div>
            </div>

            <div class="upload-area" id="areaLeave">
                <div class="upload-icon">
                    <i class="fa-solid fa-calendar-minus"></i>
                </div>
                <div class="upload-text">
                    <strong>File Rencana Cuti (Opsional)</strong> — klik untuk upload atau drag & drop
                </div>
                <div class="upload-subtext" id="subLeave">
                    CSV dengan kolom EMP_ID, HARI_KE, JENIS (maks. 10MB)
                </div>
            </div>

            <input type="file" id="fileGrid" accept=".csv" hidden>
            <input type="file" id="fileLeave" accept=".csv" hidden>

            <div id="uploadStatus" style="margin-bottom: 20px; font-size: 14px;"></div>

            <button class="btn-submit" id="btnSubmit">
                <i class="fa-solid fa-check"></i> Submit
            </button>
        </div>
    </div>

    <script>
        const API = '/api';
        const statusEl = document.getElementById('uploadStatus');
        const btn = document.getElementById('btnSubmit');

        function wireUpload(areaId, inputId, subId, defaultText) {
            const area  = document.getElementById(areaId);
            const input = document.getElementById(inputId);
            const sub   = document.getElementById(subId);

            const showFile = () => {
                sub.innerHTML = input.files.length
                    ? `<strong style="color:#0047AB;">✓ ${input.files[0].name}</strong>`
                    : defaultText;
            };

            area.addEventListener('click', () => input.click());
            input.addEventListener('change', showFile);
            area.addEventListener('dragover', e => { e.preventDefault(); area.style.backgroundColor = '#C8DBF4'; });
            area.addEventListener('dragleave', () => area.style.backgroundColor = '');
            area.addEventListener('drop', e => {
                e.preventDefault();
                area.style.backgroundColor = '';
                if (e.dataTransfer.files.length) {
                    input.files = e.dataTransfer.files;
                    showFile();
                }
            });
        }

        wireUpload('areaGrid', 'fileGrid', 'subGrid',
                   'CSV dengan kolom EMP_ID, NAMA, INITIAL, SEKTOR (maks. 10MB)');
        wireUpload('areaLeave', 'fileLeave', 'subLeave',
                   'CSV dengan kolom EMP_ID, HARI_KE, JENIS (maks. 10MB)');

        btn.addEventListener('click', async () => {
            const grid  = document.getElementById('fileGrid').files[0];
            const leave = document.getElementById('fileLeave').files[0];

            if (!grid && !leave) {
                statusEl.innerHTML = '<span style="color:#C62828;">Pilih file dulu sebelum submit.</span>';
                return;
            }

            const fd = new FormData();
            if (grid)  fd.append('grid', grid);
            if (leave) fd.append('leave', leave);

            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses (Harmony Search)…';
            statusEl.innerHTML = '';

            try {
                const res  = await fetch(`${API}/upload`, { method: 'POST', body: fd });
                const data = await res.json();
                if (!res.ok) throw new Error(data.error || 'Upload gagal');

                statusEl.innerHTML =
                    `<span style="color:#2E7D32;">✓ ${data.message}</span><br>` +
                    `${data.employee_count} personel, periode ${String(data.month).padStart(2, '0')}/${data.year} — ` +
                    `pelanggaran keras: ${data.score.hard}, lunak: ${data.score.soft}. ` +
                    `Lihat hasilnya di <a href="/jadwal">Jadwal</a> atau <a href="/">Dashboard</a>.`;
            } catch (err) {
                const msg = err.message === 'Failed to fetch'
                    ? 'Tidak bisa terhubung ke backend. Jalankan: <code>.venv/bin/python main.py</code>'
                    : err.message;
                statusEl.innerHTML = `<span style="color:#C62828;">${msg}</span>`;
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-check"></i> Submit';
            }
        });
    </script>
</body>
</html>
