    <h1>Companies violators</h1>
    <button onclick="fakeGenerator(this)" data-id="company">Generate 10 fake company</button>
    <button onclick="fakeGenerator(this)" data-id="user">Generate 50 fake users</button>
    <button onclick="fakeGenerator(this)" data-id="transfer">Generate 500 fake transfered</button>
    <div class="section-data">
        <table>
            <thead>
                <tr>
                    <td>Company</td>
                    <td>Limit</td>
                    <td>Used</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $company): ?>
                    <tr>
                        <td>
                            <?= $company['name'] ?>
                        </td>
                        <td>
                            <?= round($company['limit']/1024/1024, 2, PHP_ROUND_HALF_UP) ?> GB
                        </td>
                        <td>
                            <?= round($company['used']/1024/1024, 2, PHP_ROUND_HALF_UP) ?> GB
                        </td>
                        <td>
                            <button onclick="ViewAbusers(this)" data-id="<?= $company['name'] ?>">View abusers</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>