@csrf
<div>
    <?php
    session_start();
    $rand = rand();
    $_SESSION['rand'] = $rand;
    ?>
    <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
    <div>
        <label for="surname">Achternaam</label>
        <input type="text" name="surname" id="surname"
            class="detail-input form-control @error('surname') is-invalid @enderror" placeholder="Uw achternaam"
            required disabled value="{{ old('surname', $reservation->surname) }}">
        @error('surname')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="firstName">Voornaam</label>
        <input type="text" name="firstName" id="firstName"
            class="detail-input form-control @error('firstName') is-invalid @enderror" placeholder="Uw voornaam"
            required disabled value="{{ old('firstName', $reservation->firstName) }}">
        @error('firstName')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="email">E-mailadres</label>
        <input type="email" name="email" id="email"
            class="detail-input form-control @error('email') is-invalid @enderror" placeholder="Uw e-mailadres" required
            disabled value="{{ old('email', $reservation->email) }}">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="telephone">Telefoon</label>
        <input type="tel" minlength="9" maxlength="15" name="telephone" id="telephone"
            class="detail-input form-control @error('telephone') is-invalid @enderror" placeholder="Uw telefoonnummer"
            required disabled value="{{ old('telephone', $reservation->telephone) }}">
        @error('telephone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="address">Adres</label>
        <input type="text" name="address" id="address"
            class="detail-input form-control @error('address') is-invalid @enderror"
            placeholder="Uw straat en straatnummer" required disabled
            value="{{ old('address', $reservation->address) }}">
        @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="place">Gemeente</label>
        <input type="text" name="place" id="place"
            class="detail-input form-control @error('place') is-invalid @enderror" placeholder="Uw gemeente" required
            disabled value="{{ old('place', $reservation->place) }}">
        @error('place')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="postalCode">Postcode</label>
        <input type="text" name="postalCode" id="postalCode"
            class="detail-input form-control @error('postalCode') is-invalid @enderror" placeholder="Uw postcode"
            required disabled value="{{ old('postalCode', $reservation->postalCode) }}">
        @error('postalCode')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <p>
        <button type="submit" id="submit" class="btn btn-primary mt-3">Reserveren</button>
    </p>
</div>
