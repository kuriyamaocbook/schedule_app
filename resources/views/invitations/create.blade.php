<!-- resources/views/invitations/create.blade.php -->

<form action="{{ route('invitations.store') }}" method="POST">
    @csrf
    <label for="user_e_maile">ユーザーID:</label>
    <input type="text" name="user_e_maile" id="user_e_maile">
    <button type="submit">招待する</button>
</form>
