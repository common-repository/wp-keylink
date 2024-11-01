<?php
		/*
		Plugin Name:Keyword Linker
		Plugin URI: https://www.linkedin.com/in/mohsen-shahbazi-36194037/
		Version: v0.0.0.2
		Author:<a href="https://www.linkedin.com/in/mohsen-shahbazi-36194037/">M.Shahbazi</a>
		Description:با این افزونه کلمات موردنظر شما به آدرس تعیین شده به صورت اتوماتیک لینک میشوند 
	*/
	
add_action('admin_menu','show_kl_setting');
add_action('the_content','kl_check_post');
	
function show_kl_setting() {
	add_menu_page('klmenu', 'لینکلمه', 10, 'klmenu', 'kl_admin');
	add_submenu_page('klmenu', 'تنظیمات', 'تنظیمات', 10, 'kl_admin', 'kl_admin');
}

function kl_admin() { 
	include('kl_admin_setting.php');
}

function kl_fetch_keywords() { 
	$t=get_option('kl_keylink_list');
	$keyv=explode(',',$t);
	$m=0;
	$p=0;
	foreach ($keyv as $keyn) { 
		$tk=explode('|',$keyn);
		$keywords[$m][0]=$tk[0];
		$keywords[$m][1]=$tk[1];
		$m++;
	}
	return $keywords;
}

function show_keylink_list() { 
	$keyw=kl_fetch_keywords();
	?>
	<table class="wp-list-table widefat fixed striped tags" style="text-align:right;direction:rtl;">
		<tr>
			<th scope="col" id="name" class="manage-column column-name"  style="text-align:right;direction:rtl;">عنوان</th>
			<th scope="col" id="name" class="manage-column column-name"  style="text-align:right;direction:rtl;">لینک</th>
		</tr>
	<tbody id="the-list" >
	<?
	for ($u=0;$u<count($keyw);$u++) { 
		if ( !is_null($keyw[$u][1])) { 
		echo '<tr><th scope="row"  style="text-align:right;direction:rtl;" >'.$keyw[$u][0].'</th><td  style="text-align:right;direction:rtl;" >'.$keyw[$u][1].'</td></tr>';
		}
	}
	?>
	</tbody>
	</table>
		<?
}

function kl_check_post($content) {
 	if ( isset($content)) { 
		$keyw=kl_fetch_keywords();
		$limit=get_option('kl_limit');
		if ($limit == 0) { $limit = '100000000'; }
		for ($u=0;$u<count($keyw);$u++) { 
			if ( $limit > $cme) { 
				$content = str_replace($keyw[$u][0],'<a href="'.$keyw[$u][1].'">'.$keyw[$u][0].'</a>',$content);
			}
			$cme++;
		}
	}
	return $content;
}


function kl_filter_post_data( $data , $postarr ) { 
	if(isset($data)) { 
	$keyw=kl_fetch_keywords();
	$cme=0;
	$limit=get_option('kl_limit');
		if ($limit == 0) { $limit = '100000000'; }
			for ($u=0;$u<count($keyw);$u++) { 
				if ( $limit > $cme) { 
					$data['post_content'] = str_replace($keyw[$u][0],'<a href="'.$keyw[$u][1].'">'.$keyw[$u][0].'</a>',$data['post_content']);
				} 
				$cme++;
			}
	}
return $data;
}
?>