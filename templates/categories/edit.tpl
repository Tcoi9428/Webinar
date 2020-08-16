{include file="./header.tpl"}
<form action="/categories/editing.php" method="post">
    <input type="hidden" name="category_id" value="{$category->getId()}">
    <div class="form-group">
        <label for="category_name">Название Категории</label>
        <input id="category_name" type="text" name="name" class="form-control" required value="{$category->getName()}">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Добавить</button>
</form>
{include file="./bottom.tpl"}