@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>📬 Staff Feedback</h2>
        <a href="{{ route('feedback.create') }}" class="btn btn-purple">➕ Submit Feedback</a>
    </div>

    @include('flash::message')

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Category</th>
                    <th>Subject</th>
                    <th>Rating</th>
                    <th>Anonymous</th>
                    <th>Submitted At</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feedback as $item)
                    <tr>
                        <td>{{ $item->category }}</td>
                        <td>{{ $item->subject }}</td>
                        <td>
                            @if($item->rating)
                                @for ($i = 0; $i < $item->rating; $i++)
                                    ⭐
                                @endfor
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $item->is_anonymous ? 'Yes' : 'No' }}</td>
                        <td>{{ $item->created_at->format('Y-m-d H:i') }}</td>
                        <td class="text-center">
                            <a href="{{ route('feedback.show', $item->id) }}" class="btn btn-sm btn-outline-primary me-1" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            {!! Form::open(['route' => ['feedback.destroy', $item->id], 'method' => 'delete', 'style' => 'display:inline']) !!}
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this feedback?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No feedback available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $feedback->links() }}
    </div>
</div>
@endsection
