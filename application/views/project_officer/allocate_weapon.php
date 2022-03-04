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
                        <h1 class="h4">Search Officer</h1>
                    </div>

                    <div class="card-body bg-custom3">
                        <form class="user" role="form" method="post" id="add_form" action="">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <h6>&nbsp;Enter P No:</h6>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4 mb-1">
                                    <input type="text" class="form-control form-control-user" name="p_number" id="p_number" placeholder="P Number">
                                </div>

                                <div class="col-sm-2 mb-1">
                                    <button type="button" class="btn btn-primary btn-user btn-block" id="add_btn">
                                        <!-- <i class="fab fa-google fa-fw"></i>   -->
                                        Search
                                    </button>
                                    <span id="show_error_new" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors*</span>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div id="search_cadet" class="row my-2" style="display:none">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header bg-custom1">
                        <h1 class="h4">Officer's Information</h1>
                    </div>

                    <div class="card-body bg-custom3">
                        <form class="user" role="form" method="post" id="save_form" action="<?= base_url(); ?>Project_Officer/save_cadet_observation">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <h6>&nbsp;Name:</h6>
                                </div>

                                <div class="col-sm-4">
                                    <h6>&nbsp;Rank:</h6>
                                </div>

                                <div class="col-sm-4">
                                    <h6>&nbsp;Branch:</h6>
                                </div>

                            </div>
                            <div class="form-group row">

                                <div class="col-sm-4 mb-1" style="display:none">
                                    <input type="text" class="" name="oc_num" id="oc_num">
                                </div>
                                <div class="col-sm-4 mb-1" style="display:none">
                                    <input type="text" class="" name="id" id="id">
                                </div>

                                <div class="col-sm-4 mb-1">
                                    <input type="text" class="form-control form-control-user" name="name" id="name" style="font-weight: bold; font-size:large" placeholder="Name" readonly>
                                </div>
                                <div class="col-sm-4 mb-1">
                                    <input type="text" class="form-control form-control-user" name="term" id="term" style="font-weight: bold; font-size:large" placeholder="Term" readonly>
                                </div>
                                <div class="col-sm-4 mb-1">
                                    <input type="text" class="form-control form-control-user" name="division" id="division" style="font-weight: bold; font-size:large" placeholder="Division" readonly>
                                </div>

                            </div>
                            <hr>
                            <div style="border:4px solid grey; padding:10px; border-radius:25px">
                            <h3 style="text-align:center; text-decoration:underline; padding:10px"><strong>Weapon Allocation Form</strong></h3>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <h6>&nbsp;Select Weapon:</h6>
                                    </div>
                                    <div class="col-sm-3">
                                        <h6>&nbsp;No. of Magazines Allocated:</h6>
                                    </div>
                                    <div class="col-sm-3">
                                        <h6>&nbsp;Start Time:</h6>
                                    </div>
                                    <div class="col-sm-3">
                                        <h6>&nbsp;Return Time:</h6>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-1">
                                        <select class="form-control form-control-user" name="observation" id="observation" placeholder="Add Observation"></select>
                                    </div>
                                    <div class="col-sm-3 mb-1">
                                        <input class="form-control form-control-user" name="mag_count" id="mag_count" placeholder="No. of Magazines">
                                    </div>
                                    <div class="col-sm-3 mb-1">
                                        <input class="form-control form-control-user" name="start_time" id="start_time" placeholder="Start Time">
                                    </div>
                                    <div class="col-sm-3 mb-1">
                                        <input class="form-control form-control-user" name="return_time" id="return_time" placeholder="Return Time">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row justify-content-center" style="padding:10px">
                                <div class="col-sm-4">
                                    <button type="button" class="btn btn-primary btn-user btn-block" id="save_btn">
                                        <!-- <i class="fab fa-google fa-fw"></i>   -->
                                        save
                                    </button>
                                    <span id="show_error_save" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors*</span>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>


            </div>
        </div>

        <div id="no_data" class="row my-2" style="display:none">
            <div class="col-lg-12 my-5">

                <h4 style="color:red">No Officer Found. Please check the P Number entered</h4>

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

                        $('#name').val(result['name']);
                        $('#term').val(result['rank']);
                        $('#division').val(result['branch']);
                        $('#oc_num').val(result['p_no']);
                        $('#id').val(result['id']);
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
        var observation = $('#observation').val();


        if (observation == '') {
            validate = 1;
            $('#observation').addClass('red-border');
        }

        if (validate == 0) {
            $('#save_form')[0].submit();
            $('#show_error_save').hide();

        } else {
            $('#save_btn').removeAttr('disabled');
            $('#show_error_save').show();
        }
    });
</script>