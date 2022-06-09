<?php $this->load->view('Admin/common/header'); ?>
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
                                    <form class="form-group user" role="form" method="post" id="edit_form" action="<?= base_url(); ?>Admin/update_weapon_ammo_record">
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <h6>&nbsp;Weapon Name:</h6>
                                            </div>
                                            <div class="col-sm-4">
                                                <h6>&nbsp;Total Weapon:</h6>
                                            </div>
                                            <div class="col-sm-4">
                                                <h6>&nbsp;Total Ammo:</h6>
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-4 mb-1">
                                                <input type="text" class="form-control form-control-user" style="font-size:large;font-weight:bolder" name="weapon_name_update" id="weapon_name_update" placeholder="Enter Officer Name" disabled>
                                            </div>
                                            <div class="col-sm-4 mb-1">
                                                <input type="text" class="form-control form-control-user" name="total_weapon_update" id="total_weapon_update" placeholder="Weapon Type">
                                            </div>
                                            <div class="col-sm-2 mb-1" style="display:none">
                                                <input type="text" name="id_update" id="id_update">
                                            </div>
                                            <div class="col-sm-4 mb-1">
                                                <input type="text" class="form-control form-control-user" name="total_ammo_update" id="total_ammo_update" placeholder="Weapon Type">
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
            <h1 style="text-align:center; padding:20px"><strong>Total Weapons & Ammunation</strong></h1>
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

    
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header bg-custom1">
                    <h1 class="h4">Total Weapon & Ammo Record</h1>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">S.No.</th>
                            <th scope="col">Weapon Name</th>
                            <th scope="col">Total Weapon</th>
                            <th scope="col">Total Ammo</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="table_rows_records">
                        <?php $count = 1;
                        if (count($weapon_list) > 0) {
                            foreach ($weapon_list as $data) {
                                $count++; ?>
                                <tr>
                                    <td scope="row"><?= $data['id']; ?></td>
                                    <td scope="row"><?= $data['weapon_name']; ?></td>
                                    <td scope="row"><?= $data['total_weapon']; ?></td>
                                    <td scope="row"><?= $data['total_ammo']; ?></td>
                                    <td scope="row" type="button"><i style="margin-left: 10px; font-size:small;" id="edit" class="fas fa-edit" data-toggle="modal" data-target="#update_record"></i></td>
                                    <!-- <td scope="row" style="display:none"><?= $data['weapon_id']; ?></td> -->
                                </tr>
                        <?php }
                        }  ?>
                        <tr>
                            <td scope="row"><?php echo $count; ?></td>
                            <td><input id="weapon_name" style="border: 1px solid lightgray;"></td>
                            <td><input id="total_weapon" style="border: 1px solid lightgray;"></td>
                            <td><input id="total_ammo" style="border: 1px solid lightgray;"></td>
                            <td type="button"><i style="margin-left: 10px; font-size:larger;" id="save" class="fas fa-save"></i></td>
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



    $('#update_btn').on('click', function() {
        var validate = 0;
        
        var total_weapon_update = $('#total_weapon_update').val();
        var total_ammo_update = $('#total_ammo_update').val();


        if (total_weapon_update == '') {
            validate = 1;
            $('#total_weapon_update').addClass('red-border');
        }
        if (total_ammo_update == '') {
            validate = 1;
            $('#total_ammo_update').addClass('red-border');
        }

        if (validate == 0) {
            $('#edit_form')[0].submit();
            $('#show_error_update').hide();
        } else {
            $('#update_btn').removeAttr('disabled');
            $('#show_error_update').show();
        }
    });

    // $('#btn_return_weapon').on('click', function() {

    //     $('#hide_empty_space').hide();
    //     $('#return_barcode').show();

    //     var dt = new Date();
    //     var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();

    //     var date = Date($.now());
    //     // alert(abc);
    //     var date_part = date.substring(0, 10);
    //     var time_part = date.substring(11, 16);
    //     // $('#start_time').val(date_part + "T" + time_part);
    //     // alert(date_part + "T" + time_part);
    // });


    $('#save').on('click', function() {
        var validate = 0;
        var weapon_name = $('#weapon_name').val();
        var total_weapon = $('#total_weapon').val();
        var total_ammo = $('#total_ammo').val();

        if (weapon_name == '') {
            validate = 1;
            $('#weapon_name').addClass('red-border');
        }
        if (total_weapon == '') {
            validate = 1;
            $('#total_weapon').addClass('red-border');
        }
        if (total_ammo == '') {
            validate = 1;
            $('#total_ammo').addClass('red-border');
        }

        if (validate == 0) {
            $.ajax({
                url: '<?= base_url(); ?>Admin/save_weapon_ammo_record',
                method: 'POST',
                data: {
                    'weapon_name': weapon_name,
                    'total_weapon': total_weapon,
                    'total_ammo': total_ammo,
                    'record_type': "New"
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
        $('#id_update').val($columns[0].innerHTML);
        $('#weapon_name_update').val($columns[1].innerHTML);
        $('#total_weapon_update').val($columns[2].innerHTML);
        $('#total_ammo_update').val($columns[3].innerHTML);
    });
</script>