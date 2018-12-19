<?php

    foreach ($companies as $company):
        foreach ($company['results'] as $item):
            echo $item['name']."<br>";
        endforeach;
    endforeach;
?>

<a href="<?php echo base_url();?>">New search  </a>
<a href="<?php echo base_url("companies/page/".$next_page);?>">Next page  </a>
<?php if ($previous_page) { ?>
<a href="<?php echo base_url("companies/page/".$previous_page);?>">Previous page</a>
<?php }?>

