{include file = 'header.tpl'}

<form action="/products/editing.php" method="post" enctype="multipart/form-data">
    <input type="hidden" value="{$product->getId()}" name="product_id">
    <div class="form-group">
        <label for="product_name">Название товара</label>
        <input id="product_name" type="text" name="name" class="form-control" required value="{$product->getName()}">
    </div>
    <div class="form-group">
        <label for="product_price">Цена</label>
        <input id="product_price" type="text" name="price" class="form-control" required value="{$product->getPrice()}">
    </div>
    <div class="form-group">
        <label for="product_amount">Количество</label>
        <input id="product_amount" type="number" name="amount" class="form-control" required value="{$product->getAmount()}">
    </div>
    <div class="form-group">
        <label for="product_name">Артикул</label>
        <input id="product_name" type="text" name="article" class="form-control" required value="{$product->getArticle()}">
    </div>
    <div class="form-group">
        <label for="product_folders">Категории</label>
        <select multiple class="form-control" name="categories_ids[]" id="product_category">
                {foreach from=$categories item=category}
                    <option value="{$category->getId()}" {foreach from=$product->getCategoriesIds() item=e}{if $e == $category->getId() }selected{/if}{/foreach}>{$category->getName()}</option>
                {/foreach}
        </select>
    </div>
    <div class="form-group">
        <label for="product_description">Описание товара</label>
        <textarea id="product_description" name="description" class="form-control" rows="3">{$product->getDescription()}</textarea>
    </div>
    <div class="form-group">
        <label for="product_description">Изображения товара</label>
        <input id="images" type="file" name="images[]" class="form-control" multiple>
    </div>
    {if $product->getImages()}
        <div class="form-group images-group">
            {foreach from=$product->getImages() item=image}
            <div class="card">
                <img src="{$image->getPath()}" class="card-img-top" alt="{$image->getName()}">
                <div class="card-body">
                    <button class="btn btn-warning btn-sm delete-image-btn" data-image-id="{$image->getId()}" onclick="return deleteImage(this)">Удалить</button>
                </div>
            </div>
            {/foreach}
        </div>
    {/if}
    {literal}
        <script>
            function deleteImage(button){
                let imageId = $(button).data('imageId');
                imageId = parseInt(imageId);

                if(!imageId){
                    alert('Проблема с image_id');
                    return false;
                }

                let url = '/products/delete_image.php'

                const formData = new FormData();

                formData.append('product_image_id', imageId);

                fetch(url,{
                    method: 'POST',
                    body: formData
                }).then(() => {
                    document.location.reload();
                });
                return false
            }
        </script>
    {/literal}
    <button type="submit" class="btn btn-primary mb-2">Добавить</button>
</form>
{include file = 'bottom.tpl'}