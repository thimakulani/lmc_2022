<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("patients/add");
$can_edit = ACL::is_allowed("patients/edit");
$can_view = ACL::is_allowed("patients/view");
$can_delete = ACL::is_allowed("patients/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  Patients</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['Id']) ? urlencode($data['Id']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-Id">
                                        <th class="title"> Id: </th>
                                        <td class="value"> <?php echo $data['Id']; ?></td>
                                    </tr>
                                    <tr  class="td-Name">
                                        <th class="title"> Name: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Name']; ?>" 
                                                data-pk="<?php echo $data['Id'] ?>" 
                                                data-url="<?php print_link("patients/editfield/" . urlencode($data['Id'])); ?>" 
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
                                    </tr>
                                    <tr  class="td-Surname">
                                        <th class="title"> Surname: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Surname']; ?>" 
                                                data-pk="<?php echo $data['Id'] ?>" 
                                                data-url="<?php print_link("patients/editfield/" . urlencode($data['Id'])); ?>" 
                                                data-name="Surname" 
                                                data-title="Enter Surname" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['Surname']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-Age">
                                        <th class="title"> Age: </th>
                                        <td class="value"> <?php echo $data['Age']; ?></td>
                                    </tr>
                                    <tr  class="td-DOB">
                                        <th class="title"> Dob: </th>
                                        <td class="value"> <?php echo $data['DOB']; ?></td>
                                    </tr>
                                    <tr  class="td-Occupation">
                                        <th class="title"> Occupation: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Occupation']; ?>" 
                                                data-pk="<?php echo $data['Id'] ?>" 
                                                data-url="<?php print_link("patients/editfield/" . urlencode($data['Id'])); ?>" 
                                                data-name="Occupation" 
                                                data-title="Enter Occupation" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['Occupation']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-Tel">
                                        <th class="title"> Tel: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Tel']; ?>" 
                                                data-pk="<?php echo $data['Id'] ?>" 
                                                data-url="<?php print_link("patients/editfield/" . urlencode($data['Id'])); ?>" 
                                                data-name="Tel" 
                                                data-title="Enter Tel" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['Tel']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-Cell">
                                        <th class="title"> Cell: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Cell']; ?>" 
                                                data-pk="<?php echo $data['Id'] ?>" 
                                                data-url="<?php print_link("patients/editfield/" . urlencode($data['Id'])); ?>" 
                                                data-name="Cell" 
                                                data-title="Enter Cell" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['Cell']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-Email">
                                        <th class="title"> Email: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Email']; ?>" 
                                                data-pk="<?php echo $data['Id'] ?>" 
                                                data-url="<?php print_link("patients/editfield/" . urlencode($data['Id'])); ?>" 
                                                data-name="Email" 
                                                data-title="Enter Email" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="email" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['Email']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-IdNumber">
                                        <th class="title"> Idnumber: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['IdNumber']; ?>" 
                                                data-pk="<?php echo $data['Id'] ?>" 
                                                data-url="<?php print_link("patients/editfield/" . urlencode($data['Id'])); ?>" 
                                                data-name="IdNumber" 
                                                data-title="Enter Idnumber" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['IdNumber']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-Title">
                                        <th class="title"> Title: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Title']; ?>" 
                                                data-pk="<?php echo $data['Id'] ?>" 
                                                data-url="<?php print_link("patients/editfield/" . urlencode($data['Id'])); ?>" 
                                                data-name="Title" 
                                                data-title="Enter Title" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['Title']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-MaritialStatus">
                                        <th class="title"> Maritialstatus: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['MaritialStatus']; ?>" 
                                                data-pk="<?php echo $data['Id'] ?>" 
                                                data-url="<?php print_link("patients/editfield/" . urlencode($data['Id'])); ?>" 
                                                data-name="MaritialStatus" 
                                                data-title="Enter Maritialstatus" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['MaritialStatus']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-HomeLanguage">
                                        <th class="title"> Homelanguage: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['HomeLanguage']; ?>" 
                                                data-pk="<?php echo $data['Id'] ?>" 
                                                data-url="<?php print_link("patients/editfield/" . urlencode($data['Id'])); ?>" 
                                                data-name="HomeLanguage" 
                                                data-title="Enter Homelanguage" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['HomeLanguage']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-NoDependancies">
                                        <th class="title"> Nodependancies: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['NoDependancies']; ?>" 
                                                data-pk="<?php echo $data['Id'] ?>" 
                                                data-url="<?php print_link("patients/editfield/" . urlencode($data['Id'])); ?>" 
                                                data-name="NoDependancies" 
                                                data-title="Enter Nodependancies" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['NoDependancies']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-ClaimNo">
                                        <th class="title"> Claimno: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['ClaimNo']; ?>" 
                                                data-pk="<?php echo $data['Id'] ?>" 
                                                data-url="<?php print_link("patients/editfield/" . urlencode($data['Id'])); ?>" 
                                                data-name="ClaimNo" 
                                                data-title="Enter Claimno" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['ClaimNo']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-ShelfNo">
                                        <th class="title"> Shelfno: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['ShelfNo']; ?>" 
                                                data-pk="<?php echo $data['Id'] ?>" 
                                                data-url="<?php print_link("patients/editfield/" . urlencode($data['Id'])); ?>" 
                                                data-name="ShelfNo" 
                                                data-title="Enter Shelfno" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['ShelfNo']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-FamilyId">
                                        <th class="title"> Familyid: </th>
                                        <td class="value"> <?php echo $data['FamilyId']; ?></td>
                                    </tr>
                                    <tr  class="td-ReferedbyId">
                                        <th class="title"> Referedbyid: </th>
                                        <td class="value"> <?php echo $data['ReferedbyId']; ?></td>
                                    </tr>
                                    <tr  class="td-MedicalId">
                                        <th class="title"> Medicalid: </th>
                                        <td class="value"> <?php echo $data['MedicalId']; ?></td>
                                    </tr>
                                    <tr  class="td-NextOfKeenId">
                                        <th class="title"> Nextofkeenid: </th>
                                        <td class="value"> <?php echo $data['NextOfKeenId']; ?></td>
                                    </tr>
                                    <tr  class="td-PersonResponsibleId">
                                        <th class="title"> Personresponsibleid: </th>
                                        <td class="value"> <?php echo $data['PersonResponsibleId']; ?></td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <div class="dropup export-btn-holder mx-1">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-save"></i> Export
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                    <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                        <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                        </a>
                                        <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                        <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                            <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                            </a>
                                            <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                            <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                </a>
                                                <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                    <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                    </a>
                                                    <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                    <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                        <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                        </a>
                                                    </div>
                                                </div>
                                                <?php if($can_edit){ ?>
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("patients/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("patients/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                    <i class="fa fa-times"></i> Delete
                                                </a>
                                                <?php } ?>
                                            </div>
                                            <?php
                                            }
                                            else{
                                            ?>
                                            <!-- Empty Record Message -->
                                            <div class="text-muted p-3">
                                                <i class="fa fa-ban"></i> No Record Found
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
