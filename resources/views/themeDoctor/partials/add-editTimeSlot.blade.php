<div class="modal fade custom-modal" id="add_time_slot">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Time Slots</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('doctor.schedule.slot.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="day_of_week" id="day_of_week" value="">

                    <div class="hours-info">
                        <div class="row form-row hours-cont time-slot">
                            <div class="col-12 col-md-10">
                                <div class="row form-row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Start Time</label>
                                            <input class="form-control" type="time" name="apptstart[]" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>End Time</label>
                                            <input class="form-control" type="time" name="apptend[]" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="add-more mb-3">
                        <a href="javascript:void(0);" class="add-hours">
                            <i class="fa fa-plus-circle"></i> Add More
                        </a>
                    </div>

                    <div class="submit-section text-center">
                        <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
