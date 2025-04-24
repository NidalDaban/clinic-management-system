@extends('themeDoctor.masterDrDashboard')
@section('schedule-active', 'active')

@php
    use Carbon\Carbon;
    $today = Carbon::now()->format('l');
@endphp

@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Schedule Timings</h4>
                        <div class="profile-box">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card schedule-widget mb-0">
                                        <div class="schedule-header">
                                            <div class="schedule-nav">
                                                <ul class="nav nav-tabs nav-justified">
                                                    @foreach ($days as $i => $day)
                                                        @php
                                                            $tabId = strtolower($day->value);
                                                            $dateLabel = Carbon::now()
                                                                ->startOfWeek()
                                                                ->addDays($i)
                                                                ->format('j M (D)');
                                                            $isActive =
                                                                $day->value === $today ||
                                                                ($loop->first &&
                                                                    !in_array($today, array_column($days, 'value')));
                                                        @endphp
                                                        <li class="nav-item">
                                                            <a class="nav-link {{ $isActive ? 'active' : '' }}"
                                                                data-toggle="tab" href="#slot_{{ $tabId }}"
                                                                style="min-height: 75px">
                                                                {{ $day->value }}
                                                                <small class="d-block">{{ $dateLabel }}</small>
                                                            </a>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-content schedule-cont">
                                            @foreach ($days as $day)
                                                @php
                                                    $tabId = strtolower($day->value);
                                                    $isActive =
                                                        $day->value === $today ||
                                                        ($loop->first &&
                                                            !in_array($today, array_column($days, 'value')));
                                                @endphp
                                                <div id="slot_{{ $tabId }}"
                                                    class="tab-pane fade {{ $isActive ? 'show active' : '' }}">
                                                    <h4 class="card-title d-flex justify-content-between">
                                                        <span>Time Slots</span>
                                                        <a class="edit-link" data-toggle="modal" href="#add_time_slot"
                                                            data-day="{{ $day->value }}">
                                                            <i class="fa fa-plus-circle"></i> Add Slot
                                                        </a>
                                                    </h4>

                                                    @if (isset($schedules[$day->value]) && $schedules[$day->value]->slots->count())
                                                        <div class="doc-times">
                                                            @foreach ($schedules[$day->value]->slots as $slot)
                                                                <div class="doc-slot-list">
                                                                    {{ Carbon::parse($slot->start_time)->format('g:i A') }}
                                                                    -
                                                                    {{ Carbon::parse($slot->end_time)->format('g:i A') }}
                                                                    <form
                                                                        action="{{ route('doctor.schedule.slot.delete', $slot->id) }}"
                                                                        method="POST" class="d-inline delete-slot-form">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="delete_schedule">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <p class="text-muted mb-0">Not Available</p>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
