<?php

    foreach ($companies as $company):
        foreach ($company['results'] as $item):
            echo $item['name']."<br>";
        endforeach;
    endforeach;
?>

<a href="<?php echo base_url();?>">New search</a>

































