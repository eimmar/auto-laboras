<?php
require('header.php');
use Utils\Routing;
?>
<ul id="pagePath">
  <li><a href="<?php echo Routing::getURL(); ?>">Pradžia</a></li>
	<li>Automobilių markės</li>
</ul>
<div id="actions">
	<a href='<?php echo Routing::getURL($module, 'create'); ?>'>Nauja markė</a>
</div>
<div class="float-clear"></div>

<?php if(!empty($delete_error)) { ?>
	<div class="errorBox">
		Markė nebuvo pašalinta. Pirmiausia pašalinkite markės modelius.
	</div>
<?php } ?>

<?php if(!empty($id_error)) { ?>
  <div class="errorBox">
    Markė nerasta!
  </div>
<?php } ?>

<table>
	<tr>
		<th>ID</th>
		<th>Pavadinimas</th>
		<th></th>
	</tr>
	<?php
		// suformuojame lentelę
		foreach($data as $key => $val) {
			echo
				"<tr>"
					. "<td>{$val['id']}</td>"
					. "<td>{$val['pavadinimas']}</td>"
					. "<td>"
						. "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['id']}\"); return false;' title=''>šalinti</a>&nbsp;"
						. "<a href='" . Routing::getURL($module, 'edit', 'id=' . $val['id']), "' title=''>redaguoti</a>"
					. "</td>"
				. "</tr>\n";
		}
	?>
</table>

<?php
require('paging.php');
require('footer.php');

