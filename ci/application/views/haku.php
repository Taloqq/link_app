<div class="col-sm-1"></div>
<div class="col-sm-10">

<?php echo validation_errors(); ?>
<?php echo form_open_multipart('companies/search', 'autocomplete="off"'); ?>

<div class="row">

    <?php
    echo '<h2 class="search-title text-center">'.$title.'</h2>';
    ?>

</div>
<div class="form-group">
    <div class="row" style="padding-bottom:15px">
		<label for="city" class="col-sm-2 control-label" style="padding-top:5px"><?php echo $labels['place'];?></label>
		<div class="col-sm-2">
            <div class="autocomplete" style="width:200px;">
                <input id="myInput" class="form-control search-bar" type="text" name="city">
            </div>
            
		</div>
	</div> 
	
    <div class="row">
		<label for="city" class="col-sm-2 control-label" style="padding-top:5px"><?php echo $labels['industry'];?></label> <!-- Toimiala tai sen alkuosa millä tahansa kielellä, vois lisätä jonku infon toho. -->
		<div class="col-sm-2">
			<input type="text" class="form-control search-bar" style="width:200px" id="industry" name="industry" value="" disabled="disabled">
		</div>
	</div>	
</div>

<div class="form-group">
<div class="row">
    <div class="col-sm-1">

        <button type="submit" class="btn btn-primary"><?php echo $labels['searchbutton'];?></button>

    </div>

</div>
</div>

</form>
</div>
<div class="col-sm-3"></div>
<?php
// Close form
echo form_close();
?>
<script type="text/javascript" src="assets/js/autocomplete.js"></script>

