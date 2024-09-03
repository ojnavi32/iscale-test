<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ivanjo Sarmiento | Test</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <?php foreach ($data as $item) : ?>
                        <div class="col-4">
                            <div class="feature col">
                                <h2><?= $item['title'] ?></h2>
                                <p><?= $item['body'] ?></p>
                                <ul class="list-group">
                                    <?php foreach ($item['comments'] as $comment) : ?>
                                        <li class="list-group-item"><?= $comment ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>                
            </div>
        </div>
    </div>
</body>
</html>