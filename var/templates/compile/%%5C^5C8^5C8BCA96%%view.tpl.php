<?php /* Smarty version 2.6.31, created on 2020-09-02 10:08:19
         compiled from categories/view.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="row">
<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>

        <div class="col-lg-4 col-md-4 mb-4">
            <div class="card h-100">
                <?php $_from = $this->_tpl_vars['product']->getImages(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['image']):
        $this->_foreach['foo']['iteration']++;
?>
                    <?php if ($this->_foreach['foo']['iteration'] == '1'): ?>
                        <a href="#"><img class="card-img-top" src="<?php echo $this->_tpl_vars['image']->getPath(); ?>
"></a>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
                <div class="card-body">
                    <div class="product-article"><?php echo $this->_tpl_vars['product']->getArticle(); ?>
</div>
                    <h4 class="card-title">
                        <a href="#"><?php echo $this->_tpl_vars['product']->getName(); ?>
</a>
                    </h4>
                    <div class="price">
                        <span>Цена: </span> <span><?php echo $this->_tpl_vars['product']->getPrice(); ?>
 руб.</span>
                    </div>
                    <div class="amount">
                        <span>Кол-во: </span><span><?php echo $this->_tpl_vars['product']->getAmount(); ?>
 шт.</span>
                    </div>
                    <p class="card-text"><?php echo $this->_tpl_vars['product']->getDescription(); ?>
</p>
                </div>
                <div class="d-flex justify-content-center align-items-center bottom-btn">
                    <div class="btn-group">
                        <a href="/products/buy.php?product_id=<?php echo $this->_tpl_vars['product']->getId(); ?>
" class=" product-btn btn btn-sm btn-success">Купить</a>
                        <a href="/products/edit.php?product_id=<?php echo $this->_tpl_vars['product']->getId(); ?>
" class=" product-btn btn btn-sm btn-primary">Редактировать</a>
                        <form action="/products/delete.php" method="POST" >
                            <input type="hidden" value="<?php echo $this->_tpl_vars['product']->getId(); ?>
" name="product_id">
                            <button type="submit"  class="btn btn-sm btn-danger">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php endforeach; endif; unset($_from); ?>
</div>

<!-- /.row -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>