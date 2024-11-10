@extends('dashboard.app')
@section('content')
<div class="Container bg-light">
    <div class="profile-card">
        <div class="profile-header">
            <img src="{{ asset('storage/static/assets/logo.webp') }}" alt="Profile Picture">
            <div>
                <h3>{{$profile->full_name}}</h3>
                <p>{{$profile->registered}}</p>
            </div>
            <div style="color: red;">❤️</div>
        </div>
        <div class="profile-details">
            <div><span>Saldo:</span> <span class="value">{{number_format($profile->balance)}}</span></div>
            <div><span>Poin:</span> <span class="value">{{$profile->point}}</span></div>
            <div><span>Email:</span> <span class="value link">wahyuandrewibowo311@gmail.com</span>
            <div><span>Nomor HP:</span> <span class="value link">+6281226564887</span>
            <div><span>Referral:</span> <span class="value link">PRAzubITGgUP92nS</span>
            <div><span>Level:</span> <span class="value">{{$profile->level}}</span></div>
            <div><span>Downline:</span> <span class="value">0 User</span></div>
        </div>
        <div class="last-login">
            Terakhir Login: 14 Mei 2024 (22:01 WIB)
        </div>
    </div>
    <br>
    <div class="venn_chart">
        <center><h3>Grafik Penjualan Bulanan</h3></center>
        <canvas class="border shadow" id="myChart" width="400" height="200"></canvas>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('myChart').getContext('2d');
            var cartUserData = @json($cart_user);
            var labels = cartUserData.map(data => data.month);
            var totals = cartUserData.map(data => data.total);
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Transaksi',
                        data: totals,
                        backgroundColor: ['rgba(0, 208, 255, 0.624)', 'rgba(0, 102, 255, 0.657)'],
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
    </div>
</div>
@endsection