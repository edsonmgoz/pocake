<div class="row">
    <div class="col-md-6 col-md-offset-3">
    	<div class="page-header">
    		<h2>Editar enlace</h2>
    	</div>
        <?= $this->Form->create($bookmark, ['novalidate']) ?>
        <fieldset>
            <?= $this->element('bookmarks/fields') ?>
        </fieldset>
        <?= $this->Form->button('Editar') ?>
        <?= $this->Form->end() ?>
    </div>
</div>