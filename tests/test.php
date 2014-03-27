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
					<td><?php echo $page->facebook->shareCount; ?></td>
					<td><a href="<?php echo $page->facebook->shareUrl; ?>">Share</a></td>
					<td><a href="<?php echo $page->facebook->shareApp; ?>">Share in app</a></td>
				</tr>
				<tr>
					<th>Linkedin</th>
					<td><?php echo $page->linkedin->shareCount; ?></td>
					<td><a href="<?php echo $page->linkedin->shareUrl; ?>">Share</a></td>
					<td><a href="<?php echo $page->linkedin->shareApp; ?>">Share in app</a></td>
				</tr>
				<tr>
					<th>Pinterest</th>
					<td><?php echo $page->pinterest->shareCount; ?></td>
					<td><a href="<?php echo $page->pinterest->shareUrl; ?>">Share</a></td>
					<td><a href="<?php echo $page->pinterest->shareApp; ?>">Share in app</a></td>
				</tr>
				<tr>
					<th>Plus</th>
					<td><?php echo $page->plus->shareCount; ?></td>
					<td><a href="<?php echo $page->plus->shareUrl; ?>">Share</a></td>
					<td><a href="<?php echo $page->plus->shareApp; ?>">Share in app</a></td>
				</tr>
				<tr>
					<th>Stumbleupon</th>
					<td><?php echo $page->stumbleupon->shareCount; ?></td>
					<td><a href="<?php echo $page->stumbleupon->shareUrl; ?>">Share</a></td>
					<td><a href="<?php echo $page->stumbleupon->shareApp; ?>">Share in app</a></td>
				</tr>
				<tr>
					<th>Twitter</th>
					<td><?php echo $page->twitter->shareCount; ?></td>
					<td><a href="<?php echo $page->twitter->shareUrl; ?>">Share</a></td>
					<td><a href="<?php echo $page->twitter->shareApp; ?>">Share in app</a></td>
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
