<?php
require dirname(__DIR__).'/SocialLinks/autoloader.php';

use SocialLinks\Page;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Social Links</title>
	</head>
	<body>
		<?php if (!empty($_GET['url'])): ?>
			
			<?php $page = new Page($_GET['url']); ?>

			<table>
				<tr>
					<th>Facebook</th>
					<td><?php echo $page->facebook->count(); ?></td>
					<td><a href="<?php echo $page->facebook->shareUrl(); ?>">Share</a></td>
				</tr>
				<tr>
					<th>Linkedin</th>
					<td><?php echo $page->linkedin->count(); ?></td>
					<td><a href="<?php echo $page->linkedin->shareUrl(); ?>">Share</a></td>
				</tr>
				<tr>
					<th>Pinterest</th>
					<td><?php echo $page->pinterest->count(); ?></td>
					<td><a href="<?php echo $page->pinterest->shareUrl(); ?>">Share</a></td>
				</tr>
				<tr>
					<th>Plus</th>
					<td><?php echo $page->plus->count(); ?></td>
					<td><a href="<?php echo $page->plus->shareUrl(); ?>">Share</a></td>
				</tr>
				<tr>
					<th>Stumbleupon</th>
					<td><?php echo $page->stumbleupon->count(); ?></td>
					<td><a href="<?php echo $page->stumbleupon->shareUrl(); ?>">Share</a></td>
				</tr>
				<tr>
					<th>Twitter</th>
					<td><?php echo $page->twitter->count(); ?></td>
					<td><a href="<?php echo $page->twitter->shareUrl(); ?>">Share</a></td>
				</tr>
			</table>
		
		<?php endif; ?>

		<form>
			<label>
				Url: <input type="url" name="url">
			</label>
			<input type="submit">
		</form>
	</body>
</html>
