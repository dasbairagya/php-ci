
    <script src="assets/js/jquery.multiselect.js"></script>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('service_form'); ?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'index.php?admin/create_service/assignservice', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('service_title'); ?></label>

                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="title" id="title" data-validate="required" 
                               data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Assign Tasks'); ?></label>
                  <div class="col-sm-8">
                     <select  name="tasks[]" multiple id="tasks" style="list-style: none">
                            
                            <?php
                            $addservice = $this->db->get('add_task')->result_array();
                            foreach ($addservice as $row):
                                ?>
                                <option value="<?php echo $row['task_id']; ?>">
                                    <?php echo $row['task_title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                    <div class="col-sm-8">
                        <textarea class="form-control wysihtml5" rows="10" name="description" id="post_content" 
                                  data-stylesheet-url="assets/css/wysihtml5-color.css"></textarea>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('price'); ?></label>

                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="price" id="title" data-validate="required" 
                               data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
                    </div>
                </div>

                 <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('advancepercentage'); ?></label>

                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="advanceper" id="title" data-validate="required" 
                               data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
                    </div>
                </div>

               <div class="col-md-6"  style="margin-left:150px;" >
                    <div class="row">
                            <label>Document Required</label>
                             <input type="checkbox" name="check" id="checker">
                            <div class="form-group">                       
                                <div id="hider">
                                <div class=""><input type="tel" name="docrequired[]" class="form-control" required><input type="checkbox" name="docs[]">Require</div>
                                <DIV id="item"> </DIV>
                                <input type="button" name="add" value="+" onClick="addnew();" class="btn btn-xs btn-info">
                                <input type="button" name="add" value="-" onClick="deleteRow();" class="btn btn-xs btn-warning">
                                </div>
                        </div>
                    </div>
                </div>

                 <!--  <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('required_document');?></label>
                    <div class="row">
                        <div class="col-sm-8">
                           <div class="col-sm-2">
                             <input type="checkbox"   value="" name="pancard" />Pan card
                           </div>
                            <div class="col-sm-2">
                             <input type="checkbox"   value="" name="dl" />Dl
                           </div>
                            <div class="col-sm-2">
                             <input type="checkbox"   value="" name="Adharcard" />Adhar Card
                           </div>
                            <div class="col-sm-2">
                             <input type="checkbox"   value="" name="voterid" />Voter id
                           </div>
                           </div>
                        </div>
                 </div> -->
               
 
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" class="btn btn-info" id="submit-button">
                            <?php echo get_phrase('add_service'); ?></button>
                        <span id="preloader-form"></span>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>



<table class="table table-bordered datatable">
    <thead>
        <tr>
            

            </th>
<th><div><?php echo get_phrase('sl.no'); ?></div></th>
<th><div><?php echo get_phrase('service'); ?></div></th>
<th><div><?php echo get_phrase('description'); ?></div></th>

<th><div><?php echo get_phrase('price'); ?></div></th>
<th><div><?php echo get_phrase('advanceper%'); ?></div></th>
<th><div><?php echo get_phrase('documents'); ?></div></th>
<th><div><?php echo get_phrase('option'); ?></div></th>

</tr>
</thead>
<tbody>
    <?php
    $counter = 1;
    $this->db->order_by('service_id', 'desc');
    $services = $this->db->get('add_service')->result_array();
    foreach ($services as $row):
        ?>
        <tr>
            <td style="width:30px;">
                <?php echo $counter++; ?>
            </td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['description']; ?></td>
            
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['advanceper']; ?></td>
           
            <td>
            <?php $frequency_days= $row['docrequired'];?> 

            <?php 
            $frequency_days = unserialize($frequency_days);
            foreach($frequency_days as $day)
            {
              echo $day."<br>";
            } 
            ?>
            </td>
           
           
            
            <td>


             
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle " data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                       
                       
                        <!-- EDITING LINK -->
                      <!--   <li>
                            <a onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/client_edit/<?php echo $row['client_id']; ?>');">
                                <i class="entypo-pencil"></i>
                                <?php echo get_phrase('edit'); ?>
                            </a>
                        </li>
                        <li class="divider"></li> -->

                        <!-- DELETION LINK -->
                        <li>
                            <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/assignservice/delete/<?php echo $row['service_id']; ?>','<?php echo base_url(); ?>index.php?admin/reload_assignservice');" >
                                <i class="entypo-trash"></i>
                                <?php echo get_phrase('delete'); ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>

 <script>


$(document).ready(function(){
    $('#hider').hide();
    $("#checker").click(function(){
        $("#hider").toggle();
    });
});
  $('#tasks').multiselect({
        columns: 1,
        placeholder: 'Assign services'
    });
function addnew() {
   
  $("<DIV>").load("http://localhost/cacrm/index.php?/admin/temp", function() {
      $("#item").append($(this).html());
  }); 
}
function deleteRow() {
  $('DIV.product-item').each(function(index, item){
    jQuery(':checkbox', this).each(function () {
            if ($(this).is(':checked')) {
        $(item).remove();
            }
        });
  });
}
</script>

<script>


// custom function for reloading table data
function reload_data(url)
{
    $.ajax({
        url: url,
        success: function(response)
        {
            // Replace new page data
            jQuery('.main_data').html(response);

        }
    });
}

function delete_data(delete_url , post_refresh_url)
{
    // showing user-friendly pre-loader image
    $('#preloader-delete').html('<img src="assets/images/preloader.gif" style="height:15px;margin-top:-10px;" />');
    
    // disables the delete and cancel button during deletion ajax request
    document.getElementById("delete_link").disabled=true;
    document.getElementById("delete_cancel_link").disabled=true;
    
    $.ajax({
        url: delete_url,
        success: function(response)
        {
            // remove the preloader 
            $('#preloader-delete').html('');
            
            // show deletion success msg.
            toastr.info("Data deleted successfully.", "Success");
            
            // hide the delete dialog box
            $('#modal_delete').modal('hide');
            
            // enables the delete and cancel button after deletion ajax request success
            document.getElementById("delete_link").disabled=false;
            document.getElementById("delete_cancel_link").disabled=false;
    
            // reload the table
            reload_data(post_refresh_url);
        }
    });


}
</script>