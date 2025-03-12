<!DOCTYPE html>
<html>
<head>
    <title>Complete Your Profile</title>
    <!-- Include your CSS and other head elements -->
</head>
<body>
    <div class="container">
        <h2>Complete Your Profile</h2>
        <form action="{{ route('nextofkin.complete-profile.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="contactnumber">Contact Number</label>
                <input type="text" name="contactnumber" id="contactnumber" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="relationshiptoresident">Relationship to Resident</label>
                <input type="text" name="relationshiptoresident" id="relationshiptoresident" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
