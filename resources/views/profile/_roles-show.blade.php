<div class="row">
    <div class="col-sm-2">
        <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" id="admin" value="ADMIN" {{ $profile->hasRole('ADMIN') == 'ADMIN' ? ' checked' : '' }}>
            Admin
        </label>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" id="pm" value="PM" {{ $profile->hasRole('PM') == 'PM' ? ' checked' : '' }}>
            Project Manager
        </label>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" id="qa" value="QA" {{ $profile->hasRole('QA') == 'QA' ? ' checked' : '' }}>
            Quality Assurance
        </label>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" id="dev" value="DEV" {{ $profile->hasRole('DEV') == 'DEV' ? ' checked' : '' }}>
            Developer
        </label>
        </div>
    </div>

</div>
