<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2>Cartas Normales</h2>
<?php if ($chars): ?>

<p class="toggler"><a href="javascript:toggleSearchForm()">Buscar...</a></p>
<form action="<?php echo $this->url ?>" method="get" class="search-form">
	<?php echo $this->moduleActionFormInputs($params->get('module'), $params->get('action')) ?>
	<p>
        <label for="card_name">Buscar por carta:</label>
		<input type="text" name="card_name" id="card_name" value="<?=htmlspecialchars($params->get('card_name'))?>"/>
		<input type="submit" value="Buscar" />
		<input type="button" value="Reset" onclick="reload()" />
	</p>
</form>

<?php echo $paginator->infoText() ?>

	<table class="horizontal-table">
		<tr>
			<th><?php echo $paginator->sortableColumn('drop_date', 'Fecha') ?></th>
			<th>Personaje</th>
			<th>Monster</th>
			<th>Carta</th>
			<th>Mapa</th>
			
		</tr>
		<?php $i=0; foreach ($chars as $char): $i++;?>
		<tr style="text-align: center;">
			<td><?=htmlspecialchars($char->drop_date)?></td>
			<td><?=htmlspecialchars($char->char_name)?></td>
			<td><?=htmlspecialchars($char->monster_name)?></td>
			<td><?=htmlspecialchars($char->card_name)?></td>
			<td><?=htmlspecialchars($char->drop_map)?></td>
		</tr>
		<?php endforeach ?>
	</table>
	<?php echo $paginator->getHTML() ?>
<?php else: ?>
	<p>No se encontró ninguna carta normal en <?php echo htmlspecialchars($server->serverName) ?>. <a href="javascript:history.go(-1)"><img src="./addons/bgstats/images/skill/al_warp.png"> Volver</a>.</p>
<?php endif ?>