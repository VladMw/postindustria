<table class="abusers-list">
                <thead>
                    <tr>
                        <td>User</td>
                        <td>Email</td>
                        <td>Used</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $user): ?>
                        <tr>
                            <td>
                                <?= $user['name'] ?>
                            </td>
                            <td>
                                <?= $user['email'] ?> Gb
                            </td>
                            <td>
                                <?= round($user['used']/1024/1024, 2, PHP_ROUND_HALF_UP) ?> GB
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
    </table>

