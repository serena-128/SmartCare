@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Dietary Restriction
        </h1>
    </section>
    <div class="content">
        @include('basic-template::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    <!-- The form using plain HTML and @csrf -->
                    <form action="{{ route('dietaryrestrictions.store') }}" method="POST">
                        @csrf

                        <!-- Resident Dropdown -->
                        <div class="form-group">
                            <label for="resident_id">Resident</label>
                            <select name="resident_id" id="resident_id" class="form-control" required>
                                <option value="">Select Resident</option>
                                @foreach($residents as $resident)
                                    <option value="{{ $resident->id }}">{{ $resident->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dietary Restrictions -->
                        <div class="form-group">
                            <label for="food_restrictions">Dietary Restrictions</label>
                            <input type="text" name="food_restrictions" class="form-control" placeholder="Enter dietary restrictions (e.g., Gluten-free)">
                        </div>

                        <!-- Food Preferences -->
                        <div class="form-group">
                            <label for="food_preferences">Food Preferences</label>
                            <input type="text" name="food_preferences" class="form-control" placeholder="Enter food preferences (e.g., Vegetarian)">
                        </div>

                        <!-- Allergies -->
                        <div class="form-group">
                            <label for="allergies">Allergies</label>
                            <select name="allergies" id="allergies" class="form-control">
                                <option value="">Select Allergy (Optional)</option>
                                <option value="Nuts">Nuts</option>
                                <option value="Shellfish">Shellfish</option>
                                <option value="Dairy">Dairy</option>
                                <option value="Eggs">Eggs</option>
                                <option value="Gluten">Gluten</option>
                                <option value="Soy">Soy</option>
                                <option value="Wheat">Wheat</option>
                            </select>

                            <!-- Or Custom Allergy -->
                            <div class="form-group mt-2" id="custom_allergy_div" style="display:none;">
                                <label for="custom_allergy">Custom Allergy (if not listed)</label>
                                <input type="text" name="custom_allergy" class="form-control" placeholder="Enter custom allergy">
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="form-group">
                            <label for="notes">Additional Notes</label>
                            <textarea name="notes" class="form-control"></textarea>
                        </div>

                        <!-- Last Updated By (Staff) -->
                        <div class="form-group">
                            <label for="last_updated_by">Last Updated By</label>
                            <select name="last_updated_by" id="last_updated_by" class="form-control" required>
                                <option value="">Select Staff Member</option>
                                @foreach($staffMembers as $staff)
                                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    // Show custom allergy field if "Custom Allergy" is selected
    document.getElementById('allergies').addEventListener('change', function () {
        var customAllergyField = document.getElementById('custom_allergy_div');
        if (this.value === "") {
            customAllergyField.style.display = 'block'; // Show the custom allergy input
        } else {
            customAllergyField.style.display = 'none'; // Hide the custom allergy input
        }
    });
</script>

