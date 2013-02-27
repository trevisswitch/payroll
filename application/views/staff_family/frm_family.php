<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/application.css"/>
    </head>

    <body>
        <?php echo form_open($form_action) . form_hidden('id', $id); ?>
        <table>
            <tr>
                <td>staff_fam_staff_id</td>
                <td><?php echo form_input($staff_fam_staff_id); ?></td>
            </tr>
            <tr>
                <td>staff_fam_order</td>
                <td><?php echo form_input($staff_fam_order); ?></td>
            </tr>
            <tr>
                <td>staff_fam_name</td>
                <td><?php echo form_input($staff_fam_name); ?></td>
            </tr>
            <tr>
                <td>staff_fam_bithdate</td>
                <td><?php echo form_input($staff_fam_bithdate); ?></td>
            </tr>
            <tr>
                <td>staff_fam_birthplace</td>
                <td><?php echo form_input($staff_fam_birthplace); ?></td>
            </tr>
            <tr>
                <td>staff_fam_sex</td>
                <td><?php echo $staff_fam_sex; ?></td>
            </tr>
            <tr>
                <td>staff_fam_relation</td>
                <td><?php echo $staff_fam_relation; ?></td>
            </tr>
            <tr>
                <td></td>
                <td><?php echo form_submit($btn_save); ?></td>
            </tr>
        </table>     

        <?php echo form_close() ?>
        <br>
        <?php echo $link_back; ?>
    </body>

</html>
