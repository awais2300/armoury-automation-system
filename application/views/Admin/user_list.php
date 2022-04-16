<?php $this->load->view('Admin/common/header'); ?>
<style>
    .red-border {
        border: 1px solid red !important;
    }
</style>

<div class="container">

    <div class="card o-hidden my-4 sborder-0 shadow-lg">
        <div class="card-body bg-custom3">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header bg-custom1">
                            <h1 class="h4 text-white">All Users</h1>
                        </div>

                        <div class="card-body bg-custom3">
                            <div id="table_div">
                                <?php if (count($users_list) > 0) { ?>
                                    <table id="datatable" class="table table-striped" style="color:black">
                                        <thead>
                                            <tr>
                                                <th scope="col">S. No.</th>
                                                <th scope="col">User Name</th>
                                                <th scope="col">Account Type</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table_rows">
                                            <?php $count = 0;
                                            foreach ($users_list as $data) { ?>
                                                <tr>
                                                    <td scope="row"><?= ++$count; ?></td>
                                                    <td scope="row"><?= $data['username']; ?></td>
                                                    <td scope="row"><?= $data['acct_type']; ?></td>
                                                    <td type="button" scope="row"><a type="button" class="btn btn-primary btn-user rounded-pill" href="<?= base_url(); ?>Admin/Delete_user/<?= $data['id'];?>"> Delete Account</a></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <a> No Data found </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

</div>
<?php $this->load->view('common/footer'); ?>
<script>
    $('#status').on('focusout', function() {
        var status = $('#status').val();

        if (status != "do") {
            $("#div").prop("disabled", true);
        } else {
            $("#div").prop("disabled", false);
        }
    });

    $('#add_btni').on('click', function() {
        //alert('javascript working');
        $('#add_btn').attr('disabled', true);
        var validate = 0;

        var username = $('#username').val();
        var password = $('#password').val();
        var status = $('#status').val();
        var div = $('#div').val();



        if (username == '') {
            validate = 1;
            $('#username').addClass('red-border');
        }
        if (password == '') {
            validate = 1;
            $('#password').addClass('red-border');
        }
        if (status == '') {
            validate = 1;
            $('#status').addClass('red-border');
        }
        if (div == '' && status == 'do') {
            validate = 1;
            $('#div').addClass('red-border');
        }

        if (validate == 0) {
            $('#add_form')[0].submit();
        } else {
            $('#add_btni').removeAttr('disabled');
        }
    });


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
</script>