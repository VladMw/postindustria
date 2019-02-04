@extends("layouts.layout")
@section("header")
@section("body")
	<div class="section">
            	<?php echo view('pagination/companies', ['data' => $companies]); ?>
	</div>
        <div class="modal add-company">
            <button class="modal-hide" onclick="modalHide()"></button>
            <div class="modal-body">
                <h3>Add Company</h3>
                <form class="modal-form" id="add-company" >
                    {{ csrf_field() }}
                    <input type="text" name="name" value="" placeholder="Apple">
                    <input type="text" name="quota" value="" placeholder="Bytes">
                    <input type="submit" name="" value="Add company">
                </form>
            </div>
	</div>
        <div class="modal add-user">
            <button class="modal-hide" onclick="modalHide()"></button>
            <div class="modal-body">
                <h3>Add User</h3>
                <form class="modal-form" id="add-user" >
                    {{ csrf_field() }}
                    <input type="text" name="name" value="" placeholder="Fedor">
                    <input type="text" name="email" value="" placeholder="example@gmail.com">
                    <select name="company">
                        <?php   if($companies):
                                    foreach ($companies as $company): ?>
                                        <option><?= $company->name ?></option>
                        <?php   endforeach;
                                endif; ?>
                    </select>
                    <input type="submit" name="" value="Add company">
                </form>
            </div>
	</div>
        <div class="modal edit-modal">
            <button class="modal-hide" onclick="modalEditHide()"></button>
            <div class="modal-body" id="edit-modal-body">
            </div>
	</div>
@endsection
@section("footer")