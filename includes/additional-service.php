<?php
class ADDITIONAL_SERVICE
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'add_adition_service_sub']);
    }
    public function add_adition_service_sub()
    {
        add_submenu_page(
            'edit.php?post_type=masseur',
            'Additional Services',
            'Additional Services',
            'manage_options',
            'additional-services',
            [$this, 'my_custom_subpage_content']
        );
    }
    public function my_custom_subpage_content()
    { ?>
        <div class="wrap">
            <div>
                <h1>Additional Services Management</h1>
                <p>Configure additional services offered alongside your massage treatments. Add service titles and pricing to display complementary services to your clients.</p>
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
}