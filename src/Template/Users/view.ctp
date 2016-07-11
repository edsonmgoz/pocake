<div class="well">
<h2><?= $user->first_name . ' ' . $user->last_name ?></h2>
    <br>
    <dl>
        <dt>Nombre</dt>
        <dd>
            <?= $user->first_name ?>
            &nbsp;
        </dd>
        <br>

        <dt>Apellidos</dt>
        <dd>
            <?= $user->last_name ?>
            &nbsp;
        </dd>
        <br>

        <dt>Correo electrónico</dt>
        <dd>
            <?= $user->email ?>
            &nbsp;
        </dd>
        <br>

        <dt>Habilitado</dt>
        <dd>
            <?= $user->active ? 'SI' : 'NO' ?>
            &nbsp;
        </dd>
        <br>

        <dt>Creado</dt>
        <dd>
            <?= $user->created->nice() ?>
            &nbsp;
        </dd>
        <br>

        <dt>Modificado</dt>
        <dd>
            <?= $user->modified->nice() ?>
            &nbsp;
        </dd>
    </dl>
</div>