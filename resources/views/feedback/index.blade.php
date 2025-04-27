@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <!-- ✅ Feedback Section Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center">
            <span style="font-size: 2rem; margin-right: 10px;">📬</span>
            <h2 class="mb-0">Staff Feedback</h2>
        </div>
        <a href="{{ route('feedback.create') }}" class="btn btn-purple">➕ Submit Feedback</a>
    </div>

    @include('flash::message')

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Staff</th>
                    <th>Category</th>
                    <th>Subject</th>
                    <th>Rating</th>
                    <th>Submitted At</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feedback as $item)
                    <tr>
                        <!-- ✅ Staff Name or Anonymous -->
                        <td>
                            @if($item->is_anonymous || $item->staff == null)
                                Anonymous
                            @else
                                {{ $item->staff->firstname }} {{ $item->staff->lastname }}
                            @endif
                        </td>

                        <td>{{ $item->category }}</td>

                        <td>{{ $item->subject }}</td>

                        <!-- ✅ Star Rating -->
                        <td>
                            @if($item->rating)
                                @for ($i = 0; $i < $item->rating; $i++)
                                    ⭐
                                @endfor
                            @else
                                N/A
                            @endif
                        </td>

                        <td>{{ $item->created_at->format('Y-m-d H:i') }}</td>

                        <td class="text-center">
                            <a href="{{ route('feedback.show', $item->id) }}" class="btn btn-sm btn-outline-primary me-1" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            {!! Form::open(['route' => ['feedback.destroy', $item->id], 'method' => 'delete', 'style' => 'display:inline']) !!}
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this feedback?')">
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
