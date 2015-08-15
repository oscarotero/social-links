<?php
require dirname(__DIR__).'/src/autoloader.php';

use SocialLinks\Page;

$data = empty($_GET) ? array('url' => null, 'title' => null, 'text' => null, 'image' => null, 'twitterUser' => null) : $_GET;
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
                border-bottom: solid 1px #DCDCDC;
            }
            tr:first-child td, tr:first-child th {
                border-top: solid 1px #DCDCDC;
            }
            form {
                background: #DCDCDC;
                padding: 16px;
                margin-top: 30px;
                border-radius: 2px;
            }
            label {
                display: block;
                padding: 5px 0;
            }
            label input {
                width: calc(100% - 110px);
                padding: 0.3em;
                box-sizing: border-box;
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
            pre {
                background: #DCDCDC;
                overflow-x: auto;
                padding: 16px;
            }
        </style>
    </head>

    <body>
        <h1>Social links</h1>

        <?php if ($data['url']): ?>

            <?php
            $page = new Page($data);
            $providers = array(
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
                'tumblr',
            );
            ?>

            <table>
            <?php foreach ($providers as $name): ?>
                <?php $provider = $page->$name; ?>

                <tr>
                    <th><?php echo ucfirst($name); ?></th>
                    <td><?php echo $provider->shareCount === null ? 'not available' : $provider->shareCount; ?></td>
                    <td>
                        <?php echo $provider->shareUrl ? "<a href='{$provider->shareUrl}'>Share</a>" : 'Cannot be shared'; ?>
                    </td>
                </tr>
            <?php endforeach ?>
            </table>

            <pre><code><?php
                foreach ($page->html() as $tag) {
                    echo htmlspecialchars($tag)."\n";
                }
                echo "\n";
                foreach ($page->openGraph() as $tag) {
                    echo htmlspecialchars($tag)."\n";
                }
                echo "\n";
                foreach ($page->twitterCard() as $tag) {
                    echo htmlspecialchars($tag)."\n";
                }
            ?></code></pre>

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
