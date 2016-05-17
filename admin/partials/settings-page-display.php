<?php
/**
 * Settings page
 */
?>

<div class="wrap grid-element-trash-wrapper">
	<h2>Grid Elements Trash</h2>
	<p>Uncheck to disable Element in Grid</p>
	<dl>
		<dt>Containers</dt>
		<dd>
			<ul class="container-trash-list">
			<?php 
			foreach ($containers as $container) {
				$type = $container["type"];
				if(strpos($type, "c-") !== 0) continue;
				$checked = '';
				if( !$trash->is_container_trashed($type) ){
					$checked = 'checked="checked"';
				}
				echo "<li><input class='trash-check check-container' type='checkbox' data-element='container' $checked name='$type' /> ".$type."</li>";
			}

			?>
			</ul>
		</dd>
		<dt>Boxes</dt>
		<dd><?php 
		foreach ($meta_boxes as $meta_box) {
			$class = get_class($meta_box);
			if($class == "grid_post_box") continue;
			$obj=new $class();
			$obj->storage = $storage;
			$searchresult=$obj->metaSearch($meta_box->metaSearchCriteria(),"");
			echo "<dl>";
				echo "<dt>".$class."</dt>";
				foreach ($searchresult as $key => $box) 
				{
					$type = $box->type();
					$display = $box->render(true);
					$checked = '';
					$trashid = $type;
					if($type == "reference")
					{
						$trashid = "reference-".$box->content->boxid;
					}
					if( !$trash->is_box_trashed($trashid) )
					{
						$checked = 'checked="checked"';
					}
					?>
						<dd><?php echo "<input class='trash-check check-box' type='checkbox' data-element='box' $checked name='$trashid' />".$display; ?></dd>

					<?php
				}
			echo "</dl>";
			
		}
		?></dd>
	</dl>
	

</div>