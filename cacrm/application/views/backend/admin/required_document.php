  <div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_required_document'); ?>
                </div>
            </div>
            <div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?admin/document_required/savedocument/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('required_document');?></label>
                    <div class="row">
	                    <div class="col-sm-8">
	                       <div class="col-sm-2">
	                       	 <input type="checkbox"   value="123" name="pancard" />Pan card
	                       </div>
	                        <div class="col-sm-2">
	                       	 <input type="checkbox"   value="123" name="dl" />Dl
	                       </div>
	                        <div class="col-sm-2">
	                       	 <input type="checkbox"   value="123" name="Adharcard" />Adhar Card
	                       </div>
	                        <div class="col-sm-2">
	                       	 <input type="checkbox"   value="123" name="voterid" />Voter id
	                       </div>
	                       </div>
	                    </div>
	             </div>
	               <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-7">
                        <button type="submit" class="btn btn-info" id="submit-button"><?php echo get_phrase('add document'); ?></button>
                        <span id="preloader-form"></span>
                    </div>
                </div>
                </div>

                
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>


