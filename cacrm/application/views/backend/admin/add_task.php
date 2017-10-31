<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_task'); ?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'index.php?admin/add_task/create/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('task_title');?></label>
                    
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="task_title" data-validate="required" 
                            data-message-required="<?php echo get_phrase('value_required');?>" value="">
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
                    <div class="col-sm-offset-4 col-sm-7">
                        <button type="submit" class="btn btn-info" id="submit-button"><?php echo get_phrase('add_task'); ?></button>
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
<th><div><?php echo get_phrase('task_title'); ?></div></th>
<th><div><?php echo get_phrase('description'); ?></div></th>
<th><div><?php echo get_phrase('action'); ?></div></th>



</tr>
</thead>
<tbody>
    <?php
    $counter = 1;
    $this->db->order_by('task_id', 'desc');
    $task = $this->db->get('add_task')->result_array();
    foreach ($task as $row):
        ?>
        <tr>
            <td style="width:30px;">
                <?php echo $counter++; ?>
            </td>
            <td><?php echo $row['task_title']; ?></td>
            <td><?php echo $row['description']; ?></td>
            
          
           
          
           
            
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
                            <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/add_task/delete/<?php echo $row['task_id']; ?>','<?php echo base_url();?>index.php?admin/');" >
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
function delete_data(delete_url , post_refresh_url)
{
    // showing user-friendly pre-loader image
    $('#preloader-delete').html('<img src="assets/images/preloader.gif" style="height:15px;margin-top:-10px;"/>');
    
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

               

              

