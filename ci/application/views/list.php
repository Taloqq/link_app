 <div class="panel-group" id="accordion">
<?php
$gray = 0;
$id = 1;
    foreach ($companies as $company):
        foreach ($company['results'] as $item):
            if ($gray == 0) {
                $panel_color = 'white-panel';
                $gray = 1;
            }
            else {
                $panel_color = 'gray-panel';
                $gray = 0;
            }?>
            <div class="panel panel-default">
                <div class="panel-heading <?php echo $panel_color;?>">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $id;?>">
                    <?php echo $item['name'];?></a>
                  </h4>
                </div>
                <div id="collapse<?php echo $id;?>" class="panel-collapse collapse">
                  <div class="panel-body <?php echo $panel_color;?>">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                  sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                  minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                  commodo consequat.</div>
                </div>
             </div>
             <?php
             $id += 1;
                 endforeach;
                endforeach;
?>

</div> 

<a href="<?php echo base_url();?>">New search  </a>
<a href="<?php echo base_url("companies/page/".$next_page);?>">Next page  </a>
<?php if ($previous_page) { ?>
<a href="<?php echo base_url("companies/page/".$previous_page);?>">Previous page</a>
<?php }?>

