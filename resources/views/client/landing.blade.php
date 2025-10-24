@extends('layouts.app')

@section('title', 'PawTulong | Client Landing')

@php
    use Illuminate\Support\Str;
    /**
     * @var \Illuminate\Support\Collection|\stdClass[] $mostAsked
     * @var \Illuminate\Support\Collection|\App\Models\ChatLog[] $recentConversations
     * @var \Illuminate\Support\Collection|\App\Models\ChatSession[] $recentSessions
     */
    $layoutCss = 'landing.css';
    $page = 'home';
@endphp

@section('content')
<div class="client-landing-container">

  {{-- 📊 Summary Cards --}}
  <div class="summary-cards">
    @php
      $cards = [
        ['label'=>'Most Asked Questions', 'value'=>count($mostAsked ?? []), 'color'=>'#6b4a6b'],
      ];
    @endphp
    @foreach($cards as $card)
      <div class="summary-card">
        <div class="summary-card-label">{{ $card['label'] }}</div>
        <div class="summary-card-value">{{ $card['value'] }}</div>
      </div>
    @endforeach
  </div>

  {{-- 💡 Narrative Insight --}}
  <div class="narrative-insight">
    <p>
      💡 You’ve been chatting actively! Explore your top questions and revisit your last 10 conversations below.
    </p>
  </div>

  {{-- 🧭 Main Layout --}}
  <div class="main-layout">

    {{-- 💬 Frequently Asked Questions --}}
    <div class="faq-section">
      <h3>💬 Frequently Asked Questions</h3>
      <ul class="faq-list">
        @forelse($mostAsked ?? [] as $i => $q)
          <li class="faq-item">
            <strong>#{{ $i+1 }}</strong> — {{ Str::limit($q, 60) }}
          </li>
        @empty
          <li style="text-align:center;color:#999;">No questions yet.</li>
        @endforelse
      </ul>
    </div>

    {{-- 📝 Recent Conversations --}}
    <div class="recent-conversations">
      <h3>📝 Recent Conversations</h3>
      <div class="conversations-grid">
        @forelse($recentSessions ?? [] as $session)
          <a href="{{ route('chatbot.show', $session->id) }}" class="conversation-link">
            <div class="conversation-item">
              <div><strong>Session:</strong> {{ Str::limit($session->session_name, 80) }}</div>
              <div>
                <strong>Preview:</strong> {{ Str::limit($session->preview ?? 'No preview', 80) }}
              </div>
              <div>
                {{ $session->last_updated }}
              </div>
            </div>
          </a>
        @empty
          <div style="grid-column:span 2;text-align:center;color:#999;">
            No recent conversations yet.
          </div>
        @endforelse
      </div>
    </div>

  </div>
</div>
@endsection
