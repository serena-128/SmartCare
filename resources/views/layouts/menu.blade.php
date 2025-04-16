<li class="nav-item">
    <a href="{{ route('residents.index') }}"
       class="nav-link {{ Request::is('residents*') ? 'active' : '' }}">
        <p>Residents</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('diagnoses.index') }}"
       class="nav-link {{ Request::is('diagnoses*') ? 'active' : '' }}">
        <p>Diagnoses</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('emergencyalerts.index') }}"
       class="nav-link {{ Request::is('emergencyalerts*') ? 'active' : '' }}">
        <p>Emergency Alerts</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('standardtasks.index') }}"
       class="nav-link {{ Request::is('standardtasks*') ? 'active' : '' }}">
        <p>Standard Tasks</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('careplans.index') }}"
       class="nav-link {{ Request::is('careplans*') ? 'active' : '' }}">
        <p>Care Plans</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('doses.index') }}"
       class="nav-link {{ Request::is('doses*') ? 'active' : '' }}">
        <p>Doses</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('appointments.index') }}"
       class="nav-link {{ Request::is('appointments*') ? 'active' : '' }}">
        <p>Appointments</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('nextofkins.index') }}"
       class="nav-link {{ Request::is('nextofkins*') ? 'active' : '' }}">
        <p>Next of Kins</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('staffmembers.index') }}"
       class="nav-link {{ Request::is('staffmembers*') ? 'active' : '' }}">
        <p>Staff Members</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('roles.index') }}"
       class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
        <p>Roles</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('dietaryrestrictions.index') }}"
       class="nav-link {{ Request::is('dietaryrestrictions*') ? 'active' : '' }}">
        <p>Dietary Restrictions</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('stafftasks.index') }}"
       class="nav-link {{ Request::is('stafftasks*') ? 'active' : '' }}">
        <p>Staff Tasks</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('medicationReminders.index') }}"
       class="nav-link {{ Request::is('medicationReminders*') ? 'active' : '' }}">
        <p>Medication Reminders</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('schedules.index') }}"
       class="nav-link {{ Request::is('schedules*') ? 'active' : '' }}">
        <p>Schedules</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('diagnosistypes.index') }}"
       class="nav-link {{ Request::is('diagnosistypes*') ? 'active' : '' }}">
        <p>Diagnosistypes</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('staffProfiles.index') }}"
       class="nav-link {{ Request::is('staffProfiles*') ? 'active' : '' }}">
        <p>Staff Profiles</p>
    </a>
</li>


