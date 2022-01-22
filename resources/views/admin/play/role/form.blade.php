@csrf
<h2>Rol Toevoegen</h2>
<div class="form-group">
    <label for="character">Naam Personage</label>
    <input type="text" name="character" id="character" class="form-control" placeholder="Naam Personage"
        maxlength="255">
</div>
<div class="row">
    <div class="form-group col-6">
        <label for="role">Rol</label>
        <select name="role" id="role" class="form-control">
            @foreach ($jobs as $job)
                <option name="{{ $job->id }}" id="{{ $job->id }}" value="{{ $job->id }}">
                    {{ $job->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-6">
        <label for="person">Medewerker</label>
        <select name="person" id="person" class="form-control">
            @foreach ($people as $person)
                <option name="{{ $person->id }}" id="{{ $person->id }}" value="{{ $person->id }}">
                    {{ $person->firstName }} {{ $person->surname }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row justify-content-between p-3">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-plus-circle mr-1"></i>Rol Toevoegen
    </button>

    <a href="/admin/play" class="btn btn-outline-primary">
        Gereed
    </a>
</div>
