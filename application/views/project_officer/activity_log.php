<?php
$this->load->view('project_officer/common/header');
?>

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
        white-space: nowrap;
    }

    td {
        color: black;
        font-size: smaller;
        white-space: nowrap;
    }
</style>

<div class="container">
    <div class="card o-hidden my-4 border-0 shadow-lg">

        <div class="card-body bg-custom3">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header bg-custom1">
                            <h1 class="h4">Weapon Allocation logs</h1>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">S.No.</th>
                                    <th scope="col" style="width:10px !important">P.NO./O.NO</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Rank/Rate</th>
                                    <!-- <th scope="col">Branch</th> -->
                                    <th scope="col">Weapon</th>
                                    <th scope="col">Ammo</th>
                                    <th scope="col">Issued by</th>
                                    <th scope="col">Issue Time</th>
                                    <th scope="col">Submit Time</th>
                                    <th scope="col">Maintained On</th>
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
                                        </tr>
                                <?php }
                                }  ?>
                                

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>


        </div>

    </div>
</div>

</div>


<?php $this->load->view('common/footer'); ?>
<!-- <script src="<?= base_url('assets/js/chat/chat.js'); ?>"></script> -->


<script>
    window.onload = function() {

    }
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
<script type="text/javascript">
    function seen(data) {
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