<?php $this->load->view('project_officer/common/header'); ?>
<style>
    .red-border {
        border: 1px solid red !important;
    }

    /* .modal {
        display: none;
        position: fixed;
        padding-top: 100px;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        overflow: auto;
        z-index: 9999;
    } */

    th {
        color: black;
        font-size: smaller;
        white-space: nowrap;
        padding: 4px !important;
    }

    td {
        color: black;
        font-size: smaller;
        white-space: nowrap;
        padding: 4px !important;
    }

    /* input {
        border: 1px solid lightgray;
        height: 20px;
        width: 80px !important
    } */

    /* select {
        border: 1px solid lightgray;
        height: 25px;
        width: 80px !important
    } */
</style>



<div class="container-fluid my-2">

    <div class="modal fade" id="update_record">
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
                                    <h1 class="h4">Update Record</h1>
                                </div>

                                <div class="card-body bg-custom3">
                                    <form class="form-group user" role="form" method="post" id="edit_form" action="<?= base_url(); ?>Project_Officer/update_weapon_allocation_record">
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <h6>&nbsp;Officer Name:</h6>
                                            </div>
                                            <div class="col-sm-4">
                                                <h6>&nbsp;Weapon:</h6>
                                            </div>
                                            <div class="col-sm-4">
                                                <h6>&nbsp;Ammo:</h6>
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-4 mb-1">
                                                <input type="text" class="form-control form-control-user" style="font-size:large;font-weight:bolder" name="officer_name_update" id="officer_name_update" placeholder="Enter Officer Name" disabled>
                                            </div>
                                            <div class="col-sm-4 mb-1">
                                                <select name="select_weapon_update" class="form-control form-control-user" id="select_weapon_update" data-placeholder="Select Weapon" style="padding: 10px;height: 50px;">
                                                    <option value="">Select Weapon</option>
                                                    <?php foreach ($weapon_records as $data) { ?>
                                                        <option class="form-control form-control-user" value="<?= $data['id'] ?>"><?= $data['weapon_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-2 mb-1" style="display:none">
                                                <input type="text" name="id_update" id="id_update">
                                            </div>
                                            <div class="col-sm-4 mb-1">
                                                <input type="text" class="form-control form-control-user" name="ammo_update" id="ammo_update" placeholder="Weapon Type">
                                            </div>


                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <h6>&nbsp;Issue Time:</h6>
                                            </div>
                                            <div class="col-sm-4">
                                                <h6>&nbsp;Submit Time:</h6>
                                            </div>
                                            <div class="col-sm-4">
                                                <h6>&nbsp;Maintained On:</h6>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-4 mb-1">
                                                <input type="datetime-local" class="form-control form-control-user" name="issue_time_update" id="issue_time_update" placeholder="Enter Code">
                                            </div>
                                            <div class="col-sm-4 mb-1">
                                                <input type="datetime-local" class="form-control form-control-user" name="submit_time_update" id="submit_time_update" placeholder="Enter Date">
                                            </div>
                                            <div class="col-sm-4 mb-1">
                                                <input type="date" class="form-control form-control-user" name="maintained_on_update" id="maintained_on_update" placeholder="Enter Date">
                                            </div>

                                        </div>

                                        <br>

                                        <div class="form-group row justify-content-center">
                                            <div class="col-sm-4">
                                                <button type="button" class="btn btn-primary btn-user btn-block" id="update_btn">
                                                    <!-- <i class="fab fa-google fa-fw"></i>  -->
                                                    Update Record
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

    <div class="form-group row justify-content-center">
        <div class="col-lg-12">
            <h1 style="text-align:center; padding:20px"><strong>Weapon Allocation Register</strong></h1>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="event_alert" class="alert alert-success" role="alert" style="display:none">
            Task Scheduled successfully!!
        </div>
    </div>
    <div class="col-lg-12">
        <div id="event_alert_danger" class="alert alert-danger" role="alert" style="display:none">
            No Weapon Allocated against this barcode!!
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between">
        <h1 id="hide_empty_space" class="h3 mb-0 text-black-800"></h1>
        <input id="return_barcode" style="display:none; border: 1px solid black; border-radius:5px; height: 20px; width: 160px !important" placeholder="Scan Barcode">
        <a id="btn_return_weapon" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="#" style="margin-block-end: 10px; "><i class="fas fa-undo"></i> Return Weapon</a>
    </div>
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header bg-custom1">
                    <h1 class="h4">Record Entry Sheet</h1>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">S.No.</th>
                            <th scope="col" style="width:5px !important">P.NO./O.NO</th>
                            <th scope="col">Name</th>
                            <th scope="col">Rank/Rate</th>
                            <th scope="col">Weapon Barcode</th>
                            <th scope="col">Weapon</th>
                            <th scope="col">Ammo</th>
                            <th scope="col">Issued by</th>
                            <th scope="col">Issue Time</th>
                            <th scope="col">Submit Time</th>
                            <th scope="col">Maintained On</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="table_rows_records">
                        <?php $count = 1;
                        if (count($weapon_allocation_records) > 0) {
                            foreach ($weapon_allocation_records as $data) {
                                $count++; ?>
                                <tr>
                                    <td scope="row"><?= $data['id']; ?></td>
                                    <td scope="row" style="width:5px"><?= $data['p_no']; ?></td>
                                    <td scope="row"><?= $data['name']; ?></td>
                                    <td scope="row"><?= $data['rank']; ?></td>
                                    <td scope="row"><?= $data['weapon_barcode']; ?></td>
                                    <td scope="row"><?= $data['weapon_name']; ?></td>
                                    <td scope="row"><?= $data['magazine_provided']; ?></td>
                                    <td scope="row"><?= $data['issued_by']; ?></td>
                                    <td scope="row"><?= $data['start_time']; ?></td>
                                    <td scope="row"><?= $data['end_time']; ?></td>
                                    <td scope="row"><?= $data['maintain_on']; ?></td>
                                    <td scope="row" type="button"><i style="margin-left: 10px; font-size:small;" id="edit" class="fas fa-edit" data-toggle="modal" data-target="#update_record"></i></td>
                                    <td scope="row" style="display:none"><?= $data['weapon_id']; ?></td>
                                </tr>
                        <?php }
                        }  ?>
                        <tr>
                            <td scope="row"><?php echo $count; ?></td>
                            <td><input id="p_no" style="border: 1px solid lightgray; height: 20px; width: 60px !important"></td>
                            <td id="officer_id" style="display:none"></td>
                            <td id="name"></td>
                            <td id="rank"></td>
                            <td><input id="barcode" style="display:none; border: 1px solid lightgray; height: 20px; width: 100px !important"></td>
                            <td id="weapon" style="display:none"><select name="select_weapon" id="select_weapon" data-placeholder="Select Weapon" style="border: 1px solid lightgray; height: 20px; width: 80px !important;font-size:small">
                                    <option value="">Select Weapon</option>
                                    <?php foreach ($weapon_records as $data) { ?>
                                        <option class="form-control form-control-user" style="font-size:small" value="<?= $data['id'] ?>"><?= $data['weapon_name'] ?></option>
                                    <?php } ?>
                                </select></td>
                            <td><input id="ammo" style="display:none; border: 1px solid lightgray; height: 20px; width: 40px !important"></td>
                            <td id="issue_by"></td>
                            <td><input id="start_time" type="datetime-local" style="display:none; width:140px !important; border: 1px solid lightgray; height: 20px;"></td>
                            <td><input id="end_time" type="datetime-local" style="display:none; width:140px !important; border: 1px solid lightgray; height: 20px;"></td>
                            <td><input id="maintain_on" type="date" style="display:none; width:100px !important; border: 1px solid lightgray; height: 20px;"></td>
                            <td type="button"><i style="margin-left: 10px; font-size:larger; display:none" id="save" class="fas fa-save"></i></td>
                            <div class="col-sm-3 mb-1" style="display:none">
                                <input class="form-control form-control-user" name="record_type" id="record_type">
                            </div>
                        </tr>

                    </tbody>
                </table>

            </div>

        </div>
        <!-- </div> -->


    </div>

</div>

</div>

<?php $this->load->view('common/footer'); ?>
<script>
    function seen(data) {
        // alert('in');
        // alert(data);
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


    $('#p_no').on('focusout change keyup', function() {
        var validate = 0;
        var p_no = $('#p_no').val();

        $.ajax({
            url: '<?= base_url(); ?>Project_Officer/search_officer_for_allocation',
            method: 'POST',
            data: {
                'p_no': p_no
            },
            success: function(data) {
                var result = jQuery.parseJSON(data);

                if (result != undefined) {
                    $('#search_cadet').show();
                    $('#no_data').hide();


                    $('#name').html(result['officer']['name']);
                    $('#officer_id').html(result['officer']['id']);
                    $('#rank').html(result['officer']['rank']);
                    $('#branch').html(result['officer']['branch']);
                    $('#issue_by').html(result['user']);
                    $('#record_type').val("New"); //To Save New Record

                    $('#weapon').show();
                    $('#ammo').show();
                    $('#issue_by').show();
                    $('#start_time').show();
                    $('#end_time').show();
                    $('#maintain_on').show();
                    $('#save').show();
                    $('#barcode').show();

                } else {
                    $('#no_data').show();
                    $('#search_cadet').hide();
                }
            },
            async: true
        });
    });

    $('#barcode').on('change keyup', function() {
        var barcode = $('#barcode').val();
        $('#show_error_new').hide();

        $.ajax({
            url: '<?= base_url(); ?>Project_Officer/search_weapon_for_allocation_barcode',
            method: 'POST',
            data: {
                'barcode': barcode
            },
            success: function(data) {
                var result = jQuery.parseJSON(data);

                if (result != undefined) {
                    $('#search_cadet').show();
                    $('#no_data').hide();

                    $('#maintain_on').val(result['weapon']['maintenance_on']);
                    $('#select_weapon').val(result['weapon']['id']);
                    $('#select_weapon').attr("readonly", "readonly");

                    const dateObj = new Date();
                    let year = dateObj.getFullYear();
                    let month = dateObj.getMonth() + 1;
                    month = ('0' + month).slice(-2);

                    let date = dateObj.getDate();
                    date = ('0' + date).slice(-2);

                    let hour = dateObj.getHours();
                    hour = ('0' + hour).slice(-2);

                    let minute = dateObj.getMinutes();
                    minute = ('0' + minute).slice(-2);

                    let second = dateObj.getSeconds();
                    second = ('0' + second).slice(-2);
                    $('#start_time').val(`${year}-${month}-${date}T${hour}:${minute}:${second}`);

                } else {
                    $('#no_data').show();
                    $('#search_cadet').hide();

                }

            },
            async: true
        });
    });

    $('#return_barcode').on('change keyup', function() {
        var return_barcode = $('#return_barcode').val();
        // alert(return_barcode);
        $.ajax({
            url: '<?= base_url(); ?>Project_Officer/get_weapon_allocation_record',
            method: 'POST',
            data: {
                'barcode': return_barcode
            },
            success: function(data) {
                var result = jQuery.parseJSON(data);

                // if (result != undefined) {
                if (result['weapon_exist'] != null) {

                    $('#search_cadet').show();
                    $('#no_data').hide();

                    $('#weapon').show();
                    $('#ammo').show();
                    $('#issue_by').show();
                    $('#start_time').show();
                    $('#end_time').show();
                    $('#maintain_on').show();
                    $('#save').show();
                    $('#barcode').show();

                    // alert(result['weapon_exist']['weapon_barcode']);

                    $('#p_no').val(result['weapon_exist']['p_no']);
                    $('#name').html(result['weapon_exist']['name']);
                    $('#officer_id').html(result['weapon_exist']['officer_id']);
                    $('#rank').html(result['weapon_exist']['rank']);
                    $('#select_weapon').val(result['weapon_exist']['weapon_id']);
                    $('#issue_by').html(result['weapon_exist']['issued_by']);
                    $('#barcode').val(result['weapon_exist']['weapon_barcode']);
                    $('#record_type').val("Old"); //To Update the record

                    var date_part = result['weapon_exist']['start_time'].substring(0, 10);
                    var time_part = result['weapon_exist']['start_time'].substring(11, 16);
                    $('#start_time').val(date_part + "T" + time_part);

                    $('#ammo').val(result['weapon_exist']['magazine_provided']);
                    $('#maintain_on').val(result['weapon_exist']['maintain_on']);

                    const dateObj = new Date();
                    let year = dateObj.getFullYear();
                    let month = dateObj.getMonth() + 1;
                    month = ('0' + month).slice(-2);

                    let date = dateObj.getDate();
                    date = ('0' + date).slice(-2);

                    let hour = dateObj.getHours();
                    hour = ('0' + hour).slice(-2);

                    let minute = dateObj.getMinutes();
                    minute = ('0' + minute).slice(-2);

                    let second = dateObj.getSeconds();
                    second = ('0' + second).slice(-2);
                    $('#end_time').val(`${year}-${month}-${date}T${hour}:${minute}:${second}`);
                } else {
                    $('#record_type').val("New"); //To Save New Record
                    $('#event_alert_danger').show();
                    setTimeout(function() {
                        $('.alert').hide();
                    }, 2000);
                }

                // } else {



                // }

            },
            async: true
        });
    });

    $('#select_weapon').on('change', function() {
        var validate = 0;
        var weapon_id = $('#select_weapon').val();

        if (weapon_id == '') {
            validate = 1;
            $('#select_weapon').addClass('red-border');
        }

        if (validate == 0) {
            $('#show_error_new').hide();

            $.ajax({
                url: '<?= base_url(); ?>Project_Officer/search_weapon_for_allocation',
                method: 'POST',
                data: {
                    'weapon_id': weapon_id
                },
                success: function(data) {
                    var result = jQuery.parseJSON(data);

                    if (result != undefined) {
                        $('#search_cadet').show();
                        $('#no_data').hide();

                        $('#maintain_on').val(result['weapon']['maintenance_on']);

                    } else {
                        $('#no_data').show();
                        $('#search_cadet').hide();

                    }

                },
                async: true
            });

        } else {
            $('#add_btn').removeAttr('disabled');
            $('#show_error_new').show();
        }

    });

    $('#update_btn').on('click', function() {
        var validate = 0;
        var select_weapon = $('#select_weapon_update').val();
        var weapon_name = $('#select_weapon_update').html();
        var ammo = $('#ammo_update').val();
        var issue_time = $('#issue_time_update').val();
        // var submit_time = $('#submit_time_update').val();
        var maintain_on = $('#maintained_on_update').val();

        if (select_weapon == '') {
            validate = 1;
            $('#select_weapon_update').addClass('red-border');
        }
        if (ammo == '') {
            validate = 1;
            $('#ammo_update').addClass('red-border');
        }
        if (issue_time == '') {
            validate = 1;
            $('#issue_time_update').addClass('red-border');
        }
        // if (submit_time == '') {
        //     validate = 1;
        //     $('#submit_time_update').addClass('red-border');
        // }
        if (maintain_on == '') {
            validate = 1;
            $('#maintained_on_update').addClass('red-border');
        }

        if (validate == 0) {
            $('#edit_form')[0].submit();
            $('#show_error_update').hide();
        } else {
            $('#update_btn').removeAttr('disabled');
            $('#show_error_update').show();
        }
    });

    $('#btn_return_weapon').on('click', function() {

        $('#hide_empty_space').hide();
        $('#return_barcode').show();

        var dt = new Date();
        var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();

        var date = Date($.now());
        // alert(abc);
        var date_part = date.substring(0, 10);
        var time_part = date.substring(11, 16);
        // $('#start_time').val(date_part + "T" + time_part);
        // alert(date_part + "T" + time_part);
    });


    $('#save').on('click', function() {
        var validate = 0;
        var select_weapon = $('#select_weapon').val();
        var weapon_name = $('#select_weapon').html();
        var officer_id = $('#officer_id').html();
        var ammo = $('#ammo').val();
        var issue_by = $('#issue_by').html();
        var start_time = $('#start_time').val();
        var return_time = $('#end_time').val();
        var maintain_on = $('#maintain_on').val();
        var record_type = $('#record_type').val();

        var rank = $('#rank').html();
        var name = $('#name').html();
        var p_no = $('#p_no').val();

        if (select_weapon == '') {
            validate = 1;
            $('#select_weapon').addClass('red-border');
        }
        if (ammo == '') {
            validate = 1;
            $('#ammo').addClass('red-border');
        }
        if (issue_by == '') {
            validate = 1;
            $('#issue_by').addClass('red-border');
        }
        if (start_time == '') {
            validate = 1;
            $('#start_time').addClass('red-border');
        }

        if (validate == 0) {
            $.ajax({
                url: '<?= base_url(); ?>Project_Officer/save_weapon_allocation_excel',
                method: 'POST',
                data: {
                    'p_no': p_no,
                    'officer_id': officer_id,
                    'rank': rank,
                    'name': name,
                    'weapon_id': select_weapon,
                    'weapon_name': weapon_name,
                    'ammo': ammo,
                    'issue_by': issue_by,
                    'start_time': start_time,
                    'return_time': return_time,
                    'maintain_on': maintain_on,
                    'record_type': record_type
                },
                success: function(data) {
                    $('#event_alert').show();
                    setTimeout(function() {
                        $('.alert').hide();
                    }, 2000);

                    setTimeout(function() {
                        location.reload();
                    }, 2000);

                },
                async: false
            });

        } else {
            $('#save_btn').removeAttr('disabled');
            $('#show_error_save').show();
        }

    });

    $('#table_rows_records').find('tr').click(function(e) {
        var $columns = $(this).find('td');

        // $('#project_name_heading').html('<strong>' + $columns[1].innerHTML + '</strong>');
        // alert($columns[7].innerHTML);
        var date = moment($columns[7].innerHTML).format("YYYY-MM-DD");
        var time = moment($columns[7].innerHTML).format("HH:mm:ss");

        var date2 = moment($columns[8].innerHTML).format("YYYY-MM-DD");
        var time2 = moment($columns[8].innerHTML).format("HH:mm:ss");


        $('#id_update').val($columns[0].innerHTML);
        $('#officer_name_update').val($columns[2].innerHTML);
        $('#select_weapon_update').val($columns[11].innerHTML);
        $('#ammo_update').val($columns[5].innerHTML);
        $('#issue_time_update').val(date + 'T' + time);
        $('#submit_time_update').val(date2 + 'T' + time2);
        $('#maintained_on_update').val($columns[9].innerHTML);
    });
</script>