<?php
require dirname(__DIR__).'/src/autoloader.php';

use SocialLinks\Page;

$data = empty($_GET) ? ['url' => null, 'title' => null, 'text' => null, 'image' => null, 'twitterUser' => null] : $_GET;
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">

		<title>Social Links</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<style type="text/css">
			body {
				max-width: 600px;
				margin: 0 auto;
				padding: 20px;
				font-family: Arial, sans-serif;
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
				'meneame',
				'chuza',
				'cabozo',
				'stumbleupon',
				'email',
				'blogger',
				'bobrdobr',
				'evernote',
				'liveinternet',
				'livejournal',
				'mailru',
				'odnoklassniki',
				'vk',
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
			<label>
				<strong>Twitter user: </strong><input type="text" name="twitterUser" value="<?php echo $data['twitterUser']; ?>">
			</label>

			<input type="submit" value="Send">
		</form>

		<footer>
			<p><a href="https://github.com/oscarotero/social-links">View in github</a></p>
		</footer>
	</body>
</html>
