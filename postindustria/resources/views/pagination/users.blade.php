<?php if($data): ?>
    <h1>Users</h1>
    <a class="user-dialog" onclick="modalShow('add-user')">Add user</a>
		<div class="section-data">
                    <table>
                        <thead>
                            <tr>
                                <td>User</td>
                                <td>Email</td>
                                <td>Company</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $user): ?>
                                <tr>
                                    <td><?= $user->name ?></td>
                                    <td><?= $user->email ?></td>
                                    <td><?= array_first($user->company()->pluck('name')->toArray()) ?></td>
                                    <td>
                                        <button class="btn-delete del-user" onclick="DeleteUser(this)" data-id="<?= $user->id ?>" >delete user</button>
                                        <button class="btn-edit edit-user" onclick="ShowUser(this)" data-id="<?= $user->id ?>">edit user</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
		</div>
<?php endif; ?>
