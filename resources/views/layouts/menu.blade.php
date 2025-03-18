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
        <p>Emergencyalerts</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('standardtasks.index') }}"
       class="nav-link {{ Request::is('standardtasks*') ? 'active' : '' }}">
        <p>Standardtasks</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('careplans.index') }}"
       class="nav-link {{ Request::is('careplans*') ? 'active' : '' }}">
        <p>Careplans</p>
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
        <p>Nextofkins</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('roles.index') }}"
       class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
        <p>Roles</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('staffMembers.index') }}"
       class="nav-link {{ Request::is('staffMembers*') ? 'active' : '' }}">
        <p>Staff Members</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('dietaryrestrictions.index') }}"
       class="nav-link {{ Request::is('dietaryrestrictions*') ? 'active' : '' }}">
        <p>Dietaryrestrictions</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('stafftasks.index') }}"
       class="nav-link {{ Request::is('stafftasks*') ? 'active' : '' }}">
        <p>Stafftasks</p>
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
