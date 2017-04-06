<tr>
    <td class="editable text" data-field="first_name"><?php echo $data->first_name ?></td>
    <td class="editable text" data-field="last_name"><?php echo $data->last_name ?></td>
    <td class="editable number" data-field="mobile"><?php echo $data->mobile ?></td>
    <td class="editable email" data-field="email"><?php echo $data->email ?></td>
    <td class="editable select" data-field="language_id"><?php echo $data->language ?></td>
    <td class="editable text date" data-field="dob"><?php echo $data->dob ?></td>
    <td>
        <button class="edit btn btn-primary" data-id="<?php echo $data->id ?>" data-toggle="tooltip" data-placement="top" title="Edit Person"><span class="glyphicon glyphicon-pencil"></span></button>
        <button class="save btn btn-success" style="display: none" data-id="<?php echo $data->id ?>" data-toggle="tooltip" data-placement="top" title="Save Changes"><span class="glyphicon glyphicon-ok"></span></button>
        <button class="cancel btn btn-danger" style="display: none" data-id="<?php echo $data->id ?>" data-toggle="tooltip" data-placement="top" title="Cancel Edit"><span class="glyphicon glyphicon-remove"></span></button>
        <img src="/img/ajax-loader.gif" class="loading" />
    </td>
    <td>
        <button class="delete btn btn-danger" data-id="<?php echo $data->id ?>" data-toggle="tooltip" data-placement="top" title="Delete this person"><span class="glyphicon glyphicon-trash"></span></button>
    </td>
</tr>
