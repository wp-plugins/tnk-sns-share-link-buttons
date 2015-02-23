<?php
/*
Plugin Name: TNK SNS share link buttons
Plugin URI: http://www.tnksoft.com/soft/internet/sharegen/
Description: Generate link buttons which share a blog article by visitors.
Version: 1.0
Author: TNK Software(Tanaka Yusuke)
Author URI: http://www.tnksoft.com/
License: GPLv2

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/

class tnksnsplugin{
	public $services = array(
		"tw"=>"Twitter",
		"fb"=>"Facebook",
		"gp"=>"Google+",
		"tb"=>"Tumblr",
		"dg"=>"Digg",
		"pi"=>"Pinboard",
		"pk"=>"Pocket",
		"rt"=>"Reddit",
		"en"=>"Evernote",
		"wp"=>"Wordpress",
		"li"=>"LinkedIn",
		"mx"=>"Mixi",
		"hb"=>"Hatena bookmark",
		"dl"=>"Delicious",
		"gb"=>"Google Bookmarks",
		"yb"=>"Yahoo! Japan Bookmarks",
		"ln"=>"Line",
		"ml"=>"Mail(mailto:)"
	);
	
	private $setting_default = array(
		"target"=> 2,
		"services"=>array(),
		"mixikey"=>"",
		"addogp"=> 1,
		"default_thumb" => ""
	);
	
	public $setting;
	
	public function uninstall() {
		delete_option("tnksns_setting");
	}

	public function __construct() {
		register_uninstall_hook(__FILE__, array("tnksnsplugin", "uninstall"));
		
		// load setting
		foreach ($this->services as $k => $v) $this->setting_default["services"][$k] = 0;
		if (isset($_POST["plugin"]) && $_POST["plugin"] == "tnksns") {
			foreach ($this->services as $k => $v){
				$this->setting["services"][$k] = (isset($_POST[$k]) && $_POST[$k] == "on") ? 1 : 0;
			}
			$this->setting["target"] = (int)$_POST["target"];
			$this->setting["mixikey"] = sanitize_text_field($_POST["mixikey"]);
			$this->setting["addogp"] = (isset($_POST["addogp"]) && $_POST["addogp"] == "on") ? 1 : 0;
			$this->setting["default_thumb"] = sanitize_text_field($_POST["default_thumb"]);
			update_option("tnksns_setting", $this->setting);
		}else{
			$this->setting = get_option("tnksns_setting");
			if($this->setting === false){
				$this->setting = $this->setting_default;
			}else{
				$this->setting = $this->setting + $this->setting_default;
			}
		}

		add_action("admin_menu", function(){
			require_once(plugin_dir_path(__FILE__)."setting.php");
			add_plugins_page("TNK SNS share links", "TNK SNS links", "administrator", __FILE__, "tnksnsSetting");
		});

		require_once(plugin_dir_path(__FILE__)."ogp.php");
		add_action("wp_head", "onWpHead");
		
		add_action("wp_enqueue_scripts", function(){
			wp_enqueue_script("tnksnslink", plugins_url("tnksnslink.js", __FILE__));
		});
		
		if($this->setting["mixikey"] != ""){
			add_action('wp_head', function(){
				global $_tnksns;
				echo "<script>var tnksns_mk=\"".$_tnksns->setting["mixikey"]."\";</script>\n";
			});
		}
		
		$target = $this->setting["target"];
		if($target == 1 || $target == 2){
			add_filter("the_content", array(&$this, "output"));
		}else if($target == 3 || $target == 4){
			add_filter("the_title", array(&$this, "output"));
		}

		add_filter("the_post", function(){
			if(doing_filter("wp_head")) return;
			echo "<span style=\"display:none\" id=\"tnksns_".get_the_id()."_l\">".get_permalink()."</span>\n".
				"<span style=\"display:none\" id=\"tnksns_".get_the_id()."_t\">".get_the_title()."</span>\n";
		});
	}
	
	public function output($text){
		$svs = $this->setting["services"];
		$op = "<div class=\"tnksns\">";
		foreach ($this->services as $k => $v){
			if(!(isset($svs[$k]) && $svs[$k] == 1)) continue;
			$ir = plugins_url("icons/$k.png", __FILE__);
			$op .= "<a href=\"javascript:tnksns(".get_the_id().",'$k')\"><img src=\"$ir\"></a>";
		}
		$op .= "</div>";
		
		$target = $this->setting["target"];
		if($target == 1 || $target == 3){
			return $op . $text;
		}else if($target == 2 || $target == 4){
			return $text . $op;
		}else if($target == 0){
			echo $op;
		}
	}
}

$_tnksns = new tnksnsplugin();

function tnksns(){
	global $_tnksns;
	$_tnksns->output(null);
}
