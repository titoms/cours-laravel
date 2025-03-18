<form method="POST" action="{{ route('register.submit') }}" enctype="multipart/form-data">
    @csrf
    <input type="text" name="username" placeholder="Username">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <textarea name="bio" id="bio"></textarea>
    <input type="file" name="profile_picture" accept="image/*">

    <button type="submit">Register</button>
</form>