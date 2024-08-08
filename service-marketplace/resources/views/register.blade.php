<form method="POST" action="{{ route('register') }}">
    @csrf
    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <input type="password" name="password_confirmation" placeholder="Confirm Password">
    
    <select name="role" required>
        <option value="user">User</option>
        <option value="vendor">Vendor</option>
    </select>

    {!! NoCaptcha::display() !!
    <button type="submit">Register</button>
</form>
```

