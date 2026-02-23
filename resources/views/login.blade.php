<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

@if(session('error'))
    <p style="color:red;">{{ session('error') }}</p>
@endif

<form action="/login" method="POST">
    @csrf
    
    <input type="text" name="name" placeholder="Nama">
    
    <select name="role">
        <option value="sales">Sales</option>
        <option value="admin">Admin</option>
        <option value="gudang">Gudang</option>
    </select>
    
    <input type="password" name="password" placeholder="Password">
    
    <button type="submit">Login</button>
</form>

</body>
</html>