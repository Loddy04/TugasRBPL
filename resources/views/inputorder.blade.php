<!DOCTYPE html>
<html>
<head>
<title>Input Order</title>

<style>

body{
    font-family: sans-serif;
    background:#f3f5f9;
}

.container{
    width:360px;
    margin:auto;
}

/* HEADER */

.header{
    background:linear-gradient(135deg,#2b5cff,#0b3fd9);
    color:white;
    padding:15px;
    border-radius:12px 12px 0 0;
}

.header small{
    opacity:.8;
}

/* CARD */

.card{
    background:white;
    padding:15px;
    border-radius:12px;
    margin-top:10px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

/* INPUT */

input{
    width:100%;
    padding:10px;
    margin-top:6px;
    border:1px solid #ddd;
    border-radius:8px;
}

.row{
    display:flex;
    gap:10px;
}

.subtotal{
    margin-top:8px;
    font-size:14px;
}

/* BUTTON */

.btn-add{
    margin-top:10px;
    width:100%;
    background:#eef3ff;
    border:none;
    padding:10px;
    border-radius:8px;
    cursor:pointer;
}

.total-box{
    margin-top:10px;
    background:linear-gradient(135deg,#2b5cff,#0b3fd9);
    color:white;
    padding:15px;
    border-radius:12px;
}

.upload-box{
    border:2px dashed #ddd;
    padding:20px;
    text-align:center;
    border-radius:10px;
    cursor:pointer;
}

.upload-success{
    border:2px solid #2ecc71;
    padding:10px;
    border-radius:10px;
    background:#f0fff5;
}

.btn-submit{
    margin-top:15px;
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    background:linear-gradient(135deg,#2b5cff,#0b3fd9);
    color:white;
    font-weight:bold;
}

/* POPUP */

.popup{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.4);
    display:none;
    justify-content:center;
    align-items:center;
}

.popup-content{
    background:white;
    padding:20px;
    border-radius:12px;
    text-align:center;
    width:260px;
}

.popup button{
    margin-top:10px;
    padding:8px 15px;
    border:none;
    border-radius:8px;
}

</style>
</head>

<body>

<div class="container">

<div class="header">
<b>Sales</b><br>
<small>Loddy</small>
</div>


<div class="card">
<b>Input Order Baru</b><br>
<small>Tambahkan item dan bukti pembayaran</small>
</div>


<form id="orderForm" method="POST" action="/order/store" enctype="multipart/form-data">

@csrf

<div id="itemsWrapper">

<div class="card item-box">

<b>Item #1</b>

<input type="text" name="items[0][item_name]" placeholder="Nama Barang" required>

<div class="row">

<input type="number" name="items[0][quantity]" placeholder="Quantity" required class="qty">

<input type="number" name="items[0][price]" placeholder="Harga" required class="price">

</div>

<div class="subtotal">
Subtotal: <b>Rp <span class="subtotal-value">0</span></b>
</div>

</div>

</div>


<button type="button" class="btn-add" id="addItem">
+ Tambah Item
</button>


<div class="total-box">
Total Order <br>
<b>Rp <span id="totalOrder">0</span></b>
</div>


<div class="card">

<label>Bukti Pembayaran</label>

<div class="upload-box" id="uploadBox">
Tap untuk upload <br>
PNG, JPG, atau PDF
</div>

<input type="file" name="payment_proof" id="paymentProof" hidden>

</div>


<button type="button" class="btn-submit" id="submitBtn">
Submit Order
</button>

</form>

</div>


<!-- POPUP KONFIRMASI -->

<div class="popup" id="popup">
<div class="popup-content">
<p>Konfirmasi Submit Order</p>
<p>Apakah Anda yakin?</p>

<button onclick="closePopup()">Batal</button>

<button onclick="submitForm()">Ya, Lanjutkan</button>
</div>
</div>


<!-- POPUP ERROR -->

<div class="popup" id="errorPopup">
<div class="popup-content">
<p style="color:red;">Harap upload bukti pembayaran</p>
<button onclick="closeErrorPopup()">OK</button>
</div>
</div>

<script>

let itemIndex = 1;

/* TAMBAH ITEM */

document.getElementById('addItem').addEventListener('click', function(){

let wrapper = document.getElementById('itemsWrapper');

let div = document.createElement('div');

div.classList.add('card','item-box');

div.innerHTML = `
<b>Item #${itemIndex+1}</b>

<input type="text" name="items[${itemIndex}][item_name]" placeholder="Nama Barang" required>

<div class="row">
<input type="number" name="items[${itemIndex}][quantity]" placeholder="Quantity" class="qty" required>
<input type="number" name="items[${itemIndex}][price]" placeholder="Harga" class="price" required>
</div>

<div class="subtotal">
Subtotal: <b>Rp <span class="subtotal-value">0</span></b>
</div>
`;

wrapper.appendChild(div);

itemIndex++;

});


/* HITUNG TOTAL */

document.addEventListener("input",function(){

let total=0;

document.querySelectorAll(".item-box").forEach(function(box){

let qty = box.querySelector(".qty")?.value || 0;
let price = box.querySelector(".price")?.value || 0;

let subtotal = qty*price;

box.querySelector(".subtotal-value").innerText =
subtotal.toLocaleString();

total+=subtotal;

});

document.getElementById("totalOrder").innerText =
total.toLocaleString();

});


/* UPLOAD */

document.getElementById("uploadBox").onclick=function(){
document.getElementById("paymentProof").click();
}

document.getElementById("paymentProof").addEventListener("change",function(){

let file = this.files[0];

if(file){

document.getElementById("uploadBox").innerHTML=
"✔ "+file.name+"<br><small>File terupload</small>";

document.getElementById("uploadBox").classList.add("upload-success");

}

});


/* SUBMIT */

document.getElementById('submitBtn').addEventListener('click', function(){

let fileInput = document.querySelector('input[name="payment_proof"]');

if (!fileInput || fileInput.files.length === 0) {
document.getElementById('errorPopup').style.display = 'flex';
return;
}

document.getElementById('popup').style.display = 'flex';

});


function closePopup(){
document.getElementById('popup').style.display = 'none';
}

function closeErrorPopup(){
document.getElementById('errorPopup').style.display = 'none';
}

function submitForm(){
document.getElementById('orderForm').submit();
}

</script>

</body>
</html>