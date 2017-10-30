Ext.define('Application.view.contact.Show', {
	extend: 'Ext.window.Window',
	alias: 'widget.contactShow',
	layout: 'fit',
	iconCls: 'icon-user',
	title: 'Detalles de contacto',
	autoShow: true,
	modal: true,
	items: [
		{
			xtype: 'form',
			bodyPadding: 10,
			defaultType: 'displayfield',
			store: 'record',
			defaults: {
				anchor: '100%'
			},
			items: [
				{ xtype: 'hiddenfield', name: 'id' },
				{	xtype: 'displayfield', name: 'name', fieldLabel: 'Nombre' },
				{ xtype: 'displayfield', name: 'identification', fieldLabel: 'Identificación' },
				{ xtype: 'displayfield', name: 'phonePrimary', fieldLabel: 'Teléfono' },
				{ xtype: 'displayfield', name: 'phoneSecondary', fieldLabel: 'Teléfono 2' },
				{ xtype: 'displayfield', name: 'mobile', fieldLabel: 'Celular' },
				{ xtype: 'displayfield', name: 'address', fieldLabel: 'Dirección' },
				{ xtype: 'displayfield', name: 'city', fieldLabel: 'Ciudad' },
				{ xtype: 'displayfield', name: 'email', fieldLabel: 'Correo electrónico' },
				{ xtype: 'displayfield', name: 'observations', fieldLabel: 'Observaciones' },
			],
		},
	],
	dockedItems: [
		{
			xtype: 'toolbar',
			dock: 'bottom',
			layout: {
				type: 'hbox',
				pack: 'end'
			},
			items: [
				{
					xtype: 'button',
					text: 'Cancelar',
					itemId: 'cancel',
					iconCls: 'cancel',
					handler: function(){
						this.up('window').close();
					},
				},
			],
		},
	],
});
