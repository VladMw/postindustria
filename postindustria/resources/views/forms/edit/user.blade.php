<form id="edit-form" name="edit-company" onsubmit="EditUser(this); return false;">
    <p>Edit user, <?= $data->name ?></p>
    <input name="name" value="<?= $data->name ?>">
    <input type="email" name="email" value="<?= $data->email ?>">
    <input type="hidden" name="old" value="<?= $data->email ?>">
    <input name="company" value="<?= array_first($data->company()->pluck('name')->toArray()) ?>">
    <input type="submit" value="Save">
</form>