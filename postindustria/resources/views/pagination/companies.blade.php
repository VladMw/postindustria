<?php if($data): ?>
    <h1>Companies</h1>
    <a class="user-dialog" onclick="modalShow('add-company')">Add company</a>
    <div class="section-data">
        <table>
            <thead>
                <tr>
                    <td>Company</td>
                    <td>Quota</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $company): ?>
                    <tr>
                        <td>
                            <?= $company->name ?>
                        </td>
                        <td>
                            <?= round($company->quota/1024/1024, 2, PHP_ROUND_HALF_UP) ?> GB
                        </td>
                        <td>
                            <button class="btn-delete del-company" onclick="DeleteCompany(this)" data-name="<?= $company->name ?>">del company</button>
                            <button class="btn-edit edit-company" onclick="ShowCompany(this)" data-name="<?= $company->name ?>">edit company</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
