<form method="POST" action="{{ route('nextofkin.login') }}">
    @csrf
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" required>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" required>
    </div>
    <button type="submit">Login</button>
</form>