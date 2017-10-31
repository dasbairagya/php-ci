<?php ini_set('display_errors',0);?>


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

                <?php echo form_open(base_url() . 'index.php?admin/project/create/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('service_title'); ?></label>

                    <div class="col-sm-8">
                     <select name="add_service_id" class="form-control "  onchange="showUser(this.value)" >
                           
                            <?php
                            $addservice = $this->db->get('add_service')->result_array();
                            foreach ($addservice as $row):
                                ?>
                                <option value="<?php echo $row['service_id']; ?>">
                                    <?php echo $row['title']; ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('tasks'); ?></label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="entypo-bookmarks"></i></span>
                                <input type="text" class="form-control tas" name="tasks"   value="" >
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-info" id="add-extra-task">
                                 Add Extra Task</button>
                        </div>

                    </div>
                <div class="form-group input_fields_wraper">
                    <label for="field-1" class="col-sm-3 control-label">Add Extra Task</label>
                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-bookmarks"></i></span>
                            <input type="text" class="form-control " name="add_extra_task"   value="" >
                        </div>
                    </div>
<!--                    <div class="col-sm-2">-->
<!--                        <button type="submit" class="btn btn-info" id="add-extra-task">-->
<!--                            --><?php //echo get_phrase('Save Task'); ?><!--</button>-->
<!--                    </div>-->
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                    <div class="col-sm-8">
                        <textarea class="form-control wysihtml5 des" rows="10" name="description" id="post_content" value="" 
                                  data-stylesheet-url="assets/css/wysihtml5-color.css"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Price'); ?></label>


                  


                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-bookmarks"></i></span>

                            <input type="text" class="form-control txtHint" name="budget"   value="" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('start_time'); ?></label>

                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                            <input type="text" class="form-control datepicker" name="timestamp_start"  value="" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('ending_time'); ?></label>

                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                            <input type="text" class="form-control datepicker" name="timestamp_end"  value="" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Advancepercentage'); ?></label>

                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                            <input type="text" class="form-control adv" name="demo_url"  value="" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('progress_status'); ?></label>

                    <div class="col-sm-5" style="padding-top:9px;">
                         <div class="slider2 slider slider-blue first" data-prefix="" data-postfix="%" 
                             data-min="-1" data-max="101" data-value="0"></div> 
                        <input type="hidden"  name="progress_status" id="progress_status">
                    </div>
                </div>



                 <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('document'); ?></label>

                    <div class="col-sm-5" style="padding-top:9px;">
                       
                        <input type="value"  class="docs" name="document" value="0" readonly>
                    </div>
                </div>


                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('client'); ?></label>

                    <div class="col-sm-5">
                        <select name="client_id" class="select2">
                            <option><?php echo get_phrase('select_a_client'); ?></option>
                            <?php
                            $clients = $this->db->get('client')->result_array();
                            foreach ($clients as $row):
                                ?>
                                <option value="<?php echo $row['client_id']; ?>">
                                    <?php echo $row['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('company'); ?></label>

                    <div class="col-sm-5">
                        <select name="company_id" class="form-control selectboxit">
                            <option><?php echo get_phrase('select_company'); ?></option>
                            <?php
                            $companies = $this->db->get('company')->result_array();
                            foreach ($companies as $row):
                                ?>
                                <option value="<?php echo $row['company_id']; ?>">
                                    <?php echo $row['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('assign_staff'); ?></label>

                    <div class="col-sm-8">
                        <select multiple="multiple" name="staffs[]" class="form-control multi-select">
                            <?php
                            $staffs = $this->db->get('staff')->result_array();
                            foreach ($staffs as $row):
                                ?>
                                <option value="<?php echo $row['staff_id']; ?>">
                                    <?php echo $row['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"></label>

                    <div class="col-sm-8">
                        <div class="checkbox checkbox-replace color-blue">
                            <input type="checkbox" name="notify_check" id="notify" value="yes" checked>
                            <label> <?php echo get_phrase('notify_client'); ?></label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" class="btn btn-info" id="submit-button">
                        <?php echo get_phrase('assign_service'); ?></button>
                        <span id="preloader-form"></span>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

  <script type="text/javascript">
  function showUser(str){
    $.ajax({
        url: "http://localhost/cacrm/service.php",
        async: true,
        type: "GET",
        data: 'id=' + str,
        //"service_id="+str,
        dataType: "json",
        contentType: "charset=utf-8",
        success: function(data) {
         console.log(data.tas);
            $('.txtHint').val(data.val);
            $('.adv').val(data.adv);
            $('.docs').val(data.docs);
            $('.des').text(data.des);
            $('.tas').val(data.tas);
        }
    })
   }

  $(document).ready(function() {

      $(".input_fields_wraper").hide();
      var max_fields      = 10; //maximum input boxes allowed
      var wrapper         = $(".input_fields_wrap"); //Fields wrapper
      var add_button      = $("#add-extra-task"); //Add button ID
      var x = 1; //initlal text box count
      $(add_button).click(function(e){ //on add input button click
          e.preventDefault();
          $(".input_fields_wraper").show();
          $("#add-extra-task").hide();
      });
  });

 </script>