Ext.define('Application.view.contact.Form', {
	extend: 'Ext.window.Window',
	alias: 'widget.contactForm',
	height: 400,
	width: 500,
	layout: 'fit',
	iconCls: 'icon-user',
	title: 'Editar contacto',
	autoShow: true,
	modal: true,
	layout: 'column',
	items: [
		{
			xtype: 'form',
			bodyPadding: 10,
			defaultType: 'textfield',
			defaults: {
				anchor: '100%',
			},
			items :[
				{ id: 'clientNameTextField', name: 'name', fieldLabel: 'Nombre<span class="req">*</span>', allowBlank: false, colspan: 2, halign: 'right' },
				{ id: 'clientIdentificationTextField', name: 'identification', fieldLabel: 'Identificación', colspan: 2 },
				{
					xtype: 'fieldcontainer',
					fieldLabel: 'Address',
					// The body area will contain three text fields, arranged
					// horizontally, separated by draggable splitters.
					layout: 'hbox',
					columnWidth: 1,
					items: [{
						xtype: 'textfield',
						columnWidth: 0.5,
					}, {
						xtype: 'splitter',
					}, {
						xtype: 'textfield',
						columnWidth: 0.5,
					}],
				},
				{ name: 'address', fieldLabel: 'Dirección' },
				{ name: 'email', fieldLabel: 'Correo electrónico' },
				{ name: 'phonePrimary', fieldLabel: 'Teléfono 1' },
				{ name: 'phoneSecondary', fieldLabel: 'Teléfono 2' },
				{ name: 'fax', fieldLabel: 'Fax' },
				{ name: 'mobile', fieldLabel: 'Celular' },
				{ name: 'priceList', fieldLabel: 'Lista de precios', allowBlank: true },
				{ name: 'seller', fieldLabel: 'Vendedor', allowBlank: true },
				{ name: 'term', fieldLabel: 'Términos de pago', allowBlank: true },
				{ name: 'isClient', fieldLabel: 'Cliente', allowBlank: true },
				{ name: 'isProvider', fieldLabel: 'Proveedor', allowBlank: true },
				{ name: 'observations', fieldLabel: 'Observaciones', allowBlank: true },
				{ name: 'balanceAdvances', fieldLabel: 'Incluir estado de cuenta', allowBlank: true },
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
					text: 'Salir',
					action: 'cancel',
					itemId: 'cancelar',
					iconCls: 'cancel',
					handler: function(){
						this.up('window').close();
					}
				},
				{
					text: 'Guardar',
					action: 'save',
					itemId: 'salvar',
					iconCls: 'save'
				},
			],
		},
	],
});
