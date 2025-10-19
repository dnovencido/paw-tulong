@extends('layouts.app')

@section('title', 'Admin | Landing')

@php
    $layoutCss = 'landing.css';
    $page = 'home';
@endphp

@section('content')
<main>
    <section class="hero">
        <div class="hero-text">
            <h1>Welcome, Admin</h1>
            <p>You are on the landing page. Use the dropdown for admin actions.</p>
        </div>
        <div class="hero-image">
            <img src="{{ asset('img/8.png') }}" alt="Paw" />
        </div>
    </section>
</main>

{{-- Summary Box --}}

    <div class="card shadow" style="background:#fff;border-radius:15px;padding:20px;width:400px;text-align:center;">
        <div style="font-weight:700;color:#231f20;font-size:1rem;margin-bottom:10px;">Total Users</div>
        <div style="font-size:1.5rem;font-weight:700;color:#6b4a6b;">{{ $totalUsers }}</div>
    </div>
</div>
{{-- ================= Export / Filter Section ================= --}}
<div class="products-section" 
     style="display:flex;justify-content:center;align-items:center;gap:10px;flex-wrap:wrap;margin-bottom:20px;">

    <a href="{{ route('admin.export', ['type' => 'top_questions']) }}" 
       class="btn"
       style="padding:10px 16px;border-radius:8px;background:#6b4a6b;color:#fff;text-decoration:none;font-weight:700;">
       Export Top Questions
    </a>

    <a href="{{ route('admin.export', ['type' => 'top_users']) }}" 
       class="btn"
       style="padding:10px 16px;border-radius:8px;background:#28a745;color:#fff;text-decoration:none;font-weight:700;">
       Export Top Users
    </a>

    <a href="{{ route('admin.export', ['type' => 'trends']) }}" 
       class="btn"
       style="padding:10px 16px;border-radius:8px;background:#ff9800;color:#fff;text-decoration:none;font-weight:700;">
       Export Trends
    </a>

</div>

{{-- ================= Top Users + Charts Horizontal Layout ================= --}}
<div class="products-section" 
     style="display:flex;justify-content:center;align-items:flex-start;gap:20px;flex-wrap:wrap;">

    {{-- Top Users --}}
    <div class="card shadow" style="background:#fff;border-radius:15px;overflow:hidden;min-height:250px;max-height:350px;display:flex;flex-direction:column;width:400px;">
        <div class="card-header" style="padding:10px 14px;background:#e6b6d6;font-weight:700;text-align:center;">🏆 Top Users</div>
        <div class="card-body" style="padding:12px;overflow-y:auto;flex:1;">
            <ul style="margin:0;padding-left:0;list-style:none;">
                @forelse($topUsers as $tu)
                    <li style="margin-bottom:8px;">
                        <div style="padding:8px 10px;border:1px solid #eee;border-radius:6px;background:#f9f9f9;font-size:0.95rem;text-align:center;">
                            {{ optional($tu->user)->username ?? optional($tu->user)->email ?? 'Unknown User' }}
                            — <strong>{{ $tu->conversations_count }}</strong> questions
                        </div>
                    </li>
                @empty
                    <li style="text-align:center;">No top users yet.</li>
                @endforelse
            </ul>
        </div>
    </div>

    {{-- Most Asked Questions Chart (Horizontal Bar) --}}
    <div class="card shadow" style="background:#fff;border-radius:15px;overflow:hidden;display:flex;flex-direction:column;width:500px;">
        <div class="card-header" style="padding:12px 16px;background:#e6b6d6;font-weight:700;text-align:center;">🔥 Most Asked Questions</div>
        <div class="card-body" style="padding:16px;display:flex;justify-content:center;align-items:center;">
            <canvas id="mostAskedChart" height="220"></canvas>
            <div id="mostAskedEmpty" style="display:none;color:#6c757d;margin-top:12px;text-align:center;">No data yet.</div>
        </div>
    </div>

    {{-- Daily Trends Chart (Area + 7-day Moving Average) --}}
    <div class="card shadow" style="background:#fff;border-radius:15px;overflow:hidden;display:flex;flex-direction:column;width:500px;">
        <div class="card-header" style="padding:12px 16px;background:#e6b6d6;font-weight:700;text-align:center;">📊 Daily Trends (Last 7 Days)</div>
        <div class="card-body" style="padding:16px;display:flex;justify-content:center;align-items:center;">
            <canvas id="trendChart" height="220"></canvas>
            <div id="trendEmpty" style="display:none;color:#6c757d;margin-top:12px;text-align:center;">No data yet.</div>
        </div>
    </div>

</div>

{{-- Chart Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    // Most Asked Questions Chart (Horizontal Bar)
    const mostLabels = @json($mostAsked->pluck('question') ?? []);
    const mostSeries = @json($mostAsked->pluck('count') ?? []);
    const mostCanvas = document.getElementById('mostAskedChart');
    const mostEmpty = document.getElementById('mostAskedEmpty');

    if (mostCanvas && mostLabels.length && mostSeries.length) {
        new Chart(mostCanvas.getContext('2d'), {
            type: 'bar',
            data: {
                labels: mostLabels,
                datasets: [{
                    label: 'Count',
                    data: mostSeries,
                    backgroundColor: 'rgba(107, 74, 107, 0.85)',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                indexAxis: 'y',
                scales: {
                    x: { beginAtZero: true, ticks: { precision: 0 }, grid: { display: false } },
                    y: { grid: { display: false } }
                }
            }
        });
    } else {
        if (mostCanvas) mostCanvas.style.display = 'none';
        if (mostEmpty) mostEmpty.style.display = 'block';
    }

    // Daily Trends Chart (Area + MA)
    const trendLabels = @json($trendLabels ?? []);
    const trendSeries = @json($trendSeries ?? []);
    const trendCanvas = document.getElementById('trendChart');
    const trendEmpty = document.getElementById('trendEmpty');

    if (trendCanvas && trendLabels.length && trendSeries.length) {
        const maWindow = 7;
        const maSeries = trendSeries.map((_, i) => {
            const start = Math.max(0, i - maWindow + 1);
            const subset = trendSeries.slice(start, i + 1);
            const avg = subset.reduce((a, b) => a + b, 0) / subset.length;
            return Math.round(avg * 100) / 100;
        });

        new Chart(trendCanvas.getContext('2d'), {
            type: 'line',
            data: {
                labels: trendLabels,
                datasets: [
                    {
                        label: 'Questions per Day',
                        data: trendSeries,
                        borderColor: 'rgba(107, 74, 107, 1)',
                        backgroundColor: 'rgba(107, 74, 107, 0.20)',
                        fill: true,
                        tension: 0.25,
                        borderWidth: 2,
                        pointRadius: 2
                    },
                    {
                        label: '7-day MA',
                        data: maSeries,
                        borderColor: 'rgba(40, 167, 69, 1)',
                        backgroundColor: 'rgba(40, 167, 69, 0.0)',
                        fill: false,
                        tension: 0.25,
                        borderDash: [6, 4],
                        borderWidth: 2,
                        pointRadius: 0
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: true } },
                scales: {
                    x: { grid: { display: false } },
                    y: { beginAtZero: true, ticks: { precision: 0 } }
                }
            }
        });
    } else {
        if (trendCanvas) trendCanvas.style.display = 'none';
        if (trendEmpty) trendEmpty.style.display = 'block';
    }

});
</script>
@endsection


