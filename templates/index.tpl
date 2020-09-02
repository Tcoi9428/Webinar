{include file="header.tpl"}
{*<nav>
    <ul class="pagination pagination-sm">
        {section start=1 loop=$pagination.pages+1 name="pagination"}
            <li class="page-item {if $smarty.section.pagination.iteration == $pagination.current}active{/if}">
                {if $smarty.section.pagination.iteration == $pagination.current}
                    <span class="page-link">{$smarty.section.pagination.iteration}</span>
                {else}
                    <a class="page-link" href="/?page={$smarty.section.pagination.iteration}">{$smarty.section.pagination.iteration}</a>
                {/if}
            </li>
        {/section}
    </ul>
</nav>*}
{*<div class="row">
    {foreach from=$products.items item=product}
        <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Фото товара</text></svg>
            <div class="card-body">
                <p class="card-text" style="font-weight:700; font-size: 20px;">{$product->getName()}</p>
                <div class="card-field">
                    <p class="card-text product-name field-title">Цена:</p><small class="text-muted">{$product->getPrice()}</small>
                </div>
                <div class="card-field">
                    <p class="card-text product-name field-title">Количество:</p><small class="text-muted">{$product->getAmount()}</small>
                </div>
                <div class="card-field">
                    <p class="card-text product-name field-title">Категории:</p>
                    {foreach from=$categories item=category}
                        {foreach from=$product->getCategoriesIds() item=e}
                        {if $category->getId() == $e}
                            <p class="card-text product-name">{$category->getName()}</p>
                        {/if}
                        {/foreach}
                    {/foreach}
                </div>
                <div class="card-field">
                    <p class="card-text product-name field-title">Производитель:</p>
                    {foreach from=$vendors item=vendor}
                        {if $vendor->getId() == $product->getVendorId()}
                            <p class="card-text product-name">{$vendor->getName()}</p>
                        {/if}
                    {/foreach}
                    <p class="card-text product-name"></p>
                </div>
                <div class="card-field">
                    <p class="card-text product-name field-title">Описание:</p><p class="card-text product-name">{$product->getDescription()}</p>
                </div>
                <div class="d-flex justify-content-between align-items-center bottom-btn">
                    <div class="btn-group">
                        <a href="/products/buy.php?product_id={$product->getId()}" class=" product-btn btn btn-sm btn-success">Купить</a>
                        <a href="/products/edit.php?product_id={$product->getId()}" class=" product-btn btn btn-sm btn-primary">Редактировать</a>
                        <form action="/products/delete.php" method="POST" >
                            <input type="hidden" value="{$product->getId()}" name="product_id">
                             <button type="submit"  class="btn btn-sm btn-danger">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {/foreach}
</div>*}
<div class="row">
{foreach from=$products.items item=product}
    <div class="col-lg-4 col-md-4 mb-4">
        <div class="card h-100">
            <div class="slider-images">
                {foreach from=$product->getImages() item=image name=foo}
                    <a href="#"><img class="card-img-top" src="{$image->getPath()}"></a>
                {/foreach}
            </div>
            <div class="card-body">
                <div class="product-article">{$product->getArticle()}</div>
                <h4 class="card-title">
                    <a href="#">{$product->getName()}</a>
                </h4>
                <div class="category">
                    <span>Категории:</span>
                    {foreach from=$categories item=category}
                        {foreach from=$product->getCategoriesIds() item=e}
                            {if $category->getId() == $e}
                                <p class="card-text product-name">{$category->getName()}</p>
                            {/if}
                        {/foreach}
                    {/foreach}
                </div>
                <div class="price">
                    <span>Цена: </span> <span>{$product->getPrice()} руб.</span>
                </div>
               <div class="amount">
                   <span>Кол-во: </span><span>{$product->getAmount()} шт.</span>
               </div>
                <p class="card-text">{$product->getDescription()}</p>
            </div>
            <div class="d-flex justify-content-center align-items-center bottom-btn">
                <div class="btn-group">
                    <a href="/products/buy.php?product_id={$product->getId()}" class=" product-btn btn btn-sm btn-success">Купить</a>
                    <a href="/products/edit.php?product_id={$product->getId()}" class=" product-btn btn btn-sm btn-primary">Редактировать</a>
                    <form action="/products/delete.php" method="POST" >
                        <input type="hidden" value="{$product->getId()}" name="product_id">
                        <button type="submit"  class="btn btn-sm btn-danger">Удалить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

{/foreach}
</div>
<!-- /.row -->
{include file="bottom.tpl"}