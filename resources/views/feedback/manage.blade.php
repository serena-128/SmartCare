@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">📈 Feedback Dashboard</h2>

    <!-- Insights -->
    <div class="row text-center mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Total Feedback</h5>
                    <h3 class="fw-bold">{{ $totalFeedback }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Anonymous Feedback</h5>
                    <h3 class="fw-bold">{{ $anonymousCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Average Rating</h5>
                    <h3 class="fw-bold">
                        {{ number_format($averageRating, 1) ?? 'N/A' }}
                        ⭐
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">📝 All Feedback</h5>

            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Staff</th>
                        <th>Category</th>
                        <th>Subject</th>
                        <th>Rating</th>
                        <th>Submitted</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($feedback as $item)
                        <tr>
                            <td>
                                @if($item->is_anonymous || $item->staff == null)
                                    Anonymous
                                @else
                                    {{ $item->staff->firstname }} {{ $item->staff->lastname }}
                                @endif
                            </td>
                            <td>{{ $item->category }}</td>
                            <td>{{ $item->subject }}</td>
                            <td>
                                @if($item->rating)
                                    @for ($i = 0; $i < $item->rating; $i++) ⭐ @endfor
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $item->created_at->format('Y-m-d') }}</td>
                            <td class="text-center">
                                <a href="{{ route('feedback.show', $item->id) }}" class="btn btn-sm btn-primary">View</a>
                                {!! Form::open(['route' => ['feedback.destroy', $item->id], 'method' => 'delete', 'style' => 'display:inline']) !!}
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this feedback?')">Delete</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3">
                {{ $feedback->links() }}
            </div>
        </div>
    </div>

</div>
@endsection
