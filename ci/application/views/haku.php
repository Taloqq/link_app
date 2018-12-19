<?php echo validation_errors(); ?>
<?php echo form_open_multipart('companies/search', 'autocomplete="off"'); ?>

<div class="row">
    <?php
    echo '<h3>'.$title.'</h3>';
    ?>
    
</div>
<div class="form-group">
    <div class="row">
		<label for="city" class="col-sm-2 control-label">City</label>
		<div class="col-sm-2">
            <div class="autocomplete" style="width:300px;">
                <input id="myInput" type="text" name="city" placeholder="Country">
            </div>
            
		</div>
	</div> 
	
    <div class="row">
        <p>Tähän kysymysmerkki</p>
		<label for="city" class="col-sm-2 control-label">Industry</label> <!-- Toimiala tai sen alkuosa millä tahansa kielellä, vois lisätä jonku infon toho. -->
		<div class="col-sm-2">
			<input type="text" class="form-control" id="industry" name="industry" value="">
		</div>
	</div>	
</div>

<div class="form-group">
<div class="row">
    <div class="col-sm-2">

        <button type="submit" class="btn btn-primary">Hae</button>

    </div>

</div>
</div>

</form>
<?php
// Close form
echo form_close();
?>
<script type="text/javascript" src="assets/js/autocomplete.js"></script>

