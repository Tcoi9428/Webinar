{include file="./header.tpl"}
<div class="row">
    <div class="col-md-12" style="font-size: 25px;font-width: 700;margin-bottom: 30px;">
        Категории
    </div>
    {foreach from=$categories item=category}
        <div class="col-md-12 category-card">
            <p class="card-text category-name">{$category->getName()}</p>
            <div class="buttons-block">
                <a href="/categories/edit.php?category_id={$category->getId()}"class="btn btn-primary">Редактировать</a>
                <form action="/categories/delete.php" method="POST">
                    <input type="hidden" value="{$category->getId()}" name="delete_id">
                    <button type="submit"  class="btn btn-danger">Удалить</button>
                </form>
            </div>
        </div>
    {/foreach}
</div>
{include file="./bottom.tpl"}