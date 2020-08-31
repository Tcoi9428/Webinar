<?php /* Smarty version 2.6.31, created on 2020-08-17 06:59:02
         compiled from product/edit.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form action="/products/editing.php" method="post" enctype="multipart/form-data">
    <input type="hidden" value="<?php echo $this->_tpl_vars['product']->getId(); ?>
" name="product_id">
    <div class="form-group">
        <label for="product_name">Название товара</label>
        <input id="product_name" type="text" name="name" class="form-control" required value="<?php echo $this->_tpl_vars['product']->getName(); ?>
">
    </div>
    <div class="form-group">
        <label for="product_price">Цена</label>
        <input id="product_price" type="text" name="price" class="form-control" required value="<?php echo $this->_tpl_vars['product']->getPrice(); ?>
">
    </div>
    <div class="form-group">
        <label for="product_amount">Количество</label>
        <input id="product_amount" type="number" name="amount" class="form-control" required value="<?php echo $this->_tpl_vars['product']->getAmount(); ?>
">
    </div>
    <div class="form-group">
        <label for="product_name">Артикул</label>
        <input id="product_name" type="text" name="article" class="form-control" required value="<?php echo $this->_tpl_vars['product']->getArticle(); ?>
">
    </div>
    <div class="form-group">
        <label for="product_folders">Категории</label>
        <select multiple class="form-control" name="categories_ids[]" id="product_category">
                <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
                    <option value="<?php echo $this->_tpl_vars['category']->getId(); ?>
" <?php $_from = $this->_tpl_vars['product']->getCategoriesIds(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['e']):
?><?php if ($this->_tpl_vars['e'] == $this->_tpl_vars['category']->getId()): ?>selected<?php endif; ?><?php endforeach; endif; unset($_from); ?>><?php echo $this->_tpl_vars['category']->getName(); ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
        </select>
    </div>
    <div class="form-group">
        <label for="product_description">Описание товара</label>
        <textarea id="product_description" name="description" class="form-control" rows="3"><?php echo $this->_tpl_vars['product']->getDescription(); ?>
</textarea>
    </div>
    <div class="form-group">
        <label for="product_description">Изображения товара</label>
        <input id="images" type="file" name="images[]" class="form-control" multiple>
    </div>
    <button type="submit" class="btn btn-primary mb-2">Добавить</button>
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'bottom.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>