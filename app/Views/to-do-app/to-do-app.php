<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/style.css')?>">
    <title>Document</title>
</head>
<body>
    <h1>Your tasks:</h1>
    <?php if (session()->getFlashdata('success')):?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success')?>
        </div>
    <?php endif;?>
    <div class="formClass"></div>
    <form method="post" action="/addTask">
        <input type="text" placeholder="Enter a task" name="task">
        <button type="submit">Add</button>
    </form>
        <div class="tasksList">
        </div>
    <script src="<?= base_url('js/script.js')?>"></script>
</body>
</html>