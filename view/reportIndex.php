<?php
require('header.php');
use Utils\Routing;

?>
    <ul id="pagePath">
	<li><a href="<?php echo Routing::getURL(); ?>">Pradžia</a></li>
	<li>Ataskaitos</li>
</ul>
<div id="actions"></div>

<div class="float-clear"></div>

<div class="page">
	<ul class="reportList">
<?php
foreach ($reports as $reportId => $report) {
  echo "<li>",
    "<p>",
    '<a href="',
      Routing::getURL($module, 'view', "id={$reportId}"), '" ',
      "target='_blank' title='{$report['title']}'>", $report['title'],
    "</a></p>",
    "<p>", $report['description'], "</p>",
		"</li>\n";
}
?>
	</ul>
</div>
<?php require('footer.php');
