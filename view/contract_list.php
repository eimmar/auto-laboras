<?php
require('header.php');
use Utils\Routing;
?>

<ul id="pagePath">
	<li><a href="<?php echo Routing::getURL(); ?>">Pradžia</a></li>
	<li>Sutartys</li>
</ul>
<div id="actions">
  <a href="<?php echo Routing::getURL('report', 'view', 'id=1'); ?>" target="_blank">Sutarčių ataskaita</a>
	<a href='<?php echo Routing::getURL($module, 'create'); ?>'>Nauja sutartis</a>
</div>
<div class="float-clear"></div>

<?php if(!empty($id_error)) { ?>
  <div class="errorBox">
    Kontraktas nerastas!
  </div>
<?php } ?>

<table>
	<tr>
		<th>Nr.</th>
		<th>Data</th>
		<th>Darbuotojas</th>
		<th>Nuomininkas</th>
		<th>Būsena</th>
		<th></th>
	</tr>
	<?php
		// suformuojame lentelę
		foreach($data as $key => $val) {
			echo
				"<tr>"
					. "<td>{$val['nr']}</td>"
					. "<td>{$val['sutarties_data']}</td>"
					. "<td>{$val['darbuotojo_vardas']} {$val['darbuotojo_pavarde']}</td>"
					. "<td>{$val['kliento_vardas']} {$val['kliento_pavarde']}</td>"
					. "<td>{$val['busena']}</td>"
					. "<td>"
						. "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['nr']}\"); return false;' title=''>šalinti</a>&nbsp;"
						. "<a href='" . Routing::getURL($module, 'edit', 'id=' . $val['nr']), "' title=''>redaguoti</a>"
					. "</td>"
				. "</tr>";
		}
	?>
</table>

<?php
require('paging.php');
require('footer.php');

