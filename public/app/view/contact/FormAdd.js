Ext.define('Application.view.contact.FormAdd', {
	extend: 'Ext.form.Panel',
	//requires: [ 'Ext.form.Field',
	//	'Ext.window.Window',
	//	'Ext.ux.statusbar.StatusBar',
	//],
	alias: 'widget.formAdd',
	layout: 'anchor',
	iconCls: 'icon-user',
	title: '',
	renderTo: Ext.getBody(),
	defaultType: 'textfield',
	items: [
		{ xtype: 'hiddenfield', name: 'id' },
		{	xtype: 'textfield', name: 'name', fieldLabel: 'Nombre', allowBlank: false },
		{ xtype: 'textfield', name: 'identification', fieldLabel: 'Identificación', allowBlank: true },
		{ xtype: 'textfield', name: 'phonePrimary', fieldLabel: 'Teléfono 1', allowBlank: true },
		{ xtype: 'textfield', name: 'email', fieldLabel: 'Email', allowBlank: true },
		{ xtype: 'textfield', name: 'phoneSecondary', fieldLabel: 'Teléfono 2', allowBlank: true },
		{ xtype: 'textfield', name: 'fax', fieldLabel: 'Fax', allowBlank: true },
		{ xtype: 'textfield', name: 'mobile', fieldLabel: 'Número de célular', allowBlank: true },
		{ xtype: 'textfield', name: 'observations', fieldLabel: 'Observaciones', allowBlank: true }
	],
	// Reset and Submit buttons
	buttons: [
		{
			text: 'Limpiar',
			handler: function() {
				this.up('form').getForm().reset();
			}
		},
		{
			text: 'Guardar',
			action: 'add',
			//itemId: 'save',
			iconCls: 'save',
		},
	],
});
