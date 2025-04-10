@extends('layouts.frontend')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Metode Pembayaran</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white p-6 rounded-xl shadow-md w-full max-w-md mt-40 mb-20">
    <h2 class="text-2xl font-semibold mb-6 text-center">Metode Pembayaran</h2>

    <div class="flex justify-between mb-6">
      <button id="qrisBtn" class="w-[48%] border-2 border-orange-500 text-orange-500 py-3 rounded-xl font-medium hover:bg-orange-100 transition">
        Scan QRIS
      </button>
      <button id="cashBtn" class="w-[48%] border-2 border-gray-300 text-gray-600 py-3 rounded-xl font-medium hover:bg-gray-100 transition">
        Tunai
      </button>
    </div>

    <div id="paymentContent" class="bg-gray-50 p-4 rounded-xl text-center">
      <!-- Konten metode pembayaran akan muncul di sini -->
      <p class="mb-2">Silakan scan QRIS berikut:</p>
      <div class="flex items-center justify-center rounded-lg overflow-hidden">
      <img src="{{ asset('barcode Qris.png') }}" alt="QR Code" class="max-w-full h-auto object-contain" />
      </div>
    </div>

    <button class="mt-6 w-full bg-orange-500 text-white py-3 rounded-xl font-semibold hover:bg-orange-600 transition">
      Lanjut
    </button>
  </div>

  <script>
    const qrisBtn = document.getElementById('qrisBtn');
    const cashBtn = document.getElementById('cashBtn');
    const paymentContent = document.getElementById('paymentContent');

    qrisBtn.addEventListener('click', () => {
      qrisBtn.classList.add("border-orange-500", "text-orange-500");
      qrisBtn.classList.remove("border-gray-300", "text-gray-600");

      cashBtn.classList.remove("border-orange-500", "text-orange-500");
      cashBtn.classList.add("border-gray-300", "text-gray-600");

      paymentContent.innerHTML = `
        <p class="mb-2">Silakan scan QRIS berikut:</p>
        <div class="flex items-center justify-center rounded-lg overflow-hidden">
          <img src="{{ asset('barcode Qris.png') }}" alt="QR Code" class="max-w-full h-auto object-contain" />
        </div>
      `;
    });

    cashBtn.addEventListener('click', () => {
      cashBtn.classList.add("border-orange-500", "text-orange-500");
      cashBtn.classList.remove("border-gray-300", "text-gray-600");

      qrisBtn.classList.remove("border-orange-500", "text-orange-500");
      qrisBtn.classList.add("border-gray-300", "text-gray-600");

      paymentContent.innerHTML = `
        <p class="mb-2">Bayar dengan uang tunai ke kasir.</p>
        <p class="text-gray-500 text-sm">Pastikan Anda menerima bukti pembayaran.</p>
      `;
    });
  </script>
</body>
</html>
