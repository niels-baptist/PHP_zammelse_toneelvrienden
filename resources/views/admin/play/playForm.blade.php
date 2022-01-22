@csrf
<div class="row">
    <section class="col-6">
        <div class="form-group">
            <label for="name">Naam</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                minlength="3" maxlength="255" required value="{{ old('name', $play->name) }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Beschrijving</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                id="description" cols="30" rows="10" minlength="3" maxlength="255"
                required>{{ old('description', $play->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </section>
    <section class="col-6">
        <div class="form-group">
            <label for="year">Jaargang</label>
            <input type="number" name="year" id="year" class="form-control @error('year') is-invalid @enderror"
                minlength="4" maxlength="4" required value="{{ old('year', $play->year) }}">
            @error('year')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="playtime">Speeltijd (in minuten)</label>
            <input type="number" name="playtime" id="playtime"
                class="form-control @error('playtime') is-invalid @enderror" minlength="2" maxlength="3" required
                value="{{ old('playtime', $play->playtime) }}">
            @error('playtime')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-check">
            @if ($play->active == true)
                <input type="checkbox" name="active" id="active" class="form-check-input" checked="checked">
                <label for="active" class="form-check-label">Actief</label>
            @else
                <input type="checkbox" name="active" id="active" class="form-check-input">
                <label for="active" class="form-check-label">Actief</label>
            @endif
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Opslaan</button>
        </div>
    </section>
</div>
