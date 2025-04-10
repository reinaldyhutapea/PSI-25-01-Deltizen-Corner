@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Status Pesanan</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Nama Pelanggan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>
                    <!-- Dropdown untuk ubah status -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-{{ getStatusClass($order->status) }} dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ ucfirst($order->status) }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="updateStatus({{ $order->id }}, 'pending')">Pending</a></li>
                            <li><a class="dropdown-item" href="#" onclick="updateStatus({{ $order->id }}, 'diproses')">Diproses</a></li>
                            <li><a class="dropdown-item" href="#" onclick="updateStatus({{ $order->id }}, 'dikirim')">Dikirim</a></li>
                            <li><a class="dropdown-item" href="#" onclick="updateStatus({{ $order->id }}, 'selesai')">Selesai</a></li>
                        </ul>
                    </div>
                </td>
                <td>
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">Lihat Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
function updateStatus(orderId, newStatus) {
    fetch(`/orders/update-status/${orderId}`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ status: newStatus })
    }).then(response => response.json())
      .then(data => {
          if (data.success) {
              location.reload();
          }
      });
}
</script>
@endsection

@php
function getStatusClass($status) {
    return match ($status){
        'pending' => 'warning',
        'diproses' => 'primary',
        'dikirim' => 'info',
        'selesai' => 'success',
        default => 'secondary',
    };
}
@endphp
