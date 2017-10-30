let sm = Ext.create('Ext.selection.CheckboxModel');

Ext.define('Application.view.contact.Grid', {
	extend: 'Ext.grid.Panel',
	alias: 'widget.contactGrid',
	itemId: 'contactGrid',
	xtype: 'contactGrid',
	store: 'Contacts',
	selModel: sm,
	columns: [
		/*{
			xtype: 'checkcolumn',
			width: 60,
			editor: {
				xtype: 'checkbox',
				cls: 'x-grid-checkheader-editor',
			},
		},*/
		{ text: 'Id', dataIndex: 'id', flex: 1, hidden: true },
		{ text: 'Nombre', dataIndex: 'name', flex: 2, menuDisabled: true },
		{ text: 'Idenificación', dataIndex: 'identification', flex: 1, menuDisabled: true },
		{ text: 'Teléfono 1', dataIndex: 'phonePrimary', flex: 1, menuDisabled: true },
		{ text: 'Observaciones', dataIndex: 'observations', flex: 1, menuDisabled: true },
		{
			xtype: 'actioncolumn',
			width: 50,
			text: 'Acciones',
			align: 'center',
			flex: 1,
			menuDisabled: true,
			items: [
				{
					icon   : 'https://cdn1.alegra.com/images/icons/zoom.png',
					tooltip: 'Visualizar',
					renderer: function(value) {
          	return Ext.String.format('<a href="mailto:{0}">{1}</a>', value, value);
        	}
				},
				{
					icon   : 'https://cdn1.alegra.com/images/icons/page_edit.png',
					tooltip: 'Editar',
					handler: function(grid, rowIndex, colIndex) {
						let rec = grid.getStore().getAt(rowIndex);
						// location.href = 'index/edit';
					},
				},
			],
		},
	],
	dockedItems: [
		{
			xtype: 'toolbar',
			dock: 'top',
			items: [
				{
					xtype: 'button',
					text: 'Nuevo Contacto',
				 	iconCls: 'add',
				 	action: 'showAdd'
				},
				{
					text: 'Eliminar Contacto',
					iconCls: 'delete',
					action: 'delete'
				},
				{
					text: 'Editar Contacto',
					iconCls: 'edit',
					action: 'edit'
				},
				{
					text: 'Ver detalle',
					iconCls: 'zoom',
					action: 'show'
				}
			],
		},
		{
			xtype: 'pagingtoolbar',
			store: 'Contacts',
			displayInfo: true,
			dock: 'bottom',
		},
	],
});
