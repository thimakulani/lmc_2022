<?php
$comp_model = new SharedController;
$page_element_id = "add-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="add"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Add New Patients</h4>
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
                <div class="col-md-7 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light animated fadeIn page-content">
                        <form id="patients-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("patients/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <label class="control-label" for="Name">Name <span class="text-danger">*</span></label>
                                    <div id="ctrl-Name-holder" class=""> 
                                        <input id="ctrl-Name"  value="<?php  echo $this->set_field_value('Name',""); ?>" type="text" placeholder="Enter Name"  required="" name="Name"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label" for="Surname">Surname <span class="text-danger">*</span></label>
                                        <div id="ctrl-Surname-holder" class=""> 
                                            <input id="ctrl-Surname"  value="<?php  echo $this->set_field_value('Surname',""); ?>" type="text" placeholder="Enter Surname"  required="" name="Surname"  class="form-control " />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label" for="Occupation">Occupation <span class="text-danger">*</span></label>
                                            <div id="ctrl-Occupation-holder" class=""> 
                                                <input id="ctrl-Occupation"  value="<?php  echo $this->set_field_value('Occupation',""); ?>" type="text" placeholder="Enter Occupation"  required="" name="Occupation"  class="form-control " />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="Tel">Tel <span class="text-danger">*</span></label>
                                                <div id="ctrl-Tel-holder" class=""> 
                                                    <input id="ctrl-Tel"  value="<?php  echo $this->set_field_value('Tel',""); ?>" type="text" placeholder="Enter Tel"  required="" name="Tel"  class="form-control " />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="Cell">Cell <span class="text-danger">*</span></label>
                                                    <div id="ctrl-Cell-holder" class=""> 
                                                        <input id="ctrl-Cell"  value="<?php  echo $this->set_field_value('Cell',""); ?>" type="text" placeholder="Enter Cell"  required="" name="Cell"  class="form-control " />
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="control-label" for="Email">Email <span class="text-danger">*</span></label>
                                                        <div id="ctrl-Email-holder" class=""> 
                                                            <input id="ctrl-Email"  value="<?php  echo $this->set_field_value('Email',""); ?>" type="email" placeholder="Enter Email"  required="" name="Email"  class="form-control " />
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="control-label" for="IdNumber">Idnumber <span class="text-danger">*</span></label>
                                                            <div id="ctrl-IdNumber-holder" class=""> 
                                                                <input id="ctrl-IdNumber"  value="<?php  echo $this->set_field_value('IdNumber',""); ?>" type="text" placeholder="Enter Idnumber"  required="" name="IdNumber"  class="form-control " />
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">
                                                                <label class="control-label" for="Title">Title <span class="text-danger">*</span></label>
                                                                <div id="ctrl-Title-holder" class=""> 
                                                                    <input id="ctrl-Title"  value="<?php  echo $this->set_field_value('Title',""); ?>" type="text" placeholder="Enter Title"  required="" name="Title"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group ">
                                                                    <label class="control-label" for="MaritialStatus">Maritialstatus <span class="text-danger">*</span></label>
                                                                    <div id="ctrl-MaritialStatus-holder" class=""> 
                                                                        <input id="ctrl-MaritialStatus"  value="<?php  echo $this->set_field_value('MaritialStatus',""); ?>" type="text" placeholder="Enter Maritialstatus"  required="" name="MaritialStatus"  class="form-control " />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <label class="control-label" for="HomeLanguage">Homelanguage <span class="text-danger">*</span></label>
                                                                        <div id="ctrl-HomeLanguage-holder" class=""> 
                                                                            <input id="ctrl-HomeLanguage"  value="<?php  echo $this->set_field_value('HomeLanguage',""); ?>" type="text" placeholder="Enter Homelanguage"  required="" name="HomeLanguage"  class="form-control " />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group ">
                                                                            <label class="control-label" for="NoDependancies">Nodependancies <span class="text-danger">*</span></label>
                                                                            <div id="ctrl-NoDependancies-holder" class=""> 
                                                                                <input id="ctrl-NoDependancies"  value="<?php  echo $this->set_field_value('NoDependancies',""); ?>" type="text" placeholder="Enter Nodependancies"  required="" name="NoDependancies"  class="form-control " />
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group ">
                                                                                <label class="control-label" for="ClaimNo">Claimno <span class="text-danger">*</span></label>
                                                                                <div id="ctrl-ClaimNo-holder" class=""> 
                                                                                    <input id="ctrl-ClaimNo"  value="<?php  echo $this->set_field_value('ClaimNo',""); ?>" type="text" placeholder="Enter Claimno"  required="" name="ClaimNo"  class="form-control " />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group ">
                                                                                    <label class="control-label" for="ShelfNo">Shelfno <span class="text-danger">*</span></label>
                                                                                    <div id="ctrl-ShelfNo-holder" class=""> 
                                                                                        <input id="ctrl-ShelfNo"  value="<?php  echo $this->set_field_value('ShelfNo',""); ?>" type="text" placeholder="Enter Shelfno"  required="" name="ShelfNo"  class="form-control " />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group form-submit-btn-holder text-center mt-3">
                                                                                    <div class="form-ajax-status"></div>
                                                                                    <button class="btn btn-primary" type="submit">
                                                                                        Submit
                                                                                        <i class="fa fa-send"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
