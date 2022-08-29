<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("admin/add");
$can_edit = ACL::is_allowed("admin/edit");
$can_view = ACL::is_allowed("admin/view");
$can_delete = ACL::is_allowed("admin/delete");
?>
<?php
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
if (!empty($records)) {
?>
<!--record-->
<?php
$counter = 0;
foreach($records as $data){
$rec_id = (!empty($data['Id']) ? urlencode($data['Id']) : null);
$counter++;
?>
<tr>
    <?php if($can_delete){ ?>
    <th class=" td-checkbox">
        <label class="custom-control custom-checkbox custom-control-inline">
            <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['Id'] ?>" type="checkbox" />
                <span class="custom-control-label"></span>
            </label>
        </th>
        <?php } ?>
        <th class="td-sno"><?php echo $counter; ?></th>
        <td class="td-Id"><a href="<?php print_link("admin/view/$data[Id]") ?>"><?php echo $data['Id']; ?></a></td>
        <td class="td-Name">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Name']; ?>" 
                data-pk="<?php echo $data['Id'] ?>" 
                data-url="<?php print_link("admin/editfield/" . urlencode($data['Id'])); ?>" 
                data-name="Name" 
                data-title="Enter Name" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['Name']; ?> 
            </span>
        </td>
        <td class="td-LastName">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['LastName']; ?>" 
                data-pk="<?php echo $data['Id'] ?>" 
                data-url="<?php print_link("admin/editfield/" . urlencode($data['Id'])); ?>" 
                data-name="LastName" 
                data-title="Enter Lastname" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['LastName']; ?> 
            </span>
        </td>
        <td class="td-Email"><a href="<?php print_link("mailto:$data[Email]") ?>"><?php echo $data['Email']; ?></a></td>
        <td class="td-Username">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Username']; ?>" 
                data-pk="<?php echo $data['Id'] ?>" 
                data-url="<?php print_link("admin/editfield/" . urlencode($data['Id'])); ?>" 
                data-name="Username" 
                data-title="Enter Username" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['Username']; ?> 
            </span>
        </td>
        <td class="td-user_status_name">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['user_status_name']; ?>" 
                data-pk="<?php echo $data['Id'] ?>" 
                data-url="<?php print_link("user_status/editfield/" . urlencode($data['id'])); ?>" 
                data-name="name" 
                data-title="Enter Name" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['user_status_name']; ?> 
            </span>
        </td>
        <td class="td-user_role_id">
            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/admin_user_role_id_option_list'); ?>' 
                data-value="<?php echo $data['user_role_id']; ?>" 
                data-pk="<?php echo $data['Id'] ?>" 
                data-url="<?php print_link("admin/editfield/" . urlencode($data['Id'])); ?>" 
                data-name="user_role_id" 
                data-title="Select a value ..." 
                data-placement="left" 
                data-toggle="click" 
                data-type="select" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['user_role_id']; ?> 
            </span>
        </td>
        <th class="td-btn">
            <?php if($can_view){ ?>
            <a class="btn btn-sm btn-success has-tooltip page-modal" title="View Record" href="<?php print_link("admin/view/$rec_id"); ?>">
                <i class="fa fa-eye"></i> View
            </a>
            <?php } ?>
            <?php if($can_edit){ ?>
            <a class="btn btn-sm btn-info has-tooltip page-modal" title="Edit This Record" href="<?php print_link("admin/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Edit
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("admin/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                <i class="fa fa-times"></i>
                Delete
            </a>
            <?php } ?>
        </th>
    </tr>
    <?php 
    }
    ?>
    <?php
    } else {
    ?>
    <td class="no-record-found col-12" colspan="100">
        <h4 class="text-muted text-center ">
            No Record Found
        </h4>
    </td>
    <?php
    }
    ?>
    