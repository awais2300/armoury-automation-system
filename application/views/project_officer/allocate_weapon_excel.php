<?php $this->load->view('project_officer/common/header'); ?>
<style>
    .red-border {
        border: 1px solid red !important;
    }

    .modal {
        display: none;
        position: fixed;
        padding-top: 100px;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        overflow: auto;
        z-index: 9999;
    }

    th {
        color: black;
        font-size: smaller;
    }

    td {
        color: black;
        font-size: smaller;
    }

    input {
        border: 1px solid lightgray;
        height: 30px;
        width: 80px !important
    }

    select {
        border: 1px solid lightgray;
        height: 30px;
        width: 80px !important
    }
</style>

<div class="container-fluid my-2">

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

    <div class="card-body bg-custom3">
        <!-- Nested Row within Card Body -->
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
                                <th scope="col" style="width:10px !important">P No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Rank</th>
                                <!-- <th scope="col">Branch</th> -->
                                <th scope="col">Weapon</th>
                                <th scope="col">Ammo</th>
                                <th scope="col">Issue by</th>
                                <th scope="col">Start Time</th>
                                <th scope="col">End Time</th>
                                <th scope="col">Maintenance On</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1;
                            if (count($weapon_allocation_records) > 0) {
                                foreach ($weapon_allocation_records as $data) {
                                    $count++; ?>
                                    <tr>
                                        <td scope="row"><?= $data['id']; ?></td>
                                        <td scope="row"><?= $data['p_no']; ?></td>
                                        <td scope="row"><?= $data['name']; ?></td>
                                        <td scope="row"><?= $data['rank']; ?></td>
                                        <td scope="row"><?= $data['weapon_name']; ?></td>
                                        <td scope="row"><?= $data['magazine_provided']; ?></td>
                                        <td scope="row"><?= $data['issued_by']; ?></td>
                                        <td scope="row"><?= $data['start_time']; ?></td>
                                        <td scope="row"><?= $data['end_time']; ?></td>
                                        <td scope="row"><?= $data['maintain_on']; ?></td>
                                        <td type="button"><i style="margin-left: 10px; font-size:small;" id="edit" class="fas fa-edit"></i></td>

                                    </tr>
                            <?php }
                            }  ?>
                            <tr>
                                <td scope="row"><?php echo $count; ?></td>
                                <td><input id="p_no"></td>
                                <td id="officer_id" style="display:none"></td>
                                <td id="name"></td>
                                <td id="rank"></td>
                                <!-- <td id="branch"></td> -->
                                <td id="weapon" style="display:none"><select name="select_weapon" id="select_weapon" data-placeholder="Select Weapon">
                                        <option value="">Select Weapon</option>
                                        <?php foreach ($weapon_records as $data) { ?>
                                            <option class="form-control form-control-user" value="<?= $data['id'] ?>"><?= $data['weapon_name'] ?></option>
                                        <?php } ?>
                                    </select></td>
                                <td><input id="ammo" style="display:none"></td>
                                <td><input id="issue_by" style="display:none"></td>
                                <td><input id="start_time" type="datetime-local" style="display:none; width:120px !important"></td>
                                <td><input id="end_time" type="datetime-local" style="display:none; width:120px !important"></td>
                                <td><input id="maintain_on" type="date" style="display:none; width:120px !important"></td>
                                <td type="button"><i style="margin-left: 10px; font-size:larger; display:none" id="save" class="fas fa-save"></i></td>

                            </tr>

                        </tbody>
                    </table>

                </div>

            </div>
        </div>


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


    $('#p_no').on('focusout', function() {
        var validate = 0;
        var p_no = $('#p_no').val();

        if (p_no == '') {
            validate = 1;
            $('#p_no').addClass('red-border');
        }

        if (validate == 0) {
            // $('#add_form')[0].submit();
            $('#show_error_new').hide();

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

                        $('#weapon').show();
                        $('#ammo').show();
                        $('#issue_by').show();
                        $('#start_time').show();
                        $('#end_time').show();
                        $('#maintain_on').show();
                        $('#save').show();

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


    $('#save').on('click', function() {
        var validate = 0;
        var select_weapon = $('#select_weapon').val();
        var weapon_name = $('#select_weapon').html();
        var officer_id = $('#officer_id').html();
        var ammo = $('#ammo').val();
        var issue_by = $('#issue_by').val();
        var start_time = $('#start_time').val();
        var return_time = $('#end_time').val();
        var maintain_on = $('#maintain_on').val();

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
                    'maintain_on': maintain_on
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
</script>