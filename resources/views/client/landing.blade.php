@extends('layouts.app')

@section('title', 'PawTulong | Client Landing')

@php
    use Illuminate\Support\Str;
    use App\Models\ChatLog;
    use Illuminate\Support\Facades\DB;

    /**
     * Variables passed:
     * $user, $mostAsked, $recentConversations, $totalChats
     */
    $layoutCss = 'landing.css';
    $page = 'home';

    // ✅ Count only frequently asked questions (asked > 1 time)
    $frequentCount = ChatLog::select('question', DB::raw('COUNT(*) as count'))
        ->whereNotNull('question')
        ->where('question', '!=', '')
        ->groupBy('question')
        ->havingRaw('COUNT(*) > 1')
        ->count();
@endphp

@section('content')
<div class="client-landing-container">

  {{-- 📊 Summary Cards --}}
  <div class="summary-cards">
    @php
      $cards = [
        ['label'=>'Most Asked Questions', 'value'=>$frequentCount, 'color'=>'#8b5c8b'],
      ];
    @endphp
    @foreach($cards as $card)
      <div class="summary-card" style="background-color: {{ $card['color'] }}20;">
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
        @php
          // ✅ Get only questions asked more than once
          $frequentQs = ChatLog::select('question', DB::raw('COUNT(*) as count'))
              ->whereNotNull('question')
              ->where('question', '!=', '')
              ->groupBy('question')
              ->havingRaw('COUNT(*) > 1')
              ->orderByDesc('count')
              ->limit(10)
              ->pluck('question');
        @endphp

        @forelse($frequentQs as $i => $q)
          @php
            $answer = ChatLog::where('question', $q)
                ->whereNotNull('answer')
                ->where('answer', '!=', '')
                ->orderByDesc('created_at')
                ->value('answer');
          @endphp

          <li class="faq-item">
            <div class="faq-question" onclick="toggleFAQ(this)">
              <strong>#{{ $i + 1 }}</strong> — {{ Str::limit($q, 80) }}
            </div>
            <div class="faq-answer" style="display:none;">
              {!! $answer ? e($answer) : '<em>No answer recorded.</em>' !!}
            </div>
          </li>
        @empty
          <li style="text-align:center;color:#999;">No frequently asked questions yet.</li>
        @endforelse
      </ul>
    </div>

    {{-- 📝 Recent Conversations --}}
    <div class="recent-conversations">
      <h3>📝 Recent Conversations</h3>
      <div class="conversations-grid">
        @forelse($recentConversations ?? [] as $chat)
          <a href="{{ route('chatbot.show', $chat->chat_session_id) }}" class="conversation-link">
            <div class="conversation-item">
              <div><strong>Question:</strong> {{ Str::limit($chat->question, 100) }}</div>
              <div><strong>Answer:</strong> {{ Str::limit($chat->answer ?? 'No answer', 120) }}</div>
              <div class="conversation-date">{{ $chat->created_at->diffForHumans() }}</div>
            </div>
          </a>
        @empty
          <div style="text-align:center;color:#999;">No recent conversations yet.</div>
        @endforelse
      </div>
    </div>

  </div>
</div>

{{-- 💡 JS for toggling FAQ answers --}}
<script>
function toggleFAQ(element) {
  const answer = element.nextElementSibling;
  answer.style.display = answer.style.display === "none" ? "block" : "none";
}
</script>

@endsection
