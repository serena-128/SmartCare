@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-dark text-center">📩 Messages</h2>

    <!-- Nav Tabs -->
    <ul class="nav nav-tabs" id="messageTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="received-tab" data-bs-toggle="tab" href="#received" role="tab" aria-controls="received" aria-selected="true">Received Messages</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="sent-tab" data-bs-toggle="tab" href="#sent" role="tab" aria-controls="sent" aria-selected="false">Sent Messages</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content mt-3" id="messageTabsContent">
        <!-- Received Messages -->
        <div class="tab-pane fade show active" id="received" role="tabpanel" aria-labelledby="received-tab">
            <div class="card shadow-lg mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Received Messages</h5>
                </div>
                <div class="card-body">
                    @if($currentMessage)
                        <div class="message">
                            <strong>{{ $currentMessage->sender }} (Received):</strong>
                            <p>{{ $currentMessage->message }}</p>
                            <small class="text-muted">{{ $currentMessage->created_at->diffForHumans() }}</small>
                            
                            <!-- Reply Form -->
                            <form action="{{ route('staff.reply', $currentMessage->id) }}" method="POST" class="mt-3">
                                @csrf
                                <textarea name="reply" rows="4" placeholder="Type your reply here..." class="form-control" required></textarea>
                                <button type="submit" class="btn btn-primary mt-2">Reply</button>
                            </form>
                        </div>
                        
                        <!-- Navigation Buttons -->
                        <div class="mt-4">
                            @if($previousMessage)
                                <a href="{{ route('staff.messages', $previousMessage->id) }}" class="btn btn-secondary">Previous</a>
                            @endif
                            
                            @if($nextMessage)
                                <a href="{{ route('staff.messages', $nextMessage->id) }}" class="btn btn-secondary float-end">Next</a>
                            @endif
                        </div>
                    @else
                        <p>No message found.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sent Messages (Similar structure as Received) -->
        <div class="tab-pane fade" id="sent" role="tabpanel" aria-labelledby="sent-tab">
            <div class="card shadow-lg mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Sent Messages</h5>
                </div>
                <div class="card-body">
                    @if($sentMessages->isEmpty())
                        <p>No sent messages.</p>
                    @else
                        <ul class="list-group">
                            @foreach($sentMessages as $sentMessage)
                                <li class="list-group-item" style="border-left: 5px solid #28a745; padding-left: 20px;">
                                    <strong>{{ $sentMessage->receiver }} (Sent):</strong>
                                    <p>{{ $sentMessage->message }}</p>
                                    <small class="text-muted">{{ $sentMessage->created_at->diffForHumans() }}</small>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
