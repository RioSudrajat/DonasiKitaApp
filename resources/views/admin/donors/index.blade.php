@extends('layouts.admin')

@section('title', 'Daftar Donatur')

@section('extra-styles')
<style>
    .header {
        background: white;
        padding: 25px;
        border-radius: 8px;
        margin-bottom: 25px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .header h1 {
        font-size: 28px;
        margin-bottom: 10px;
    }
    .stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }
    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 8px;
    }
    .stat-card.green {
        background: linear-gradient(135deg, #56ab2f 0%, #a8e063 100%);
    }
    .stat-card.blue {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    }
    .stat-card h3 {
        font-size: 14px;
        margin-bottom: 8px;
        opacity: 0.9;
    }
    .stat-card .value {
        font-size: 24px;
        font-weight: 700;
    }

    .filters {
        background: white;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        display: flex;
        gap: 15px;
        align-items: center;
        flex-wrap: wrap;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .filters input {
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        flex: 1;
        min-width: 200px;
    }
    .btn {
        padding: 10px 20px;
        background: #667eea;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn:hover {
        background: #5568d3;
    }
    .btn.secondary {
        background: #6c757d;
    }
    .btn.secondary:hover {
        background: #5a6268;
    }

    .table-container {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th {
        background: #f8f9fa;
        padding: 15px;
        text-align: left;
        font-weight: 600;
        font-size: 13px;
        color: #666;
        border-bottom: 1px solid #e0e0e0;
    }
    td {
        padding: 15px;
        border-bottom: 1px solid #e0e0e0;
    }
    tr:hover {
        background: #f9f9f9;
    }
    .donor-info {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }
    .donor-name {
        font-weight: 600;
        color: #333;
    }
    .donor-email {
        font-size: 12px;
        color: #999;
    }
    .amount {
        font-weight: 600;
        color: #667eea;
    }
    .badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        background: #e7f3ff;
        color: #0066cc;
    }
    .pagination {
        display: flex;
        justify-content: center;
        gap: 5px;
        margin-top: 20px;
    }
    .pagination a, .pagination span {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        text-decoration: none;
        color: #667eea;
    }
    .pagination a:hover {
        background: #f5f5f5;
    }
    .pagination .active {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }
    .action-buttons a {
        padding: 6px 12px;
        background: #e7f3ff;
        color: #0066cc;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        font-size: 12px;
        cursor: pointer;
    }
    .action-buttons a:hover {
        background: #cce5ff;
    }
    .empty {
        text-align: center;
        padding: 40px 20px;
        color: #999;
    }
</style>
@endsection

@section('content')
        <div class="header">
            <h1><i class="fas fa-users"></i> Manajemen Donatur</h1>
            <p>Track donatur aktif dan status donasi mereka</p>

            <div class="stats">
                <div class="stat-card">
                    <h3>Total Donatur</h3>
                    <div class="value">{{ $totalDonors }}</div>
                </div>
                <div class="stat-card green">
                    <h3>Total Terkumpul</h3>
                    <div class="value">{{ number_format($totalDonations / 1000000, 1) }}M</div>
                </div>
                <div class="stat-card blue">
                    <h3>Rata-rata Donasi</h3>
                    <div class="value">Rp {{ number_format($averageDonation / 1000, 0) }}K</div>
                </div>
            </div>
        </div>

        <div class="filters">
            <form method="GET" style="display: flex; gap: 15px; flex-wrap: wrap; align-items: center; width: 100%;">
                <input type="text" name="search" placeholder="Cari nama atau email donatur..." value="{{ request('search') }}">
                <button type="submit" class="btn">
                    <i class="fas fa-search"></i> Filter
                </button>
                <a href="{{ route('admin.donors.export') }}" class="btn secondary">
                    <i class="fas fa-download"></i> Export CSV
                </a>
            </form>
        </div>

        <div class="table-container">
            @if($donors->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Nama & Email</th>
                            <th>Telepon</th>
                            <th>Jumlah Donasi</th>
                            <th>Total Donasi</th>
                            <th>Donasi Terakhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donors as $donor)
                            <tr>
                                <td>
                                    <div class="donor-info">
                                        <span class="donor-name">{{ $donor->donor_name }}</span>
                                        <span class="donor-email">{{ $donor->donor_email }}</span>
                                    </div>
                                </td>
                                <td>{{ $donor->donor_phone }}</td>
                                <td>
                                    <span class="badge">{{ $donor->donation_count }}x</span>
                                </td>
                                <td class="amount">Rp {{ number_format($donor->total_amount, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($donor->max('created_at'))->format('d/m/Y') ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.donors.show', $donor->donor_email) }}" class="action-buttons" style="text-decoration: none;">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination">
                    {{ $donors->links() }}
                </div>
            @else
                <div class="empty">
                    <i class="fas fa-inbox" style="font-size: 48px; color: #ddd;"></i>
                    <p style="margin-top: 15px;">Tidak ada donatur</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
