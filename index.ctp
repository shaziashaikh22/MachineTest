<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee[]|\Cake\Collection\CollectionInterface $employees
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Employee'), ['action' => 'add']) ?></li>
    </ul>
</nav>


<div class="employees index large-9 medium-8 columns content">
    <h3><?= __('Employees') ?></h3>
    <div>
            <input name="search" id="search" type="text" class="form-control" placeholder="Search By id ...">

                        <div>
<!--<select name="search" class="form-control small" id="search">
  <option selected="selected">Select Name </option>
  <?php
    foreach($employees as $employee) { ?>
      <option value="<?= $employee['id'] ?>"><?= $employee['employee_name'] ?></option>
  <?php
    } ?>
</select>-->
                        </div></div>
    <table cellpadding="0" cellspacing="0" class="table-responsive-lg">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('employee_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_of_birth') ?></th>
                <th scope="col"><?= $this->Paginator->sort('employee_image') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $employee): ?>
            <tr>
                <td><?= $this->Number->format($employee->id) ?></td>
                <td><?= h($employee->employee_name) ?></td>
                <td><?= h($employee->address) ?></td>
                <td><?= h($employee->email) ?></td>
                <td><?= $this->Number->format($employee->phone) ?></td>
                <td><?= h($employee->date_of_birth) ?></td>
                <td><?= h($employee->employee_image) ?></td>
                <td><?= h($employee->created) ?></td>
                <td><?= h($employee->modified) ?></td>
                <td><?= h($employee->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $employee->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $employee->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $employee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employee->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
<script>
$('document').ready(function(){
    $('#search').keyup(function() {
        var searchkey=$(this).val();
        searchTags(searchkey );
    });
    function searchTags(keyword){
        var data= keyword;
        $.ajax({
            method:'get',
            url:"Employees/search",
            data:{keyword:data},
                 success:function(response){
                     $('.table-responsive-lg').html(response);
                 }
                                    
        });
    };
});

</script>

