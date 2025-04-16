@extends('theme.master')

@section('title', 'Doctor Details')

@section('content')
    <main class="main">
        <section class="section profile">
            <div class="container">
                <div class="card">
                    <div class="card-body pt-3">
                        <h2>{{ $doctor->first_name }} {{ $doctor->last_name }}</h2>
                        <p>{{ $doctor->job_title }}</p>

                        {{-- Display Average Rating --}}
                        <div class="rating mb-2">
                            @php $stars = floor($doctor->rating ?? 0); @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $stars)
                                    <i class="bi bi-star-fill text-warning"></i>
                                @else
                                    <i class="bi bi-star text-muted"></i>
                                @endif
                            @endfor
                            <span class="text-muted ms-1">({{ number_format($doctor->rating ?? 0, 1) }})</span>
                        </div>

                        {{-- Display Reviews --}}
                        <h5 class="mt-4">Reviews</h5>
                        @forelse($doctor->doctorReviews as $review)
                            <div class="mb-3 border-bottom pb-2">
                                <strong>{{ $review->patient->first_name ?? 'Anonymous' }}</strong>:
                                <p>{{ $review->comment }}</p>
                            </div>
                        @empty
                            <p>No reviews yet.</p>
                        @endforelse

                        {{-- Role-based content --}}
                        @auth
                            @if (auth()->user()->isPatient())
                                <p>Leave a review for the doctor below.</p>
                            @elseif (auth()->user()->isDoctor())
                                <p>You are the doctor. Manage your appointments and reviews.</p>
                            @elseif (auth()->user()->isPsychologist())
                                <p>You are a psychologist. Please update your availability.</p>
                            @endif
                        @endauth

                        @auth
                            @if (auth()->user()->isPatient())
                                <h5 class="mt-4">Leave a Review</h5>
                                <form action="{{ route('reviews.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="recipient_id" value="{{ $doctor->id }}">

                                    <div class="mb-3">
                                        <label for="rating">Your Rating:</label>
                                        <div class="star-rating">
                                            @for ($i = 5; $i >= 1; $i--)
                                                <input type="radio" id="star{{ $i }}" name="ratings"
                                                    value="{{ $i }}">
                                                <label for="star{{ $i }}"><i class="bi bi-star-fill"></i></label>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="comment">Your Review:</label>
                                        <textarea name="comment" class="form-control" rows="4" placeholder="Write something..."></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-sm">Submit Review</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
