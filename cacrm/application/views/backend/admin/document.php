
  <!--   <script type="text/javascript">
   
      $(function () {

        $("#id_client").change(function () {
     
            var selectedText = $(this).find("option:selected").text();
            var selectedValue = $(this).val();
          
            $.ajax({
                url: "http://localhost/cacrm/services_and_client.php",
                  async: true,
                  type: "get",
                  data: 'id=' + selectedValue,
                   dataType: "json",
                 contentType: "charset=utf-8",
                 success: function(html){
                    console.log(html);
                    $('#serviceid').html(html);
                    },
                 error: function(err){
                   
                 }
             })
        });
    });

</script> -->

 <!--  <div class="form-group" style="padding-bottom: 5%;">
        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('select client'); ?></label>
      <div class="col-sm-8">
         <select  name="client" class="form-control" id="id_client" style="list-style: none">
         <option >Select</option>
                <?php
                $addservice = $this->db->get('client')->result_array();
                foreach ($addservice as $row):
                    ?>
                    <option value="<?php echo $row['client_id']; ?>">
                        <?php echo $row['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
     <div class="form-group" style="padding-bottom: 5%;">
        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('select services'); ?></label>
      <div class="col-sm-8">
        <select name="serviceid" id="serviceid" class="form-control">
        <option value="">Select services first</option>
        </select>
        </div>
    </div> -->
<table class="table table-bordered datatable">
    <thead>
        <tr>
           
            <th><div><?php echo get_phrase('service_name'); ?></div></th>
            <th><div><?php echo get_phrase('client'); ?></div></th>
            <th><div><?php echo get_phrase('company_name'); ?></div></th>
            <th><div><?php echo get_phrase('task'); ?></div></th>
            <th><div><?php echo get_phrase('document'); ?></div></th>
            
            <th><div><?php echo get_phrase('Start_date'); ?></div></th>
            <th><div><?php echo get_phrase('End_Date'); ?></div></th>
            </tr>
    </thead>
    <tbody>
     <?php 
        $this->db->select('proj.service_id,proj.project_id,proj.tasks,proj.client_id,proj.company_id,proj.timestamp_start, proj.document,proj.timestamp_end,adds.title,c.name as clientname,com.name as companyname');
            $this->db->from('project as proj');
            $this->db->join('add_service as adds', 'adds.service_id =  proj.service_id');
            $this->db->join('client as c', 'c.client_id =proj.client_id ');
            // $this->db->join('project_file as pf','pf.project_id = proj.project_id');
            $this->db->join('company as com', 'com.company_id = proj.company_id');
           $query = $this->db->get();
           $re =  $query->result_array();
            foreach ( $re as $row)
            {
               // print_r($row);
            ?>
        <tr>
            <td style="width:30px;">
                <?php echo $row['title']; ?>
            </td>
             <td style="width:30px;">
                <?php echo $row['clientname']; ?>
            </td>
            <td>
                <?php echo  $row['companyname']; ?>
            </td>
            <td>
                <?php echo  $row['tasks']; ?>
            </td>
             <td>

              <span>
               <a class="tooltip-default" style="color:#aaa;" data-toggle="tooltip" 
                       data-placement="top" data-original-title="<?php echo get_phrase('downloadrequireddocument'); ?>"
                       href="<?php echo base_url(); ?>index.php?admin/project_file/downloadrequireddocument/<?php echo $row['project_id']; ?>">
                        <i class="entypo-download"></i>
                    </a>
                   <?php echo $row['document']; ?>
                </span>
            </td>   
             <td>
                <?php echo  $row['timestamp_start']; ?>
            </td>
             <td>
                <?php echo  $row['timestamp_end']; ?>
            </td>
        </tr>
     <?php } ?>
  
    </tbody>
</table>

