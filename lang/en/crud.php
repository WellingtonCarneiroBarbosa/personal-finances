<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'workspaces' => [
        'name' => 'Workspaces',
        'index_title' => 'Workspaces List',
        'new_title' => 'New Workspace',
        'create_title' => 'Create Workspace',
        'edit_title' => 'Edit Workspace',
        'show_title' => 'Show Workspace',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'expense_categories' => [
        'name' => 'Expense Categories',
        'index_title' => 'ExpenseCategories List',
        'new_title' => 'New Expense category',
        'create_title' => 'Create ExpenseCategory',
        'edit_title' => 'Edit ExpenseCategory',
        'show_title' => 'Show ExpenseCategory',
        'inputs' => [
            'title' => 'Title',
            'workspace_id' => 'Workspace',
        ],
    ],

    'expenses' => [
        'name' => 'Expenses',
        'index_title' => 'Expenses List',
        'new_title' => 'New Expense',
        'create_title' => 'Create Expense',
        'edit_title' => 'Edit Expense',
        'show_title' => 'Show Expense',
        'inputs' => [
            'title' => 'Title',
            'cost' => 'Cost',
            'description' => 'Description',
            'expense_category_id' => 'Expense Category',
            'workspace_id' => 'Workspace',
        ],
    ],
];
