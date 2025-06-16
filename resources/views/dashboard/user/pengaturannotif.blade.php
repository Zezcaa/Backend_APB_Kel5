<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pengaturan Notifikasi</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 40px auto;
      background-color: #fff;
      padding: 32px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    h1 {
      font-size: 24px;
      margin-bottom: 24px;
      text-align: center;
    }

    .switch-group {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .switch-label {
      flex: 1;
    }

    .switch-label h2 {
      margin: 0;
      font-size: 18px;
    }

    .switch-label p {
      margin: 4px 0 0;
      font-size: 14px;
      color: #555;
    }

    .switch-input {
      transform: scale(1.3);
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #007bff;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }

    .notification {
      display: none;
      margin-top: 20px;
      padding: 12px;
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
      border-radius: 8px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Pengaturan Notifikasi</h1>

    <div class="switch-group">
      <div class="switch-label">
        <h2>Notifikasi Email</h2>
        <p>Terima pemberitahuan melalui email.</p>
      </div>
      <input type="checkbox" id="email" class="switch-input" checked />
    </div>

    <div class="switch-group">
      <div class="switch-label">
        <h2>Notifikasi SMS</h2>
        <p>Terima pemberitahuan melalui SMS.</p>
      </div>
      <input type="checkbox" id="sms" class="switch-input" />
    </div>

    <div class="switch-group">
      <div class="switch-label">
        <h2>Notifikasi Push</h2>
        <p>Terima pemberitahuan melalui aplikasi.</p>
      </div>
      <input type="checkbox" id="push" class="switch-input" checked />
    </div>

    <button onclick="saveSettings()">Simpan Pengaturan</button>

    <div class="notification" id="notifSuccess">
      Pengaturan Notifikasi Berhasil Disimpan
    </div>
  </div>

  <script>
    function saveSettings() {
      // Simulasi simpan ke server
      document.getElementById('notifSuccess').style.display = 'block';

      // Sembunyikan setelah 3 detik
      setTimeout(() => {
        document.getElementById('notifSuccess').style.display = 'none';
      }, 3000);
    }
  </script>
</body>
</html>
