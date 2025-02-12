<li class="nav-item">
    <a href="{{ route('residents.index') }}"
       class="nav-link {{ Request::is('residents*') ? 'active' : '' }}">
        <p>Residents</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('roles.index') }}"
       class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
        <p>Roles</p>
    </a>
</li>


