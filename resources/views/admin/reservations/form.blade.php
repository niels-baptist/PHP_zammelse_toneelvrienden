@csrf
<div>
    <div>
        <label for="surname">Achternaam</label>
        <input type="text" name="surname" id="surname" class="form-control @error('surname') is-invalid @enderror"
            placeholder="Uw achternaam" minlength="2" maxlength="255" required
            value="{{ old('surname', $reservation->surname) }}">
        @error('surname')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="firstName">Voornaam</label>
        <input type="text" name="firstName" id="firstName" class="form-control @error('firstName') is-invalid @enderror"
            placeholder="Uw voornaam" minlength="2" maxlength="255" required
            value="{{ old('firstName', $reservation->firstName) }}">
        @error('firstName')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="email">E-mailadres</label>
        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
            placeholder="Uw e-mailadres" minlength="8" maxlength="255" required
            value="{{ old('email', $reservation->email) }}">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="telephone">Telefoon</label>
        <input type="tel" minlength="9" maxlength="15" name="telephone" id="telephone"
            class="form-control @error('telephone') is-invalid @enderror" placeholder="Uw telefoonnummer" required
            value="{{ old('telephone', $reservation->telephone) }}">
        @error('telephone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="address">Adres</label>
        <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror"
            placeholder="Uw straat en straatnummer" minlength="5" maxlength="255" required
            value="{{ old('address', $reservation->address) }}">
        @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="place">Gemeente</label>
        <input type="text" name="place" id="place" class="form-control @error('place') is-invalid @enderror"
            placeholder="Uw gemeente" minlength="2" maxlength="255" required
            value="{{ old('place', $reservation->place) }}">
        @error('place')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="postalCode">Postcode</label>
        <input type="text" name="postalCode" id="postalCode"
            class="form-control @error('postalCode') is-invalid @enderror" placeholder="Uw postcode" minlength="4"
            maxlength="4" required value="{{ old('postalCode', $reservation->postalCode) }}">
        @error('postalCode')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="performance_id">Voorstelling</label>
        <select name="performance_id" id="performance_id"
            class="custom-select @error('performace_id') is-invalid @enderror" required>
            <option value="">Selecteer een voorstelling</option>
            @foreach ($performances as $performance)
                <option value="{{ $performance->id }}"
                    {{ old('performance_id', $reservation->performance_id) == $performance->id ? 'selected' : '' }}>
                    {{ ucfirst($performance->play->name) }} {{ $performance->performanceText }}</option>
            @endforeach
        </select>
        @error('performance_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="row justify-content-between p-3">
        <div class="form-group">
            @if ($reservation->paid)
                <input class="ml-1" type="checkbox" name="paid" id="paid" class="form-check-input" checked>
            @else
                <input class="ml-1" type="checkbox" name="paid" id="paid" class="form-check-input">
            @endif
            <label for="paid" class="form-check-label">Betaald</label>
        </div>
        <p>
            <button type="submit" id="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Opslaan
            </button>
        </p>
    </div>
</div>
