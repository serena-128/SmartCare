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
                    @if($messages->isEmpty())
                        <p>No new messages.</p>
                    @else
                        <ul class="list-group">
                            @foreach($messages as $message)
                                <li class="list-group-item" style="border-left: 5px solid #007bff; padding-left: 20px;">
                                    <strong>{{ $message->sender }}:</strong>
                                    <p>{{ $message->message }}</p>
                                    <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                                    
                                    <!-- Reply Form -->
                                    <form action="{{ route('staff.reply', $message->id) }}" method="POST" class="mt-3">
                                        @csrf
                                        <textarea name="reply" rows="4" placeholder="Type your reply here..." class="form-control" required></textarea>
                                        <button type="submit" class="btn btn-primary mt-2">Reply</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sent Messages -->
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
                                    <strong>{{ $sentMessage->receiver }}:</strong>
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
