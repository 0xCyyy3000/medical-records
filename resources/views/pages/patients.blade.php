<x-layout :title='$title'>
    <div class="container">
        @if (Session::has('success'))
            <div class="alert alert-my-success alert-dismissible fade show" role="alert">
                Patient has been added successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(Session::has('error'))
            <div class="alert alert-my-danger alert-dismissible fade show" role="alert">
                There was an error adding the patient, please try to contact the administrator.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @livewire('patient-table')
    </div>
</x-layout>
