 <div class="panel-group" id="accordion">
<?php
function ifExists($data = NULL) {
    if ($data) {
        return $data;
    }
    else {
        $data = " ";
        return $data;
    }
}
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
            }
            foreach ($item['addresses'] as $address) {
                $place = $address['city'];
                $street = $address['street'];
                $postcode = $address['postCode'];
            }
            if ($item['contactDetails']) {
                foreach ($item['contactDetails'] as $contactdetails) {
                    $contact = $contactdetails['value'];
                }
            }
            else {
                $contact = "";
            }
            ?>
            <div class="panel panel-default">
                <div class="panel-heading <?php echo $panel_color;?>">
                  <h4 class="panel-title text-center">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $id;?>">
                    <?php echo $item['name'];?></a>
                  </h4>
                </div>
                
                <div id="collapse<?php echo $id;?>" class="panel-collapse collapse">
                    <div class="panel-body <?php echo $panel_color;?>">
                        <div class="col-sm-2">
                            <p><?php echo $labels['place'].": ";?></p></br>
                            <p><?php echo $labels['street'].": ";?></p></br>
                            <p><?php echo $labels['postcode'].": ";?></p></br>
                        </div>
                        <div class="col-sm-4">
                            <p class="text-right"><?php echo $place;?></p></br>
                            <p class="text-right"><?php echo $street;?></p></br>
                            <p class="text-right"><?php echo $postcode;?></p></br>
                        </div>
                        <div class="col-sm-2" style="border-left-style:solid;border-left-width:2px">
                             <p><?php echo $labels['registered'].": ";?></p></br>
                             <p><?php echo $labels['contact'].": ";?></p></br>
                             <a href="https://www.google.com/?q=<?php echo $item['name'];?>" target="_blank">Google <?php echo $labels['googlesearch'];?></a>
                        </div>
                        <div class="col-sm-4">
                            <p class="text-right"><?php echo $item['registrationDate'];?></p></br>
                            <p class="text-right"><?php echo $contact;?> </p></br>

                        </div>
                    </div>
                </div>
            </div>
             <?php
             $id += 1;
                 endforeach;
                endforeach;
?>

</div> 
<div class="row">

    <div class="col-sm-12" style="left:10px">
    <a href="<?php echo base_url();?>" class="btn btn-primary" role="button"><?php echo $labels['newsearch'];?></a>
    <?php if ($previous_page) { ?>
    <a href="<?php echo base_url("companies/page/".$previous_page);?>" class="btn btn-default" role="button"><?php echo $labels['previouspage'];?></a>
    <?php }?>
    <a href="<?php echo base_url("companies/page/".$next_page);?>"class="btn btn-default" role="button"><?php echo $labels['nextpage'];?></a>
    </div>
</div>


