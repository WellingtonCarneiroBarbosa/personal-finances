<?php

return [
    'common' => [
        'actions'         => 'Actions',
        'create'          => 'Create',
        'edit'            => 'Edit',
        'update'          => 'Update',
        'new'             => 'New',
        'cancel'          => 'Cancel',
        'attach'          => 'Attach',
        'detach'          => 'Detach',
        'save'            => 'Save',
        'delete'          => 'Delete',
        'cannot_delete'   => 'You can not delete :entity',
        'delete_selected' => 'Delete selected',
        'search'          => 'Search...',
        'back'            => 'Back to List',
        'are_you_sure'    => 'Are you sure?',
        'no_items_found'  => 'No items found',
        'created'         => 'Successfully created',
        'saved'           => 'Saved successfully',
        'removed'         => 'Successfully removed',
    ],

    'workspaces' => [
        'name'         => 'Workspaces',
        'index_title'  => 'Workspaces List',
        'new_title'    => 'New Workspace',
        'create_title' => 'Create Workspace',
        'edit_title'   => 'Edit Workspace',
        'show_title'   => 'Show Workspace',
        'inputs'       => [
            'name' => 'Name',
        ],
    ],

    'expense_categories' => [
        'name'         => 'Categories',
        'index_title'  => 'Categories List',
        'new_title'    => 'New category',
        'create_title' => 'Create Category',
        'edit_title'   => 'Edit Category',
        'show_title'   => 'Show Category',
        'inputs'       => [
            'name'        => 'Name',
        ],
    ],

    'expenses' => [
        'name'         => 'Expenses',
        'index_title'  => 'Expenses List',
        'new_title'    => 'New Expense',
        'create_title' => 'Register Expense',
        'edit_title'   => 'Edit Expense',
        'show_title'   => 'Show Expense',
        'inputs'       => [
            'title'               => 'Title',
            'cost'                => 'Cost',
            'description'         => 'Description',
            'expense_category_id' => 'Category',
        ],
    ],
];
