<!-- File: templates/Domains/add.php -->

<h1>Add Domain</h1>
<?php
    echo $this->Form->create($domain);
    echo $this->Form->control('url');
    echo $this->Form->control('notes', ['rows' => '2']);
    echo $this->Form->control('active');
    echo $this->Form->button(__('Save Domain'));
    echo $this->Form->end();
?>