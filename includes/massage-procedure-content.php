<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
class MASSAGE_PROCEDURE_CONTENT
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'add_adition_service_sub']);
    }
    public function add_adition_service_sub()
    {
        add_submenu_page(
            'edit.php?post_type=massage',
            'Massage Procedure',
            'Massage Procedure',
            'manage_options',
            'massage-procedure',
            [$this, 'massage_procedure_page']
        );
    }
    public function my_custom_subpage_content()
    { ?>
        <div class="wrap">
            <div>
                <h1>Additional Services Management</h1>
                <p>Configure additional services offered alongside your massage treatments. Add service titles and pricing to
                    display complementary services to your clients.</p>
            </div>
            <?php
            $cmb = new_cmb2_box([
                'id' => 'additional_services_options',
                'title' => 'Additional Services Settings',
                'object_types' => ['options-page'],
                'option_key' => 'additional_services_settings',
                'context' => 'normal',
                'priority' => 'high',
                'show_names' => true, // Show field names on the left
            ]);

            $service_group_id = $cmb->add_field(array(
                'id' => 'service_group',
                'type' => 'group',
                'repeatable' => true,
                'options' => array(
                    'group_title' => 'Additional Service {#}',
                    'add_button' => 'Add Another Service',
                    'remove_button' => 'Remove Service',
                    'closed' => true,
                    'sortable' => true,
                    'remove_confirm' => esc_html__('Are you sure you want to remove?', 'cmb2'),
                ),
            ));

            $cmb->add_group_field($service_group_id, array(
                'name' => 'Service Title',
                'desc' => 'Enter the service title.',
                'id' => 'title',
                'type' => 'text',
            ));
            $cmb->add_group_field($service_group_id, array(
                'name' => 'Service Price',
                'desc' => 'Enter the service price with currency (e.g., 500 CZK).',
                'id' => 'price',
                'type' => 'text_money',
                'before_field' => 'CZK',
            ));
            cmb2_metabox_form('additional_services_options', 'additional_services_settings');
            ?>
        </div>
        <?php

    }

    public function massage_procedure_page()
    { ?>
        <div class="wrap">
            <div>
                <h1>Massage Procedure Management</h1>
                <p>Configure the step-by-step procedure and details for your massage services.</p>
            </div>
            <?php
            $cmb = new_cmb2_box([
                'id' => 'massage_procedure_options',
                'title' => 'Massage Procedure Settings',
                'object_types' => ['options-page'],
                'option_key' => 'massage_procedure_settings',
                'context' => 'normal',
                'priority' => 'high',
                'show_names' => true,
            ]);

            $cmb->add_field(array(
                'name' => 'Procedure Title',
                'desc' => 'Enter the main title for the massage procedure.',
                'id' => 'procedure_title',
                'type' => 'text',
            ));

            $procedure_group_id = $cmb->add_field(array(
                'id' => 'procedure_steps',
                'type' => 'group',
                'repeatable' => true,
                'options' => array(
                    'group_title' => 'Procedure Step {#}',
                    'add_button' => 'Add Another Step',
                    'remove_button' => 'Remove Step',
                    'closed' => true,
                    'sortable' => true,
                    'remove_confirm' => esc_html__('Are you sure you want to remove?', 'cmb2'),
                ),
            ));

            $cmb->add_group_field($procedure_group_id, array(
                'name' => 'Image',
                'desc' => 'Upload an icon for this step.',
                'id' => 'image',
                'type' => 'file',
            ));

            $cmb->add_group_field($procedure_group_id, array(
                'name' => 'Step Description',
                'desc' => 'Enter the description for this step.',
                'id' => 'description',
                'type' => 'wysiwyg',
                'options' => array(
                    'textarea_rows' => 8,
                ),
            ));

            cmb2_metabox_form('massage_procedure_options', 'massage_procedure_settings');
            ?>
        </div>
        <?php
    }
}