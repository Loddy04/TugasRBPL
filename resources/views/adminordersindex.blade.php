<!DOCTYPE html>
<html>
<head>
    <title>Admin - Konfirmasi Order</title>
    <style>

        body{
            font-family: Arial, sans-serif;
            background:#f5f7fb;
            margin:0;
            padding:20px;
        }

        .container{
            max-width:500px;
            margin:auto;
        }

        .header{
            background:linear-gradient(135deg,#8a2be2,#4b6cb7);
            color:white;
            padding:15px;
            border-radius:10px;
            margin-bottom:20px;
        }

        .order-card{
            background:white;
            border-radius:10px;
            padding:15px;
            margin-bottom:10px;
            box-shadow:0 2px 6px rgba(0,0,0,0.1);
        }

        .order-id{
            font-weight:bold;
        }

        .status{
            padding:4px 10px;
            border-radius:6px;
            font-size:12px;
            display:inline-block;
            margin-top:5px;
        }

        .pending{
            background:#ffeaa7;
        }

        .accepted{
            background:#55efc4;
        }

        .rejected{
            background:#ff7675;
            color:white;
        }

        .buttons{
            margin-top:10px;
        }

        .buttons button{
            padding:8px 12px;
            border:none;
            border-radius:6px;
            cursor:pointer;
            margin-right:5px;
        }

        .accept{
            background:#2ecc71;
            color:white;
        }

        .reject{
            background:#e74c3c;
            color:white;
        }

        .rekap{
            background:#3498db;
            color:white;
        }

    </style>
</head>
<body>

<div class="container">

    <div class="header">
        <h2>Admin</h2>
        <p>Konfirmasi Order</p>
    </div>

    {{-- Jika tidak ada order --}}
    @if($orders->isEmpty())
        <p>Tidak ada order.</p>
    @endif


    {{-- List Order --}}
    @foreach($orders as $order)

        <div class="order-card">

            <div class="order-id">
                Order ID : {{ $order->id }}
            </div>

            <div>
                Sales ID : {{ $order->user_id }}
            </div>

            <div>
                Total : Rp {{ number_format($order->total) }}
            </div>

            {{-- Status --}}
            <div class="status {{ $order->status }}">
                @if($order->status == 'pending')
                    Menunggu Konfirmasi
                @elseif($order->status == 'accepted')
                    Terkonfirmasi
                @elseif($order->status == 'rejected')
                    Ditolak
                @elseif($order->status == 'rekap')
                    Sudah Direkap
                @endif
            </div>


            {{-- Detail Item --}}
            <div style="margin-top:10px;">

                <b>Items:</b>

                <ul>
                    @foreach($order->items as $item)
                        <li>
                            {{ $item->item_name }}
                            ({{ $item->quantity }} x Rp {{ number_format($item->price) }})
                        </li>
                    @endforeach
                </ul>

            </div>


            {{-- Bukti Pembayaran --}}
            <div>
                <a href="{{ asset('storage/'.$order->payment_proof) }}" target="_blank">
                    Lihat Bukti Pembayaran
                </a>
            </div>


            {{-- Tombol --}}
            <div class="buttons">

                <form action="/admin/orders/{{ $order->id }}/accept" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="accept">Terima</button>
                </form>

                <form action="/admin/orders/{{ $order->id }}/reject" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="reject">Tolak</button>
                </form>

                <form action="/admin/rekap/{{ $order->id }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="rekap">Rekap</button>
                </form>

            </div>

        </div>

    @endforeach

</div>

</body>
</html>