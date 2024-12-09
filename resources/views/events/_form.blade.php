<div class="mb-3">
    <label for="time" class="form-label">Time</label>
    <input type="time" class="form-control" id="time" name="time" value="{{ $event->time ?? '' }}" required>
</div>

<div class="mb-3">
    <label for="date" class="form-label">Date</label>
    <input type="date" class="form-control" id="date" name="date" value="{{ $event->date ?? '' }}" required>
</div>

<div class="mb-3">
    <label for="event_name" class="form-label">Event Name</label>
    <input type="text" class="form-control" id="event_name" name="event_name"
        value="{{ $event->event_name ?? '' }}" required>
</div>

<div class="mb-3">
    <label for="event_place" class="form-label">Event Place</label>
    <input type="text" class="form-control" id="event_place" name="event_place"
        value="{{ $event->event_place ?? '' }}" required>
</div>
