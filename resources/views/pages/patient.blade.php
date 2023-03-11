<x-layout :title='$title'>
    <div class="row w-25">
        <a href="{{ route('index.patient') }}" class="text-decoration-none dark d-flex gap-2 align-items-center w-50">
            <span class="material-icons-sharp fs-5">
                arrow_back_ios
            </span>
            Patient Records
        </a>
    </div>

    {{-- Warning Modal --}}
    <div class="modal fade" id="removeWarningModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="removeWarningModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="removeWarningModalLabel">Removing patient</h1>
                </div>
                <div class="modal-body py-2">
                    You are about to remove this patient, do you want to proceed?
                    <br>This action cannot be undone.
                </div>
                <div class="modal-footer border-0 modal-actions">
                    <button type="button" class="btn primary" data-bs-dismiss="modal"
                        style="color: var(--color-white) !important; background: var(--color-info-dark) !important;">No,
                        don't proceed</button>
                    <form action="{{ route('patient.destroy', ['patient' => $patient->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn"
                            style="color: var(--color-danger) !important; border: solid 1px var(--color-danger) !important;">Yes,
                            proceed</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Medical Record Modal --}}
    <div class="modal fade" id="addMedicalRecord" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="medicalRecordLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route('diagnosis.store', ['patient' => $patient->id]) }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h1 class="modal-title fs-5" id="medicalRecordLabel">Add Medical Record</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 p-2">
                            <div class="col-md-5">
                                <label for="date" class="form-label">Issued Date</label>
                                <input type="text" placeholder="mm/dd/yyyy" class="form-control date-issue"
                                    name="date" readonly required>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" required placeholder="Doctor/Consultant"name="doctor" style="height: 50px"></textarea>
                                    <label for="doctor">Doctor/Consultant</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea class="form-control" required placeholder="Diagnosis/Findings"name="diagnosis" style="height: 100px"></textarea>
                                    <label for="diagnosis">Diagnosis/Findings</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" required placeholder="Prescription"name="prescription" style="height: 100px"></textarea>
                                    <label for="prescription">Prescription</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn bg-my-secondary text-white"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-my-primary text-white">Save record</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Medical Record Modal --}}
    <div class="modal fade" id="editMedicalRecord" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editMedicalRecordLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route('diagnosis.update') }}">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h1 class="modal-title fs-5" id="editMedicalRecordLabel">Add Medical Record</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 p-2">
                            <div class="col-md-5">
                                <label for="date" class="form-label">Issued Date</label>
                                <input type="text" placeholder="mm/dd/yyyy" class="form-control date-issue"
                                    name="date" id="date" readonly required>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" required placeholder="Doctor/Consultant"name="doctor" id="doctor"
                                        style="height: 50px"></textarea>
                                    <label for="doctor">Doctor/Consultant</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea class="form-control" required placeholder="Diagnosis/Findings"name="diagnosis" id="diagnosis"
                                        style="height: 100px"></textarea>
                                    <label for="diagnosis">Diagnosis/Findings</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" required placeholder="Prescription"name="prescription" id="prescription"
                                        style="height: 100px"></textarea>
                                    <label for="prescription">Prescription</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn bg-my-secondary text-white"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="did" id="diagnosis_edit"
                            class="btn btn-my-primary text-white">
                            Update medical record
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Warning Diagnosis Record Modal --}}
    <div class="modal fade" id="removeDiagnosisModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="removeDiagnosisModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="removeDiagnosisModalLabel">Removing Medical Record</h1>
                </div>
                <div class="modal-body py-2">
                    You are about to remove this medical record, do you want to proceed?
                    <br>This action cannot be undone.
                </div>
                <div class="modal-footer border-0 modal-actions">
                    <button type="button" class="btn primary" data-bs-dismiss="modal"
                        style="color: var(--color-white) !important; background: var(--color-info-dark) !important;">No,
                        don't proceed</button>
                    <form id="deleteDiagnosis" action="{{ route('diagnosis.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" name="diagnosis" id="diagnosis_delete"
                            style="color: var(--color-danger) !important; border: solid 1px var(--color-danger) !important;">Yes,
                            proceed</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row p-4 mb-3" style="--bs-gutter-x: 0rem !important;" id="patient">
        <div class="bg-white rounded-4 col shadow">
            <form class="position-relative p-5" method="POST" id="patient_form"
                action="{{ route('patient.update', ['patient' => $patient->id]) }}">
                @method('PUT')
                @csrf
                <section class="row grid-3 mb-4">
                    <div class="d-flex mb-3 justify-content-between align-items-center">
                        <h2 class="fw-semibold">Patient Information</h2>
                        <div class="d-flex gap-3 action">
                            <button type="button" class="btn d-flex align-items-center p-0 gap-2 edit-patient">
                                <span class="material-icons-sharp fs-5 primary">
                                    edit
                                </span>
                                <span class="primary">Edit patient</span>
                            </button>
                            <button type="button" class=" btn d-flex align-items-center p-0 gap-2 remove-patient"
                                data-bs-toggle="modal" data-bs-target="#removeWarningModal">
                                <span class="material-icons-sharp fs-5 danger">
                                    delete
                                </span>
                                <span class="danger">Remove patient</span>
                            </button>
                        </div>
                        <div class="d-flex gap-3 final-action d-none">
                            <button type="button" class="btn d-flex align-items-center p-0 gap-2 cancel-edit">
                                <span class="material-icons-sharp fs-5 dark">
                                    cancel
                                </span>
                                <span class="dark">Cancel</span>
                            </button>
                            <button type="submit" class="btn d-flex align-items-center p-0 gap-2">
                                <span class="material-icons-sharp fs-5 primary">
                                    save
                                </span>
                                <span class="primary">Save changes</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="first_name" class="form-label">First name</label>
                        <input type="text"
                            class="form-control @error('first_name') is-invalid @enderror patient_entities"
                            id="first_name" name="first_name" placeholder="Juan" readonly
                            value="@if (old('first_name')) {{ old('first_name') }}@else{{ $patient->first_name }} @endif">
                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="middle_name" class="form-label">Middle name</label>
                        <input type="text"
                            class="form-control @error('middle_name') is-invalid @enderror patient_entities"
                            id="middle_name" name="middle_name" placeholder="Deguzman" readonly
                            value="@if (old('middle_name')) {{ old('middle_name') }} @else{{ $patient->middle_name }} @endif">
                        @error('middle_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="last_name" class="form-label">Last name</label>
                        <input type="text"
                            class="form-control @error('last_name') is-invalid @enderror patient_entities"
                            id="last_name" name="last_name" placeholder="Dela Cruz" readonly
                            value="@if (old('last_name')) {{ old('last_name') }} @else{{ $patient->last_name }} @endif">
                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="civil_status" class="form-label">Civil status</label>
                        <select name="civil_status" id="civil_status" disabled
                            class="form-select @error('civil_status') is-invalid @enderror patient_entities">
                            <option value="Single" @if (old('civil_status') == 'Single' or $patient->civil_status == 'Single') selected @endif>
                                Single
                            </option>
                            <option value="Married" @if (old('civil_status') == 'Married' or $patient->civil_status == 'Married') selected @endif>
                                Married
                            </option>
                            <option value="Separated" @if (old('civil_status') == 'Separated' or $patient->civil_status == 'Separated') selected @endif>
                                Separated
                            </option>
                            <option value="Divorced" @if (old('civil_status') == 'Divorced' or $patient->civil_status == 'Divorced') selected @endif>
                                Divorced
                            </option>
                            <option value="Widowed" @if (old('civil_status') == 'Widowed' or $patient->civil_status == 'Widowed') selected @endif>
                                Widowed
                            </option>
                        </select>
                        @error('civil_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select name="gender" id="gender"
                            class="form-select @error('gender') is-invalid @enderror patient_entities" disabled>
                            <option value="Male" @if (old('gender') == 'Male' or $patient->gender == 'Male') selected @endif>Male</option>
                            <option value="Female" @if (old('gender') == 'Female' or $patient->gender == 'Female') selected @endif>Female</option>
                            <option value="Others" @if (old('gender') == 'Others' or $patient->gender == 'Others') selected @endif>Others</option>
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
                            class="form-control @error('birthdate') is-invalid @enderror patient_entities"
                            id="birthdate" name="birthdate" readonly
                            value="@if (old('birthdate')) {{ old('birthdate') }}@else{{ Illuminate\Support\Carbon::parse($patient->birthdate)->format('m/d/Y') }} @endif">
                        @error('birthdate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="text" class="form-control @error('age') is-invalid @enderror "
                            id="age" name="age" placeholder="Dela Cruz" readonly
                            value="@if (old('age')) {{ old('age') }} @else{{ $patient->age }} @endif">
                        @error('age')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="birthdate" class="form-label">Birthplace</label>
                        <input type="text"
                            class="form-control @error('birthplace') is-invalid @enderror patient_entities"
                            id="birthdate" name="birthplace"
                            placeholder="Barangay, Street, City/Municipality, Province" readonly
                            value="@if (old('birthplace')) {{ old('birthplace') }}@else{{ $patient->birthplace }} @endif">
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
                        <input type="email"
                            class="form-control @error('email') is-invalid @enderror patient_entities" id="email"
                            name="email" placeholder="example@mail.com" readonly
                            value="@if (old('email')) {{ old('email') }} @else{{ $patient->email }} @endif">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="phone_number" class="form-label">Phone number</label>
                        <input type="text"
                            class="form-control @error('phone_number') is-invalid @enderror patient_entities"
                            id="phone_number" name="phone_number" placeholder="11 digit number" readonly
                            value="@if (old('phone_number')) {{ old('phone_number') }}@else{{ $patient->phone_number }} @endif">
                        @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="street" class="form-label">Address</label>
                        <input type="text"
                            class="form-control @error('street') is-invalid @enderror patient_entities"
                            id="street" name="street" placeholder="Barangay, Street" readonly
                            value="@if (old('street')) {{ old('street') }}@else{{ $address->street }} @endif">
                        @error('street')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="city" class="form-label">City/Municipality</label>
                        <input type="text"
                            class="form-control @error('city') is-invalid @enderror patient_entities" id="city"
                            name="city" placeholder="Tacloban City" readonly
                            value="@if (old('city')) {{ old('city') }}@else{{ $address->city }} @endif">
                        @error('city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="province" class="form-label">Province</label>
                        <input type="text"
                            class="form-control @error('province') is-invalid @enderror patient_entities"
                            id="province" name="province" placeholder="Leyte" readonly
                            value="@if (old('province')) {{ old('province') }}@else{{ $address->province }} @endif">
                        @error('province')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <label for="zip_code" class="form-label">Zip code</label>
                        <input type="text"
                            class="form-control @error('zip_code') is-invalid @enderror patient_entities"
                            id="zip_code" name="zip_code" placeholder="6500" readonly
                            value="@if (old('zip_code')) {{ old('zip_code') }}@else{{ $address->zip_code }} @endif">
                        @error('zip_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </section>
            </form>
        </div>
        <div class="col-md-3 px-3 vital-signs">
            <div class="container bg-white rounded-4 p-2 shadow">
                <div class="d-flex align-items-center gap-5">
                    <h2 class="fs-5 fw-semibold mb-1 p-2">Vital Signs</h2>
                    <div class="form-check form-switch">
                        <input class="form-check-input edit-vitals" type="checkbox" role="switch"
                            id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Edit</label>
                    </div>
                </div>
                {{-- <a href="#diagnosis">Diagnosis</a> --}}

                <form action="{{ route('patient.vitals.update', ['patient' => $patient->id]) }}" method="POST"
                    id="vital_signs_form">
                    @csrf
                    <div class="container p-1">
                        <ul class="list-group">
                            <li class="list-group m-auto mb-2 pb-1">
                                <div class="d-flex align-items-center px-2 gap-1">
                                    <img src="{{ asset('images/blood.png') }}" alt="img" width="25">
                                    <div class="d-flex gap-2">
                                        <span class="fs-6 text-start" style="width: 65% !important;">Blood
                                            pressure:</span>
                                        <input type="text" name="blood_pressure" id=""
                                            class="border-0 bg-transparent w-50 vital-input" readonly
                                            value="@if ($vital_signs) {{ $vital_signs->blood_pressure }} @endif">
                                    </div>
                                </div>
                            </li>
                            <li class="list-group m-auto mb-2 pb-1">
                                <div class="d-flex align-items-center px-2 gap-1">
                                    <img src="{{ asset('images/lungs.png') }}" alt="img" width="25">
                                    <div class="d-flex gap-2">
                                        <span class="fs-6 text-start" style="width: 65% !important;">Respiratory rate:
                                        </span>
                                        <input type="text" name="respiratory_rate" id=""
                                            class="border-0 bg-transparent w-50 vital-input" readonly
                                            value="@if ($vital_signs) {{ $vital_signs->respiratory_rate }} @endif">
                                    </div>
                                </div>
                            </li>
                            <li class="list-group m-auto mb-2 pb-1">
                                <div class="d-flex align-items-center px-2 gap-2">
                                    <img src="{{ asset('images/capillaries.png') }}" alt="img" width="20">
                                    <div class="d-flex gap-2">
                                        <span class="fs-6 text-start w-50">Capillary Refill:</span>
                                        <input type="text" name="capillary_refill" id=""
                                            class="border-0 bg-transparent w-50 vital-input" readonly
                                            value="@if ($vital_signs) {{ $vital_signs->capillary_refill }} @endif">
                                    </div>
                                </div>
                            </li>
                            <li class="list-group m-auto mb-2 pb-1">
                                <div class="d-flex align-items-center px-2 gap-1">
                                    <img src="{{ asset('images/thermometer.png') }}" alt="img" width="25">
                                    <div class="d-flex gap-2">
                                        <span class="fs-6 text-start">Temperature:</span>
                                        <input type="text" name="temperature" id=""
                                            class="border-0 bg-transparent w-50 vital-input" readonly
                                            value="@if ($vital_signs) {{ $vital_signs->temperature }} @endif">
                                    </div>
                                </div>
                            </li>
                            <li class="list-group m-auto mb-2 pb-1">
                                <div class="d-flex align-items-center px-2 gap-2">
                                    <img src="{{ asset('images/pulse.png') }}" alt="img" width="25">
                                    <div class="d-flex gap-2">
                                        <span class="fs-6 text-start">Pulse rate:</span>
                                        <input type="text" name="pulse_rate" id=""
                                            class="border-0 bg-transparent w-50 vital-input" readonly
                                            value="@if ($vital_signs) {{ $vital_signs->pulse_rate }} @endif">
                                    </div>
                                </div>
                            </li>
                            <li class="list-group m-auto mb-2 pb-1">
                                <div class="d-flex align-items-center px-2 gap-2">
                                    <img src="{{ asset('images/weight-scale.png') }}" alt="img" width="25">
                                    <div class="d-flex gap-2">
                                        <span class="fs-6 text-start">Weight:</span>
                                        <input type="text" name="weight" id=""
                                            class="border-0 bg-transparent w-50 vital-input" readonly
                                            value="@if ($vital_signs) {{ $vital_signs->weight }} @endif">
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <div class="row px-3 mt-3 save-changes d-none">
                            <button type="submit" form="vital_signs_form"
                                class="btn bg-my-primary text-white dark rounded-5">
                                Save changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="container p-3 mt-3">
                <ul class="list-group">
                    @foreach ($errors->all() as $error)
                        <li class="danger list-group fw-5">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="row mb-3 p-4" style="--bs-gutter-x: 0rem !important;">
        <div class="bg-white rounded-4 col shadow p-5">
            <h2 class="fw-semibold mb-4 mt-2">Medical Records</h2>
            <livewire:diagnosis-table patient="{{ $patient->id }}" />
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(document).on('change', '.edit-vitals', function() {
                if (this.checked) {
                    $('.vital-input').attr('readonly', false);
                    $('.save-changes').removeClass('d-none');
                } else {
                    $('.vital-input').attr('readonly', true);
                    $('.save-changes').addClass('d-none');
                }
            });

            $(document).on('click', '.edit-patient', function() {
                $('#birthdate').toggleClass('datepicker');
                $('.datepicker').datepicker({
                    uiLibrary: 'bootstrap5',
                })

                $('.patient_entities').attr('readonly', false);
                $('.patient_entities').attr('disabled', false);

                $('.action').toggleClass('d-none');
                $('.final-action').toggleClass('d-none');
            });

            $(document).on('click', '.cancel-edit', function() {
                location.reload();
            });

            $('.date-issue').datepicker({
                uiLibrary: 'bootstrap5',
                modal: true,
                footer: true,
            })
        });
    </script>

    {{-- <div class="row pt-3" style="--bs-gutter-x: 0rem !important;">
        <div class="bg-white rounded-4 col ms-4" id="diagnosis">
            <form class="position-relative p-5" method="POST" action="{{ route('patient.store') }}">
                @csrf
                <section class="row grid-3 mb-4">
                    <div class="d-flex mb-3 justify-content-between align-items-center">
                        <h2 class="fw-semibold">Diagnosis</h2>
                        <div class="d-flex gap-3 action">
                            <button type="button" class="btn d-flex align-items-center p-0 gap-2">
                                <span class="material-icons-sharp fs-5 primary">
                                    edit
                                </span>
                                <span class="primary">Edit patient</span>
                            </button>
                            <button type="button" class=" btn d-flex align-items-center p-0 gap-2">
                                <span class="material-icons-sharp fs-5 danger">
                                    delete
                                </span>
                                <span class="danger">Remove patient</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="first_name" class="form-label">First name</label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                            id="first_name" name="first_name" placeholder="Juan" value="{{ old('first_name') }}">
                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="middle_name" class="form-label">Middle name</label>
                        <input type="text" class="form-control @error('middle_name') is-invalid @enderror"
                            id="middle_name" name="middle_name" placeholder="Deguzman"
                            value="{{ old('middle_name') }}">
                        @error('middle_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="last_name" class="form-label">Last name</label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                            id="last_name" name="last_name" placeholder="Dela Cruz" value="{{ old('last_name') }}">
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
                            <option value="Married" @if (old('civil_status') == 'Married') selected @endif>Married
                            </option>
                            <option value="Separated" @if (old('civil_status') == 'Separated') selected @endif>Separated
                            </option>
                            <option value="Divorced" @if (old('civil_status') == 'Divorced') selected @endif>Divorced
                            </option>
                            <option value="Widowed" @if (old('civil_status') == 'Widowed') selected @endif>Widowed
                            </option>
                        </select>
                        @error('civil_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select name="gender" id="gender"
                            class="form-select @error('gender') is-invalid @enderror">
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
                        <input type="date" class="form-control @error('birthdate') is-invalid @enderror"
                            id="birthdate" name="birthdate" value="{{ old('birthdate') }}">
                        @error('birthdate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="birthdate" class="form-label">Birthplace</label>
                        <input type="text" class="form-control @error('birthplace') is-invalid @enderror"
                            id="birthdate" name="birthplace"
                            placeholder="Barangay, Street, City/Municipality, Province"
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
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" name="email" placeholder="example@mail.com"
                            value="{{ old('email') }}">
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
                        <input type="text" class="form-control @error('street') is-invalid @enderror"
                            id="street" name="street" placeholder="Barangay, Street"
                            value="{{ old('street') }}">
                        @error('street')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="city" class="form-label">City/Municipality</label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror"
                            id="city" name="city" placeholder="Tacloban City" value="{{ old('city') }}">
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
            </form>
        </div>
    </div> --}}
</x-layout>
