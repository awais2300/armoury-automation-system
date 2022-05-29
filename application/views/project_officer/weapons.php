<?php
$this->load->view('project_officer/common/header');
?>

<style>
    .red-border {
        border: 1px solid red !important;
    }
</style>

<div class="container">
 
    <div class="card o-hidden my-4 border-0 shadow-lg">
        <div class="modal fade" id="new_contractor">
            <!-- <div class="row"> -->
            <div class="modal-dialog modal-dialog-centered " style="margin-left: 300px;" role="document">
                <div class="modal-content bg-custom3" style="width:1000px;">
                    <div class="modal-header" style="width:1000px;">

                    </div>
                    <div class="card-body bg-custom3">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="card">
                                    <div class="card-header bg-custom1">
                                        <h1 class="h4">Add New Weapon</h1>
                                    </div>

                                    <div class="card-body bg-custom3">
                                        <form class="user" role="form" method="post" id="add_form" action="<?= base_url(); ?>Project_Officer/insert_weapon">
                                            <!-- <form class="user" role="form" method="post" id="add_form" action="barcode.php"> -->
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <h6>&nbsp;Weapon Name:</h6>
                                                </div>
                                                <div class="col-sm-3">
                                                    <h6>&nbsp;Weapon Type:</h6>
                                                </div>
                                                <div class="col-sm-3">
                                                    <h6>&nbsp;BarCode:</h6>
                                                </div>
                                                <div class="col-sm-3">
                                                    <h6>&nbsp;Maintenance On:</h6>
                                                </div>
                                                <!--   <div class="col-sm-3">
                                                    <h6>&nbsp;Generate/Print:</h6>
                                                </div> -->
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-3 mb-1">
                                                    <input type="text" class="form-control form-control-user" name="weapon_name" id="weapon_name" placeholder="Weapon Name">
                                                </div>
                                                <div class="col-sm-3 mb-1">
                                                    <input type="text" class="form-control form-control-user" name="weapon_type" id="weapon_type" placeholder="Weapon Type">
                                                </div>
                                                <div class="col-sm-3 mb-1">
                                                    <input type="text" class="form-control form-control-user" name="barcode" id="barcode" placeholder="Enter Code">
                                                </div>
                                                <div class="col-sm-3 mb-1">
                                                    <input type="date" class="form-control form-control-user" name="maintenance_on" id="maintenance_on" placeholder="Enter Date">
                                                </div>

                                                <!--  <div class="col-sm-3 mb-1"> -->
                                                <!-- <button type="button" class="btn btn-primary btn-user btn-block" id="generate_barcode" style="font-size:smaller" onclick="" location.href='<?php echo base_url(); ?>Project_Officer/generate_barcode/abc'"> -->
                                                <!--   <button type="button" class="btn btn-primary btn-user btn-block" id="generate_barcode" style="font-size:smaller" onclick="generateBarCode()">
                                                        Generate & Print BarCode
                                                    </button> -->
                                                <!--  </div> -->
                                            </div>

                                            <br>
                                            <hr>

                                            <div class="form-group row justify-content-center">
                                                <div class="col-sm-4">
                                                    <button type="button" class="btn btn-primary btn-user btn-block" id="add_btn">
                                                        <!-- <i class="fab fa-google fa-fw"></i>  -->
                                                        Submit Data
                                                    </button>
                                                    <span id="show_error_new" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors*</span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="edit_material">
            <!-- <div class="row"> -->
            <div class="modal-dialog modal-dialog-centered " style="margin-left: 370px;" role="document">
                <div class="modal-content bg-custom3" style="width:1000px;">
                    <div class="modal-header" style="width:1000px;">

                    </div>
                    <div class="card-body bg-custom3">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="card">
                                    <div class="card-header bg-custom1">
                                        <h1 class="h4">Edit Weapon</h1>
                                    </div>

                                    <div class="card-body bg-custom3">
                                        <form class="user" role="form" method="post" id="edit_form" action="<?= base_url(); ?>Project_Officer/edit_weapon">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <h3 id="weapon_name_heading"></h3>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3" style="display:none">
                                                    <h6>&nbsp;Weapon Name:</h6>
                                                </div>

                                                <div class="col-sm-3">
                                                    <h6>&nbsp;Weapon Type:</h6>
                                                </div>

                                                <div class="col-sm-3">
                                                    <h6>&nbsp;Barcode:</h6>
                                                </div>

                                                <div class="col-sm-3">
                                                    <h6>&nbsp;Availability:</h6>
                                                </div>

                                                <div class="col-sm-3">
                                                    <h6>&nbsp;Status:</h6>
                                                </div>

                                            </div>

                                            <div class="form-group row">

                                                <div class="col-sm-3 mb-1" style="display:none">
                                                    <input type="text" class="form-control form-control-user" name="id_edit" id="id_edit" placeholder="id" readonly="readonly" style="color:black; font-size:medium; background-color:lightgray; border:1px solid black;">
                                                </div>

                                                <div class="col-sm-3 mb-1" style="display:none">
                                                    <input type="text" class="form-control form-control-user" name="weapon_name_edit" id="weapon_name_edit" placeholder="Weapon Name">
                                                </div>

                                                <div class="col-sm-3 mb-1">
                                                    <input type="text" class="form-control form-control-user" name="weapon_type_edit" id="weapon_type_edit" placeholder="Weapon Type">
                                                </div>

                                                <div class="col-sm-3 mb-1">
                                                    <input type="text" class="form-control form-control-user" name="barcode_edit" id="barcode_edit" placeholder="Enter Barcode">
                                                </div>

                                                <div class="col-sm-3 mb-1">
                                                    <input type="text" class="form-control form-control-user" name="weapon_avail_edit" id="weapon_avail_edit" placeholder="Weapon Availibility">
                                                </div>

                                                <div class="col-sm-3 mb-1">
                                                    <input type="text" class="form-control form-control-user" name="weapon_status_edit" id="weapon_status_edit" placeholder="Weapon Status">
                                                </div>

                                            </div>

                                            <div class="form-group row justify-content-center">
                                                <div class="col-sm-4">
                                                    <button type="button" class="btn btn-primary btn-user btn-block" id="edit_btn">
                                                        <!-- <i class="fab fa-google fa-fw"></i>  -->
                                                        Update
                                                    </button>
                                                    <span id="show_error_update" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors*</span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button> -->
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="assigned_projects">
            <!-- <div class="row"> -->
            <div class="modal-dialog modal-dialog-centered " style="margin-left: 370px;" role="document">
                <div class="modal-content bg-custom3" style="width:1000px;">
                    <div class="modal-header" style="width:1000px;">

                    </div>
                    <div class="card-body bg-custom3">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="card">
                                    <div class="card-header bg-custom1">
                                        <h1 id="contractor_head" class="h4">Assigned Projects of </h1>
                                    </div>

                                    <div class="card-body bg-custom3">
                                        <form class="user" role="form" method="post" id="edit_form" action="<?= base_url(); ?>Project_Officer/edit_contractor">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <h3 id="contractor_heading"></h3>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <h4>List of Projects:</h4>
                                                    <br>
                                                </div>
                                                <div id="show_list" class="col-sm-12">

                                                </div>

                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="completed_projects">
            <!-- <div class="row"> -->
            <div class="modal-dialog modal-dialog-centered " style="margin-left: 370px;" role="document">
                <div class="modal-content bg-custom3" style="width:1000px;">
                    <div class="modal-header" style="width:1000px;">

                    </div>
                    <div class="card-body bg-custom3">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="card">
                                    <div class="card-header bg-custom1">
                                        <h1 id="contractor_head_completed" class="h4">Completed Projects of </h1>
                                    </div>

                                    <div class="card-body bg-custom3">
                                        <form class="user" role="form" method="post" id="edit_form" action="">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <h3 id="contractor_heading"></h3>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <h4>List of Projects:</h4>
                                                    <br>
                                                </div>
                                                <div id="show_list_completed" class="col-sm-12">

                                                </div>

                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body bg-custom3">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">

                    <div class="card bg-custom3">
                        <div class="card-header bg-custom1">
                            <h1 class="h4">Weapon Database</h1>
                        </div>

                        <div class="card-body">
                            <div id="table_div">
                                <?php if (count($weapon_records) > 0) { ?>
                                    <table id="datatable" class="table table-striped" style="color:black">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Weapon Name</th>
                                                <th scope="col">Weapon Type</th>
                                                <th scope="col">Barcode</th>
                                                <th scope="col" style="white-space: nowrap">Maintenance Date</th>
                                                <!-- <th scope="col">Status</th> -->
                                                <!-- <th scope="col">Assigned to Officer</th> -->
                                                <!-- <th scope="col">Completed Projects</th> -->
                                                <th scope="col">Edit Record</th>
                                                <th scope="col">Generate Barcode</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table_rows_cont">
                                            <?php $count = 0;
                                            foreach ($weapon_records as $data) { ?>
                                                <tr>
                                                    <td scope="row" id="cont<?= $count; ?>"><?= $data['id']; ?></td>
                                                    <td style="width:150px" scope="row"><?= $data['weapon_name']; ?></td>
                                                    <td class="quant" scope="row"><?= $data['weapon_type']; ?></td>
                                                    <td style="width:150px" scope="row"><?= $data['barcode']; ?></td>
                                                    <td style="width:150px" scope="row"><?= $data['maintenance_on']; ?></td>
                                                    <!-- <td scope="row"><?php if ($data['availability'] == 'Y') {
                                                                    //     echo "Yes";
                                                                    // } else {
                                                                    //     echo "No";
                                                                    }; ?></td> -->
                                                    <!-- <td style="width:150px" scope="row"><?= $data['status']; ?></td> -->
                                                    <!-- <td scope="row" id="assigned_officers<?= $count; ?>" style="text-align:center; background-color:darksalmon; cursor: pointer;" data-toggle="modal" data-target="#assigned_projects"><?= $data['Assigned_Projects']; ?></td> -->
                                                    <!-- <td scope="row" id="completed_project<?= $count; ?>" style="text-align:center; background-color:darksalmon; cursor: pointer;" data-toggle="modal" data-target="#completed_projects"><?= $data['Completed_Projects']; ?></td> -->
                                                    <td style="width:120px" type="button" id="edit<?= $data['id']; ?>" class="edit" scope="row" data-toggle="modal" data-target="#edit_material"><i style="margin-left: 40px;" class="fas fa-edit"></i></td>

                                                    <td> <button type="button" class="btn btn-primary btn-user rounded-pill" id="generate_barcode" style="font-size:smaller" onclick="generateBarCode(<?= $data['barcode'] ?>)">
                                                            Generate Barcode
                                                        </button></td>
                                                </tr>
                                            <?php
                                                $count++;
                                            } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <a> No Data Available yet </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <form class="user" role="form" method="post" id="add_form" action="">
                        <div class="form-group row my-2 justify-content-center">
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-primary btn-user btn-block" id="add_btn" data-toggle="modal" data-target="#new_contractor">
                                    <i class="fas fa-plus"></i>
                                    Add new Weapon
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</div>


<?php $this->load->view('common/footer'); ?>
<script src="<?= base_url('assets/js/chat/chat.js'); ?>"></script>

<script>
    window.onload = function() {
        $.ajax({
            url: '<?= base_url(); ?>Project_Officer/get_total_projects_assigned',
            method: 'POST',
            success: function(data) {

                var result = jQuery.parseJSON(data);
                $count = 0;
                $('#table_rows_cont > tr').each(function(index, tr) {
                    var cp = document.getElementById("assigned_project" + $count);
                    var cont_id = document.getElementById("cont" + $count);

                    for (var i in result) {
                        if (cont_id.innerHTML == result[i].contractor_id) {
                            cp.innerHTML = result[i].count;
                        }
                    }
                    $count++;
                });
            },
            async: true
        });

        $.ajax({
            url: '<?= base_url(); ?>Project_Officer/get_total_projects_completed',
            method: 'POST',
            success: function(data) {

                var result = jQuery.parseJSON(data);
                $count = 0;
                $('#table_rows_cont > tr').each(function(index, tr) {
                    var cp = document.getElementById("completed_project" + $count);
                    var cont_id = document.getElementById("cont" + $count);

                    for (var i in result) {
                        if (cont_id.innerHTML == result[i].contractor_id) {
                            cp.innerHTML = result[i].count;
                        }
                    }
                    $count++;
                });


            },
            async: true
        });

    }

    $('#add_btn').on('click', function() {
        //alert('javascript working');
        $('#add_btn').attr('disabled', true);
        var validate = 0;

        var weapon_name = $('#weapon_name').val();
        var weapon_type = $('#weapon_type').val();
        var barcode = $('#barcode').val();

        if (weapon_name == '') {
            validate = 1;
            $('#weapon_name').addClass('red-border');
        }
        if (weapon_type == '') {
            validate = 1;
            $('#weapon_type').addClass('red-border');
        }
        if (barcode == '') {
            validate = 1;
            $('#barcode').addClass('red-border');
        }

        if (validate == 0) {
            $('#add_form')[0].submit();
            $('#show_error_new').hide();
        } else {
            $('#add_btn').removeAttr('disabled');
            $('#show_error_new').show();
        }
    });

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    $('#edit_btn').on('click', function() {
        //alert('javascript working');
        $('#edit_btn').attr('disabled', true);
        var validate = 0;

        //  var material_name = $('#material_name_edit').val();
        var weapon_type_edit = $('#weapon_type_edit').val();
        var weapon_avail_edit = $('#weapon_avail_edit').val();
        var weapon_status_edit = $('#weapon_status_edit').val();
        var barcode_edit = $('#barcode_edit').val();

        if (weapon_type_edit == '') {
            validate = 1;
            $('#weapon_type_edit').addClass('red-border');
        }
        if (weapon_avail_edit == '') {
            validate = 1;
            $('#weapon_avail_edit').addClass('red-border');
        }
        if (weapon_status_edit == '') {
            validate = 1;
            $('#weapon_status_edit').addClass('red-border');
        }
        if (barcode_edit == '') {
            validate = 1;
            $('#barcode_edit').addClass('red-border');
        }

        if (validate == 0) {
            $('#edit_form')[0].submit();
            $('#show_error_update').hide();
        } else {
            $('#edit_btn').removeAttr('disabled');
            $('#show_error_update').show();
        }
    });

    function generateBarCode(barcode) {
        if (barcode != undefined) {
            location.href = '<?php echo base_url(); ?>Project_Officer/generate_barcode/' + barcode;
        } else {
            alert("Barcode not defined");
        }
    }

    $('#table_rows_cont').find('tr').click(function(e) {
        var $columns = $(this).find('td');

        $('#weapon_name_edit').val($columns[1].innerHTML);
        $('#weapon_name_heading').html('<strong>' + $columns[1].innerHTML + '</strong>');
        $('#id_edit').val($columns[0].innerHTML);
        $('#contractor_name').html($columns[1].innerHTML);
        $('#weapon_type_edit').val($columns[2].innerHTML);
        $('#barcode_edit').val($columns[3].innerHTML);
        $('#weapon_avail_edit').val($columns[4].innerHTML);
        $('#weapon_status_edit').val($columns[5].innerHTML);

        if ((e.target.id.substr(0, 16) == "assigned_project") || (e.target.id.substr(0, 17) == "completed_project")) {

            var status;
            if (e.target.id.substr(0, 16) == "assigned_project") {
                status = 'ALL';
            } else if (e.target.id.substr(0, 17) == "completed_project") {
                status = 'Completed';
            }

            $.ajax({
                url: '<?= base_url(); ?>Project_Officer/get_list_of_projects',
                method: 'POST',
                data: {
                    'contractor_id': $columns[0].innerHTML,
                    'status': status
                },
                success: function(data) {
                    var result = jQuery.parseJSON(data);

                    if (status == 'ALL') {
                        var plist = document.getElementById("show_list")
                        var innerhtml = "";
                        for (var i in result) {
                            innerhtml = innerhtml + `<li><strong><a style="color:black" href=<?php echo base_url(); ?>Project_Officer/overview/${result[i].ID}>${result[i].Name}</a></strong></li>`;
                        }

                        if (result.length != 0) {
                            plist.innerHTML = innerhtml;
                        } else {
                            plist.innerHTML = `<p>No projects Assigned</p>`;
                        }
                        $('#contractor_head').html("Assigned Projects of " + $columns[1].innerHTML);
                    } else {
                        var plistc = document.getElementById("show_list_completed")
                        var innerhtml = "";
                        for (var i in result) {
                            innerhtml = innerhtml + `<li><strong><a style="color:black" href=<?php echo base_url(); ?>Project_Officer/overview/${result[i].ID}>${result[i].Name}</a></strong></li>`;
                        }
                        if (result.length != 0) {
                            plistc.innerHTML = innerhtml;
                        } else {
                            plistc.innerHTML = `<p>No projects Completed</p>`;
                        }
                        $('#contractor_head_completed').html("Completed Projects of " + $columns[1].innerHTML);
                    }
                },
                async: true
            });
        }
    });
</script>

<script type="text/javascript">
    function seen(data) {
        alert('in');
        alert(data);
        // var receiver_id=$(this).attr('id');
        $.ajax({
            url: '<?= base_url(); ?>ChatController/seen',
            method: 'POST',
            data: {
                'id': data
            },
            success: function(data) {
                $('#notification').html(data);
            },
            async: true
        });
    }

    $('#notifications').focusout(function() {
        // alert('notification clicked');
        $.ajax({
            url: '<?= base_url(); ?>ChatController/activity_seen',
            success: function(data) {
                $('#notifications').html(data);
            },
            async: true
        });
    });
</script>