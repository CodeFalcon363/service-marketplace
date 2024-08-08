<!-- Profile Creation Form -->
<form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
    @csrf
    
    <!-- Common Fields -->
    <div>
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" required>
    </div>

    <!-- Vendor-Specific Fields -->
    @if(auth()->user()->role == 'vendor')
        <div>
            <label for="business_name">Business Name:</label>
            <input type="text" name="business_name" id="business_name" required>
        </div>

        <div>
            <label for="business_location">Business Location:</label>
            <input type="text" name="business_location" id="business_location" required>
        </div>

        <div>
            <label for="registration_type">Registration Type:</label>
            <select name="registration_type" id="registration_type" required>
                <option value="Business Name">Business Name</option>
                <option value="SMEDAN">SMEDAN</option>
                <option value="Limited Company">Limited Company</option>
                <option value="Unregistered">Unregistered</option>
            </select>
        </div>

        <div id="registration_certificate_div" style="display: none;">
            <label for="registration_certificate">Registration Certificate:</label>
            <input type="file" name="registration_certificate" id="registration_certificate" accept=".jpg,.png,.pdf">
        </div>
    @endif

    <button type="submit">Create Profile</button>
</form>

<script>
    // Show/Hide the registration certificate field based on the registration type
    document.getElementById('registration_type').addEventListener('change', function () {
        var certificateDiv = document.getElementById('registration_certificate_div');
        if (this.value === 'Business Name' || this.value === 'SMEDAN' || this.value === 'Limited Company') {
            certificateDiv.style.display = 'block';
        } else {
            certificateDiv.style.display = 'none';
        }
    });
</script>