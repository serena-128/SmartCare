<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartCare - Nursing Home Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        .container {
            margin-top: 40px;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>SmartCare - Nursing Home Management</h1>
            <p>Efficiently manage residents, staff, and health records</p>
        </div>

        <div class="row mt-4">
            <!-- Residents -->
            <div class="col-md-4">
                <a href="{{ route('residents.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h3>🏡 Residents</h3>
                            <p>Manage resident information</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Diagnoses -->
            <div class="col-md-4">
                <a href="{{ route('diagnoses.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h3>📋 Diagnoses</h3>
                            <p>View medical diagnoses</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Emergency Alerts -->
            <div class="col-md-4">
                <a href="{{ route('emergencyalerts.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h3>🚨 Emergency Alerts</h3>
                            <p>Monitor and resolve alerts</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Standard Tasks -->
            <div class="col-md-4">
                <a href="{{ route('standardtasks.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h3>✅ Standard Tasks</h3>
                            <p>Manage daily tasks</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Care Plans -->
            <div class="col-md-4">
                <a href="{{ route('careplans.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h3>📝 Care Plans</h3>
                            <p>Personalized resident care</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Doses -->
            <div class="col-md-4">
                <a href="{{ route('doses.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h3>💊 Medication Doses</h3>
                            <p>Track medication schedules</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Appointments -->
            <div class="col-md-4">
                <a href="{{ route('appointments.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h3>📅 Appointments</h3>
                            <p>Manage medical appointments</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Next of Kin -->
            <div class="col-md-4">
                <a href="{{ route('nextofkins.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h3>👨‍👩‍👦 Next of Kin</h3>
                            <p>Emergency contact details</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Staff Members -->
            <div class="col-md-4">
                <a href="{{ route('staffmembers.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h3>👨‍⚕️ Staff Members</h3>
                            <p>Manage staff information</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Roles -->
            <div class="col-md-4">
                <a href="{{ route('roles.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h3>🔧 Roles</h3>
                            <p>Assign roles to staff</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Dietary Restrictions -->
            <div class="col-md-4">
                <a href="{{ route('dietaryrestrictions.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h3>🥗 Dietary Restrictions</h3>
                            <p>Manage special diets</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Staff Tasks -->
            <div class="col-md-4">
                <a href="{{ route('stafftasks.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h3>🛠 Staff Tasks</h3>
                            <p>Assign staff responsibilities</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
