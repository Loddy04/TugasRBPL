<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #0f172a;
}

.container {
    width: 360px;
    background: linear-gradient(180deg, #1e293b, #0f172a);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0,0,0,0.4);
}

.header {
    text-align: center;
    padding: 40px 20px;
    color: white;
}

.header-icon {
    width: 60px;
    height: 60px;
    background: rgba(255,255,255,0.1);
    border-radius: 15px;
    margin: 0 auto 15px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 28px;
}

.header h2 {
    font-weight: 600;
}

.header p {
    font-size: 14px;
    opacity: 0.8;
}

.card {
    background: #f1f5f9;
    padding: 25px;
    border-top-left-radius: 25px;
    border-top-right-radius: 25px;
}

.role-title {
    font-weight: 500;
    margin-bottom: 15px;
    color: #334155;
}

.role-option {
    display: flex;
    align-items: center;
    padding: 14px;
    border-radius: 14px;
    margin-bottom: 12px;
    background: #e5e7eb;
    cursor: pointer;
    transition: 0.3s;
    border: 1px solid #d1d5db;
}

/* SALES ACTIVE */
.role-option.sales.active {
    background: linear-gradient(90deg, #3b82f6, #2563eb);
    color: white;
    box-shadow: 0 8px 20px rgba(37,99,235,0.3);
}

/* ADMIN ACTIVE */
.role-option.admin.active {
    background: linear-gradient(90deg, #a855f7, #7e22ce);
    color: white;
    box-shadow: 0 8px 20px rgba(126,34,206,0.3);
}

/* GUDANG ACTIVE */
.role-option.gudang.active {
    background: linear-gradient(90deg, #22c55e, #16a34a);
    color: white;
    box-shadow: 0 8px 20px rgba(22,163,74,0.3);
}


.input-group {
    margin-top: 15px;
}

.input-group label {
    font-size: 14px;
    color: #334155;
}

.input-group input {
    width: 100%;
    padding: 12px;
    margin-top: 5px;
    border-radius: 10px;
    border: none;
    background: #cbd5e1;
    outline: none;
}

button {
    width: 100%;
    padding: 14px;
    margin-top: 20px;
    border: none;
    border-radius: 12px;
    background: linear-gradient(90deg, #3b82f6, #2563eb);
    color: white;
    font-weight: 500;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    opacity: 0.9;
}

.error-alert {
    display: none;
    background: linear-gradient(90deg, #ef4444, #dc2626);
    color: white;
    padding: 12px;
    border-radius: 12px;
    margin-bottom: 15px;
    font-size: 14px;
    animation: slideDown 0.3s ease;
    box-shadow: 0 6px 15px rgba(220,38,38,0.3);
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
</head>

<body>

<div class="container">

    <div class="header">
        <div class="header-icon">📦</div>
        <h2>Sistem Order & Gudang</h2>
        <p>Manajemen Order & Pengiriman</p>
    </div>

        <form action="/login" method="POST">
            @csrf

    <div class="card">

        <div class="role-title">Pilih Role Anda</div>

        <input type="hidden" id="roleInput" name="role" value="sales">

        <div class="role-option sales">Sales</div>
        <div class="role-option admin">Admin</div>
        <div class="role-option gudang">Kepala Gudang</div>

        <div id="errorAlert" class="error-alert"
            @if(session('error')) style="display:block;" @endif>
            {{ session('error') ?? 'Username atau password salah!' }}
        </div>

        <div class="input-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" placeholder="Loddy">
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="xxxxxxxxxx">
        </div>

            <button type="submit">Masuk ke Dashboard</button>
        </form>

    </div>

</div>

<script>
const roles = document.querySelectorAll('.role-option');
const roleInput = document.getElementById('roleInput');

roles.forEach(role => {
    role.addEventListener('click', () => {

        // hapus active semua
        roles.forEach(r => r.classList.remove('active'));

        // aktifkan yang diklik
        role.classList.add('active');

        // ambil role berdasarkan class
        if (role.classList.contains('sales')) {
            roleInput.value = 'sales';
        } else if (role.classList.contains('admin')) {
            roleInput.value = 'admin';
        } else if (role.classList.contains('gudang')) {
            roleInput.value = 'kepala_gudang';
        }

        console.log("Role dipilih:", roleInput.value);
    });
});

window.addEventListener("load", function() {
    const errorAlert = document.getElementById("errorAlert");

    if (errorAlert.style.display === "block") {
        setTimeout(() => {
            errorAlert.style.display = "none";
        }, 3000);
    }
});
</script>

</body>
</html>