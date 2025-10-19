@extends('layouts.app')

@section('title', 'PawTulong | Client Landing')

@php
    use Illuminate\Support\Str;
    /** 
     * @var \Illuminate\Support\Collection|\stdClass[] $mostAsked
     * @var \Illuminate\Support\Collection|\App\Models\ChatLog[] $recentConversations
     */
    $layoutCss = 'landing.css';
    $page = 'home';
@endphp

@section('content')
<div class="client-landing-container" style="padding:40px 20px;">

  {{-- 📊 Summary Cards --}}
  <div style="display:flex;justify-content:center;flex-wrap:wrap;gap:24px;margin:30px 0 40px;">
    @php
      $cards = [
        ['label'=>'Most Asked Questions', 'value'=>count($mostAsked ?? []), 'color'=>'#6b4a6b'],
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
      💡 You’ve been chatting actively! Explore your top questions and revisit your last 10 conversations below.
    </p>
  </div>

  {{-- 🧭 Main Layout --}}
  <div style="display:flex;justify-content:center;align-items:flex-start;gap:28px;flex-wrap:wrap;padding:0 20px 40px;">

    {{-- 💬 Frequently Asked Questions --}}
    <div style="background:#fff;border:1px solid #eee;border-radius:14px;width:360px;padding:20px 18px;box-shadow:0 3px 14px rgba(0,0,0,0.05);">
      <h3 style="margin:0 0 14px;text-align:center;color:#6b4a6b;">💬 Frequently Asked Questions</h3>
      <ul style="list-style:none;padding:0;margin:0;max-height:360px;overflow-y:auto;">
        @forelse($mostAsked ?? [] as $i => $q)
          <li style="padding:10px 12px;margin-bottom:6px;border:1px solid #eee;border-radius:8px;background:#fafafa;font-size:0.9rem;line-height:1.4;">
            <strong style="color:#ff6b81;">#{{ $i+1 }}</strong> — {{ Str::limit($q, 60) }}
          </li>
        @empty
          <li style="text-align:center;color:#999;">No questions yet.</li>
        @endforelse
      </ul>
    </div>

    {{-- 📝 Recent Conversations --}}
    <div style="background:#fff;border:1px solid #eee;border-radius:14px;width:650px;padding:20px;box-shadow:0 3px 14px rgba(0,0,0,0.05);">
      <h3 style="margin:0 0 14px;text-align:center;color:#28a745;">📝 Your Last 10 Conversations</h3>
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:14px;">
        @forelse($recentConversations ?? [] as $conv)
          <div style="padding:12px;border:1px solid #eee;border-radius:10px;background:#fafafa;font-size:0.9rem;line-height:1.3;">
            <div><strong>Q:</strong> {{ Str::limit($conv->question, 80) }}</div>
            <div style="margin-top:4px;"><strong>A:</strong> {{ Str::limit($conv->answer ?? '— Unanswered —', 80) }}</div>
            <div style="margin-top:4px;font-size:0.8rem;color:#6c757d;text-align:right;">
              {{ $conv->created_at->format('M d, Y h:i A') }}
            </div>
          </div>
        @empty
          <div style="grid-column:span 2;text-align:center;color:#999;">No recent conversations yet.</div>
        @endforelse
      </div>
    </div>

  </div>
</div>
@endsection
