{include file="header.tpl"}
<p>
<h3>Загрузка файла импорта</h3>
    <form action="/import/upload.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="product_description">Файл импорта(csv)</label>
        <input type="file" name="import_file" class="form-control" multiple>
    </div>
    <button type="submit" class="btn btn-primary mb-2">Добавить</button>
    </form>
</p>
{include file="bottom.tpl"}