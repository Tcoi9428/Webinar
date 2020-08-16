<?php /* Smarty version 2.6.31, created on 2020-08-09 14:47:19
         compiled from categories/edit.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="/categories/editing.php" method="post">
    <input type="hidden" name="category_id" value="<?php echo $this->_tpl_vars['category']->getId(); ?>
">
    <div class="form-group">
        <label for="category_name">Название Категории</label>
        <input id="category_name" type="text" name="name" class="form-control" required value="<?php echo $this->_tpl_vars['category']->getName(); ?>
">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Добавить</button>
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>