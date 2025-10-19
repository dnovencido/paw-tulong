@extends('layouts.app')

@section('title', 'PawTulong | Home')

@php
use Illuminate\Support\Str;
/** 
 * @var \Illuminate\Support\Collection|\App\Models\User[] $topUsers
 * @var \Illuminate\Support\Collection|\stdClass[] $mostAsked
 * @var int $totalUsers
 * @var int $totalChats
 */
$layoutCss = 'landing.css';
$page = 'home';
@endphp

@section('content')
@auth
@if(Auth::user()->user_type === 'admin')

{{-- 📊 Summary Cards --}}
<div style="display:flex;justify-content:center;flex-wrap:wrap;gap:24px;margin:30px 0 40px;">
  @php
    $cards = [
      ['label'=>'Users', 'value'=>$totalUsers ?? 0, 'color'=>'#6b4a6b'],
      ['label'=>'Total Chats', 'value'=>$totalChats ?? 0, 'color'=>'#28a745'],
    ];
  @endphp
  @foreach($cards as $card)
    <div style="background:#fff;border:1px solid #eee;border-radius:12px;padding:20px 26px;min-width:180px;text-align:center;box-shadow:0 2px 10px rgba(0,0,0,0.05);">
      <div style="font-size:0.95rem;color:#777;">{{ $card['label'] }}</div>
      <div style="font-size:1.6rem;font-weight:700;color:{{ $card['color'] }};">{{ $card['value'] }}</div>
    </div>
  @endforeach
</div>

{{-- 💡 Narrative Insight --}}
<div style="background:#fdf4fa;border:1px solid #eed3f3;border-radius:12px;padding:18px 24px;margin:0 auto 40px;max-width:950px;text-align:center;box-shadow:0 2px 10px rgba(0,0,0,0.05);">
  <p style="margin:0;font-size:1.05rem;font-weight:600;color:#6b4a6b;line-height:1.5;">
    💡 This week, user activity increased by <strong>12%</strong>.
    <strong>{{ $topUsers[0]->user->username ?? 'Unknown' }}</strong> was most active — 
    top question: <strong>“{{ Str::limit($mostAsked[0]->question ?? 'No data', 40) }}”</strong>
    ({{ $mostAsked[0]->count ?? 0 }}x)
  </p>
</div>

{{-- 🏆 Top Users + 💬 Most Asked Questions (Horizontal Layout) --}}
<div style="display:flex;justify-content:center;align-items:flex-start;gap:28px;flex-wrap:wrap;padding:0 20px 40px;">

  {{-- Top Users --}}
  <div style="background:#fff;border:1px solid #eee;border-radius:14px;width:360px;padding:20px 18px;box-shadow:0 3px 14px rgba(0,0,0,0.05);">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
      <h3 style="margin:0;color:#6b4a6b;">🏆 Top Users</h3>
      <a href="{{ route('admin.export', ['type'=>'top_users']) }}" title="Download" style="font-size:1.1rem;text-decoration:none;color:#28a745;">⬇️</a>
    </div>
    <ul style="list-style:none;padding:0;margin:0;max-height:360px;overflow-y:auto;">
      @forelse($topUsers ?? [] as $i => $u)
        <li style="padding:10px 12px;margin-bottom:6px;border:1px solid #eee;border-radius:8px;background:#fafafa;display:flex;justify-content:space-between;align-items:center;font-size:0.95rem;">
          <span><strong>#{{ $i+1 }}</strong> — {{ $u->user->username ?? $u->user->email ?? 'Unknown' }}</span>
          <span style="color:#6b4a6b;font-weight:600;">{{ $u->conversations_count ?? 0 }}</span>
        </li>
      @empty
        <li style="text-align:center;color:#999;">No users</li>
      @endforelse
    </ul>
  </div>

  {{-- Most Asked Questions --}}
  <div style="background:#fff;border:1px solid #eee;border-radius:14px;width:650px;padding:20px;box-shadow:0 3px 14px rgba(0,0,0,0.05);">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
      <h3 style="margin:0;color:#6b4a6b;">💬 Most Asked Questions</h3>
      <a href="{{ route('admin.export', ['type'=>'top_questions']) }}" title="Download" style="font-size:1.1rem;text-decoration:none;color:#6b4a6b;">⬇️</a>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:14px;">
      @forelse($mostAsked ?? [] as $i => $q)
        <div style="padding:12px;border:1px solid #eee;border-radius:10px;background:#fafafa;font-size:0.9rem;line-height:1.3;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $q->question ?? 'Unknown' }}">
          <strong style="color:#ff6b81;">#{{ $i+1 }}</strong> — {{ Str::limit($q->question ?? 'Unknown', 45) }}
          <div style="text-align:right;color:#6b4a6b;font-weight:600;margin-top:4px;">{{ $q->count ?? 0 }}</div>
        </div>
      @empty
        <div style="grid-column:span 2;text-align:center;color:#999;">No questions</div>
      @endforelse
    </div>
  </div>

</div>

@endif
@endauth
@endsection
