{include file="header.tpl"}
<div class="row">
{foreach from=$products item=product}

        <div class="col-lg-4 col-md-4 mb-4">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                <div class="card-body">
                    <div class="product-article">{$product->getArticle()}</div>
                    <h4 class="card-title">
                        <a href="#">{$product->getName()}</a>
                    </h4>
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
</div>
{/foreach}
<!-- /.row -->
{include file="bottom.tpl"}