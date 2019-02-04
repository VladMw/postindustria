<form id="edit-form" name="edit-company" onsubmit="EditCompany(this); return false;">
    <p>Edit company, <?= $data->name ?></p>
    <input name="name" value="<?= $data->name ?>">
    <input type="hidden" name="old" value="<?= $data->name ?>">
    <input name="quota" value="<?= $data->quota ?>">
    <input type="submit" value="Save">
</form>
