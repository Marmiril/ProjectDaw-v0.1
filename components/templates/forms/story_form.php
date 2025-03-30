<?php
if (!defined('ALLOW_ACCESS')) {
    die('Acceso no permitido');
}
?>

<form id="createStoryForm" style="display: none;">
    <input type="hidden" name="user_id" value="<?php echo getCurrentUserId(); ?>">
    <div class="form-group">
        <label for="story-title">Título: </label>
        <input type="text" id="story-title" name="story-title" required>
    </div>

    <div class="form-group">
        <label for="story-theme">Tema: </label>
        <select id="story-theme" name="story-theme" required>
            (option value)*7
            




    <div class="form-group">
        <label for="guide-word">Palabra guía: </label>
        <input type="text" id="guide-word" name="guide-word">
    </div>
</form>