<!-- File: templates/Domain/index.php -->
<?= $this->Html->link('Add Domain', ['action' => 'add']) ?>
<h1>Domains</h1>
<table>
    <tr>
        <th>Url</th>
        <th>Notes</th>
        <th>Active</th>
        <th>Last Update Attempt</th>
        <th>Last Successful Update</th>
        <th>Created</th>
        <th>Modified</th>
    </tr>

    <!-- Here is where we iterate through our $articles query object, printing out article info -->

    <?php foreach ($query as $domain): ?>
    <tr>
        <td>
            <?= $domain->url ?>
        </td>
        <td>
            <?= $domain->notes ?>
        </td>
        <td>
            <?= $domain->active ?>
        </td>
        <td>
            <?= $domain->last_update_attempt ?>
        </td>
        <td>
            <?= $domain->last_successful_update ?>
        </td>
        <td>
            <?= $domain->created ?>
        </td>
        <td>
            <?= $domain->modified ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>