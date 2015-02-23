<?php
function tnksnsSetting(){
	global $_tnksns;?>
<div class="wrap">
<h2>TNK SNS share link buttons</h2>
		
<form method="post" action="">
	<input type="hidden" name="plugin" value="tnksns"></input>
	<table class="form-table">
		<tr valign="top">
		<th scope="row">Output target</th>
		<td>
			<select name="target">
			<?php
			$a_target = array("On \"tnksns()\" function called","Before content","After content","Before title", "After title");
			$t = $_tnksns->setting["target"];
			for($i=0,$l=count($a_target);$i<$l;$i++){
				echo "<option value=\"$i\"";
				if($t == $i) echo " selected";
				echo ">".$a_target[$i]."</option>";
			}
			?>
			</select>
		</td>
		</tr>
		
		<tr valign="top">
		<th scope="row">Services</th>
		<td>
			<?php
				$svs = $_tnksns->setting["services"]; $first = true;
				foreach ($_tnksns->services as $k => $v){
					if(!$first) echo "<br>\n";
					$first = false;
					echo "<input type=\"checkbox\" name=\"$k\"";
					if(isset($svs[$k]) && $svs[$k] == 1) echo " checked";
					echo "></input>$v";
					if($k == "mx") echo " (<a href=\"http://developer.mixi.co.jp/connect/mixi_plugin/\" target=\"_blank\">Developer key</a> :<input type=\"text\" name=\"mixikey\" value=\"".$_tnksns->setting["mixikey"]."\"></input>)";
				}
			?>
		</td>
		</tr>
		
		<th scope="row">Open Graph</th>
		<td>
			<input type="checkbox" name="addogp"<?php if($_tnksns->setting["addogp"]) echo " checked"; ?>></input>Append Open Graph protocol into head tag.<br>
			Default thumbnail : <input type="url" name="default_thumb" value="<?php echo $_tnksns->setting["default_thumb"]; ?>"></input>
		</td>
		</tr>
	</table>

	<?php submit_button(); ?>
</form>

I am glad when you rescue me from poverty. Please read "readme.txt" in the archive file or visit my plugin site.<br>

</div>
<?php
}
?>