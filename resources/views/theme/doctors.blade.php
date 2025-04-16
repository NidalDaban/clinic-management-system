@extends('theme.master')
@section('title', 'Doctors')
@section('doctors-active', 'active')

@section('content')
@section('subtitle', 'Place your appointment with the favirote doctor')


<main class="main">

    <section id="doctors" class="doctors section">

        <div class="container">

            <div class="row gy-4">
                @if (is_null($doctors) || $doctors->isEmpty())
                    <p class="text-center">No doctors available at the moment.</p>
                @else
                    @foreach ($doctors as $doctor)
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                            <div class="team-member d-flex align-items-start">
                                <div class="pic">
                                    <img src="{{ $doctor->image_path
                                        ? asset('storage/' . $doctor->image_path)
                                        : ($doctor->gender === 'female'
                                            ? 'https://cdn-icons-png.flaticon.com/512/3135/3135789.png'
                                            : 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png') }}"
                                        class="img-fluid" alt="{{ $doctor->first_name }}">
                                </div>
                                <div class="member-info">
                                    <h4>{{ ucfirst($doctor->first_name) . ' ' . ucfirst($doctor->second_name) . ' ' . ucfirst($doctor->last_name) }}
                                    </h4>
                                    <span>{{ ucfirst($doctor->role) }}</span>

                                    {{-- Doctor Rating --}}
                                    <div class="rating mb-2">
                                        @php $stars = floor($doctor->rating ?? 4); @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $stars)
                                                <i class="bi bi-star-fill text-warning"></i>
                                            @else
                                                <i class="bi bi-star text-muted"></i>
                                            @endif
                                        @endfor
                                        <span class="text-muted ms-1">
                                            ({{ number_format($doctor->rating ?? 4, 1) }})
                                            • {{ $doctor->reviews_count ?? 0 }}
                                            review{{ $doctor->reviews_count === 1 ? '' : 's' }}
                                        </span>
                                    </div>

                                    {{-- Review Preview --}}
                                    @if ($doctor->latest_review)
                                        <blockquote class="small fst-italic text-muted">
                                            "{{ \Illuminate\Support\Str::limit($doctor->latest_review->comment, 100) }}"
                                        </blockquote>
                                    @endif

                                    <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>
                                    <div class="mt-2">
                                        <a class="btn btn-secondary btn-sm mb-1"
                                            href="{{ route('doctors.show', $doctor->id) }}">Show Details</a>
                                    </div>

                                    <div>
                                        <a class="btn btn-primary btn-sm mb-1" style="width: 6rem;"
                                            href="{{ route('appointment.create', $doctor->id) }}">Book
                                            Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                @endif
            </div>

        </div>

    </section><!-- /Doctors Section -->

</main>


@endsection
