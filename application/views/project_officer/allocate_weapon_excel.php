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
    }
    input {
        border: 1px solid lightgray;
        height: 30px;
    }
</style>

<div class="container-fluid my-2">

    <div class="form-group row justify-content-center">
        <div class="col-lg-1">

        </div>
        <div class="col-lg-11">
            <h1 style="text-align:center; padding:40px"><strong>Allocate/De-Allocate Weapon</strong></h1>
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
                                <th scope="col">P No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Rank</th>
                                <th scope="col">Branch</th>
                                <th scope="col">Select Weapon</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($weapon_allocation_records) > 0) {
                                $count = 1;
                                foreach ($weapon_allocation_records as $data) { ?>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td><input></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php
                                    $count++;
                                }
                            } else { ?>
                                <tr>
                                    <th scope="row">1</th>
                                    <td><input id="p_no"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            <?php } ?>
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


    $('#add_btn').on('click', function() {
        var validate = 0;
        var p_no = $('#p_number').val();

        if (p_no == '') {
            validate = 1;
            $('#p_number').addClass('red-border');
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

                        $('#name').val(result['officer']['name']);
                        $('#rank').val(result['officer']['rank']);
                        $('#branch').val(result['officer']['branch']);
                        $('#oc_num').val(result['officer']['p_no']);
                        $('#id').val(result['officer']['id']);

                        if (result['exist'] != null) {
                            $('#select_weapon').val(result['exist']['weapon_id']);
                            $('#record_type').val("Old");
                            $('#weapon_id').val(result['exist']['weapon_id']);
                            $('#show_status').html("<p style='color:green'>Status: <strong>" + result['exist']['status'] + "</strong></p>");
                            $('#select_weapon').attr("disabled", true);
                            $('#mag_count').val(result['exist']['magazine_provided']);
                            document.getElementById('mag_count').readOnly = true;

                            var date_part = result['exist']['start_time'].substring(0, 10);
                            var time_part = result['exist']['start_time'].substring(11, 16);
                            $('#start_time').val(date_part + "T" + time_part);

                            document.getElementById('start_time').readOnly = true;
                            $('#return_time').val(result['exist']['end_time']);

                            $('#save_btn').html("Update");
                        } else {
                            $('#record_type').val("New");
                        }

                        // var dt = new Date();
                        // var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
                        // $('#start_time').val(time);
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


    $('#save_btn').on('click', function() {
        $('#save_btn').attr('disabled', true);
        var validate = 0;
        var select_weapon = $('#select_weapon').val();
        var mag_count = $('#mag_count').val();
        var start_time = $('#start_time').val();
        var return_time = $('#return_time').val();


        if (select_weapon == '') {
            validate = 1;
            $('#select_weapon').addClass('red-border');
        }
        if (mag_count == '') {
            validate = 1;
            $('#mag_count').addClass('red-border');
        }
        if (start_time == '') {
            validate = 1;
            $('#start_time').addClass('red-border');
        }

        if (validate == 0) {
            $('#save_form')[0].submit();
            $('#show_error_save').hide();

        } else {
            $('#save_btn').removeAttr('disabled');
            $('#show_error_save').show();
        }
    });

    $('#p_no').on('focusout', function() {
        $p_no = $('#p_no').val();
        alert($p_no);
    });
</script>