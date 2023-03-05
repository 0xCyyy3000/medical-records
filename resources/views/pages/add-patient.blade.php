<x-layout :title='$title'>
    <div class="container bg-white w-75 m-auto p-5 rounded-4">
        <form class="position-relative " method="POST" action="{{ route('patient.store') }}">
            @csrf
            <section class="row grid-3 mb-4">
                <h2 class=" fw-semibold mb-3">Patient Information</h2>
                <div class="col-md-4 mb-3">
                    <label for="first_name" class="form-label">First name</label>
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                        name="first_name" placeholder="Juan" value="{{ old('first_name') }}">
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="middle_name" class="form-label">Middle name</label>
                    <input type="text" class="form-control @error('middle_name') is-invalid @enderror"
                        id="middle_name" name="middle_name" placeholder="Deguzman" value="{{ old('middle_name') }}">
                    @error('middle_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="last_name" class="form-label">Last name</label>
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                        name="last_name" placeholder="Dela Cruz" value="{{ old('last_name') }}">
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-2 mb-3">
                    <label for="civil_status" class="form-label">Civil status</label>
                    <select name="civil_status" id="civil_status"
                        class="form-select @error('civil_status') is-invalid @enderror">
                        <option value="Single" @if (old('civil_status') == 'Single') selected @endif>Single</option>
                        <option value="Married" @if (old('civil_status') == 'Married') selected @endif>Married</option>
                        <option value="Separated" @if (old('civil_status') == 'Separated') selected @endif>Separated</option>
                        <option value="Divorced" @if (old('civil_status') == 'Divorced') selected @endif>Divorced</option>
                        <option value="Widowed" @if (old('civil_status') == 'Widowed') selected @endif>Widowed</option>
                    </select>
                    @error('civil_status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-2 mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
                        <option value="Male" @if (old('gender') == 'Male') selected @endif>Male</option>
                        <option value="Female" @if (old('gender') == 'Female') selected @endif>Female</option>
                        <option value="Others" @if (old('gender') == 'Others') selected @endif>Others</option>
                    </select>
                    @error('gender')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="birthdate" class="form-label">Birthdate</label>
                    <input type="text" placeholder="mm/dd/yyyy"
                        class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" name="birthdate"
                        value="{{ old('birthdate') }}" autocomplete="off">
                    @error('birthdate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-5 mb-3">
                    <label for="birthdate" class="form-label">Birthplace</label>
                    <input type="text" class="form-control @error('birthplace') is-invalid @enderror" id="birthdate"
                        name="birthplace" placeholder="Barangay, Street, City/Municipality, Province"
                        value="{{ old('birthplace') }}">
                    @error('birthplace')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </section>

            <section class="row grid-3 mb-3">
                <h2 class=" fw-semibold mb-3">Contact Information</h2>
                <div class="col-md-4 mb-3">
                    <label for="email" class="form-label">Email <small>(optional)</small></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="example@mail.com" value="{{ old('email') }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="phone_number" class="form-label">Phone number</label>
                    <input type="number" class="form-control @error('phone_number') is-invalid @enderror"
                        id="phone_number" name="phone_number" placeholder="11 digit number"
                        value="{{ old('phone_number') }}">
                    @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label for="street" class="form-label">Address</label>
                    <input type="text" class="form-control @error('street') is-invalid @enderror" id="street"
                        name="street" placeholder="Barangay, Street" value="{{ old('street') }}">
                    @error('street')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="city" class="form-label">City/Municipality</label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                        name="city" placeholder="Tacloban City" value="{{ old('city') }}">
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="province" class="form-label">Province</label>
                    <input type="text" class="form-control @error('province') is-invalid @enderror"
                        id="province" name="province" placeholder="Leyte" value="{{ old('province') }}">
                    @error('province')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label for="zip_code" class="form-label">Zip code</label>
                    <input type="number" class="form-control @error('zip_code') is-invalid @enderror"
                        id="zip_code" name="zip_code" placeholder="6500" value="{{ old('zip_code') }}">
                    @error('zip_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </section>

            <section class="row grid-3 mb-3">
                <h2 class="fw-semibold mb-3">Vital Signs</h2>
                <div class="col-md-3 mb-3">
                    <label for="blood_pressure" class="form-label">Blood pressure</label>
                    <input type="text" class="form-control @error('blood_pressure') is-invalid @enderror"
                        id="blood_pressure" name="blood_pressure" value="{{ old('blood_pressure') }}">
                    @error('blood_pressure')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="respiratory_rate" class="form-label">Respiratory rate</label>
                    <input type="text" class="form-control @error('respiratory_rate') is-invalid @enderror"
                        id="respiratory_rate" name="respiratory_rate" value="{{ old('respiratory_rate') }}">
                    @error('respiratory_rate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="capillary_refill" class="form-label">Capillary refill</label>
                    <input type="text" class="form-control @error('capillary_refill') is-invalid @enderror"
                        id="capillary_refill" name="capillary_refill" value="{{ old('capillary_refill') }}">
                    @error('capillary_refill')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="pulse_rate" class="form-label">Pulse rate</label>
                    <input type="text" class="form-control @error('pulse_rate') is-invalid @enderror"
                        id="pulse_rate" name="pulse_rate" value="{{ old('pulse_rate') }}">
                    @error('pulse_rate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="temperature" class="form-label">Temperature</label>
                    <input type="text" class="form-control @error('temperature') is-invalid @enderror"
                        id="temperature" name="temperature" value="{{ old('temperature') }}">
                    @error('temperature')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="weight" class="form-label">Weight</label>
                    <input type="text" class="form-control @error('weight') is-invalid @enderror" id="weight"
                        name="weight" value="{{ old('weight') }}">
                    @error('weight')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

            </section>

            <div class="col-md-12 py-3">
                <button type="submit" class="btn btn-my-primary text-white float-end rounded-2">
                    Add patient</button>
                <a href="{{ route('index.patient') }}"
                    class="text-decoration-none float-end p-2 primary me-4">Cancel</a>
            </div>
        </form>

        <script>
            $(document).ready(function() {
                $('#birthdate').datepicker({
                    uiLibrary: 'bootstrap5',

                })
            });
        </script>
    </div>
</x-layout>
