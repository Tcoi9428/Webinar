<?php /* Smarty version 2.6.31, created on 2020-08-09 15:22:01
         compiled from categories/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="row">
    <div class="col-md-12" style="font-size: 25px;font-width: 700;margin-bottom: 30px;">
        Категории
    </div>
    <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
        <div class="col-md-12 category-card">
            <p class="card-text category-name"><?php echo $this->_tpl_vars['category']->getName(); ?>
</p>
            <div class="buttons-block">
                <a href="/categories/edit.php?category_id=<?php echo $this->_tpl_vars['category']->getId(); ?>
"class="btn btn-primary">Редактировать</a>
                <form action="/categories/delete.php" method="POST">
                    <input type="hidden" value="<?php echo $this->_tpl_vars['category']->getId(); ?>
" name="delete_id">
                    <button type="submit"  class="btn btn-danger">Удалить</button>
                </form>
            </div>
        </div>
    <?php endforeach; endif; unset($_from); ?>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>