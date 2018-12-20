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
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $id;?>">
                    <?php echo $item['name'];?></a>
                  </h4>
                </div>
                
                <div id="collapse<?php echo $id;?>" class="panel-collapse collapse">
                    <div class="panel-body <?php echo $panel_color;?>">
                        <div class="col-sm-6">
                            <p><?php echo $labels['place'].": ".ifExists($place);?></p></br>
                            <p><?php echo $labels['street'].": ".ifExists($street);?></p></br>
                            <p><?php echo $labels['postcode'].": ".ifExists($postcode);?></p></br>
                        </div>
                        <div class="col-sm-6">
                             <p><?php echo $labels['registered'].": ".ifExists($item['registrationDate']);?></p></br>
                             <p><?php echo $labels['contact'].": ".$contact;?></p></br>
                             <a href="https://www.google.com/?q=<?php echo $item['name'];?>" target="_blank">Google <?php echo $labels['googlesearch'].": "; echo $item['name'];?></a>
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

<a href="<?php echo base_url();?>">New search  </a>
<a href="<?php echo base_url("companies/page/".$next_page);?>">Next page  </a>
<?php if ($previous_page) { ?>
<a href="<?php echo base_url("companies/page/".$previous_page);?>">Previous page</a>
<?php }?>

