Ext.define('Application.view.contact.Window', {
	extend: 'Ext.window.Window',
	title: 'Editando registro',
	width: 400,
	height: 400,
	layout: 'fit',
	autoShow: true,
	modal: true,
	alias: 'widget.contactEdit',
	initComponent: function() {
		this.items = [
			Ext.widget('contactForm'),
		];
		this.callParent(arguments);
	},
});
