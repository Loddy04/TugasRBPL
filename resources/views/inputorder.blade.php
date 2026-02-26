<!DOCTYPE html>
<html>
<head>
    <title>Input Order</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .item-box {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        button {
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn-add {
            background: #3498db;
            color: white;
            margin-bottom: 15px;
        }

        .btn-submit {
            background: #2ecc71;
            color: white;
            width: 100%;
        }

        .popup {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .popup button {
            margin: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Input Order Baru</h2>

    @if(session('success'))
        <div style="background:#d4edda;padding:10px;margin-bottom:10px;border-radius:5px;">
            {{ session('success') }}
        </div>
    @endif

    <form id="orderForm" method="POST" action="/order/store" enctype="multipart/form-data">
        @csrf

        <div id="itemsWrapper">

            <div class="item-box">
                <input type="text" name="items[0][item_name]" placeholder="Nama Barang" required>
                <input type="number" name="items[0][quantity]" placeholder="Quantity" required>
                <input type="number" name="items[0][price]" placeholder="Harga" required>
            </div>

        </div>

        <button type="button" class="btn-add" id="addItem">+ Tambah Item</button>

        <label>Bukti Pembayaran:</label>
        <input type="file" name="payment_proof" required>

        <button type="button" class="btn-submit" id="submitBtn">
            Submit Order
        </button>
    </form>
</div>

<!-- Popup Konfirmasi -->
<div class="popup" id="popup">
    <div class="popup-content">
        <p>Apakah Anda yakin ingin submit order ini?</p>
        <button onclick="closePopup()">Batal</button>
        <button onclick="submitForm()">Ya, Lanjutkan</button>
    </div>
</div>

<div class="popup" id="errorPopup">
    <div class="popup-content">
        <p style="color:red;">Silakan upload bukti pembayaran terlebih dahulu!</p>
        <button onclick="closeErrorPopup()">OK</button>
    </div>
</div>

<script>
let itemIndex = 1;

document.getElementById('addItem').addEventListener('click', function() {
    let wrapper = document.getElementById('itemsWrapper');

    let div = document.createElement('div');
    div.classList.add('item-box');

    div.innerHTML = `
        <input type="text" name="items[${itemIndex}][item_name]" placeholder="Nama Barang" required>
        <input type="number" name="items[${itemIndex}][quantity]" placeholder="Quantity" required>
        <input type="number" name="items[${itemIndex}][price]" placeholder="Harga" required>
    `;

    wrapper.appendChild(div);
    itemIndex++;
});

document.getElementById('submitBtn').addEventListener('click', function() {

    let fileInput = document.querySelector('input[name="payment_proof"]');

    if (!fileInput || fileInput.files.length === 0) {
        document.getElementById('errorPopup').style.display = 'flex';
        return;
    }

    document.getElementById('popup').style.display = 'flex';
});

function closePopup() {
    document.getElementById('popup').style.display = 'none';
}

function closeErrorPopup() {
    document.getElementById('errorPopup').style.display = 'none';
}

function submitForm() {
    document.getElementById('orderForm').submit();
}
</script>

</body>
</html>