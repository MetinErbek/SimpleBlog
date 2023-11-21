<div class="pull-left total_info_table" style="font-size: 12px;"> <?php echo __('Total');?> {{ $Element->total() }} <?php echo __('entries');?></div>
@if($Element->hasPages())
<nav aria-label="Page navigation" class="pull-right">
    <ul class="pagination">
        <li class="page-item"><a class="page-link before" data-number="<?php echo 1;?>" href="<?php echo make_page_url($_GET, 'page', 1);?>"><?php echo __('First');?></a></li>
        <?php if($Element->currentPage()-1 > 0):?>
        <li class="page-item"><a class="page-link before" data-number="<?php echo $Element->currentPage()-1?>" href="<?php echo make_page_url($_GET, 'page', $Element->currentPage()-1);?>"><?php echo __('Previous');?></a></li>
        <?php endif;?>
        <?php if($Element->currentPage() != 1):?>
            <li class="page-item"><a class="page-link" href="<?php echo make_page_url($_GET, 'page', $Element->currentPage()-1);?>"><?php echo $Element->currentPage()-1;?></a></li>
        <?php endif;?>
            <li class="page-item active"><a class="page-link" href="<?php echo make_page_url($_GET, 'page', $Element->currentPage());?>"><?php echo $Element->currentPage();?></a></li>
        <?php if($Element->currentPage() != $Element->lastPage()):?>
            <li class="page-item"><a class="page-link" href="<?php echo make_page_url($_GET, 'page', $Element->currentPage()+1);?>"><?php echo $Element->currentPage()+1;?></a></li>
        <?php endif;?>
        <?php if($Element->currentPage()+1 < $Element->lastPage()):?>
        <li class="page-item"><a class="page-link next" data-number="<?php echo $Element->currentPage()+1?>" href="<?php echo make_page_url($_GET, 'page', $Element->currentPage()+1);?>"><?php echo __('Next');?></a></li>
        <?php endif;?>
        <li class="page-item"><a class="page-link last" data-number="<?php echo $Element->lastPage();?>" href="<?php echo make_page_url($_GET, 'page', $Element->lastPage());?>"><?php echo __('Last');?></a></li>
    </ul>
</nav>
@endif
