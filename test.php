<?php
require dirname(__DIR__).'/SocialLinks/autoloader.php';

use SocialLinks\Page;

$data = empty($_GET) ? ['url' => null, 'title' => null, 'text' => null, 'image' => null] : $_GET;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Social Links</title>

		<style type="text/css">
			body {
				max-width: 600px;
				margin: 0 auto;
				padding: 20px;
				font-family: sans-serif;
			}
			table {
				text-align: left;
				border-collapse:collapse;
				width: 100%;
			}
			td, th {
				padding: 10px;
				border-bottom: solid 1px #ccc;
			}
			tr:first-child td, tr:first-child th {
				border-top: solid 1px #ccc;
			}
			form {
				background: #ccc;
				padding: 10px;
				margin-top: 30px;
				border-radius: 4px;
			}
			label {
				display: block;
				padding: 5px 0;
			}
			label input {
				width: 300px;
			}
			label strong {
				display: inline-block;
				width: 100px;
				text-align: right;
				margin-right: 10px;
			}
			input[type="submit"] {
				margin-left: 110px;
				margin-top: 10px;
			}
		</style>
	</head>

	<body>
		<h1>Social links</h1>

		<?php if ($data['url']): ?>
			
			<?php
			$page = new Page($data);
			$providers = [
				'twitter',
				'facebook',
				'plus',
				'pinterest',
				'linkedin',
				'stumbleupon',
			];
			?>

			<table>
			<?php foreach ($providers as $name): ?>
				<?php $provider = $page->$name; ?>

				<tr>
					<th><?php echo ucfirst($name); ?></th>
					<td><?php echo $provider->shareCount; ?></td>
					<td>
						<?php echo $provider->shareUrl ? "<a href='{$provider->shareUrl}'>Share</a>" : 'Cannot be shared'; ?>
					</td>
					<td>
						<?php echo $provider->shareApp ? "<a href='{$provider->shareApp}'>Share in app</a>" : 'Cannot be shared in app'; ?>
					</td>
				</tr>
			<?php endforeach ?>
			</table>
		
		<?php endif; ?>

		<form>
			<label>
				<strong>Url: </strong><input type="url" name="url" value="<?php echo $data['url']; ?>" required>
			</label>
			<label>
				<strong>Title: </strong><input type="text" name="title" value="<?php echo $data['title']; ?>">
			</label>
			<label>
				<strong>Text: </strong><input type="text" name="text" value="<?php echo $data['text']; ?>">
			</label>
			<label>
				<strong>Image: </strong><input type="url" name="image" value="<?php echo $data['image']; ?>">
			</label>

			<input type="submit" value="Send">
		</form>
	</body>
</html>
