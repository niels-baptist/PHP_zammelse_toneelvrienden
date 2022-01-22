@csrf
<div class="form-group">
    <label for="hall">Zaal</label>
    <select class="form-control" name="hall_id" id="hall">
        @foreach ($halls as $hall)
            <option value="{{ $hall->id }}" {{ $performance->hall_id == $hall->id ? 'selected' : '' }}>
                {{ $hall->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="play">Toneelstuk</label>
    <select class="form-control" name="play_id" id="play">
        @foreach ($plays as $play)
            <option value="{{ $play->id }}" {{ $performance->play_id == $play->id ? 'selected' : '' }}>
                {{ $play->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="date">Datum</label>
    <input type="text" name="date" id="date" class="form-control @error('date') is-invalid @enderror"
        placeholder="DD/MM/JJJJ" required value="{{ old('date', $performance->date) }}">
    @error('date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="time">Startuur</label>
    <input type="text" name="time" id="time" class="form-control @error('time') is-invalid @enderror"
        placeholder="UU:MM" required value="{{ old('time', $performance->time) }}">
    @error('time')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="name">Prijs</label>
    <input type="number" name="price" id="price" step="0.25" class="form-control @error('price') is-invalid @enderror"
        placeholder="prijs" required value="{{ old('price', $performance->price) }}">
    @error('price')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="row justify-content-between p-3">
    <div class="form-group ">
        @if ($performance->active)
            <input class="ml-1" type="checkbox" name="active" id="active" class="form-check-input" checked>
        @else
            <input class="ml-1" type="checkbox" name="active" id="active" class="form-check-input">
        @endif
        <label for="active" class="form-check-label">Actief</label>
    </div>

    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Opslaan</button>
</div>
