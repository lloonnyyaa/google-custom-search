<!DOCTYPE html>
<html>
    <head>
        <title>Search</title>
    </head>
    <body>

        <h1>Google custom search</h1>

        <form method="post" style="margin-bottom:10px">
            <input type="text" name="q" value="<?php echo $_POST['q'] ?>">
            <button type="submit">Search</button>
        </form>

        <?php
        if ($results):
            foreach ($results as $result):
                ?>
                <div style="margin-bottom:15px">
                    <a href="<?php echo $result['link'] ?>" target="_blank">
                        <?php echo $result['htmlTitle'] ?>
                    </a>
                    <p>
                        <?php echo $result['htmlSnippet'] ?>
                    </p>
                    <span>
                        <strong>Content lenght:</strong> <?php echo str_word_count($result['snippet'], 0) ?> words
                    </span>
                </div>
                <?php
            endforeach;
        endif;
        ?>

    </body>
</html>