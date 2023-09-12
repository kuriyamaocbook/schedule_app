<form action="{{ route('groups.store') }}" method="POST">
    @csrf
    <label for="name">グループ名:</label>
    <input type="text" name="name" id="name" required>
    
    
    
    <!-- 招待対象のメールアドレス -->
    <label for="invitee_email">招待したい人物のメールアドレス:</label>
    <input type="email" name="invitee_email" id="invitee_email" required>
    
    <!-- 他のフォームフィールドを追加 -->
    
    <button type="submit">グループを作成</button>
</form>
