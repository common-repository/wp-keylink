<?php
echo  '<link rel="stylesheet" type="text/css" href="'.plugin_dir_url( __FILE__ ).'css/kl-styles.css"">';
	if(isset($_GET['clean'])) { 
		if($_GET['clean'] == 'ok') { 
			update_option('kl_keylink_list',NULL);
		}
}
	if(isset($_POST['do'])) { 
		
		if(!empty($_POST['kl_title']) AND !empty($_POST['kl_link']))  {
			
			$getlast=get_option('kl_keylink_list');
				if (empty($getlast)) { 
					$b=$_POST['kl_title']."|".$_POST['kl_link'].",";
					$final=$getlast.$b;
				}else { 
					$b=$_POST['kl_title']."|".$_POST['kl_link'];
					$final=$getlast.",".$b;	
					}
			$final = str_replace(',,',',',$final);
			update_option('kl_keylink_list',$final);
			update_option('kl_limit',$_POST['kl_limit']);
			
		} else { 
			echo "اطلاعات ناقص وارد شده است . کلمه و لینک مربوطه را وارد کنید ";
		}
		
		echo 'تنظیمات ذخیره شد ';
	}
	
	
	?>
<div id="kl-wrapper" style="direction:rtl;padding-right:10px;">	
	<header class="cs-header">
		<h1>ایجاد کننده لینک داخلی</h1>
			<div class="clear"></div>
			<hr>
		</header>

<form method="post">
	<table class="form-table">
		<tr>
			<th scope="row" style="text-align:right;">
				<lable> محدودیت لینک در هر صفحه:</lable>
			</th>
			<td>
				حداکثر
					<input type="text" name="kl_limit" size="1" value="<?php echo get_option('kl_limit'); ?>">لینک در هر صفحه
					<p class="description" >برای نامحدود بودن 0 را واردکنید</p>
			</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right;">
					کلمه : 
				</th>
				<td>
					<input type="text" name="kl_title">
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right;">
				لینک:
				</th>
				<td>
					<input type="text" name="kl_link">
				</td>
			</tr>
				<input type="hidden" name="do">
			<tr>
				<td></td><td><input type="submit"  value="ذخیره" class="button button-primary" ></td>
	</table>
	<?php show_keylink_list(); ?>
	<a href="?page=klmenu&clean=ok" class="button button-primary"> حذف همه کلمات  </a>
</form>
</div>