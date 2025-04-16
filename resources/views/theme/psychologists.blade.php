@extends('theme.master')
@section('title', 'Psychologists')
@section('doctors-active', 'active')

@section('content')
@section('subtitle', 'Place your appointment with the favirote psychologist')


<main class="main">

    <section id="doctors" class="doctors section">

        <div class="container">
            <div class="row gy-4">
                @foreach ($psychologists as $psychologist)
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="team-member d-flex align-items-start">
                            <div class="pic">
                                <img src="{{ $psychologist->image_path
                                    ? asset('storage/' . $psychologist->image_path)
                                    : ($psychologist->gender === 'female'
                                        ? 'https://cdn-icons-png.flaticon.com/512/3135/3135789.png'
                                        : 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png') }}"
                                    class="img-fluid" alt="{{ $psychologist->first_name }}">
                            </div>
                            <div class="member-info">
                                <h4>{{ ucfirst($psychologist->first_name) . ' ' . ucfirst($psychologist->second_name) . ' ' . ucfirst($psychologist->last_name) }}
                                </h4>
                                <span>{{ ucfirst($psychologist->role) }}</span>


                                {{-- psychologist Rating --}}
                                <div class="rating mb-2">
                                    @php $stars = floor($psychologist->psychologist_rating ?? 4); @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $stars)
                                            <i class="bi bi-star-fill text-warning"></i>
                                        @else
                                            <i class="bi bi-star text-muted"></i>
                                        @endif
                                    @endfor
                                    <span class="text-muted ms-1">
                                        ({{ number_format($psychologist->psychologist_rating ?? 4, 1) }})
                                        • {{ $psychologist->psychologist_reviews_count ?? 0 }}
                                        review{{ $psychologist->psychologist_reviews_count === 1 ? '' : 's' }}
                                    </span>
                                </div>

                                {{-- Review Preview --}}
                                @if ($psychologist->latest_psychologist_review)
                                    <blockquote class="small fst-italic text-muted">
                                        "{{ \Illuminate\Support\Str::limit($psychologist->latest_psychologist_review->comment, 100) }}"
                                    </blockquote>
                                @endif

                                <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>

                                <div class="mt-2">
                                    <a class="btn btn-secondary btn-sm mb-1"
                                        href="{{ route('psychologist.show', $psychologist->id) }}">Show Details</a>
                                </div>

                                <div>
                                    <a class="btn btn-primary btn-sm mb-1" style="width: 6rem;" href="#">Book
                                        Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </section><!-- /psychologists Section -->
</main>


@endsection
