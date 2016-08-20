<div class="row">
    <div class="col-md-12">
    	<div class="page-header">
    		<h2>
    			Mi lista
    			<?= $this->Html->link('<span class="glyphicon glyphicon-plus"></span> Nuevo', ['controller' => 'Bookmarks', 'action' => 'add'], ['class' => 'btn btn-primary pull-right', 'escape' => false]); ?>
    		</h2>
    	</div>
		<ul class="list-group">
			<?php foreach ($bookmarks as $bookmark): ?>
			<li class="list-group-item">
				<h4 class="list-group-item-heading"><?= h($bookmark->title) ?></h4>
				<p>
					<strong class="text-info">
						<small>
							<?= $this->Html->link($bookmark->url, null, ['target' => '_blank']) ?>
						</small>
					</strong>
				</p>
				<p class="list-group-item-text">
					<?= h($bookmark->description) ?>
				</p>
			</li>
			<?php endforeach ?>
		</ul>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('< Anterior') ?>
                <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
                <?= $this->Paginator->next('Siguiente >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
    </div>
</div>
