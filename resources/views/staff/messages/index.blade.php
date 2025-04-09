@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <i class="fas fa-users"></i> Next of Kin
        </div>
        <div class="card-body p-0">
          <div class="list-group list-group-flush">
            @foreach($nextOfKins as $kin)
              <a href="{{ route('staff.messages.conversation', $kin->id) }}" 
                 class="list-group-item list-group-item-action d-flex justify-content-between align-items-center 
                        {{ $currentKin && $currentKin->id == $kin->id ? 'active' : '' }}">
                {{ $kin->firstname }} {{ $kin->lastname }}
                @if($kin->unread_count > 0)
                  <span class="badge bg-danger rounded-pill">{{ $kin->unread_count }}</span>
                @endif
              </a>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    
    <!-- Main Content -->
    <div class="col-md-9">
      @if($currentKin)
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Conversation with {{ $currentKin->firstname }}</h5>
            <a href="{{ route('staff.messages.create') }}?recipient={{ $currentKin->id }}" 
               class="btn btn-sm btn-primary">
              <i class="fas fa-plus"></i> New Message
            </a>
          </div>
          
          <div class="card-body chat-box" style="height: 400px; overflow-y: auto;">
            @foreach($messages as $message)
              <div class="mb-3 d-flex {{ $message->sender_id == auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
                <div class="{{ $message->sender_id == auth()->id() ? 'bg-primary text-white' : 'bg-light' }} p-3 rounded-3" 
                     style="max-width: 70%;">
                  <p class="mb-1">{{ $message->message }}</p>
                  <small class="{{ $message->sender_id == auth()->id() ? 'text-white-50' : 'text-muted' }}">
                    {{ $message->created_at->format('g:i A • M j') }}
                    @if($message->sender_id == auth()->id())
                      • {{ $message->read_at ? 'Read' : 'Sent' }}
                    @endif
                  </small>
                </div>
              </div>
            @endforeach
          </div>
          
          <div class="card-footer">
            <form action="{{ route('staff.messages.send') }}" method="POST">
              @csrf
              <input type="hidden" name="recipient_id" value="{{ $currentKin->id }}">
              <div class="input-group">
                <input type="text" name="message" class="form-control" placeholder="Type your message..." required>
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-paper-plane"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
      @else
        <div class="card">
          <div class="card-body text-center py-5">
            <i class="fas fa-comments fa-4x text-muted mb-3"></i>
            <h4>Select a conversation</h4>
            <p class="text-muted">Choose a next of kin from the list to view messages</p>
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection