<?php /* Smarty version 2.6.31, created on 2020-09-13 13:22:40
         compiled from index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<nav>
    <ul class="pagination pagination-sm">
        <?php unset($this->_sections['pagination']);
$this->_sections['pagination']['start'] = (int)1;
$this->_sections['pagination']['loop'] = is_array($_loop=$this->_tpl_vars['pagination']['pages']+1) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pagination']['name'] = 'pagination';
$this->_sections['pagination']['show'] = true;
$this->_sections['pagination']['max'] = $this->_sections['pagination']['loop'];
$this->_sections['pagination']['step'] = 1;
if ($this->_sections['pagination']['start'] < 0)
    $this->_sections['pagination']['start'] = max($this->_sections['pagination']['step'] > 0 ? 0 : -1, $this->_sections['pagination']['loop'] + $this->_sections['pagination']['start']);
else
    $this->_sections['pagination']['start'] = min($this->_sections['pagination']['start'], $this->_sections['pagination']['step'] > 0 ? $this->_sections['pagination']['loop'] : $this->_sections['pagination']['loop']-1);
if ($this->_sections['pagination']['show']) {
    $this->_sections['pagination']['total'] = min(ceil(($this->_sections['pagination']['step'] > 0 ? $this->_sections['pagination']['loop'] - $this->_sections['pagination']['start'] : $this->_sections['pagination']['start']+1)/abs($this->_sections['pagination']['step'])), $this->_sections['pagination']['max']);
    if ($this->_sections['pagination']['total'] == 0)
        $this->_sections['pagination']['show'] = false;
} else
    $this->_sections['pagination']['total'] = 0;
if ($this->_sections['pagination']['show']):

            for ($this->_sections['pagination']['index'] = $this->_sections['pagination']['start'], $this->_sections['pagination']['iteration'] = 1;
                 $this->_sections['pagination']['iteration'] <= $this->_sections['pagination']['total'];
                 $this->_sections['pagination']['index'] += $this->_sections['pagination']['step'], $this->_sections['pagination']['iteration']++):
$this->_sections['pagination']['rownum'] = $this->_sections['pagination']['iteration'];
$this->_sections['pagination']['index_prev'] = $this->_sections['pagination']['index'] - $this->_sections['pagination']['step'];
$this->_sections['pagination']['index_next'] = $this->_sections['pagination']['index'] + $this->_sections['pagination']['step'];
$this->_sections['pagination']['first']      = ($this->_sections['pagination']['iteration'] == 1);
$this->_sections['pagination']['last']       = ($this->_sections['pagination']['iteration'] == $this->_sections['pagination']['total']);
?>
            <li class="page-item <?php if ($this->_sections['pagination']['iteration'] == $this->_tpl_vars['pagination']['current']): ?>active<?php endif; ?>">
                <?php if ($this->_sections['pagination']['iteration'] == $this->_tpl_vars['pagination']['current']): ?>
                    <span class="page-link"><?php echo $this->_sections['pagination']['iteration']; ?>
</span>
                <?php else: ?>
                    <a class="page-link" href="/?page=<?php echo $this->_sections['pagination']['iteration']; ?>
"><?php echo $this->_sections['pagination']['iteration']; ?>
</a>
                <?php endif; ?>
            </li>
        <?php endfor; endif; ?>
    </ul>
</nav>

<div class="row">
<?php $_from = $this->_tpl_vars['products']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
    <div class="col-lg-4 col-md-4 mb-4">
        <div class="card h-100">
            <div class="slider-images">
                <?php $_from = $this->_tpl_vars['product']->getImages(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['image']):
        $this->_foreach['foo']['iteration']++;
?>
                    <a href="#"><img class="card-img-top" src="<?php echo $this->_tpl_vars['image']->getPath(); ?>
"></a>
                <?php endforeach; endif; unset($_from); ?>
            </div>
            <div class="card-body">
                <div class="product-article"><?php echo $this->_tpl_vars['product']->getArticle(); ?>
</div>
                <h4 class="card-title">
                    <a href="#"><?php echo $this->_tpl_vars['product']->getName(); ?>
</a>
                </h4>
                <div class="category">
                    <span>Категории:</span>
                    <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
                        <?php $_from = $this->_tpl_vars['product']->getCategoriesIds(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['e']):
?>
                            <?php if ($this->_tpl_vars['category']->getId() == $this->_tpl_vars['e']): ?>
                                <p class="card-text product-name"><?php echo $this->_tpl_vars['category']->getName(); ?>
</p>
                            <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                    <?php endforeach; endif; unset($_from); ?>
                </div>
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